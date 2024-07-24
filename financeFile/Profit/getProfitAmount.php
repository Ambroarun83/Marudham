<?php

include('../../ajaxconfig.php');
$user_id = ($_POST['user_id'] != '') ? $_POST['user_id'] : '';


$type = $_POST['type'];

if ($type == 'today') {

    $where = " DATE(coll_date) = CURRENT_DATE  ";
    $condition = getSubareaList($con, $user_id); //condition will be returned if user id selected

    getDetials($con, $where, $condition);
} else if ($type == 'day') {

    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $where = " (DATE(coll_date) >= DATE('$from_date') && DATE(coll_date) <= DATE('$to_date'))  ";
    $condition = getSubareaList($con, $user_id); //condition will be returned if user id selected

    getDetials($con, $where, $condition);
} else if ($type == 'month') {

    $month = date('m', strtotime($_POST['month']));
    $year = date('Y', strtotime($_POST['month']));

    $where = " (MONTH(coll_date) = '$month' && YEAR(coll_date) = '$year')  ";
    $condition = getSubareaList($con, $user_id); //condition will be returned if user id selected

    getDetials($con, $where, $condition);
}


function getDetials($con, $where, $condition)
{

    $res['interest_paid'] = 0;
    $res['interest_amount'] = 0;
    $res['principal_paid'] = 0;
    $res['due_amt_track'] = 0;
    $qry1 = $con->query("SELECT req_id from in_acknowledgement where cus_status > 13 "); // >13 means entries moved to collection from issue
    if ($qry1->num_rows > 0) {
        while ($row1 = $qry1->fetch_assoc()) {

            $qry = $con->query("SELECT req_id from in_verification where req_id = '" . $row1['req_id'] . "' $condition "); //will check based on user's branch if user selected
            //will show only interest amunt under user's branch not others also
            if ($qry->num_rows > 0) {

                $qry = $con->query("SELECT req_id,principal_amt_cal,int_amt_cal,due_period from acknowlegement_loan_calculation where req_id = '" . $row1['req_id'] . "' and due_type != 'Interest' ");
                //excluding due type interest , coz interest loans will be sepately calculated. those interest will be collected every month as due amount
                if ($qry->num_rows > 0) {
                    $row = $qry->fetch_assoc();
                    $principal_amt_cal = intVal($row['principal_amt_cal'] ?? 0);
                    $int_amt_cal = intVal($row['int_amt_cal'] ?? 0);
                    $due_period = intVal($row['due_period'] ?? 0);
                    $nonint_req_id = $row['req_id'];

                    $qry = $con->query("SELECT sum(due_amt_track) as due_amt_track from collection where req_id = '" . $nonint_req_id . "' and $where ");
                    $row = $qry->fetch_assoc();
                    $paidAmt = $row['due_amt_track'];
                    if ($paidAmt != null) {
                        $data = calculatePrincipalAndInterest($principal_amt_cal / $due_period, $int_amt_cal / $due_period, $paidAmt);
                        $res['interest_paid'] += $data['interest_paid'];
                        $res['principal_paid'] += $data['principal_paid'];
                        $res['due_amt_track'] += $paidAmt;
                    }
                } else {
                    $qry = $con->query("SELECT req_id from acknowlegement_loan_calculation where req_id = '" . $row1['req_id'] . "' and due_type = 'Interest' ");

                    if ($qry->num_rows > 0) {
                        $row = $qry->fetch_assoc();
                        $nonint_req_id = $row['req_id'];

                        $qry = $con->query("SELECT sum(int_amt_track) as int_amt_track from collection where req_id = '" . $nonint_req_id . "' and $where ");
                        $row = $qry->fetch_assoc();
                        $interest_amount = $row['int_amt_track'];
                        if ($interest_amount != null) {
                            $res['interest_amount'] += $interest_amount;
                        }
                    }
                }
            }
        }
    }
    $response['split_interest'] = moneyFormatIndia($res['due_amt_track'] - $res['principal_paid']);
    $response['interest_amount'] = moneyFormatIndia($res['interest_amount']);

    echo json_encode($response);
}

function getSubareaList($con, $user_id)
{

    if ($user_id != '') { //to get user's sub area id based on user's branch assigned

        $userQry = $con->query("SELECT * FROM USER WHERE user_id = $user_id ");
        while ($rowuser = $userQry->fetch_assoc()) {
            $line_id = $rowuser['line_id'];
        }
        $line_id = explode(',', $line_id);
        $sub_area_list = array();
        foreach ($line_id as $line) {
            $groupQry = $con->query("SELECT * FROM area_line_mapping where map_id = $line ");
            $row_sub = $groupQry->fetch_assoc();
            $sub_area_list[] = $row_sub['sub_area_id'];
        }
        $sub_area_ids = array();
        foreach ($sub_area_list as $subarray) {
            $sub_area_ids = array_merge($sub_area_ids, explode(',', $subarray));
        }
        $sub_area_list = array();
        $sub_area_list = implode(',', $sub_area_ids);
    } else {
        $sub_area_list = '';
    }
    $condition = ($sub_area_list != '') ? " and FIND_IN_SET(sub_area ,'" . $sub_area_list . "')" : '';
    return $condition;
}

/*** Calculates the principal and interest paid based on the principal amount, interest amount, and the paid amount.*/
function calculatePrincipalAndInterest($principal,  $interest,  $paidAmount): array
{
    $principal_paid = 0;
    $interest_paid = 0;

    while ($paidAmount > 0) {
        if ($paidAmount >= $principal) {
            $principal_paid += $principal;
            $paidAmount -= $principal;
        } else {
            $principal_paid += $paidAmount;
            break;
        }

        if ($paidAmount >= $interest) {
            $interest_paid += $interest;
            $paidAmount -= $interest;
        } else {
            $interest_paid += $paidAmount;
            break;
        }
    }

    return [
        'principal_paid' => (int) $principal_paid,
        'interest_paid' => (int) $interest_paid
    ];
}

//Format number in Indian Format
function moneyFormatIndia($num)
{
    $isNegative = false;
    if ($num < 0) {
        $isNegative = true;
        $num = abs($num);
    }

    $explrestunits = "";
    if (strlen((string)$num) > 3) {
        $lastthree = substr((string)$num, -3);
        $restunits = substr((string)$num, 0, -3);
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
        $expunit = str_split($restunits, 2);
        foreach ($expunit as $index => $value) {
            if ($index == 0) {
                $explrestunits .= (int)$value . ",";
            } else {
                $explrestunits .= $value . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }

    return $isNegative ? "-" . $thecash : $thecash;
}

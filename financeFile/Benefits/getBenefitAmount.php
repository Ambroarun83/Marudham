<?php
session_start();
include ('../../ajaxconfig.php');
$userid = $_SESSION['userid'];
if($userid != ''){//to get user's sub area id based on user's branch assigned

    $userQry = $con->query("SELECT * FROM USER WHERE user_id = $userid ");
    while($rowuser = $userQry->fetch_assoc()){
        $group_id = $rowuser['group_id'];
    }
    $group_id = explode(',',$group_id);
    $sub_area_list = array();
    foreach($group_id as $group){
        $groupQry = $con->query("SELECT * FROM area_group_mapping where map_id = $group ");
        $row_sub = $groupQry->fetch_assoc();
        $sub_area_list[] = $row_sub['sub_area_id'];
    }
    $sub_area_ids = array();
    foreach ($sub_area_list as $subarray) {
        $sub_area_ids = array_merge($sub_area_ids, explode(',',$subarray));
    }
    $sub_area_list = array();
    $sub_area_list = implode(',',$sub_area_ids);
}


$type = $_POST['type'];

if($type == 'today'){
    $where = " DATE(updated_date) = CURRENT_DATE and cus_status > 13 ";
    getDetials($con,$sub_area_list, $where);
    

}else if($type == 'day'){

    $from_date = $_POST['from_date'];$to_date = $_POST['to_date'];
    $where = " (DATE(updated_date) >= DATE('$from_date') && DATE(updated_date) <= DATE('$to_date')) and cus_status > 13 ";
    getDetials($con,$sub_area_list, $where);
    

}else if($type == 'month'){
    
    $month = date('m',strtotime($_POST['month']));
    $year = date('Y',strtotime($_POST['month']));
    $where = " (MONTH(updated_date) = '$month' && YEAR(updated_date) = '$year') and cus_status > 13 ";
    getDetials($con,$sub_area_list, $where);

}


function getDetials($con,$sub_area_list, $where){
    
    $benefit_amount = 0;//interest amount
    $interest_amount = 0;//interest amount on interest type loans

    $qry1 = $con->query("SELECT req_id from in_acknowledgement where $where ");// >13 means entries moved to collection from issue
    
    if($qry1->num_rows > 0){
        while($row1 = $qry1->fetch_assoc()){
            
            $qry = $con->query("SELECT req_id from in_verification where req_id = '".$row1['req_id']."' and FIND_IN_SET(sub_area ,'".$sub_area_list."') ");//will check based on user's branch
            //will show only interest amunt under user's branch not others also
            if($qry->num_rows > 0){
                $qry = $con->query("SELECT int_amt_cal from acknowlegement_loan_calculation where req_id = '".$row1['req_id']."' and due_type != 'Interest' ");
                //excluding due type interest , coz interest loans will be sepately calculated. those interest will be collected every month as due amount
                $row = $qry->fetch_assoc();
                $benefit_amount += intVal($row['int_amt_cal']??0);

                $qry = $con->query("SELECT int_amt_cal from acknowlegement_loan_calculation where req_id = '".$row1['req_id']."' and due_type = 'Interest' ");
                //getting only due type interest 
                $row = $qry->fetch_assoc();
                $interest_amount += intVal($row['int_amt_cal']??0);
            }
        }
    }
    

    $response['benefit_amount'] = moneyFormatIndia($benefit_amount);
    $response['interest_amount'] = moneyFormatIndia($interest_amount);

    echo json_encode($response);
}

//Format number in Indian Format
function moneyFormatIndia($num1) {
    if($num1 < 0){
        $num = str_replace("-","",$num1);
    }else{
        $num = $num1;
    }
    $explrestunits = "";
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3);
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            if ($i == 0) {
                $explrestunits .= (int)$expunit[$i] . ",";
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }

    if($num1 < 0 && $num1 != ''){
        $thecash = "-" . $thecash;
    }

    return $thecash;
}
?>
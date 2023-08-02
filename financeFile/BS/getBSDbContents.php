<?php
session_start();
$userid = $_SESSION['userid'];

include ('../../ajaxconfig.php');

$type = $_POST['type'];

if($type == 'today'){

    $where = " DATE(created_date) = CURRENT_DATE && insert_login_id = '".$userid."' ";
    getDetails($con, $where);
        

}else if($type == 'day'){

    $from_date = $_POST['from_date'];$to_date = $_POST['to_date'];
    $where = " (DATE(created_date) >= DATE('".$from_date."') && DATE(created_date) <= DATE('".$to_date."')) && insert_login_id = '".$userid."' ";
    getDetails($con, $where);

        
}else if($type == 'month'){
    
    $month = date('m',strtotime($_POST['month']));
    $year = date('Y',strtotime($_POST['month']));

    $where = " MONTH(created_date) = '".$month."' && YEAR(created_date) = '".$year."' && insert_login_id = '".$userid."' ";
    getDetails($con, $where);
    
}




function getDetails($con, $where){
    // Issued
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_db_hissued WHERE $where
        UNION ALL
        SELECT netcash FROM ct_db_bissued WHERE $where
    ) AS combined_table");

    $row = $qry->fetch_assoc();
    $issued = $row['amt'] ?? 0;

    $response['issued'] = intval($issued);
    
    // Expense
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_db_hexpense WHERE $where
        UNION ALL
        SELECT amt FROM ct_db_bexpense WHERE $where
    ) AS combined_table");

    $row = $qry->fetch_assoc();
    $expense = $row['amt'] ?? 0;

    $response['expense'] = intval($expense);
    
    // Bank Deposit
    $qry = $con->query("SELECT SUM(amount) as amt FROM ct_db_bank_deposit WHERE $where ");

    $row = $qry->fetch_assoc();
    $bank_deposit = $row['amt'] ?? 0;

    $response['bank_deposit'] = intval($bank_deposit);
    
    // Cash Withdrawal
    $qry = $con->query("SELECT SUM(amt) as amt FROM ct_db_cash_withdraw WHERE $where ");

    $row = $qry->fetch_assoc();
    $cash_withdrawal = $row['amt'] ?? 0;

    $response['cash_withdrawal'] = intval($cash_withdrawal);


    $response['issued'] = moneyFormatIndia($response['issued']);
    $response['expense'] = moneyFormatIndia($response['expense']);
    $response['bank_deposit'] = moneyFormatIndia($response['bank_deposit']);
    $response['cash_withdrawal'] = moneyFormatIndia($response['cash_withdrawal']);

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
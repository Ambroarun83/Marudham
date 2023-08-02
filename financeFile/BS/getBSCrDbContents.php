<?php
session_start();
$userid = $_SESSION['userid'];

include ('../../ajaxconfig.php');

$type = $_POST['type'];

if($type == 'today'){
    $where = 'DATE(created_date) = CURRENT_DATE && insert_login_id ="'.$userid.'" ';
    getDetails($con,$where); //passing where clause as arg

}else if($type == 'day'){

    $from_date = $_POST['from_date'];$to_date = $_POST['to_date'];
    
    $where = '(DATE(created_date) >= DATE("'.$from_date.'") && DATE(created_date) <= DATE("'.$to_date.'")) && insert_login_id = "'.$userid.'" ';
    getDetails($con, $where);//passing where clause as arg
        

}else if($type == 'month'){
    
    $month = date('m',strtotime($_POST['month']));
    $year = date('Y',strtotime($_POST['month']));

    $where = 'MONTH(created_date) = "'.$month.'" && YEAR(created_date) = "'.$year.'" && insert_login_id = "'.$userid.'" ';
    getDetails($con, $where);//passing where clause as arg
}




function getDetails($con, $where){
    
    // Investment Credit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_cr_binvest WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_cr_hinvest WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $investment = $row['amt'] ?? 0;
    
    $response['cr_investment'] = intval($investment);

    // Investment Debit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_db_binvest WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_db_hinvest WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $investment = $row['amt'] ?? 0;
    
    $response['db_investment'] = intval($investment);


    // Deposit Credit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_cr_bdeposit WHERE ".$where."
        ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $deposit = $row['amt'] ?? 0;
    
    $response['cr_deposit'] = intval($deposit);
    
    // Deposit Debit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_db_bdeposit WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $deposit = $row['amt'] ?? 0;
    
    $response['db_deposit'] = intval($deposit);

    // EL Credit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_cr_bel WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_cr_hel WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $el = $row['amt'] ?? 0;
    
    $response['cr_el'] = intval($el);

    // EL Debit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_db_bel WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_db_hel WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $el = $row['amt'] ?? 0;
    
    $response['db_el'] = intval($el);
    
    // Exchange Credit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_cr_bexchange WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_cr_hexchange WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $exchange = $row['amt'] ?? 0;
    
    $response['cr_exchange'] = intval($exchange);

    // Exchange Debit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_db_bexchange WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_db_hexchange WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $exchange = $row['amt'] ?? 0;
    
    $response['db_exchange'] = intval($exchange);
    
    // Agent Credit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_cr_bag WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_cr_hag WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $agent = $row['amt'] ?? 0;
    
    $response['cr_agent'] = intval($agent);
    
    // Agent Debit
    $qry = $con->query("SELECT SUM(amt) as amt FROM (
        SELECT amt FROM ct_db_bag WHERE ".$where."
        UNION ALL
        SELECT amt FROM ct_db_hag WHERE ".$where."
    ) AS combined_table");
    
    $row = $qry->fetch_assoc();
    $agent = $row['amt'] ?? 0;
    
    $response['db_agent'] = intval($agent);


    
    $response['cr_investment'] = moneyFormatIndia($response['cr_investment']);
    $response['db_investment'] = moneyFormatIndia($response['db_investment']);
    $response['cr_deposit'] = moneyFormatIndia($response['cr_deposit']);
    $response['db_deposit'] = moneyFormatIndia($response['db_deposit']);
    $response['cr_el'] = moneyFormatIndia($response['cr_el']);
    $response['db_el'] = moneyFormatIndia($response['db_el']);
    $response['cr_exchange'] = moneyFormatIndia($response['cr_exchange']);
    $response['db_exchange'] = moneyFormatIndia($response['db_exchange']);
    $response['cr_agent'] = moneyFormatIndia($response['cr_agent']);
    $response['db_agent'] = moneyFormatIndia($response['db_agent']);

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
<?php
session_start();
$userid = $_SESSION['userid'];

include ('../../ajaxconfig.php');

$type = $_POST['type'];

if($type == 'today'){
    
    $qry = $con->query("SELECT SUM(due_amt_track) as total_collection from collection where DATE(created_date) = CURRENT_DATE ");
    
    if($qry->num_rows > 0){
        $row = $qry->fetch_assoc();
        $response['collection'] = $row['total_collection'] ?? 0;
    }else{
        $response['collection'] = 0;
    }

}else if($type == 'day'){

    $from_date = $_POST['from_date'];$to_date = $_POST['to_date'];
    $qry = $con->query("SELECT SUM(due_amt_track) as total_collection from collection where (DATE(created_date) >= DATE($from_date) && DATE(created_date) <= DATE($to_date)) ");

    if($qry->num_rows > 0){
        $row = $qry->fetch_assoc();
        $response['collection'] = $row['total_collection'] ?? 0;
    }else{
        $response['collection'] = 0;
    }

}else if($type == 'month'){
    
    $month = date('m',strtotime($_POST['month']));
    $year = date('Y',strtotime($_POST['month']));

    $qry = $con->query("SELECT SUM(due_amt_track) as total_collection from collection where (MONTH(created_date) = $month and YEAR(created_date) = $year) ");

    if($qry->num_rows > 0){
        $row = $qry->fetch_assoc();
        $response['collection'] = $row['total_collection'] ?? 0;
    }else{
        $response['collection'] = 0;
    }
}
$response['collection'] = moneyFormatIndia($response['collection']);

echo json_encode($response);


?>


<?php

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
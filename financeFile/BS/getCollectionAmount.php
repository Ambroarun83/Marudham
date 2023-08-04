<?php
// session_start();
// $userid = $_SESSION['userid'];

include ('../../ajaxconfig.php');

$type = $_POST['type'];
$user_id = ($_POST['user_id'] != '') ? $where = " and insert_login_id = '".$_POST['user_id']."' " : $where = '';//for user based

if($type == 'today'){
    
    $qry = $con->query("SELECT SUM(due_amt_track) as total_collection,SUM(pre_close_waiver) as total_waiver from collection where DATE(created_date) = CURRENT_DATE $where ");
    


    if($qry->num_rows > 0){
        $row = $qry->fetch_assoc();
        $response['collection'] = ($row['total_collection'] ?? 0) + ($row['total_waiver'] ?? 0);
    }else{
        $response['collection'] = 0;
    }

}else if($type == 'day'){

    $from_date = $_POST['from_date'];$to_date = $_POST['to_date'];
    $qry = $con->query("SELECT SUM(due_amt_track) as total_collection,SUM(pre_close_waiver) as total_waiver from collection where (DATE(created_date) >= '$from_date' && DATE(created_date) <= '$to_date' ) $where ");

    if($qry->num_rows > 0){
        $row = $qry->fetch_assoc();
        $response['collection'] = ($row['total_collection'] ?? 0) + ($row['total_waiver'] ?? 0);
    }else{
        $response['collection'] = 0;
    }

}else if($type == 'month'){
    
    $month = date('m',strtotime($_POST['month']));
    $year = date('Y',strtotime($_POST['month']));

    $qry = $con->query("SELECT SUM(due_amt_track) as total_collection,SUM(pre_close_waiver) as total_waiver from collection where (MONTH(created_date) = '$month' and YEAR(created_date) = $year) $where ");

    if($qry->num_rows > 0){
        $row = $qry->fetch_assoc();
        $response['collection'] = ($row['total_collection'] ?? 0) + ($row['total_waiver'] ?? 0);
    }else{
        $response['collection'] = 0;
    }
}
$response['collection'] = moneyFormatIndia($response['collection']);

echo json_encode($response);


?>


<?php

//Format number in Indian Format
function moneyFormatIndia($num) {
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
?>
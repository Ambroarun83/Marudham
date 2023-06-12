<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../../ajaxconfig.php');

$to_user_id = $_POST['user_id'];
$remark = $_POST['remark'];
$amt = $_POST['amt'];

$response = '';

$qry = $con->query("INSERT INTO `ct_db_hexchange`(`to_user_id`, `remark`, `amt`, `insert_login_id`, `created_date`) 
    VALUES ('$to_user_id','$remark','$amt','$user_id',now())");

if($qry){
    $response = "Submitted Successfully";
}else{
    $response = "Error";
}

echo $response;
?>
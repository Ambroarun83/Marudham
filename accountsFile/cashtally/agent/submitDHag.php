<?php

session_start();
$user_id= $_SESSION['userid'];

include('../../../ajaxconfig.php');

$ag_id = $_POST['ag_id'];
$remark = $_POST['remark'];
$amt = $_POST['amt'];


$qry = $con->query("INSERT INTO `ct_db_hag`(`ag_id`,`remark`, `amt`, `insert_login_id`, `created_date`) 
VALUES ('$ag_id','$remark','$amt','$user_id',now())");

if($qry){
    $response = "Submitted Successfully";
}else{
    $response = "Error While Submitting";
}

echo $response;


?>
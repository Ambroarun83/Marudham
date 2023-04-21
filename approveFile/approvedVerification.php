<?php 
session_start();
include('../ajaxconfig.php');
if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}


    $selectIC = $con->query("UPDATE request_creation set cus_status = 3, update_login_id = $userid WHERE  req_id = '".$req_id."' ") or die('Error on Request Table');
    $selectIC = $con->query("UPDATE customer_register set cus_status = 3 WHERE req_ref_id = '".$req_id."' ")or die('Error on Customer Table');
    $selectIC = $con->query("UPDATE in_verification set cus_status = 3, update_login_id = $userid WHERE req_id = '".$req_id."' ") or die('Error on inVerification Table');
    $selectIC = $con->query("UPDATE in_approval set `cus_status`= 3 where `req_id`= '".$req_id."' ") or die('Error on in-Approval Table');
    $insertACK = $con->query("INSERT INTO `in_acknowledgement`(`req_id`, `cus_id`, `cus_status`, `status`, `insert_login_id`) 
    SELECT req_id,cus_id,cus_status,status,update_login_id from in_verification where req_id = '".$req_id."' ");

    $response = 'Verification Approved';
echo json_encode($response);
?>
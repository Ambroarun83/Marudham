<?php 
session_start();
include('../ajaxconfig.php');
if (isset($_POST['cus_id'])) {
    $cus_id = $_POST['cus_id'];
}
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}

//Closed  Completed And Move to NOC = 21.

    $selectIC = $con->query("UPDATE request_creation set cus_status = 21, update_login_id = $userid WHERE  cus_id = '".$cus_id."' && cus_status = '20' ") or die('Error on Request Table');
    $selectIC = $con->query("UPDATE customer_register set cus_status = 21 WHERE cus_id = '".$cus_id."' ")or die('Error on Customer Table');
    $selectIC = $con->query("UPDATE in_verification set cus_status = 21, update_login_id = $userid WHERE cus_id = '".$cus_id."' && cus_status = '20' ")or die('Error on inVerification Table');
    $selectIC = $con->query("UPDATE `in_approval` SET `cus_status`= 21,`update_login_id`= $userid WHERE  cus_id = '".$cus_id."' && cus_status = '20' ") or die('Error on in_approval Table');
    $selectIC = $con->query("UPDATE `in_acknowledgement` SET `cus_status`= 21,`update_login_id`= $userid WHERE  cus_id = '".$cus_id."' && cus_status = '20' ") or die('Error on in_acknowledgement Table');
    $insertIssue = $con->query("UPDATE `in_issue` SET `cus_status`= 21,`updated_date`=current_timestamp,`update_login_id` = $userid where cus_id = '".$cus_id."'  && cus_status = '20' ") or die('Error on in_issue Table');
    $updClosedSts = $con->query("UPDATE `closed_status` SET `cus_sts`='21',`update_login_id`=$userid,`updated_date`= now() WHERE `cus_sts`='20' && `cus_id`='".$cus_id."' ") or die('Error on closed_status Table');

    $response = 'Customer Moved to NOC';
    echo json_encode($response);
?>
<?php 
session_start();
include('../ajaxconfig.php');
if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}

//Issue  Completed And Move to Collection = 14.

    $selectIC = $con->query("UPDATE request_creation set cus_status = 14, update_login_id = $userid WHERE  req_id = '".$req_id."' ") or die('Error on Request Table');
    // $selectIC = $con->query("UPDATE customer_register set cus_status = 14 WHERE req_ref_id = '".$req_id."' ")or die('Error on Customer Table');
    $selectIC = $con->query("UPDATE in_verification set cus_status = 14, update_login_id = $userid WHERE req_id = '".$req_id."' ")or die('Error on inVerification Table');
    $selectIC = $con->query("UPDATE `in_approval` SET `cus_status`= 14,`update_login_id`= $userid WHERE  req_id = '".$req_id."' ") or die('Error on in_approval Table');
    $selectIC = $con->query("UPDATE `in_acknowledgement` SET `cus_status`= 14,`update_login_id`= $userid WHERE  req_id = '".$req_id."' ") or die('Error on in_acknowledgement Table');
    $insertIssue = $con->query("UPDATE `in_issue` SET `cus_status`= 14,`update_login_id` = $userid where req_id = '".$req_id."' ") or die('Error on in_issue Table');

    $response = 'Moved to Collection';
    echo json_encode($response);
?>
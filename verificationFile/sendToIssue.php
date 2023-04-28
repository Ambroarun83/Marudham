<?php 
session_start();
include('../ajaxconfig.php');
if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}

//Move to Issue = 13.

    $selectIC = $con->query("UPDATE request_creation set cus_status = 13, update_login_id = $userid WHERE  req_id = '".$req_id."' ") or die('Error on Request Table');
    $selectIC = $con->query("UPDATE customer_register set cus_status = 13 WHERE req_ref_id = '".$req_id."' ")or die('Error on Customer Table');
    $selectIC = $con->query("UPDATE in_verification set cus_status = 13, update_login_id = $userid WHERE req_id = '".$req_id."' ")or die('Error on inVerification Table');
    $selectIC = $con->query("UPDATE `in_approval` SET `cus_status`= 13 WHERE  req_id = '".$req_id."' ") or die('Error on in_approval Table');
    $selectIC = $con->query("UPDATE `in_acknowledgement` SET `cus_status`= 13 WHERE  req_id = '".$req_id."' ") or die('Error on in_acknowledgement Table');
    $insertIssue = $con->query("INSERT INTO `in_issue`(`req_id`, `cus_id`, `cus_status`, `status`, `insert_login_id`, `created_date`)  
    SELECT req_id,cus_id,cus_status,status,update_login_id,now() from in_verification where req_id = '".$req_id."' ");

    $response = 'Moved to Issue';
    echo json_encode($response);
?>
<?php
session_start();
include_once '../ajaxconfig.php';

if (isset($_SESSION['userid'])) {
    $userid  = $_SESSION['userid'];
}
if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}
if (isset($_POST['cus_id'])) {
    $cus_id = $_POST['cus_id'];
}
if (isset($_POST['cus_name'])) {
    $cus_name = $_POST['cus_name'];
}
if (isset($_POST['area_id'])) {
    $area_id =  $_POST['area_id'];
}
if (isset($_POST['sub_area_id'])) {
    $sub_area_id = $_POST['sub_area_id'];
}
if (isset($_POST['branch_id'])) {
    $branch_id = $_POST['branch_id'];
}
if (isset($_POST['line_id'])) {
    $line_id = $_POST['line_id'];
}
if (isset($_POST['mobile1'])) {
    $mobile1 = $_POST['mobile1'];
}
if (isset($_POST['cus_image'])) {
    $cus_image = $_POST['cus_image'];
}
if (isset($_POST['loan_category_id'])) {
    $loan_category_id = $_POST['loan_category_id'];
}
if (isset($_POST['sub_category_id'])) {
    $sub_category_id = $_POST['sub_category_id'];
}
if (isset($_POST['status'])) {
    $status = $_POST['status'];
}
if (isset($_POST['sub_status'])) {
    $sub_status = $_POST['sub_status'];
}
if (isset($_POST['tot_amt'])) {
    $tot_amt = $_POST['tot_amt'];
}
if (isset($_POST['paid_amt'])) {
    $paid_amt = $_POST['paid_amt'];
}
if (isset($_POST['bal_amt'])) {
    $bal_amt = $_POST['bal_amt'];
}
if (isset($_POST['due_amt'])) {
    $due_amt = $_POST['due_amt'];
}
if (isset($_POST['pending_amt'])) {
    $pending_amt = $_POST['pending_amt'];
}
if (isset($_POST['payable_amt'])) {
    $payable_amt = $_POST['payable_amt'];
}
if (isset($_POST['penalty'])) {
    $penalty = $_POST['penalty'];
}
if (isset($_POST['coll_charge'])) {
    $coll_charge = $_POST['coll_charge'];
}
if (isset($_POST['collection_mode'])) {
    $collection_mode = $_POST['collection_mode'];
}
if (isset($_POST['bank_id'])) {
    $bank_id = $_POST['bank_id'];
}
if (isset($_POST['cheque_no'])) {
    $cheque_no = $_POST['cheque_no'];
}
if (isset($_POST['trans_id'])) {
    $trans_id = $_POST['trans_id'];
}
if (isset($_POST['trans_date'])) {
    $trans_date = $_POST['trans_date'];
}
if (isset($_POST['collection_loc'])) {
    $collection_loc = $_POST['collection_loc'];
}
if (isset($_POST['collection_date'])) {
    $collection_date = date('Y-m-d', strtotime($_POST['collection_date']));
}
if (isset($_POST['collection_id'])) {
    $collection_id = $_POST['collection_id'];
}
if (isset($_POST['due_amt_track'])) {
    $due_amt_track = $_POST['due_amt_track'];
}
if (isset($_POST['princ_amt_track'])) {
    $princ_amt_track = $_POST['princ_amt_track'];
}
if (isset($_POST['int_amt_track'])) {
    $int_amt_track = $_POST['int_amt_track'];
}
$penalty_track = '';
if (isset($_POST['penalty_track'])) {
    $penalty_track = $_POST['penalty_track'];
}
$coll_charge_track = '';
if (isset($_POST['coll_charge_track'])) {
    $coll_charge_track = $_POST['coll_charge_track'];
}
if (isset($_POST['total_paid_track'])) {
    $total_paid_track = $_POST['total_paid_track'];
}
$pre_close_waiver = '';
if (isset($_POST['pre_close_waiver'])) {
    $pre_close_waiver = $_POST['pre_close_waiver'];
}
$penalty_waiver = '';
if (isset($_POST['penalty_waiver'])) {
    $penalty_waiver = $_POST['penalty_waiver'];
}
$coll_charge_waiver = '';
if (isset($_POST['coll_charge_waiver'])) {
    $coll_charge_waiver = $_POST['coll_charge_waiver'];
}
$total_waiver = '';
if (isset($_POST['total_waiver'])) {
    $total_waiver = $_POST['total_waiver'];
}

$insertQry = "INSERT INTO `collection`(  `coll_code`, `req_id`, `cus_id`, `cus_name`, `branch`, `area`, `sub_area`, `line`, `loan_category`, `sub_category`, `coll_status`, 
    `coll_sub_status`, `tot_amt`, `paid_amt`, `bal_amt`, `due_amt`, `pending_amt`, `payable_amt`, `penalty`, `coll_charge`, `coll_mode`, `bank_id`, `cheque_no`, `trans_id`, `trans_date`, 
    `coll_location`, `coll_date`, `due_amt_track`,`princ_amt_track`,`int_amt_track`, `penalty_track`, `coll_charge_track`, `total_paid_track`, `pre_close_waiver`, `penalty_waiver`, `coll_charge_waiver`, 
    `total_waiver`, `insert_login_id`,`created_date`)  VALUES('" . strip_tags($collection_id) . "','" . strip_tags($req_id) . "','" . strip_tags($cus_id) . "','" . strip_tags($cus_name) . "',
    '" . strip_tags($branch_id) . "', '" . strip_tags($area_id) . "', '" . strip_tags($sub_area_id) . "', '" . strip_tags($line_id) . "','" . strip_tags($loan_category_id) . "',
    '" . strip_tags($sub_category_id) . "','" . strip_tags($status) . "','" . strip_tags($sub_status) . "', '" . strip_tags($tot_amt) . "', '" . strip_tags($paid_amt) . "', 
    '" . strip_tags($bal_amt) . "','" . strip_tags($due_amt) . "','" . strip_tags($pending_amt) . "','" . strip_tags($payable_amt) . "','" . strip_tags($penalty) . "','" . strip_tags($coll_charge) . "',
    '" . strip_tags($collection_mode) . "','" . strip_tags($bank_id) . "','" . strip_tags($cheque_no) . "','" . strip_tags($trans_id) . "','" . strip_tags($trans_date) . "','" . strip_tags($collection_loc) . "',
    '" . strip_tags($collection_date) . "','" . strip_tags($due_amt_track) . "','" . strip_tags($princ_amt_track) . "','" . strip_tags($int_amt_track) . "','" . strip_tags($penalty_track) . "','" . strip_tags($coll_charge_track) . "','" . strip_tags($total_paid_track) . "',
    '" . strip_tags($pre_close_waiver) . "','" . strip_tags($penalty_waiver) . "','" . strip_tags($coll_charge_waiver) . "','" . strip_tags($total_waiver) . "',$userid,current_timestamp )";

$insresult = $mysqli->query($insertQry) or die("Error " . $mysqli->error);

if ($penalty_track != '' or $penalty_waiver != '') {
    $qry = $mysqli->query("INSERT INTO penalty_charges (`req_id`,`paid_date`,`paid_amnt`,`waiver_amnt`)VALUES('" . strip_tags($req_id) . "','" . strip_tags($collection_date) . "',
        '" . strip_tags($penalty_track) . "','" . strip_tags($penalty_waiver) . "')");
}
if ($coll_charge_track != '' or $coll_charge_waiver != '') {
    $qry = $mysqli->query("INSERT INTO collection_charges (`req_id`,`paid_date`,`paid_amnt`,`waiver_amnt`)VALUES('" . strip_tags($req_id) . "','" . strip_tags($collection_date) . "',
        '" . strip_tags($coll_charge_track) . "','" . strip_tags($coll_charge_waiver) . "')");
}

if ($cheque_no != '') {
    $qry = $mysqli->query("UPDATE `cheque_no_list` SET `used_status`='1' WHERE `id`=$cheque_no "); //If cheque has been used change status to 1
}

$check = intval($due_amt_track) + intval($pre_close_waiver) - intval($bal_amt);

if (($princ_amt_track != '' or $int_amt_track != '') and ($due_amt_track == '' or $due_amt_track == 0 or $due_amt_track == null)) {
    // if this condition is true then it will be the interest based loan. coz thats where we able to give princ/int amt track and not able to give due amt track
    //if yes then $check variable should check with principal amt
    $check = intVal($princ_amt_track) + intVal($pre_close_waiver) - intval($bal_amt);
}

$penalty_check = intval($penalty_track) + intval($penalty_waiver) - intval($penalty);
$coll_charge_check = intval($coll_charge_track) + intval($coll_charge_waiver) - intval($coll_charge);

if ($check == 0 && $penalty_check == 0 && $coll_charge_check == 0) {
    $cus_status = 20;
    $mysqli->query("UPDATE request_creation set cus_status = $cus_status,updated_date=now(), update_login_id = $userid WHERE  req_id = '" . $req_id . "' ") or die('Error on Request Table');
    // $mysqli->query("UPDATE customer_register set cus_status = 14 WHERE req_ref_id = '".$req_id."' ")or die('Error on Customer Table');
    $mysqli->query("UPDATE in_verification set cus_status = $cus_status,updated_date=now(), update_login_id = $userid WHERE req_id = '" . $req_id . "' ") or die('Error on inVerification Table');
    $mysqli->query("UPDATE `in_approval` SET `cus_status`= $cus_status,updated_date=now(),`update_login_id`= $userid WHERE  req_id = '" . $req_id . "' ") or die('Error on in_approval Table');
    $mysqli->query("UPDATE `in_acknowledgement` SET `cus_status`= $cus_status,updated_date=now(),`update_login_id`= $userid WHERE  req_id = '" . $req_id . "' ") or die('Error on in_acknowledgement Table');
    $mysqli->query("UPDATE `in_issue` SET `cus_status`= $cus_status, `update_login_id` = $userid where req_id = '" . $req_id . "' ") or die('Error on in_issue Table');
    $mysqli->query("INSERT INTO `closing_customer` (req_id,cus_id,closing_date) VALUES ($req_id, $cus_id, DATE(now()) ) ") or die('Error on closing_customer Table');
}
// $qry = $con->query("SELECT customer_name, mobile1 from customer_register where req_ref_id = '$req_id' ");
// $row = $qry->fetch_assoc();
// $customer_name = $row['customer_name'];
// $cus_mobile1 = $row['mobile1'];

// $message = "";
// $templateid	= ''; //FROM DLT PORTAL.
// // Account details
// $apiKey = '';
// // Message details
// $sender = '';
// // Prepare data for POST request
// $data = 'access_token='.$apiKey.'&to='.$cus_mobile1.'&message='.$message.'&service=T&sender='.$sender.'&template_id='.$templateid;
// // Send the GET request with cURL
// $url = 'https://sms.messagewall.in/api/v2/sms/send?'.$data; 
// $response = file_get_contents($url);  
// // Process your response here
// return $response; 


if ($insresult) {
    $response['info'] = 'Success';
    $response['coll_id'] = $collection_id;
} else {
    $response['info'] = 'Error';
}

echo json_encode($response);

$con->close();
$mysqli->close();
$connect = null;

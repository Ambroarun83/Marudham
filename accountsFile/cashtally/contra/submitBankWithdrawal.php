<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../../ajaxconfig.php');


$bwd_id = $_POST['bwd_id'];
$bank_id = $_POST['bank_id_bwd'];
$from_bank = $_POST['from_bank_bwd'];
$acc_no = $_POST['acc_no_bwd'];
$ref_code = $_POST['ref_code_bwd'];
$trans_id = $_POST['trans_id_bwd'];
$amt = $_POST['amt_bwd'];
$remark = $_POST['remark_bwd'];



$qry = $con->query("UPDATE ct_db_cash_withdraw set received = 0 where id = '$bwd_id' ");

$qry = $con->query("INSERT INTO `ct_cr_bank_withdraw`(`db_ref_id`, `remark`, `insert_login_id`, `created_date`) VALUES ('$bwd_id','$remark','".$user_id."',now())");

if($qry){
    $response = 'Submitted Successfully';
}else{
    $response = 'Error';
}

echo $response;

?>
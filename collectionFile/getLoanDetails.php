<?php 
session_start();
include('../ajaxconfig.php');

if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
}

if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
if(isset($_POST['cus_id'])){
    $cus_id = $_POST['cus_id'];
}

$response = array();
$result=$con->query("SELECT * FROM loan_calculation where status=0 and sub_category = '".strip_tags($sub_cat_id)."' ");
if($result->num_rows>0){
    
    $row = $result->fetch_assoc();
    $response['advance'] = $row['collection_info'];
    $response['loan_limit'] = $row['loan_limit'];
    $response['message'] ="";
}else{
    $response['message'] ="No Loan Calculation Made!";
}

echo json_encode($response);
?>
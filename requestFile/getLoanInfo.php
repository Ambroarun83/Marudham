<?php 
include('../ajaxconfig.php');
if(isset($_POST['sub_cat_id'])){
    $sub_cat_id = $_POST['sub_cat_id'];
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
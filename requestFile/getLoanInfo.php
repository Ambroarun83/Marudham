<?php 
include('../ajaxconfig.php');
if(isset($_POST['sub_cat_id'])){
    $sub_cat_id = $_POST['sub_cat_id'];
}

$result=$con->query("SELECT * FROM loan_calculation where status=0 and sub_category = '".strip_tags($sub_cat_id)."' ");
if($result->num_rows>0){
    
    $row = $result->fetch_assoc();
    $advance = $row['collection_info'];
}else{
    $advance ="No Loan Calculation Made!";
}

echo $advance;
?>
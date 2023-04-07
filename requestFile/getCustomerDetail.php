<?php 
include('../ajaxconfig.php');
if(isset($_POST['cus_id'])){
    $cus_id = $_POST['cus_id'];
}
// $cus_id='546546546465';
$records = array();

$result=$con->query("SELECT * FROM customer_register where cus_id = '".strip_tags($cus_id)."' ");
if($result->num_rows>0){
    $row = $result->fetch_assoc();

    $records['cus_name'] = $row['customer_name'];
    $records['dob'] = $row['dob'];
    $records['age'] = $row['age'];
    $records['gender'] = $row['gender'];
    $records['state'] = $row['state'];
    $records['district'] = $row['district'];
    $records['taluk'] = $row['taluk'];
    $records['area'] = $row['area'];
    $records['sub_area'] = $row['sub_area'];
    $records['address'] = $row['address'];
    $records['mobile1'] = $row['mobile1'];
    $records['mobile2'] = $row['mobile2'];
    $records['father_name'] = $row['father_name'];
    $records['mother_name'] = $row['mother_name'];
    $records['marital'] = $row['marital'];
    $records['spouse'] = $row['spouse'];
    $records['occupation_type'] = $row['occupation_type'];
    $records['occupation'] = $row['occupation'];
    $records['pic'] = $row['pic'];

    $records['message'] = "Existing";
    
}else{
    $records['message'] = "New";
}

echo json_encode($records);
?>
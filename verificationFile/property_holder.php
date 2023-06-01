<?php 
include('../ajaxconfig.php');

$Membername_arr = array();

$cus_id =$_POST['cus_id'];
$result = $connect->query("SELECT famname FROM `verification_family_info` where cus_id = '$cus_id' ");

while( $row = $result->fetch()){
    $Membername_arr[] = $row['famname'];
}

echo json_encode($Membername_arr);
?>
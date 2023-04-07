<?php 
include('../ajaxconfig.php');

$Membername_arr = array();

$req_id =$_POST['reqId'];
$result = $connect->query("SELECT famname FROM `verification_family_info` where req_id = '$req_id' ");

while( $row = $result->fetch()){
    $Membername_arr[] = $row['famname'];
}

echo json_encode($Membername_arr);
?>
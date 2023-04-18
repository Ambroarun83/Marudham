<?php 
include('../ajaxconfig.php');

$famList_arr = array();

$reqId = $_POST['reqId'];
$result = $connect->query("SELECT id,famname,relationship FROM `verification_family_info` where req_id='$reqId'");

while( $row = $result->fetch()){
    $fam_name = $row['famname'];
     $fam_id = $row['id'];
     $relationship = $row['relationship'];
    $famList_arr[] = array("fam_id" => $fam_id, "fam_name" => $fam_name, "relationship" => $relationship);
}

echo json_encode($famList_arr);
?>
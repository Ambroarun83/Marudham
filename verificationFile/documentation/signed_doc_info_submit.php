<?php
require '../../ajaxconfig.php';

$req_id                = $_POST['reqId'];
$doc_name              = $_POST['doc_name'];
$sign_type             = $_POST['sign_type'];
$signType_relationship = $_POST['signType_relationship'];
$doc_Count             = $_POST['doc_Count'];
$cus_profile_id        = $_POST['cus_profile_id'];
$signedID              = $_POST['signedID'];


if($signedID == ''){

$insert_qry = $connect ->query("INSERT INTO `signed_doc_info`(`doc_name`, `sign_type`, `signType_relationship`, `doc_Count`, `req_id`, `cus_profile_id`) VALUES ('$doc_name','$sign_type','$signType_relationship','$doc_Count','$req_id','$cus_profile_id')");

}
else{
    
 $update = $connect->query("UPDATE `signed_doc_info` SET `doc_name`='$doc_name',`sign_type`='$sign_type',`signType_relationship`='$signType_relationship',`doc_Count`='$doc_Count' WHERE `id`='$signedID' ");

}

if($insert_qry){
    $result = "Signed Doc Info Inserted Successfully.";
}
elseif($update){
    $result = "Signed Doc Info Updated Successfully.";
}

echo json_encode($result);

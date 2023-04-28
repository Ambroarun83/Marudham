<?php
require '../ajaxconfig.php';

$req_id                = $_POST['reqId'];
$feedback_label        = $_POST['feedback_label'];
$cus_feedback              = $_POST['cus_feedback'];
$feedback_remark              = $_POST['feedback_remark'];
$feedbackID              = $_POST['feedbackID'];


if($feedbackID == ''){

$insert_qry = $connect ->query("INSERT INTO `verification_cus_feedback`( `req_id`, `feedback_label`, `cus_feedback`,`feedback_remark`) VALUES ('$req_id','$feedback_label','$cus_feedback','$feedback_remark')");

}
else{
    
 $update = $connect->query("UPDATE `verification_cus_feedback` SET `req_id`='$req_id',`feedback_label`='$feedback_label',`cus_feedback`='$cus_feedback',`feedback_remark`='$feedback_remark' WHERE `id`='$feedbackID' ");

}

if($insert_qry){
    $result = "Feedback Inserted Successfully.";
}
elseif($update){
    $result = "Feedback Updated Successfully.";
}

echo json_encode($result);
?>
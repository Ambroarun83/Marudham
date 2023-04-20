<?php
require '../ajaxconfig.php';

$req_id                = $_POST['reqId'];
$feedback_label        = $_POST['feedback_label'];
$cus_feedback              = $_POST['cus_feedback'];
$feedbackID              = $_POST['feedbackID'];


if($feedbackID == ''){

$insert_qry = $connect ->query("INSERT INTO `verification_cus_feedback`( `req_id`, `feedback_label`, `cus_feedback`) VALUES ('$req_id','$feedback_label','$cus_feedback')");

}
else{
    
 $update = $connect->query("UPDATE `verification_cus_feedback` SET `req_id`='$req_id',`feedback_label`='$feedback_label',`cus_feedback`='$cus_feedback' WHERE `id`='$feedbackID' ");

}

if($insert_qry){
    $result = "Feedback Inserted Successfully.";
}
elseif($update){
    $result = "Feedback Updated Successfully.";
}

echo json_encode($result);
?>
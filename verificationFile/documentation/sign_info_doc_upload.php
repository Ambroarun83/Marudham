<?php
require '../../ajaxconfig.php';

$req_id                = $_POST['doc_req_id'];
$cus_id                = $_POST['doc_cus_id'];
$signedID              = $_POST['signedID'];
$filesArr3             = $_FILES['signdoc_upd'];

$connect->query("DELETE FROM `signed_doc` WHERE `signed_doc_id` ='$signedID'");

 foreach($filesArr3['name'] as $key=>$val)
 {
	 $fileName = basename($filesArr3['name'][$key]);  
	 $targetFilePath = "../../uploads/verification/signed_doc/".$fileName; 

		 // Upload file to server  
		 if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  

             $update =  $connect->query("INSERT INTO `signed_doc`(`cus_id`,`req_id`,`signed_doc_id`, `upload_doc_name`) VALUES ('$cus_id','$req_id','$signedID','$fileName')");
	 }
 }

if($update){
    $result = "Signed Doc Info Uploaded Successfully.";
}

echo json_encode($result);

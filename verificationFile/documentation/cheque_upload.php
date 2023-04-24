<?php
require '../../ajaxconfig.php';

$req_id                = $_POST['cheque_req_id'];
$chequeID              = $_POST['chequeID'];
$filesArr3             = $_FILES['cheque_upd'];

 foreach($filesArr3['name'] as $key=>$val)
 {
	 $fileName = basename($filesArr3['name'][$key]);  
	 $targetFilePath = "../../uploads/verification/cheque_upd/".$fileName; 

		 // Upload file to server  
		 if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  

             $update =  $connect->query("INSERT INTO `cheque_upd`(`req_id`, `cheque_table_id`, `upload_cheque_name`) VALUES ('$req_id','$chequeID','$fileName')");
	 }
 }

if($update){
    $result = "Cheque Uploaded Successfully.";
}

echo json_encode($result);

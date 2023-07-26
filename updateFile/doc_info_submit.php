<?php
session_start();

require '../ajaxconfig.php';

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}
if(isset($_POST['doc_info_id'])){
    $doc_id = $_POST['doc_info_id'];
}

$doc_upload ='';
if(isset($_FILES['document_info_upd'])){

    $fileArray = $_FILES['document_info_upd'];
    $uploadDir = "../uploads/verification/doc_info/";
    // File upload path  
    foreach($fileArray['name'] as $key=>$val)
    {
        $fileName = basename($fileArray['name'][$key]);  
        $targetFilePath = $uploadDir . $fileName; 
        
        // Check whether file type is valid  
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
        
        // Upload file to server  
        if(move_uploaded_file($fileArray["tmp_name"][$key], $targetFilePath)){  
            $doc_upload .= $fileName.',';  
        }
    }
    $doc_upload = rtrim($doc_upload,',');
}


    $update = $connect->query("UPDATE `document_info` SET `doc_upload`='$doc_upload',`update_login_id`= $userid,`updated_date`=now()  WHERE `id`='$doc_id' ");

    if($update){
        $result = "Document Info Updated Successfully.";
    }



echo $result;
?>

<?php
require '../ajaxconfig.php';

$cus_id                = $_POST['cus_id'];
$chequeID              = $_POST['chequeID'];
$filesArr3             = $_FILES['cheque_upd'];
$cheque_upd_no         = explode(',',$_POST['cheque_upd_no']);
$holder_type           = $_POST['holder_type'];

if($holder_type == '0' || $holder_type == '1'){
$holderName = $_POST['holder_name'];
}else{
$holderName = $_POST['holder_relationship_name'];
}

$connect->query("DELETE FROM `cheque_upd` WHERE `cheque_table_id`='$chequeID'");
$connect->query("DELETE FROM `cheque_no_list` WHERE `cheque_table_id`='$chequeID'");

foreach($filesArr3['name'] as $key=>$val)
{
    $fileName = basename($filesArr3['name'][$key]);  
    $targetFilePath = "../uploads/verification/cheque_upd/".$fileName; 

        // Upload file to server  
        if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  

            $update =  $connect->query("INSERT INTO `cheque_upd`(`cus_id`, `cheque_table_id`, `upload_cheque_name`) VALUES ('$cus_id','$chequeID','$fileName')");
    }
}


foreach($cheque_upd_no as $chequeNo){
$insert  = $connect->query("INSERT INTO `cheque_no_list`( `cus_id`,`cheque_table_id`, `cheque_holder_type`, `cheque_holder_name`, `cheque_no`) VALUES ('$cus_id','$chequeID',' $holder_type','$holderName','$chequeNo')");
}


if($update || $insert){
    $result = "Cheque Uploaded Successfully.";
}

echo json_encode($result);

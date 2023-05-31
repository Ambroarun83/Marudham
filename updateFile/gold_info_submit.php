<?php
require '../ajaxconfig.php';

$cus_id                = $_POST['cus_id'];
$gold_sts        = $_POST['gold_sts'];
$gold_type              = $_POST['gold_type'];
$Purity             = $_POST['Purity'];
$gold_Count = $_POST['gold_Count'];
$gold_Weight             = $_POST['gold_Weight'];
$gold_Value             = $_POST['gold_Value'];
$goldID             = $_POST['goldID'];



if($goldID == ''){

$insert_qry = $connect ->query("INSERT INTO `gold_info`(`cus_id`, `gold_sts`, `gold_type`, `Purity`, `gold_Count`, `gold_Weight`, `gold_Value`) VALUES ('$cus_id','$gold_sts','$gold_type','$Purity','$gold_Count','$gold_Weight','$gold_Value')");

}
else{
$update = $connect->query("UPDATE `gold_info` SET `cus_id`='$cus_id',`gold_sts`='$gold_sts',`gold_type`='$gold_type',`Purity`='$Purity',`gold_Count`='$gold_Count',`gold_Weight`='$gold_Weight',`gold_Value`='$gold_Value' WHERE `id`='$goldID' ");

}

if($insert_qry){
    $result = "Gold Info Inserted Successfully.";
}
elseif($update){
    $result = "Gold Info Updated Successfully.";
}

echo json_encode($result);

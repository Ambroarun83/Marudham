<?php
require '../ajaxconfig.php';

$reqId                   = $_POST['reqId'];
$famname                 = $_POST['famname'];
$realtionship            = $_POST['realtionship'];

if($realtionship  == 'Other'){
    $other_remark            = $_POST['other_remark'];
    $other_address           = $_POST['other_address'];
}
else{
    $other_remark            = null;
    $other_address           = null;
}


$relation_age            = $_POST['relation_age'];
$relation_aadhar         = $_POST['relation_aadhar'];
$relation_Mobile         = $_POST['relation_Mobile'];
$relation_Occupation     = $_POST['relation_Occupation'];
$relation_Income         = $_POST['relation_Income'];
$relation_Blood          = $_POST['relation_Blood'];
$famTableId              = $_POST['famTableId'];


if($famTableId == ''){

$insert_qry = $connect ->query("INSERT INTO `verification_family_info`(`req_id`, `famname`, `relationship`, `other_remark`, `other_address`, `relation_age`, `relation_aadhar`, `relation_Mobile`, `relation_Occupation`, `relation_Income`, `relation_Blood`) VALUES ('$reqId','$famname','$realtionship','$other_remark','$other_address ','$relation_age','$relation_aadhar','$relation_Mobile','$relation_Occupation','$relation_Income','$relation_Blood')");

}
else{
 $update = $connect->query("UPDATE `verification_family_info` SET `req_id`='$reqId',`famname`='$famname',`relationship`='$realtionship',`other_remark`='$other_remark',`other_address`='$other_address',`relation_age`='$relation_age',`relation_aadhar`='$relation_aadhar',`relation_Mobile`='$relation_Mobile',`relation_Occupation`='$relation_Occupation',`relation_Income`='$relation_Income',`relation_Blood`='$relation_Blood' WHERE id = '$famTableId ' ");

}

if($insert_qry){
    $result = "Family Info Inserted Successfully.";
}
elseif($update){
    $result = "Family Info Updated Successfully.";
}

echo json_encode($result);

?>
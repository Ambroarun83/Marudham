<?php
require '../ajaxconfig.php';

if(isset($_POST['reqId'])){
    $req_id = $_POST['reqId'];
}

$NameList = array();

$names = $connect->query("SELECT `famname`,`relation_aadhar`,`relation_Mobile` FROM `verification_family_info` WHERE  req_id = '$req_id' ");

while($famName = $names->fetch()){
    $famname = $famName['famname'];
    $aadhar = $famName['relation_aadhar'];
    $mobile = $famName['relation_Mobile'];

    $NameList[] = array("fam_name" => $famname, "aadhar" => $aadhar, "mobile" => $mobile);
}

// $names = $connect->query("SELECT `group_name`,`group_aadhar`,`group_mobile` FROM `verification_group_info` WHERE  req_id = '$req_id' ");

// while($grpName = $names->fetch()){
//     $famname = $grpName['group_name'];
//     $aadhar = $grpName['group_aadhar'];
//     $mobile = $grpName['group_mobile'];

//     $NameList[] = array("fam_name" => $famname, "aadhar" => $aadhar, "mobile" => $mobile);
// }

echo json_encode($NameList);
?>
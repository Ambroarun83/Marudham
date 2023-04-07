<?php
require '../ajaxconfig.php';

// $reqId = '4';
if(isset($_POST['reqId'])){
    $reqId = $_POST['reqId'];
}
// $proof = '1';
if(isset($_POST['proof'])){
    $proof = $_POST['proof'];
}

$KYCProof = array();
$proofs = $connect -> query("SELECT proof_type FROM `verification_kyc_info` WHERE req_id = '".$reqId."' && proofOf ='".$proof."' ");
$cnt = $proofs->rowCount();
if($cnt > 0){
    while($kyc_Proof = $proofs->fetch()){
        $KYCProof[] = $kyc_Proof['proof_type'];
    }
}

echo json_encode($KYCProof);
?>



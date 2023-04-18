<?php
require '../../ajaxconfig.php';

$id = $_POST['id'];

$ChequeDoc = array();

$chequeInfo = $connect -> query("SELECT * FROM `cheque_info` WHERE id='$id' ");
$cheque_details = $chequeInfo->fetch();

$ChequeDoc['id'] = $cheque_details['id'];
$ChequeDoc['holder_type'] = $cheque_details['holder_type'];
$ChequeDoc['holder_name'] = $cheque_details['holder_name'];
$ChequeDoc['holder_relationship_name'] = $cheque_details['holder_relationship_name'];
$ChequeDoc['cheque_relation'] = $cheque_details['cheque_relation'];
$ChequeDoc['chequebank_name'] = $cheque_details['chequebank_name'];
$ChequeDoc['cheque_count'] = $cheque_details['cheque_count'];

echo json_encode($ChequeDoc);
?>
<?php
session_start();

require '../../ajaxconfig.php';

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}
if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
if(isset($_POST['doc_id'])){
    $doc_id = $_POST['doc_id'];
}
if(isset($_POST['doc_name'])){
    $doc_name = $_POST['doc_name'];
}
if(isset($_POST['doc_details'])){
    $doc_details = $_POST['doc_details'];
}
if(isset($_POST['doc_type'])){
    $doc_type = $_POST['doc_type'];
}
if(isset($_POST['doc_holder'])){
    $doc_holder = $_POST['doc_holder'];
}
if(isset($_POST['holder_name'])){
    $holder_name = $_POST['holder_name'];
}
if(isset($_POST['relation_name'])){
    $relation_name = $_POST['relation_name'];
}
if(isset($_POST['relation'])){
    $relation = $_POST['relation'];
}


if($doc_id == ''){

    $insert_qry = $connect ->query("INSERT INTO `document_info`( `req_id`, `doc_name`, `doc_detail`, `doc_type`, `doc_holder`, `holder_name`,`relation_name`, `relation`, `insert_login_id`,`created_date`) 
    VALUES ('$req_id','$doc_name','$doc_details','$doc_type','$doc_holder','$holder_name','$relation_name','$relation','$userid',now())");

    if($insert_qry){
        $result = "Document Info Inserted Successfully.";
    }
}
else{
    
    $update = $connect->query("UPDATE `document_info` SET `req_id`='$req_id',`doc_name`='$doc_name',`doc_detail`='$doc_details',`doc_type`='$doc_type',`doc_holder`='$doc_holder',
    `holder_name`='$holder_name',`relation_name`='$relation_name',`relation`='$relation',`update_login_id`=$userid WHERE `id`='$doc_id' ");

    if($update){
        $result = "Document Info Updated Successfully.";
    }
}


echo json_encode($result);

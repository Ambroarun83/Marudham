<?php
session_start();

require '../ajaxconfig.php';

$table_obj = ['sign'=>'signed_doc','cheque'=>'cheque_no_list','gold'=>'gold_info','document'=>'document_info'];
$table_id_obj = ['sign'=>'signed_doc_id','cheque'=>'cheque_table_id','document'=>'id'];

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}
if(isset($_POST['type'])){
    $type = $_POST['type'];
    $temp_sts = ($type=='out')?'1':'0';
}
if(isset($_POST['table_id'])){
    $table_id = $_POST['table_id'];
}
if(isset($_POST['table_name'])){
    $table_name = $table_obj[$_POST['table_name']];
    $table_col = $table_id_obj[$_POST['table_name']];
}
if(isset($_POST['temp_person'])){
    $temp_person = $_POST['temp_person'];
    if($temp_person == '1'){
        $temp_name = $_POST['temp_name'];
    }else{
        $temp_name = $_POST['temp_rel_name'];
    }
}



$update = $con->query("UPDATE $table_name SET `temp_sts`='$temp_sts',`temp_date`=date(now()),`temp_person`='$temp_person',`temp_name`='$temp_name',
    `update_login_id`= $userid,`updated_date`=now()  WHERE $table_col = '$table_id' ");

if($update){
    $result = "Successfully Submitted!";
}else{
    $result = "Error While Submitting!";
}



echo json_encode($result);
?>

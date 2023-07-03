<?php
require '../ajaxconfig.php';

if(isset($_POST['reqId'])){
    $reqId = $_POST['reqId'];
}


$records = array();
$run = $connect -> query("SELECT famname FROM `verification_family_info` WHERE req_id = '".$reqId."' ");
$cnt = $run->rowCount();
if($cnt > 0){
    while($row = $run->fetch()){
        $records[] = $row['famname'];
    }
}

echo json_encode($records);
?>



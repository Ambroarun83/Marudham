<?php

include('../../ajaxconfig.php');


if(isset($_POST['cus_id'])){
    $cus_id = preg_replace('/\D/', '',$_POST['cus_id']);
}
if(isset($_POST['cus_name'])){
    $cus_name = $_POST['cus_name'];
}
if(isset($_POST['cus_mob'])){
    $cus_mob = $_POST['cus_mob'];
}
if(isset($_POST['area'])){
    $area = $_POST['area'];
}
if(isset($_POST['sub_area'])){
    $sub_area = $_POST['sub_area'];
}

$sql = $con->query("SELECT * FROM new_promotion WHERE cus_id = '$cus_id'");

if($sql->num_rows > 0){
    $sql = $con->query("UPDATE new_promotion SET cus_name = '$cus_name', mobile = '$cus_mob', area = '$area', sub_area = '$sub_area' WHERE cus_id = '$cus_id'");
    if($sql){
        $response = 'Updated Successfully';
    }else{
        $response = 'Error While Updating';
    }
}else{
    $sql = $con->query("INSERT INTO new_promotion(cus_id, cus_name, mobile, area, sub_area) VALUES('$cus_id', '$cus_name', '$cus_mob', '$area', '$sub_area')");
    if($sql){
        $response = 'Inserted Successfully';
    }else{
        $response = 'Error While Inserting';
    }
}

echo json_encode($response);
?>
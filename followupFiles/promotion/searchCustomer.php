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

if($cus_id != ''){
    $sql = $con->query("SELECT a.cus_id,a.customer_name,a.mobile1,b.area_name,c.sub_area_name FROM customer_register a JOIN area_list_creation b ON a.area = b.area_id JOIN sub_area_list_creation c ON a.sub_area = c.sub_area_id WHERE a.cus_id = '$cus_id' ");

    if($sql->num_rows){
        $row = $sql->fetch_assoc();
        foreach($row as $key => $value){
            $response[$key] = $value;
        }
    }

}else if($cus_name != ''){
    $sql = $con->query("SELECT a.cus_id,a.customer_name,a.mobile1,b.area_name,c.sub_area_name FROM customer_register a JOIN area_list_creation b ON a.area = b.area_id JOIN sub_area_list_creation c ON a.sub_area = c.sub_area_id WHERE a.customer_name = '$cus_name' ");

    if($sql->num_rows){
        $row = $sql->fetch_assoc();
        foreach($row as $key => $value){
            $response[$key] = $value;
        }
    }
}else if($cus_mob != ''){
    $sql = $con->query("SELECT a.cus_id,a.customer_name,a.mobile1,b.area_name,c.sub_area_name FROM customer_register a JOIN area_list_creation b ON a.area = b.area_id JOIN sub_area_list_creation c ON a.sub_area = c.sub_area_id WHERE a.mobile1 = '$cus_mob' ");

    if($sql->num_rows){
        $row = $sql->fetch_assoc();
        foreach($row as $key => $value){
            $response[$key] = $value;
        }
    }
}

if($sql->num_rows){
    $response['status'] = 'Records Found';
}else{
    $response['status'] = 'No Records Found';
}


echo json_encode($response);



?>
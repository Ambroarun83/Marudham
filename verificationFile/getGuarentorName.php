<?php 
include('../ajaxconfig.php');

$famname = '';

$cus_id = $_POST['cus_id'];
$result = $connect->query("SELECT fam.famname FROM customer_profile cp JOIN verification_family_info fam ON cp.req_id = fam.req_id and cp.guarentor_name = fam.id where cp.cus_id='$cus_id'");

while( $row = $result->fetch()){
    $famname = $row['famname'];
}

echo $famname;
?>
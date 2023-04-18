<?php 
session_start();
include('../../ajaxconfig.php');

// if(isset($_SESSION['userid'])){
//     $userid = $_SESSION['userid'];
// }
if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
$detailrecords = array();


$result=$con->query("SELECT * FROM request_category_info where req_ref_id = $req_id ");
$i=0;
while($row = $result->fetch_assoc()){
    $detailrecords[$i] = $row['category_info'];
    $i++;
}


echo json_encode($detailrecords);
?>
<?php
include('../../ajaxconfig.php');

$opt_for = $_POST['opt_for'];

$i = 0;
$records = array();

$qry = $con->query("SELECT * from name_detail_creation WHERE opt_for = '$opt_for'");
while ($row = $qry->fetch_assoc()) {
    $records[$i]['name_id'] = $row['name_id'];
    $records[$i]['name'] = $row['name'];
    $records[$i]['area'] = $row['area'];
    $records[$i]['ident'] = $row['ident'];
    $i++;
}


echo json_encode($records);

$con->close();
$mysqli->close();
$connect = null;

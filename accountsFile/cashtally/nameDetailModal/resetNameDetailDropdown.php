<?php
include '../../../ajaxconfig.php';
$opt_for = $_POST['opt_for'];

$qry = "SELECT * FROM name_detail_creation WHERE opt_for = '$opt_for' and status=0 ";
$res = $mysqli->query($qry) or die("Error in Get All Records");
$i = 0;
$detailrecords = array();
while ($row = $res->fetch_object()) {
    $detailrecords[$i]     = [
        'name_id'   => $row->name_id,
        'name'   => $row->name,
        'area'   => $row->area,
        'ident'   => $row->ident,
    ];
    $i++;
}

echo json_encode($detailrecords);

$con->close();
$mysqli->close();
$connect = null;

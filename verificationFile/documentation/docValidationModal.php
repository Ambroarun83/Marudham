<?php
include('../../ajaxconfig.php');

if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}
if (isset($_POST['table'])) {
    $table = $_POST['table'];
}

$response = '';
$selectIC = $con->query("SELECT * FROM $table WHERE req_id = '" . $req_id . "' ") or die('Error on the Table');
if ($selectIC->num_rows > 0) {
    $response = 1;
} else {
    $response = 0;
}

echo $response;

$con->close();
$mysqli->close();
$connect = null;

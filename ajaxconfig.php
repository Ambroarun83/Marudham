<?php
$timeZoneQry = "SET time_zone = '+5:30' ";

$host = "localhost";
$db_user = "root";
$db_pass = "";
$dbname = "marudham";
// $host = "mysql5045.site4now.net";
// $db_user = "a6c192_marudha";
// $db_pass = "marudham@123";
// $dbname = "db_a6c192_marudha";


$con = mysqli_connect($host, $db_user, $db_pass, $dbname) or die("Error in database connection" . mysqli_error($mysqli));
mysqli_set_charset($con, "utf8");
$con->query($timeZoneQry);


$connect = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass);
$connect->exec($timeZoneQry);

$mysqli = mysqli_connect($host, $db_user, $db_pass, $dbname);
mysqli_set_charset($mysqli, "utf8");
$mysqli->query($timeZoneQry);



date_default_timezone_set('Asia/Kolkata');

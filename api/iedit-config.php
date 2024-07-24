<?php

$host = "localhost";
$db_user = "root";
$db_pass = "";
$dbname = "marudham";
// $host = "mysql5045.site4now.net";
// $db_user = "a6c192_marudha";
// $db_pass = "marudham@123";
// $dbname = "db_a6c192_marudha";

$mysqli = mysqli_connect($host, $db_user, $db_pass, $dbname) or die("Error in database connection" . mysqli_error($mysqli));
mysqli_set_charset($mysqli, "utf8");
$timeZoneQry = "set time_zone = '+5:30' ";
$mysqli->query($timeZoneQry);

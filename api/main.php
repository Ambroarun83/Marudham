<?php
@session_start();  
include('config-file.php');
include("iedit-config.php");
include("adminclass.php");

$userObj = new admin();
$where = '';
$idupd ='';

$getuserdetails  = $userObj->getuser($mysqli, $idupd); 

date_default_timezone_set('Asia/Calcutta');
?>



<?php
@session_start();
include('config-file.php');
include("iedit-config.php");
include("adminclass.php");

$userObj = new admin();
$idupd = $_SESSION['userid'];

$getuserdetails  = $userObj->getuser($mysqli, $idupd);

date_default_timezone_set('Asia/Calcutta');

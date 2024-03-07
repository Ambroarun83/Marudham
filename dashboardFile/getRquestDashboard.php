<?php
include '../ajaxconfig.php';
include '../dashboardFile/requestDashboardClass.php';

$requestClass = new requestClass($con);


$response = $requestClass->getRequestCounts($con);

echo json_encode($response);
<?php
include('../ajaxconfig.php');
if (isset($_POST['cus_id'])) {
    $cus_id = $_POST['cus_id'];
}

$qry = $con->query("SELECT loan_limit FROM customer_register WHERE cus_id = $cus_id ");
if ($qry->num_rows > 0) {
    $cus_loan_limit = $qry->fetch_assoc()['loan_limit'];
    if ($cus_loan_limit != '' and $cus_loan_limit != NULL) {
        echo json_encode(['cus_limit' => $cus_loan_limit]);
    } else {
        echo json_encode(['cus_limit' => '']);
    }
} else {
    echo json_encode(['cus_limit' => '']);
}


$con->close();
$mysqli->close();
$connect = null;

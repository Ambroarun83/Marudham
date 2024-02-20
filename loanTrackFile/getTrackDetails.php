<?php
session_start();
include '../ajaxconfig.php';

$req_id = $_POST['req_id'] ?? '';
$i = 0;
$data = array();

$qry = $con->query("SELECT cus_status FROM request_creation where req_id = '$req_id' ");
$cus_status = $qry->fetch_assoc()['cus_status']??'';

if($cus_status != ''){
    $qry = $con->query("SELECT update_login_id,created_date from request_creation where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $data[] = array('stage'=>'Request','date'=>$row['created_date'],'user'=>$row['update_login_id']);

    $qry = $con->query("SELECT update_login_id,updated_date from request_creation where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $data[] = array('stage'=>'Request','date'=>$row['updated_date'],'user'=>$row['update_login_id']);

    $qry = $con->query("SELECT update_login_id,updated_date from request_creation where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $data[] = array('stage'=>'Request','date'=>$row['updated_date'],'user'=>$row['update_login_id']);

    $qry = $con->query("SELECT update_login_id,updated_date from request_creation where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $data[] = array('stage'=>'Request','date'=>$row['updated_date'],'user'=>$row['update_login_id']);
}

?>

<table>
    <thead>
        <th width="10%">S.No</th>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Loan Stage</th>
        <th>Updated Date</th>
        <th>Updated By</th>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $i + 1; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
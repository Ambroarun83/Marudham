<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../ajaxconfig.php');

$op_date = date('Y-m-d', strtotime($_POST['op_date']));

$li_count = 0;
$submitted_count = 0;

$qry = $con->query("SELECT COUNT(*) as li_count,created_date,insert_login_id FROM `loan_issue` where (agent_id = '' or agent_id = null) and date(created_date) = '$op_date' ");
if ($qry->num_rows > 0) {

    $row = $qry->fetch_assoc();
    $li_count = $row['li_count'];
    $insert_login_id = $row['insert_login_id'];
    $created_date = date('Y-m-d', strtotime($row['created_date']));

    $hissueQry = $con->query("SELECT COUNT(*) as hissue_count from ct_db_hissued where date(created_date) = '$created_date' and li_user_id = '$insert_login_id' ");
    $bissueQry = $con->query("SELECT COUNT(*) as bissue_count from ct_db_bissued where date(created_date) = '$created_date' and li_user_id = '$insert_login_id' ");

    $hissue_count = $hissueQry->fetch_assoc()['hissue_count'];
    $bissue_count = $bissueQry->fetch_assoc()['bissue_count'];

    $submitted_count = $hissue_count + $bissue_count;
}

if ($li_count == $submitted_count) {
    $response = "Today's Loan Issue Already Submitted";
} else {
    $response = "Today's Loan Issue Not Submitted";
}


echo $response;

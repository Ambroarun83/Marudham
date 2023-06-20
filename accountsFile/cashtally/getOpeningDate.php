<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../ajaxconfig.php');

$records = array();

$qry = $con->query("SELECT created_date FROM cash_tally where insert_login_id = '$user_id' and DATE_ADD(date(op_date),INTERVAL 1 DAY) = CURRENT_DATE() ");

if($qry->num_rows == '0'){
    // if this condition true, then today's cash tally has not been closed, so have to
    $qry = $con->query("SELECT date(op_date) as opening_date FROM cash_tally where insert_login_id = '$user_id' and date(created_date) < CURRENT_DATE() "); // then fetch the last updated date
    echo "SELECT date(op_date) as opening_date FROM cash_tally where insert_login_id = '$user_id' and date(created_date) < CURRENT_DATE() ";
    if($qry->num_rows >0){
        $row = $qry->fetch_assoc();
        $records['opening_date'] = date('d-m-Y',strtotime($row['opening_date']));
    }else{
        $records['opening_date'] = date('d-m-Y');
    }
    // $records['op_hand'] = $row['op_hand'];
    // $records['op_bank'] = $row['op_bank'];
    // $records['op_agent'] = $row['op_agent'];
    // $records['opening_bal'] = $row['opening_bal'];
    // $records['cl_hand'] = $row['cl_hand'];
    // $records['cl_bank'] = $row['cl_bank'];
    // $records['cl_agent'] = $row['cl_agent'];
    // $records['closing_bal'] = $row['closing_bal'];
}else{
    // if this condition true, then today's cash tally has been closed
    $records['opening_date'] = date('d-m-Y');
    // $records['op_hand'] = 0;
    // $records['op_bank'] = 0;
    // $records['op_agent'] = 0;
    // $records['opening_bal'] = 0;
    // $records['cl_hand'] = 0;
    // $records['cl_bank'] = 0;
    // $records['cl_agent'] = 0;
    // $records['closing_bal'] = 0;
}

echo json_encode($records);

?>
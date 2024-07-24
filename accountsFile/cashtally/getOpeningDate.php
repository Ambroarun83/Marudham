<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../ajaxconfig.php');

$records = array();

$qry1 = $con->query("SELECT created_date,closing_bal FROM cash_tally where insert_login_id = '$user_id' and date(cl_date) = CURRENT_DATE() ");

if($qry1->num_rows == '0'){
    // if this condition true, then today's cash tally has not been closed, so have to
    $qry = $con->query("SELECT date(cl_date) as closing_date,closing_bal FROM cash_tally where insert_login_id = '$user_id' and date(cl_date) < CURRENT_DATE() ORDER BY date(cl_date) DESC"); // then fetch the last updated date
    
    if($qry->num_rows != 0){
        $row = $qry->fetch_assoc();
        $records['opening_date'] = date('d-m-Y',strtotime($row['closing_date'].' +1 day'));
        $records['closing_bal'] = $row['closing_bal'];
    }else{
        $records['opening_date'] = date('d-m-Y');
        $records['closing_bal'] = 0;
    }
    
}else{
    // if this condition true, then today's cash tally has been closed
    $row1 = $qry1->fetch_assoc();
    $records['opening_date'] = date('d-m-Y',strtotime(''.' +1 day'));
    $records['closing_bal'] = $row1['closing_bal'];
    
}

echo json_encode($records);

?>
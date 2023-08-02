<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../ajaxconfig.php');

$type = $_POST['type'];

$records = array();


if($type == 'today'){

    $qry1 = $con->query("SELECT closing_bal FROM cash_tally where insert_login_id = '$user_id' and date(cl_date) = CURRENT_DATE() ");

    if($qry1->num_rows == '0'){
        // if this condition true, then today's cash tally has not been closed, so have to
        $qry = $con->query("SELECT closing_bal FROM cash_tally where insert_login_id = '$user_id' and date(cl_date) < CURRENT_DATE() ORDER BY date(cl_date) DESC"); // then fetch the last updated date
        
        if($qry->num_rows != 0){
            $row = $qry->fetch_assoc();
            $records['closing_bal'] = $row['closing_bal'];
        }else{
            $records['closing_bal'] = 0;
        }
    }else{
        // if this condition true, then today's cash tally has been closed
        $row1 = $qry1->fetch_assoc();
        $records['closing_bal'] = $row1['closing_bal'];
    }

}else if($type == 'day'){

    $from_date = $_POST['from_date'];$to_date = $_POST['to_date'];
    
    $qry1 = $con->query("SELECT closing_bal FROM cash_tally where insert_login_id = '$user_id' and (date(cl_date) >= DATE($from_date) && date(cl_date) <= DATE($to_date)) ORDER BY date(cl_date) DESC"); // then fetch the last updated date
    //this will check between two days
    if($qry1->num_rows == '0'){ // if nothing between two dates then take before date
        
        $qry = $con->query("SELECT closing_bal FROM cash_tally where insert_login_id = '$user_id' and date(cl_date) < DATE($from_date) ORDER BY date(cl_date) DESC"); 
        // it will get the last date entered
        
        if($qry->num_rows != 0){
            $row = $qry->fetch_assoc();
            $records['closing_bal'] = $row['closing_bal'];
        }else{
            $records['closing_bal'] = 0;
        }
    }else{
        // if this condition true, then today's cash tally has been closed
        $row1 = $qry1->fetch_assoc();
        $records['closing_bal'] = $row1['closing_bal'];
    }

}else if($type == 'month'){

    $month = date('m',strtotime($_POST['month']));
    $year = date('Y',strtotime($_POST['month']));


    $qry1 = $con->query("SELECT closing_bal FROM cash_tally where insert_login_id = '$user_id' and (month(cl_date) = $month && YEAR(cl_date) = '$year' ) ORDER BY date(cl_date) DESC"); // then fetch the last updated date
    //this will check within month
    if($qry1->num_rows == '0'){ // if nothing inside the month then take before month

        $qry = $con->query("SELECT closing_bal FROM cash_tally where insert_login_id = '$user_id' and (month(cl_date) = $month && YEAR(cl_date) = '$year') ORDER BY date(cl_date) DESC"); // then fetch the last updated date
            
        if($qry->num_rows != 0){
            $row = $qry->fetch_assoc();
            $records['closing_bal'] = $row['closing_bal'];
        }else{
            $records['closing_bal'] = 0;
        }
    }else{
        // if this condition true, then today's cash tally has been closed
        $row1 = $qry1->fetch_assoc();
        $records['closing_bal'] = $row1['closing_bal'];
    }

}




echo json_encode($records);

?>
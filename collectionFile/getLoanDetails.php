<?php 
session_start();
include('../ajaxconfig.php');

if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
}

if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
// $req_id = '11';//****************************************************************************************************************************************
if(isset($_POST['cus_id'])){
    $cus_id = $_POST['cus_id'];
}
//get Total amt from ack loan calculation (For monthly interest total amount will not be there, so take principals)*
//get Paid amt from collection table if nothing paid show 0*
//balance amount is Total amt - paid amt*
//get Due amt from ack loan calculation*
//get Pending amt from collection based on last entry against request id (Due amt - paid amt)
//get Payable amt by adding pending and due amount
//get penalty, if due date exceeded put the penalty percentage to the due amt
//get collection charges from collection charges table if exists else 0
$loan_arr = array();
$coll_arr = array();
$response = array(); //Final array to return

$result=$con->query("SELECT * FROM `acknowlegement_loan_calculation` WHERE req_id = $req_id ");
if($result->num_rows>0){
    $row = $result->fetch_assoc();
    $loan_arr = $row;

    if($loan_arr['tot_amt_cal'] == '' || $loan_arr['tot_amt_cal'] == null){
        //(For monthly interest total amount will not be there, so take principals)
        $response['total_amt'] = $loan_arr['principal_amt_cal'];
    }else{
        $response['total_amt'] = $loan_arr['tot_amt_cal'];
    }

    if($loan_arr['due_amt_cal'] == '' || $loan_arr['due_amt_cal'] == null){
        //(For monthly interest Due amount will not be there, so take interest)
        $response['due_amt'] = $loan_arr['int_amt_cal'];
    }else{
        $response['due_amt'] = $loan_arr['due_amt_cal']; //Due amount will remain same
    }
}

$result=$con->query("SELECT * FROM `collection` WHERE req_id = $req_id ");
if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
        $coll_arr[] = $row;
    }
    $total_paid=0;
    $pre_closure=0;
    foreach ($coll_arr as $tot) {
        $total_paid += intVal($tot['due_amt_track']); //only calculate due amount not total paid value, because it will have penalty and coll charge also
        $pre_closure += intVal($tot['pre_close_waiver']); //get pre closure value to subract to get balance amount
    }
    //total paid amount will be all records again request id should be summed
    $response['total_paid'] = $total_paid; 
    $response['pre_closure'] = $pre_closure; 

    //total amount subracted by total paid amount and subracted with pre closure amount will be balance to be paid
    $response['balance'] = $response['total_amt'] - $response['total_paid'] - $pre_closure;

    $response = calculateOthers($loan_arr,$response,$con);

    
}else{
    //If collection table dont have rows means there is no payment against that request, so total paid will be 0
    $response['total_paid'] = 0;
    
    //If in collection table, there is no payment means balance amount still remains total amount
    $response['balance'] = $response['total_amt'];
    
    $response = calculateOthers($loan_arr,$response,$con); 
}
//To get the collection charges
$result=$con->query("SELECT SUM(coll_charge) as coll_charge FROM `collection_charges` WHERE req_id = '".$req_id."' ");
$row = $result->fetch_assoc();
if($row['coll_charge'] != null){
    
    $coll_charges = $row['coll_charge'];

    $result=$con->query("SELECT SUM(coll_charge_track) as coll_charge_track,SUM(coll_charge_waiver) as coll_charge_waiver FROM `collection` WHERE req_id = '".$req_id."' ");
    if($result->num_rows >0){
        $row = $result->fetch_assoc();
        $coll_charge_track = $row['coll_charge_track'];
        $coll_charge_waiver = $row['coll_charge_waiver'];
    }else{
        $coll_charge_track = 0;
        $coll_charge_waiver = 0;
    }

    $response['coll_charge'] = $coll_charges - $coll_charge_track - $coll_charge_waiver;
}else{
    $response['coll_charge'] = 0;
}

function calculateOthers($loan_arr,$response,$con){
    if(isset($_POST['req_id'])){
        $req_id = $_POST['req_id'];
    }
    // $req_id = '11';//***************************************************************************************************************************************************
    $due_start_from = $loan_arr['due_start_from'];
    $maturity_month = $loan_arr['maturity_month'];

    if($loan_arr['due_method_calc'] == 'Monthly' || $loan_arr['due_method_scheme'] == '1'){
        //Convert Date to Year and month, because with date, it will use exact date to loop months, instead of taking end of month
        $due_start_from = date('Y-m',strtotime($due_start_from));
        $maturity_month = date('Y-m',strtotime($maturity_month));

        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        $current_date = date('Y-m');
        
        $start_date_obj = DateTime::createFromFormat('Y-m', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m', $current_date);

        $interval = new DateInterval('P1M'); // Create a one month interval

        $count = 0;
        $qry = $con->query("DELETE FROM penalty_charges where req_id = '$req_id' and (penalty_date != '' or penalty_date != NULL ) ");

        while ($start_date_obj < $end_date_obj && $start_date_obj < $current_date_obj) 
        {
            //To raise penalty in seperate table
            $penalty_raised_date  = $start_date_obj->format('Y-m');
            // If due month exceeded
            if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }else{
                $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }
            $row = $result->fetch_assoc();
            $penalty_per = $row['overdue'] ; //get penalty percentage to insert
            $penalty = number_format(($response['due_amt'] * $penalty_per) / 100);
            

            $qry = $con->query("INSERT into penalty_charges (`req_id`,`penalty_date`, `penalty`, `created_date`) values ('$req_id','$penalty_raised_date','$penalty',current_timestamp)");


            $start_date_obj->add($interval);
            $count++; //Count represents how many months are exceeded
        }
            // //Insert Penalty once again because its showing extra one penalty in collection for current month
            // $qry = $con->query("INSERT into penalty_charges (`req_id`,`penalty_date`, `penalty`, `created_date`) values ('$req_id','$penalty_raised_date','$penalty',current_timestamp)");
        if($count>0){
            // echo $count;
            //if Due month exceeded due amount will be as pending with how many months are exceeded and subract pre closure amount if available
            $response['pending'] = ($response['due_amt'] * $count) - $response['total_paid'] - $response['pre_closure'] ; 

            // If due month exceeded
            if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }else{
                $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }
            $row = $result->fetch_assoc();
            $penalty_per = number_format($row['overdue'] * $count); //Count represents how many months are exceeded//Number format if percentage exeeded decimals then pernalty may increase

            $result=$con->query("SELECT SUM(penalty_track) as penalty,SUM(penalty_waiver) as penalty_waiver FROM `collection` WHERE req_id = '".$req_id."' ");
            $row = $result->fetch_assoc();

            $penalty = number_format(($response['due_amt'] * $penalty_per) / 100);
            $response['penalty'] = $penalty - $row['penalty'] - $row['penalty_waiver'];

            //Payable amount will be pending amount added with current month due amount
            $response['payable'] = $response['due_amt'] + $response['pending'];
        }else{
            //If still current month is not ended, then pending will be same due amt
            $response['pending'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
            //If still current month is not ended, then penalty will be 0
            $response['penalty'] = 0;
            //If still current month is not ended, then payable will be due amt
            $response['payable'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
        }

    }else
    if($loan_arr['due_method_scheme'] == '2'){
        
        //If Due method is Weekly, Calculate penalty by checking the month has ended or not
        $current_date = date('Y-m-d');
        
        $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);

        $interval = new DateInterval('P1W'); // Create a one Week interval

        $count = 0;
        $qry = $con->query("DELETE FROM penalty_charges where req_id = '$req_id' and (penalty_date != '' or penalty_date != NULL ) ");
        while ($start_date_obj < $end_date_obj && $start_date_obj < $current_date_obj) 
        {
            //To raise penalty in seperate table
            $penalty_raised_date  = $start_date_obj->format('Y-m-d');
            // If due month exceeded
            if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }else{
                $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }
            $row = $result->fetch_assoc();
            $penalty_per = $row['overdue'] ; //get penalty percentage to insert
            
            $penalty = number_format(($response['due_amt'] * $penalty_per) / 100);

            $qry = $con->query("INSERT into penalty_charges (`req_id`,`penalty_date`, `penalty`, `created_date`) values ('$req_id','$penalty_raised_date','$penalty',current_timestamp)");


            $start_date_obj->add($interval);
            $count++; //Count represents how many months are exceeded
        }
        if($count>0){
            
            //if Due month exceeded due amount will be as pending with how many months are exceeded and subract pre closure amount if available
            $response['pending'] = ($response['due_amt'] * $count) - $response['total_paid'] - $response['pre_closure'] ; 

            // If due month exceeded
            if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }else{
                $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }
            $row = $result->fetch_assoc();
            $penalty_per = number_format($row['overdue'] * $count); //Count represents how many months are exceeded//Number format if percentage exeeded decimals then pernalty may increase

            $result=$con->query("SELECT SUM(penalty_track) as penalty,SUM(penalty_waiver) as penalty_waiver FROM `collection` WHERE req_id = '".$req_id."' ");
            $row = $result->fetch_assoc();

            $penalty = number_format(($response['due_amt'] * $penalty_per) / 100);
            $response['penalty'] = $penalty - $row['penalty'] - $row['penalty_waiver'];

            //Payable amount will be pending amount added with current month due amount
            $response['payable'] = $response['due_amt'] + $response['pending'];

        }else{
            //If still current month is not ended, then pending will be same due amt
            $response['pending'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
            //If still current month is not ended, then penalty will be 0
            $response['penalty'] = 0;
            //If still current month is not ended, then payable will be due amt
            $response['payable'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
        }

    }elseif($loan_arr['due_method_scheme'] == '3'){
        //If Due method is Daily, Calculate penalty by checking the month has ended or not
        $current_date = date('Y-m-d');
        
        $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);
        
        $interval = new DateInterval('P1D'); // Create a one Week interval

        $count = 0;
        $qry = $con->query("DELETE FROM penalty_charges where req_id = '$req_id' and (penalty_date != '' or penalty_date != NULL ) ");
        // echo "DELETE FROM penalty_charges where req_id = '$req_id' and (penalty_date != '' or penalty_date != NULL ) ";
        while ($start_date_obj < $end_date_obj && $start_date_obj < $current_date_obj) 
        {
            //To raise penalty in seperate table
            $penalty_raised_date  = $start_date_obj->format('Y-m-d');
            // If due month exceeded
            if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }else{
                $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }
            $row = $result->fetch_assoc();
            $penalty_per = $row['overdue'] ; //get penalty percentage to insert
            
            $penalty = ($response['due_amt'] * $penalty_per) / 100;

            $qry = $con->query("INSERT into penalty_charges (`req_id`,`penalty_date`, `penalty`, `created_date`) values ('$req_id','$penalty_raised_date','$penalty',current_timestamp)");

            $start_date_obj->add($interval);
            $count++; //Count represents how many months are exceeded
        }
        if($count>0){
            
            //if Due month exceeded due amount will be as pending with how many months are exceeded and subract pre closure amount if available
            $response['pending'] = ($response['due_amt'] * $count) - $response['total_paid'] - $response['pre_closure'] ; 

            // If due month exceeded
            if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }else{
                $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }
            $row = $result->fetch_assoc();
            $penalty_per = number_format($row['overdue'] * $count); //Count represents how many months are exceeded//Number format if percentage exeeded decimals then pernalty may increase
            
            $result=$con->query("SELECT SUM(penalty_track) as penalty,SUM(penalty_waiver) as penalty_waiver FROM `collection` WHERE req_id = '".$req_id."' ");
            $row = $result->fetch_assoc();

            $penalty = number_format(($response['due_amt'] * $penalty_per) / 100);
            $response['penalty'] = $penalty - $row['penalty'] - $row['penalty_waiver'];

            //Payable amount will be pending amount added with current month due amount
            $response['payable'] = $response['due_amt'] + $response['pending'];

        }else{
            //If still current month is not ended, then pending will be same due amt
            $response['pending'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
            //If still current month is not ended, then penalty will be 0
            $response['penalty'] = 0;
            //If still current month is not ended, then payable will be due amt
            $response['payable'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
        }
    }
    if($response['pending'] < 0){
        $response['pending'] = 0; 
    }
    return $response;
}

echo json_encode($response);
?>
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

// Caution **** Dont Touch any code below..
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
        $loan_arr['loan_type'] = 'interest';
    }else{
        $response['total_amt'] = $loan_arr['tot_amt_cal'];
        $loan_arr['loan_type'] = 'emi';
    }

    if($loan_arr['due_amt_cal'] == '' || $loan_arr['due_amt_cal'] == null){
        //(For monthly interest Due amount will not be there, so take interest)
        $response['due_amt'] = $loan_arr['int_amt_cal'];
    }else{
        $response['due_amt'] = $loan_arr['due_amt_cal']; //Due amount will remain same
    }
}
$coll_arr = array();
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
    $response['pre_closure'] = 0;
    //If in collection table, there is no payment means balance amount still remains total amount
    $response['balance'] = $response['total_amt'];
    
    $response = calculateOthers($loan_arr,$response,$con); 
}

if($loan_arr['loan_type'] == 'interest'){
    //to calculate current interest amount based on current balance value//bcoz interest will be calculated based on current balance amt only for interest loan
    $int = $response['balance'] * ($loan_arr['int_rate']/100);
    $curInterest = ceil($int / 5) * 5; //to increase Interest to nearest multiple of 5
    if ($curInterest < $int) {
        $curInterest += 5;
    }
     $response['due_amt'] = $curInterest;
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



    $checkcollection = $con->query("SELECT SUM(`due_amt_track`) as totalPaidAmt FROM `collection` WHERE `req_id` = '$req_id'"); // To Find total paid amount till Now.
    $checkrow = $checkcollection->fetch_assoc();
    $totalPaidAmt = $checkrow['totalPaidAmt'];
    $checkack = $con->query("SELECT int_amt_cal,due_amt_cal FROM `acknowlegement_loan_calculation` WHERE `req_id` = '$req_id'"); // To Find Due Amount.
    $checkAckrow = $checkack->fetch_assoc();
    $int_amt_cal = $checkAckrow['int_amt_cal'];
    $due_amt = $checkAckrow['due_amt_cal'];

    if($loan_arr['due_method_calc'] == 'Monthly' || $loan_arr['due_method_scheme'] == '1'){

        //Convert Date to Year and month, because with date, it will use exact date to loop months, instead of taking end of month
        $due_start_from = date('Y-m',strtotime($due_start_from));
        $maturity_month = date('Y-m',strtotime($maturity_month));

        // Create a DateTime object from the given date
        $maturity_month = new DateTime($maturity_month);
        // Subtract one month from the date
        $maturity_month->modify('-1 month');
        // Format the date as a string
        $maturity_month = $maturity_month->format('Y-m');

        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        $current_date = date('Y-m');
        
        $start_date_obj = DateTime::createFromFormat('Y-m', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m', $current_date);

        $interval = new DateInterval('P1M'); // Create a one month interval

        // $qry = $con->query("DELETE FROM penalty_charges where req_id = '$req_id' and (penalty_date != '' or penalty_date != NULL ) ");
            //condition start
            $count = 0;
            $loandate_tillnow = 0;
            $countForPenalty = 0;

            $dueCharge = ($due_amt) ? $due_amt : $int_amt_cal;
            $start = DateTime::createFromFormat('Y-m', $due_start_from);
            $current = DateTime::createFromFormat('Y-m', $current_date);

            // if($loan_arr['loan_type'] == 'interest'){
            //     $start->modify('+1 month');
            // }

            for($i=$start; $i<$current;$start->add($interval) ){
                $loandate_tillnow += 1;
                $toPaytilldate = intval($loandate_tillnow) * intval($dueCharge);
            }
            
            while($start_date_obj < $end_date_obj && $start_date_obj < $current_date_obj){ // To find loan date count till now from start date.
                $penalty_checking_date  = $start_date_obj->format('Y-m-d'); // This format is for query.. month , year function accept only if (Y-m-d).
                $penalty_date  = $start_date_obj->format('Y-m');
                $start_date_obj->add($interval);
                            
                $checkcollection =$con->query("SELECT * FROM `collection` WHERE `req_id` = '$req_id' && ((MONTH(coll_date)= MONTH('$penalty_checking_date') || MONTH(trans_date)= MONTH('$penalty_checking_date')) && (YEAR(coll_date)= YEAR('$penalty_checking_date') || YEAR(trans_date)= YEAR('$penalty_checking_date')))");
                $collectioncount = mysqli_num_rows($checkcollection); // Checking whether the collection are inserted on date or not by using penalty_raised_date.

                if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                    $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
                }else{
                    $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
                }
                $row = $result->fetch_assoc();
                $penalty_per = $row['overdue'] ; //get penalty percentage to insert
                $penalty = round(($response['due_amt'] * $penalty_per) / 100 );
                $count++; //Count represents how many months are exceeded

                if($totalPaidAmt < $toPaytilldate && $collectioncount == 0 ){ 
                    $checkPenalty = $con->query("SELECT * from penalty_charges where penalty_date = '$penalty_date' and req_id = '$req_id' ");
                    if($checkPenalty->num_rows == 0){
                        $qry = $con->query("INSERT into penalty_charges (`req_id`,`penalty_date`, `penalty`, `created_date`) values ('$req_id','$penalty_date','$penalty',current_timestamp)");
                    }
                    $countForPenalty++;
                } 
            }
           //condition END

        if($count>0){
            //if Due month exceeded due amount will be as pending with how many months are exceeded and subract pre closure amount if available
            $response['pending'] = ($response['due_amt'] * ($count)) - $response['total_paid'] - $response['pre_closure'] ; 


            // If due month exceeded
            if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }else{
                $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
            }
            $row = $result->fetch_assoc();
            $penalty_per = number_format($row['overdue'] * $countForPenalty); //Count represents how many months are exceeded//Number format if percentage exeeded decimals then pernalty may increase

            // to get overall penalty paid till now to show pending penalty amount
            $result=$con->query("SELECT SUM(penalty_track) as penalty,SUM(penalty_waiver) as penalty_waiver FROM `collection` WHERE req_id = '".$req_id."' ");
            $row = $result->fetch_assoc();
            if($row['penalty'] == null){
                $row['penalty'] = 0;
            }
            if($row['penalty_waiver'] == null){
                $row['penalty_waiver'] = 0;
            }
            //to get overall penalty raised till now for this req id
            $result1=$con->query("SELECT SUM(penalty) as penalty FROM `penalty_charges` WHERE req_id = '".$req_id."' ");
            $row1 = $result1->fetch_assoc();
            if($row1['penalty'] == null){
                $penalty = 0;
            }else{
                $penalty = $row1['penalty'];
            }

            $response['penalty'] = $penalty - $row['penalty'] - $row['penalty_waiver'];


            //Payable amount will be pending amount added with current month due amount
            $response['payable'] = $response['due_amt'] + $response['pending'];

                
            if($loan_arr['loan_type'] == 'interest'){ // if loan type is interest then we need to calculate pending and payable again

                if($count == 1){
                    // if this condition true then, first month of the start date only has been ended
                    // so we need to calculate only the first month interest , not whole interest amount as payable
                    $response['payable'] = getTillDateInterest($loan_arr,$response,$con,'fullstartmonth') ;

                    //pending amount will remain zero , coz usually we pay ended month's interest amount only in next month
                    //so when only one month is exceeded, that not the pending 
                    $response['pending'] =  0;

                }else{
                    //if this condition means, more than 1 month is crossed from start month
                    //pending amount will be calculated above for all other loan types as usual
                    //for interest type, we should not calculate due month multiplied by count of month crossed.
                    //in interest loan we need to calculate interest amount of first month by how many days are used in first month only
                    //so that, here subracted one month due amt and added first month's interest based on days spent there
                    $response['pending'] =  $response['pending'] - $response['due_amt'] + getTillDateInterest($loan_arr,$response,$con,'fullstartmonth');

                    
                    $response['payable'] =  $response['pending'];

                    if($count == 2){
                        //if condition is true then this is , 2 months has been completed.
                        //so the pending amt will be only the first month's complete interest amount
                        $response['pending'] =  getTillDateInterest($loan_arr,$response,$con,'fullstartmonth');
                    }else{
                        //else means, month crossed is more than 2 or less than 2 means the pending amount will remain same with above calculated pending amt
                        $response['pending'] =  $response['pending'] - $response['due_amt'] ;
                    }
                }
            }
            
            if($response['payable'] > $response['balance']){
                //if payable is greater than balance then change it as balance amt coz dont collect more than balance
                //this case will occur when collection status becoms OD
                $response['payable'] = $response['balance']; 
            }
            // $response['payable'] = $response['pending'];

            //in this calculate till date interest when month are crossed for current month
            $response['till_date_int'] = getTillDateInterest($loan_arr,$response,$con,'from01');
            

        }else{
            //If still current month is not ended, then pending will be same due amt // pending will be 0 if due date not exceeded
            $response['pending'] = 0;// $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
            //If still current month is not ended, then penalty will be 0
            $response['penalty'] = 0;
            //If still current month is not ended, then payable will be due amt
            $response['payable'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;

            if($loan_arr['loan_type'] == 'interest'){
                $response['payable'] =  0;

            }

            //in this calculate till date interest when month are not crossed for due starting month
            $response['till_date_int'] = getTillDateInterest($loan_arr,$response,$con,'forstartmonth');
        }

    }else
    if($loan_arr['due_method_scheme'] == '2'){
        
        //If Due method is Weekly, Calculate penalty by checking the month has ended or not
        $current_date = date('Y-m-d');
        
        $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
        $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
        $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);

        $interval = new DateInterval('P1W'); // Create a one Week interval

        // $qry = $con->query("DELETE FROM penalty_charges where req_id = '$req_id' and (penalty_date != '' or penalty_date != NULL ) ");
            //condition start
            $count = 0;
            $loandate_tillnow = 0;
            $countForPenalty = 0;

            $dueCharge = ($due_amt) ? $due_amt : $int_amt_cal;
            $start = DateTime::createFromFormat('Y-m-d', $due_start_from);
            $current = DateTime::createFromFormat('Y-m-d', $current_date);

            for($i=$start; $i<$current;$start->add($interval) ){
                $loandate_tillnow += 1;
                $toPaytilldate = intval($loandate_tillnow) * intval($dueCharge);
            }

            while($start_date_obj < $end_date_obj && $start_date_obj < $current_date_obj){ // To find loan date count till now from start date.
                
                $penalty_checking_date  = $start_date_obj->format('Y-m-d'); // This format is for query.. month , year function accept only if (Y-m-d).
                $start_date_obj->add($interval);
                            
                $checkcollection =$con->query("SELECT * FROM `collection` WHERE `req_id` = '$req_id' && ((WEEK(coll_date)= WEEK('$penalty_checking_date') || WEEK(trans_date)= WEEK('$penalty_checking_date')) && (YEAR(coll_date)= YEAR('$penalty_checking_date') || YEAR(trans_date)= YEAR('$penalty_checking_date')))");
                $collectioncount = mysqli_num_rows($checkcollection); // Checking whether the collection are inserted on date or not by using penalty_raised_date.

                if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                    $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
                }else{
                    $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
                }
                $row = $result->fetch_assoc();
                $penalty_per = $row['overdue'] ; //get penalty percentage to insert
                $penalty = round(($response['due_amt'] * $penalty_per) / 100);
                $count++; //Count represents how many months are exceeded

                if($totalPaidAmt < $toPaytilldate && $collectioncount == 0 ){
                    $checkPenalty = $con->query("SELECT * from penalty_charges where penalty_date = '$penalty_checking_date' and req_id = '$req_id' ");
                    if($checkPenalty->num_rows == 0){
                        $qry = $con->query("INSERT into penalty_charges (`req_id`,`penalty_date`, `penalty`, `created_date`) values ('$req_id','$penalty_checking_date','$penalty',current_timestamp)");
                    }
                    $countForPenalty++;
                } 
            }
           //condition END

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
            $penalty_per = number_format($row['overdue'] * $countForPenalty); //Count represents how many months are exceeded//Number format if percentage exeeded decimals then pernalty may increase

            // to get overall penalty paid till now to show pending penalty amount
            $result=$con->query("SELECT SUM(penalty_track) as penalty,SUM(penalty_waiver) as penalty_waiver FROM `collection` WHERE req_id = '".$req_id."' ");
            $row = $result->fetch_assoc();
            if($row['penalty'] == null){
                $row['penalty'] = 0;
            }
            if($row['penalty_waiver'] == null){
                $row['penalty_waiver'] = 0;
            }
            //to get overall penalty raised till now for this req id
            $result1=$con->query("SELECT SUM(penalty) as penalty FROM `penalty_charges` WHERE req_id = '".$req_id."' ");
            $row1 = $result1->fetch_assoc();
            if($row1['penalty'] == null){
                $penalty = 0;
            }else{
                $penalty = $row1['penalty'];
            }

            // $penalty = intval((($response['due_amt'] * $penalty_per) / 100));

            $response['penalty'] = $penalty - $row['penalty'] - $row['penalty_waiver'];

            //Payable amount will be pending amount added with current month due amount
            $response['payable'] = $response['due_amt'] + $response['pending'];
            if($response['payable'] > $response['balance']){
                //if payable is greater than balance then change it as balance amt coz dont collect more than balance
                //this case will occur when collection status becoms OD
                $response['payable'] = $response['balance']; 
            }

        }else{
            //If still current month is not ended, then pending will be same due amt // pending will be 0 if due date not exceeded
            $response['pending'] =0; // $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
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

        // $qry = $con->query("DELETE FROM penalty_charges where req_id = '$req_id' and (penalty_date != '' or penalty_date != NULL ) ");

            //condition start
            $count = 0;
            $loandate_tillnow = 0;
            $countForPenalty = 0;

            $dueCharge = ($due_amt) ? $due_amt : $int_amt_cal;
            $start = DateTime::createFromFormat('Y-m-d', $due_start_from);
            $current = DateTime::createFromFormat('Y-m-d', $current_date);

            for($i=$start; $i<$current;$start->add($interval) ){
                $loandate_tillnow += 1;
                $toPaytilldate = intval($loandate_tillnow) * intval($dueCharge);
            }

                while($start_date_obj < $end_date_obj && $start_date_obj < $current_date_obj){ // To find loan date count till now from start date.
                $penalty_checking_date  = $start_date_obj->format('Y-m-d'); // This format is for query.. month , year function accept only if (Y-m-d).
                $start_date_obj->add($interval);

                    $checkcollection =$con->query("SELECT * FROM `collection` WHERE `req_id` = '$req_id' && ((DAY(coll_date)= DAY('$penalty_checking_date') || DAY(trans_date)= DAY('$penalty_checking_date')) && (YEAR(coll_date)= YEAR('$penalty_checking_date') || YEAR(trans_date)= YEAR('$penalty_checking_date')))");
                    $collectioncount = mysqli_num_rows($checkcollection); // Checking whether the collection are inserted on date or not by using penalty_raised_date.

                if($loan_arr['scheme_name'] == '' || $loan_arr['scheme_name'] == null ){
                    $result=$con->query("SELECT overdue FROM `loan_calculation` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
                }else{
                    $result=$con->query("SELECT overdue FROM `loan_scheme` WHERE loan_category = '".$loan_arr['loan_category']."' and sub_category = '".$loan_arr['sub_category']."' ");
                }
                $row = $result->fetch_assoc();
                $penalty_per = $row['overdue'] ; //get penalty percentage to insert
                $penalty = round(($response['due_amt'] * $penalty_per) / 100);
                $count++; //Count represents how many months are exceeded

                if($totalPaidAmt < $toPaytilldate && $collectioncount == 0 ){ 
                    $checkPenalty = $con->query("SELECT * from penalty_charges where penalty_date = '$penalty_checking_date' and req_id = '$req_id' ");
                    if($checkPenalty->num_rows == 0){
                        $qry = $con->query("INSERT into penalty_charges (`req_id`,`penalty_date`, `penalty`, `created_date`) values ('$req_id','$penalty_checking_date','$penalty',current_timestamp)");
                    }
                    $countForPenalty++;
                } 
            }
            //condition END

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
            $penalty_per = number_format($row['overdue'] * $countForPenalty); //Count represents how many months are exceeded//Number format if percentage exeeded decimals then pernalty may increase
            
            // to get overall penalty paid till now to show pending penalty amount
            $result=$con->query("SELECT SUM(penalty_track) as penalty,SUM(penalty_waiver) as penalty_waiver FROM `collection` WHERE req_id = '".$req_id."' ");
            $row = $result->fetch_assoc();
            if($row['penalty'] == null){
                $row['penalty'] = 0;
            }
            if($row['penalty_waiver'] == null){
                $row['penalty_waiver'] = 0;
            }
            //to get overall penalty raised till now for this req id
            $result1=$con->query("SELECT SUM(penalty) as penalty FROM `penalty_charges` WHERE req_id = '".$req_id."' ");
            $row1 = $result1->fetch_assoc();
            if($row1['penalty'] == null){
                $penalty = 0;
            }else{
                $penalty = $row1['penalty'];
            }

            // $penalty = intval((($response['due_amt'] * $penalty_per) / 100));
            
            $response['penalty'] = $penalty - $row['penalty'] - $row['penalty_waiver'];

            //Payable amount will be pending amount added with current month due amount
            $response['payable'] = $response['due_amt'] + $response['pending'];
            if($response['payable'] > $response['balance']){
                //if payable is greater than balance then change it as balance amt coz dont collect more than balance
                //this case will occur when collection status becoms OD
                $response['payable'] = $response['balance']; 
            }

        }else{
            //If still current month is not ended, then pending will be same due amt// pending will be 0 if due date not exceeded
            $response['pending'] = 0;//$response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
            //If still current month is not ended, then penalty will be 0
            $response['penalty'] = 0;
            //If still current month is not ended, then payable will be due amt
            $response['payable'] = $response['due_amt'] - $response['total_paid'] - $response['pre_closure'] ;
        }
    }

    if($response['pending'] < 0){
        $response['pending'] = 0; 
    }
    if($response['payable'] < 0){
        $response['payable'] = 0; 
    }
    return $response;
}


function getTillDateInterest($loan_arr,$response,$con,$data){

    if($data == 'from01'){
        //in this calculate till date interest when month are crossed for current month

        //to calculate till date interest if loan is interst based
        if($loan_arr['loan_type'] == 'interest'){

            
            // Get the current month's count of days
            $currentMonthCount = date('t');
            // divide current interest amt for one day of current month
            $amtperDay = $response['due_amt'] / intVal($currentMonthCount); 
            
            $st_date = new DateTime(date('Y-m-01')); // start date
            $tdate = new DateTime();//current date
            // $tdate = $tdate->modify('+1 day');//current date +1
            // Calculate the interval between the two dates
            $date_diff = $st_date->diff($tdate);
            // Get the number of days from the interval
            $numberOfDays = $date_diff->days;
            $response = $amtperDay * $numberOfDays;
            
            //to increase till date Interest to nearest multiple of 5
            $cur_amt = ceil($response / 5) * 5; //ceil will set the number to nearest upper integer//i.e ceil(121/5)*5 = 125
            if ($cur_amt < $response) {
                $cur_amt += 5;
            }
            $response = $cur_amt;
        }


    }else if($data == 'forstartmonth'){
        //if condition is true then this is , 2 months has been completed.
        //so the pending amt will be only the first month's complete interest amount


        //to calculate till date interest if loan is interst based
        if($loan_arr['loan_type'] == 'interest'){
            
            // Get the current month's count of days
            $currentMonthCount = date('t',strtotime($loan_arr['due_start_from']));
            // divide current interest amt for one day of current month
            $amtperDay = $response['due_amt'] / intVal($currentMonthCount); 
            
            $st_date = new DateTime(date('Y-m-d',strtotime($loan_arr['due_start_from']))); // start date
            $tdate = new DateTime();//current date
            // $tdate = $tdate->modify('+1 day');//current date +1
            // Calculate the interval between the two dates
            $date_diff = $st_date->diff($tdate);
            // Get the number of days from the interval
            $numberOfDays = $date_diff->days;
            $response = $amtperDay * $numberOfDays;
            
            //to increase till date Interest to nearest multiple of 5
            $cur_amt = ceil($response / 5) * 5; //ceil will set the number to nearest upper integer//i.e ceil(121/5)*5 = 125
            if ($cur_amt < $response) {
                $cur_amt += 5;
            }
            $response = $cur_amt;
            if($st_date > $tdate){
                $response = 0;
            }
        }

    }else if($data == 'fullstartmonth'){
        //in this calculate till date interest when month are not crossed for due starting month

        //to calculate till date interest if loan is interst based
        if($loan_arr['loan_type'] == 'interest'){
            
            // Get the current month's count of days
            $currentMonthCount = date('t',strtotime($loan_arr['due_start_from']));
            // divide current interest amt for one day of current month
            $amtperDay = $response['due_amt'] / intVal($currentMonthCount); 
            
            $st_date = new DateTime(date('Y-m-d',strtotime($loan_arr['due_start_from']))); // start date
            $tdate = new DateTime(date('Y-m-t',strtotime($loan_arr['due_start_from']))) ;//current date
            // $tdate = $tdate->modify('+1 day');//current date +1
            // Calculate the interval between the two dates
            $date_diff = $st_date->diff($tdate);
            // Get the number of days from the interval
            $numberOfDays = $date_diff->days;
            $response = ceil($amtperDay * $numberOfDays);
            
                // //to increase till date Interest to nearest multiple of 5
                // $cur_amt = ceil($response / 5) * 5; //ceil will set the number to nearest upper integer//i.e ceil(121/5)*5 = 125
                // if ($cur_amt < $response) {
                //     $cur_amt += 5;
                // }
                // $response = $cur_amt;
        }

    }

    return $response;
}

echo json_encode($response);
?>
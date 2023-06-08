<?php
session_start();
include '../ajaxconfig.php';

if (isset($_SESSION["userid"])) {
    $user_id = $_SESSION["userid"];
}

function moneyFormatIndia($num)
{
    $explrestunits = "";
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3);
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            if ($i == 0) {
                $explrestunits .= (int)$expunit[$i] . ",";
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash;
}
?>
<table class="table custom-table" id='dueChartListTable'>
    <thead>
        <tr>
            <th width="15"> S.No </th>
            <th width="50"> Due Month </th>
            <th> Month </th>
            <th> Due Amount </th>
            <th> Pending </th>
            <th> Payable </th>
            <th> Collection Date </th>
            <th> Collection Amount </th>
            <th> Balance Amount </th>
            <th> Pre Closure </th>
            <th> Role </th>
            <th> User ID </th>
            <th> Collection Location </th>
            <th> ACTION </th>
        </tr>
    </thead>
    <tbody>

        <?php
        $req_id = $_POST['req_id'];
        $cus_id = $_POST['cus_id'];
        if(isset($_POST['closed'])){$closed = $_POST['closed'];}else{ $closed = 'false';}
        $loanStart = $connect->query("SELECT alc.due_start_from,alc.maturity_month,alc.due_method_calc,alc.due_method_scheme FROM acknowlegement_loan_calculation alc WHERE alc.`req_id`= '$req_id' ");
        $loanFrom = $loanStart->fetch();
        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        $due_start_from = $loanFrom['due_start_from'];
        $maturity_month = $loanFrom['maturity_month'];



        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
            //If Due method is Monthly, Calculate penalty by checking the month has ended or not
            $due_start_from = date('Y-m-d', strtotime($due_start_from));
            $maturity_month = date('Y-m-d', strtotime($maturity_month));
            $current_date = date('Y-m-d');

            $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
            $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
            $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);
            $interval = new DateInterval('P1M'); // Create a one month interval
            //$count = 0;
            $i = 1;
            $dueMonth[] = $due_start_from;
            while ($start_date_obj < $end_date_obj) {
                $start_date_obj->add($interval);
                $dueMonth[] = $start_date_obj->format('Y-m-d');
            }
        } else
        if ($loanFrom['due_method_scheme'] == '2') {
            //If Due method is Weekly, Calculate penalty by checking the month has ended or not
            $current_date = date('Y-m-d');

            $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
            $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
            $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);

            $interval = new DateInterval('P1W'); // Create a one Week interval

            //$count = 0;
            $i = 1;
            $dueMonth[] = $due_start_from;
            while ($start_date_obj < $end_date_obj) {
                $start_date_obj->add($interval);
                $dueMonth[] = $start_date_obj->format('Y-m-d');
            }
        } else
        if ($loanFrom['due_method_scheme'] == '3') {
            //If Due method is Weekly, Calculate penalty by checking the month has ended or not
            $current_date = date('Y-m-d');

            $start_date_obj = DateTime::createFromFormat('Y-m-d', $due_start_from);
            $end_date_obj = DateTime::createFromFormat('Y-m-d', $maturity_month);
            $current_date_obj = DateTime::createFromFormat('Y-m-d', $current_date);

            $interval = new DateInterval('P1D'); // Create a one Week interval

            //$count = 0;
            $i = 1;
            $dueMonth[] = $due_start_from;
            while ($start_date_obj < $end_date_obj) {
                $start_date_obj->add($interval);
                $dueMonth[] = $start_date_obj->format('Y-m-d');
            }
        }
        if($closed == 'true'){
            // $issueDate = $connect->query("SELECT li.loan_amt,ii.updated_date FROM in_issue ii JOIN loan_issue li ON li.req_id = ii.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 20 order by li.id desc limit 1 ");
            $issueDate = $connect->query("SELECT alc.tot_amt_cal,alc.principal_amt_cal,ii.updated_date FROM in_issue ii JOIN acknowlegement_loan_calculation alc ON ii.req_id = alc.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 20 order by alc.loan_cal_id desc limit 1 ");

        }else{
            // $issueDate = $connect->query("SELECT li.loan_amt,ii.updated_date FROM in_issue ii JOIN loan_issue li ON li.req_id = ii.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 14 order by li.id desc limit 1 ");
            $issueDate = $connect->query("SELECT alc.tot_amt_cal,alc.principal_amt_cal,ii.updated_date FROM in_issue ii JOIN acknowlegement_loan_calculation alc ON ii.req_id = alc.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 14 order by alc.loan_cal_id desc limit 1 ");
        }
        $loanIssue = $issueDate->fetch();
        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        if($loanIssue['tot_amt_cal'] == '' || $loanIssue['tot_amt_cal'] == null){
            //(For monthly interest total amount will not be there, so take principals)
            $loan_amt = intVal($loanIssue['principal_amt_cal']);
        }else{
            $loan_amt = intVal($loanIssue['tot_amt_cal']);
        }

        // $loan_amt = $loanIssue['loan_amt'];
        $issue_date = $loanIssue['updated_date'];
        ?>
        <tr>
            <td> </td>
            <td><?php
                if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                    //For Monthly.
                    echo date('m-Y', strtotime($issue_date));
                } else {
                    //For Weekly && Day.
                    echo date('d-m-Y', strtotime($issue_date));
                } ?></td>
            <td><?php echo date('M', strtotime($issue_date)); ?></td>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $loan_amt; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php
            $issued = date('Y-m-d',strtotime($issue_date));
        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
            //Query for Monthly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (MONTH(c.coll_date) = MONTH('$issued') AND YEAR(c.coll_date) = YEAR('$issued')) OR
                (MONTH(c.trans_date) = MONTH('$issued') AND YEAR(c.trans_date) = YEAR('$issued'))
            )
            AND (
                (c.coll_date >= MONTH($issued) AND c.coll_date < MONTH($due_start_from) ) OR
                (c.trans_date >= MONTH($issued) AND c.coll_date < MONTH($due_start_from) )
            )");
            
        } else
        if ($loanFrom['due_method_scheme'] == '2') {
            //Query For Weekly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (WEEK(c.coll_date) = WEEK('$issued') AND YEAR(c.coll_date) = YEAR('$issued')) OR
                (WEEK(c.trans_date) = WEEK('$issued') AND YEAR(c.trans_date) = YEAR('$issued'))
            )
            AND (
                (c.coll_date >= WEEK('$issued') AND c.coll_date < WEEK('$due_start_from') ) OR
                (c.trans_date >= WEEK('$issued') AND c.coll_date < WEEK('$due_start_from') )
            ) ");
        } else
        if ($loanFrom['due_method_scheme'] == '3') {
            //Query For Day.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (c.coll_date >= '$issued' AND c.coll_date < '$due_start_from' ) OR
                (c.trans_date >= '$issued' AND c.coll_date < '$due_start_from' )
            ) ");
        }

        if ($run->rowCount() > 0) {
            $due_amt_track = 0;
            $waiver = 0;
            while ($row = $run->fetch()) {
                $role = $row['role'];
                $collectionAmnt = intVal($row['due_amt_track']);
                $due_amt_track = $due_amt_track + intVal($row['due_amt_track']);
                $waiver = $waiver + intVal($row['pre_close_waiver']);
                $bal_amt = $loan_amt - $due_amt_track - $waiver;
                ?>
                <tr>
                    <td></td>
                    <td><?php
                        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                            //For Monthly.
                            echo date('m-Y', strtotime($row['coll_date']));
                        } else {
                            //For Weekly && Day.
                            echo date('d-m-Y', strtotime($row['coll_date']));
                        }
                        ?></td>
                    <td><?php echo date('M', strtotime($row['coll_date'])); ?></td>
                    <td><?php echo $row['due_amt']; ?></td>
                    <td><?php $pendingMinusCollection = ( intVal($row['pending_amt']) - $collectionAmnt );
                        if($pendingMinusCollection > 0 ){ echo $pendingMinusCollection;}else{echo 0;} ?></td>
                    <td><?php $payableMinusCollection = ( intVal($row['payable_amt']) - $collectionAmnt );
                        if($payableMinusCollection > 0){ echo $payableMinusCollection;}else{echo 0;} ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['coll_date'])); ?></td>
                    <td><?php if ($row['due_amt_track'] > 0) {
                            echo $row['due_amt_track'];
                        } elseif ($row['pre_close_waiver'] > 0) {
                            echo $row['pre_close_waiver'];
                        } ?></td>
                    <td><?php echo $bal_amt; ?></td>
                    <td><?php if ($row['pre_close_waiver'] > 0) {
                            echo $row['pre_close_waiver'];
                        } else {
                            echo '0';
                        } ?></td>
                    <td><?php if (isset($role) && $role == '1') {
                            echo 'Director';
                        } else if (isset($role) && $role == '2') {
                            echo 'Agent';
                        } else if (isset($role) && $role == '3') {
                            echo 'Staff';
                        } ?>
                    </td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php if ($row['coll_location'] == '1') {
                            echo 'Office';
                        } elseif ($row['coll_location'] == '2') {
                            echo 'On Spot';
                        } elseif ($row['coll_location'] == '3') {
                            echo 'Bank Transfer';
                        } ?></td>
                    <td> <a class='print_due_coll' id="" value="<?php echo $row['coll_code']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
                </tr>

                <?php 
            } 
        }

        $due_amt_track = 0;
        $waiver = 0;
        $bal_amt = 0;
        foreach ($dueMonth as $cusDueMonth) {
            if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                //Query for Monthly.
                $run = $connect->query("SELECT c.coll_code,c.due_amt,c.pending_amt,c.payable_amt,c.coll_date,c.due_amt_track,c.bal_amt,c.coll_charge_track,c.coll_location,c.pre_close_waiver,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) and (c.due_amt_track != '' or c.pre_close_waiver!='') && ((MONTH(coll_date)= MONTH('$cusDueMonth') || MONTH(trans_date)= MONTH('$cusDueMonth')) && (YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth')) )");
            } else
        if ($loanFrom['due_method_scheme'] == '2') {
                //Query For Weekly.
                $run = $connect->query("SELECT c.coll_code,c.due_amt,c.pending_amt,c.payable_amt,c.coll_date,c.due_amt_track,c.bal_amt,c.coll_charge_track,c.coll_location,c.pre_close_waiver,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) and (c.due_amt_track != '' or c.pre_close_waiver!='') && ((WEEK(coll_date)= WEEK('$cusDueMonth') || WEEK(trans_date)= WEEK('$cusDueMonth')) && (YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth')) )");
            } else
        if ($loanFrom['due_method_scheme'] == '3') {
                //Query For Day.
                $run = $connect->query("SELECT c.coll_code,c.due_amt,c.pending_amt,c.payable_amt,c.coll_date,c.due_amt_track,c.bal_amt,c.coll_charge_track,c.coll_location,c.pre_close_waiver,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) and (c.due_amt_track != '' or c.pre_close_waiver!='') && ((DAY(coll_date)= DAY('$cusDueMonth') || DAY(trans_date)= DAY('$cusDueMonth')) && (YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth')) )");
            }

            if ($run->rowCount() > 0) {

                while ($row = $run->fetch()) {
                    $role = $row['role'];
                    $due_amt_track = intVal($row['due_amt_track']);
                    // $waiver = $waiver + intVal($row['pre_close_waiver']);
                    $waiver = intVal($row['pre_close_waiver']);
                    $bal_amt = intVal($row['bal_amt']) - $due_amt_track - $waiver;

        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php
                            if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                                //For Monthly.
                                echo date('m-Y', strtotime($cusDueMonth));
                            } else {
                                //For Weekly && Day.
                                echo date('d-m-Y', strtotime($cusDueMonth));
                            }
                            ?></td>
                        <td><?php echo date('M', strtotime($cusDueMonth)); ?></td>
                        <td><?php echo $row['due_amt']; ?></td>
                        <td><?php $pendingMinusCollection = ( intVal($row['pending_amt']) - $due_amt_track );
                        if($pendingMinusCollection > 0 ){ echo $pendingMinusCollection;}else{echo 0;} ?></td>
                        <td><?php $payableMinusCollection = ( intVal($row['payable_amt']) - $due_amt_track );
                        if($payableMinusCollection > 0){ echo $payableMinusCollection;}else{echo 0;} ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['coll_date'])); ?></td>
                        <td><?php if ($row['due_amt_track'] > 0) {
                                echo $row['due_amt_track'];
                            } elseif ($row['pre_close_waiver'] > 0) {
                                echo $row['pre_close_waiver'];
                            } ?></td>   
                        <td><?php echo $bal_amt; ?></td>
                        <td><?php if ($row['pre_close_waiver'] > 0) {
                                echo $row['pre_close_waiver'];
                            } else {
                                echo '0';
                            } ?></td>
                        <td><?php if (isset($role) && $role == '1') {
                                echo 'Director';
                            } else if (isset($role) && $role == '2') {
                                echo 'Agent';
                            } else if (isset($role) && $role == '3') {
                                echo 'Staff';
                            } ?>
                        </td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php if ($row['coll_location'] == '1') {
                                echo 'Office';
                            } elseif ($row['coll_location'] == '2') {
                                echo 'On Spot';
                            } elseif ($row['coll_location'] == '3') {
                                echo 'Bank Transfer';
                            } ?></td>
                        <td> <a class='print_due_coll' id="" value="<?php echo $row['coll_code']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
                    </tr>

                <?php $i++;
                }
            } else {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php
                        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                            //For Monthly.
                            echo date('m-Y', strtotime($cusDueMonth));
                        } else {
                            //For Weekly && Day.
                            echo date('d-m-Y', strtotime($cusDueMonth));
                        } ?></td>
                    <td><?php echo date('M', strtotime($cusDueMonth)); ?></td>
                    <td> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

        <?php
                $i++;
            }
        } 
        
        $currentMonth = date('Y-m-d');
        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
            //Query for Monthly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.due_start_from, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (c.coll_date > '$maturity_month' AND c.coll_date <= '$currentMonth') OR
                (c.trans_date > '$maturity_month' AND c.coll_date <= '$currentMonth')
            )");
            
        } else
        if ($loanFrom['due_method_scheme'] == '2') {
            //Query For Weekly.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.maturity_month, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (c.coll_date > '$maturity_month' AND c.coll_date <= '$currentMonth'  ) OR
                (c.trans_date > '$maturity_month' AND c.coll_date <= '$currentMonth' )
            ) ");
        } else
        if ($loanFrom['due_method_scheme'] == '3') {
            //Query For Day.
            $run = $connect->query("SELECT c.coll_code, c.due_amt, c.pending_amt, c.payable_amt, c.coll_date, c.due_amt_track, c.bal_amt, c.coll_charge_track, c.coll_location, c.pre_close_waiver, alc.maturity_month, alc.maturity_month, alc.due_method_calc, u.fullname, u.role
            FROM `collection` c
            LEFT JOIN acknowlegement_loan_calculation alc ON c.req_id = alc.req_id
            LEFT JOIN user u ON c.insert_login_id = u.user_id
            WHERE c.`req_id` = '$req_id' AND (c.due_amt_track != '' or c.pre_close_waiver!='')
            AND (
                (c.coll_date >  '$maturity_month' AND c.coll_date <= '$currentMonth') OR
                (c.trans_date > '$maturity_month' AND c.coll_date <= '$currentMonth')
            ) ");
        }

        if ($run->rowCount() > 0) {
            $due_amt_track = 0;
            $waiver = 0;
            while ($row = $run->fetch()) {
                $role = $row['role'];
                $collectionAmnt = intVal($row['due_amt_track']);
                $due_amt_track = $due_amt_track + intVal($row['due_amt_track']);
                $waiver = $waiver + intVal($row['pre_close_waiver']);
                $bal_amt = $loan_amt - $due_amt_track - $waiver;
                ?>
                <tr>
                    <td> <?php echo $i;?></td>
                    <td><?php
                        if ($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1') {
                            //For Monthly.
                            echo date('m-Y', strtotime($issue_date));
                        } else {
                            //For Weekly && Day.
                            echo date('d-m-Y', strtotime($row['coll_date']));
                        }
                        ?></td>
                    <td><?php echo date('M', strtotime($issue_date)); ?></td>
                    <td><?php echo $row['due_amt']; ?></td>
                    <td><?php $pendingMinusCollection = ( intVal($row['pending_amt']) - $collectionAmnt );
                        if($pendingMinusCollection > 0 ){ echo $pendingMinusCollection;}else{echo 0;} ?></td>
                        <td><?php $payableMinusCollection = ( intVal($row['payable_amt']) - $collectionAmnt );
                        if($payableMinusCollection > 0){ echo $payableMinusCollection;}else{echo 0;} ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['coll_date'])); ?></td>
                    <td><?php if ($row['due_amt_track'] > 0) {
                            echo $row['due_amt_track'];
                        } elseif ($row['pre_close_waiver'] > 0) {
                            echo $row['pre_close_waiver'];
                        } ?></td>
                    <td><?php echo $bal_amt; ?></td>
                    <td><?php if ($row['pre_close_waiver'] > 0) {
                            echo $row['pre_close_waiver'];
                        } else {
                            echo '0';
                        } ?></td>
                    <td><?php if (isset($role) && $role == '1') {
                            echo 'Director';
                        } else if (isset($role) && $role == '2') {
                            echo 'Agent';
                        } else if (isset($role) && $role == '3') {
                            echo 'Staff';
                        } ?>
                    </td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php if ($row['coll_location'] == '1') {
                            echo 'Office';
                        } elseif ($row['coll_location'] == '2') {
                            echo 'On Spot';
                        } elseif ($row['coll_location'] == '3') {
                            echo 'Bank Transfer';
                        } ?></td>
                    <td> <a class='print_due_coll' id="" value="<?php echo $row['coll_code']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
                </tr>

                <?php 
        $i++; } 
        }

        ?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $('#dueChartListTable').DataTable({
            'processing': true,
            'iDisplayLength': 11,
            "lengthMenu": [
                [11, 26, 51, -1],
                [10, 25, 50, "All"]
            ],
            // "createdRow": function(row, data, dataIndex) {
            //     $(row).find('td:first').html(dataIndex + 1);
            // },
            // "drawCallback": function(settings) {
            //     this.api().column(0).nodes().each(function(cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // },
        });
    });
</script>
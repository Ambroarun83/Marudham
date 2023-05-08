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
            <th> Due Month </th>
            <th> Month </th>
            <th> Due Amount </th>
            <th> Pending </th>
            <th> Payable </th>
            <th> Collection Date </th>
            <th> Collection Amount </th>
            <th> Balance Amount </th>
            <th> Collection Track </th>
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
        $loanStart = $connect->query("SELECT alc.due_start_from,alc.maturity_month,alc.due_method_calc,alc.due_method_scheme FROM acknowlegement_loan_calculation alc WHERE alc.`req_id`= '$req_id' ");
        $loanFrom = $loanStart->fetch();
        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        $due_start_from = $loanFrom['due_start_from'];
        $maturity_month = $loanFrom['maturity_month'];



        if($loanFrom['due_method_calc'] == 'Monthly' || $loanFrom['due_method_scheme'] == '1'){
            //If Due method is Monthly, Calculate penalty by checking the month has ended or not
            $due_start_from = date('Y-m',strtotime($due_start_from));
            $maturity_month = date('Y-m',strtotime($maturity_month));
            $current_date = date('Y-m');

            $start_date_obj = DateTime::createFromFormat('Y-m', $due_start_from);
            $end_date_obj = DateTime::createFromFormat('Y-m', $maturity_month);
            $current_date_obj = DateTime::createFromFormat('Y-m', $current_date);
            $interval = new DateInterval('P1M'); // Create a one month interval
            //$count = 0;
            $i = 1;
            $dueMonth[] = $due_start_from;
            while ($start_date_obj < $end_date_obj) {
                $start_date_obj->add($interval);
                $dueMonth[] = $start_date_obj->format('Y-m');
            }
            //  $count++; //Count represents how many months are exceeded
            // }
            // echo $count;
            // if ($count > 0) {
            // }
        }else
        if($loanFrom['due_method_scheme'] == '2'){
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
        }else
        if($loanFrom['due_method_scheme'] == '3'){
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
        $issueDate = $connect->query("SELECT li.loan_amt,ii.updated_date FROM in_issue ii JOIN loan_issue li ON li.req_id = ii.req_id  WHERE ii.req_id = '$req_id' and ii.cus_status = 14 order by li.id desc limit 1 ");
        $loanIssue = $issueDate->fetch();
        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        $loan_amt = $loanIssue['loan_amt'];
        $issue_date = $loanIssue['updated_date'];
        ?>
        <tr>
            <td> </td>
            <td><?php echo date('m-Y',strtotime($issue_date)); ?></td>
            <td><?php echo date('M',strtotime($issue_date)); ?></td>
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
        foreach ($dueMonth as $cusDueMonth) {

            $run = $connect->query("SELECT c.coll_code,c.due_amt,c.pending_amt,c.payable_amt,c.coll_date,c.due_amt_track,c.bal_amt,c.coll_charge_track,c.coll_location,c.pre_close_waiver,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) and (c.due_amt_track != '' or c.pre_close_waiver!='') && ((MONTH(coll_date)= MONTH('$cusDueMonth') || MONTH(trans_date)= MONTH('$cusDueMonth')) && (YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth')) )");

            if ($run->rowCount() > 0) {
                $due_amt_track = 0;
                $waiver = 0;
                $bal_amt =0;
                while ($row = $run->fetch()) {
                    $role = $row['role'];
                    $due_amt_track = $due_amt_track + intVal($row['due_amt_track']) ; 
                    $waiver = $waiver + intVal($row['pre_close_waiver']) ;
                    $bal_amt = $loan_amt - $due_amt_track - $waiver;

        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo date('m-Y', strtotime($cusDueMonth)); ?></td>
                        <td><?php echo date('M', strtotime($cusDueMonth)); ?></td>
                        <td><?php echo $row['due_amt']; ?></td>
                        <td><?php echo $row['pending_amt']; ?></td>
                        <td><?php echo $row['payable_amt']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['coll_date'])); ?></td>
                        <td><?php if($row['due_amt_track'] > 0){echo $row['due_amt_track'];}elseif($row['pre_close_waiver'] > 0){echo $row['pre_close_waiver'];} ?></td>
                        <td><?php echo $bal_amt; ?></td>
                        <td><?php if($row['pre_close_waiver'] > 0){echo $row['pre_close_waiver']; }else{echo '0';}?></td>
                        <td><?php if (isset($role) && $role == '1') {
                                echo 'Director';
                            } else if (isset($role) && $role == '2') {
                                echo 'Agent';
                            } else if (isset($role) && $role == '3') {
                                echo 'Staff';
                            } ?>
                        </td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php if($row['coll_location'] == '1'){echo 'Office';}elseif($row['coll_location'] == '2'){echo 'On Spot';}elseif($row['coll_location'] == '3'){echo 'Bank Transfer';} ?></td>
                        <td> <a class='print_due_coll' id="" value="<?php echo $row['coll_code']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
                    </tr>

                <?php $i++;
                }
            } else {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo date('m-Y', strtotime($cusDueMonth)); ?></td>
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
        } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $('#dueChartListTable').DataTable({
            'processing': true,
            'iDisplayLength': 10,
            "lengthMenu": [
                [10, 25, 50, -1],
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
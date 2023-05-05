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
        $loanStart = $connect->query("SELECT alc.due_start_from,alc.maturity_month,alc.due_method_calc FROM acknowlegement_loan_calculation alc WHERE alc.`req_id`= '$req_id' ");
        $loanFrom = $loanStart->fetch();
        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        $due_start_from = $loanFrom['due_start_from'];
        $maturity_month = $loanFrom['maturity_month'];




        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
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
        //  $count++; //Count represents how many months are exceeded
        // }
        // echo $count;
        // if ($count > 0) {
        // }

        $issueDate = $connect->query("SELECT loan_amt,created_date FROM loan_issue  WHERE req_id = '$req_id' order by id desc limit 1 ");
        $loanIssue = $issueDate->fetch();
        //If Due method is Monthly, Calculate penalty by checking the month has ended or not
        $loan_amt = $loanIssue['loan_amt'];
        $issue_date = $loanIssue['created_date'];
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

            $run = $connect->query("SELECT c.due_amt,c.pending_amt,c.payable_amt,c.coll_date,c.coll_charge,c.bal_amt,c.coll_charge_track,c.coll_location,alc.due_start_from,alc.maturity_month,alc.due_method_calc,u.fullname,u.role FROM `collection` c LEFT JOIN acknowlegement_loan_calculation alc on c.req_id = alc.req_id LEFT JOIN user u on c.insert_login_id = u.user_id WHERE (c.`req_id`= $req_id) && ((MONTH(coll_date)= MONTH('$cusDueMonth') || MONTH(trans_date)= MONTH('$cusDueMonth')) && (YEAR(coll_date)= YEAR('$cusDueMonth') || YEAR(trans_date)= YEAR('$cusDueMonth')) )");

            if ($run->rowCount() > 0) {
                while ($row = $run->fetch()) {
                    $role = $row['role'];

        ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo date('m-Y', strtotime($cusDueMonth)); ?></td>
                        <td><?php echo date('M', strtotime($cusDueMonth)); ?></td>
                        <td><?php echo $row['due_amt']; ?></td>
                        <td><?php echo $row['pending_amt']; ?></td>
                        <td><?php echo $row['payable_amt']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['coll_date'])); ?></td>
                        <td><?php echo $row['coll_charge']; ?></td>
                        <td><?php echo $row['bal_amt']; ?></td>
                        <td><?php echo $row['coll_charge_track']; ?></td>
                        <td><?php if (isset($role) && $role == '1') {
                                echo 'Director';
                            } else if (isset($role) && $role == '2') {
                                echo 'Agent';
                            } else if (isset($role) && $role == '3') {
                                echo 'Staff';
                            } ?>
                        </td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['coll_location']; ?></td>
                        <td> <a id="" value="<?php echo $cheque['id']; ?>"> <i class="fa fa-print" aria-hidden="true"></i> </a> </td>
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
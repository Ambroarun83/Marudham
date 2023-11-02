<?php

include '../../ajaxconfig.php';

$where = "";

if(isset($_POST['to_date']) && $_POST['to_date'] != ''){
    $to_date = date('Y-m-d',strtotime($_POST['to_date']));
    $where  = "and (date(coll_date) <= '".$to_date."') ";

}

$qry = $con->query("
            SELECT 
            cp.area_line as line,
            ii.loan_id,
            ii.updated_date as loan_date,
            lc.maturity_month,
            cp.cus_id,
            cp.req_id,
            cp.cus_name,
            al.area_name,
            sal.sub_area_name,
            (SELECT loan_category_creation_name From loan_category_creation WHERE loan_category_creation_id = lc.loan_category) as loan_cat_name,
            lc.sub_category,
            (SELECT ag_name from agent_creation where ag_id = req.agent_id) as ag_name,
            lc.loan_amt_cal,
            lc.due_amt_cal,
            lc.principal_amt_cal,
            lc.int_amt_cal,
            lc.tot_amt_cal,
            lc.due_type,
            lc.due_period,
            (SELECT sum(due_amt_track) from collection where req_id = lc.req_id ".$where." ) as due_amt_track ,
            (SELECT sum(princ_amt_track) from collection where req_id = lc.req_id ".$where." ) as princ_amt_track ,
            (SELECT sum(int_amt_track) from collection where req_id = lc.req_id ".$where." ) as int_amt_track ,
            req.cus_status

            FROM acknowlegement_loan_calculation lc
            JOIN acknowlegement_customer_profile cp ON lc.req_id = cp.req_id
            JOIN in_issue ii ON lc.req_id = ii.req_id
            JOIN area_list_creation al ON cp.area_confirm_area = al.area_id
            JOIN sub_area_list_creation sal ON cp.area_confirm_subarea = sal.sub_area_id
            JOIN request_creation req ON lc.req_id = req.req_id
            
            WHERE req.cus_status BETWEEN 14 and 18
            
            ");

    $statusObj = [
        '14'=> 'Current',
        '15'=> 'Error',
        '16'=> 'Legal',
        '17'=> 'Current',
    ]
?>


<table id="balance_report_table" class="table custom-table">
    <thead>
        <th>S.No</th>
        <th>Line</th>
        <th>Loan ID</th>
        <th>Loan Date</th>
        <th>Maturity Date</th>
        <th>Cust. ID</th>
        <th>Cust. Name</th>
        <th>Area</th>
        <th>Sub Area</th>
        <th>Loan Category</th>
        <th>Sub Category</th>
        <th>Agent</th>
        <th>Loan Amount</th>
        <th>Due Amount</th>
        <th>No of Due</th>
        <th>Total Amount</th>
        <th>Balance Amount</th>
        <th>Principal Amount</th>
        <th>Interest Amount</th>
        <th>No of Balance Due</th>
        <th>Status</th>
        <th>Sub Status</th>
    </thead>
    <tbody>
        <?php
            $i=1;
            while ($row = $qry->fetch_assoc()){
                if($row['due_type'] != 'Interest'){
                    $due_amt = $row['due_amt_cal'];
                    $total_amt = $row['tot_amt_cal'];
                    $balance_amt = intVal($row['tot_amt_cal']) - intVal($row['due_amt_track']);

                    //for princ and int to be paid
                    $princ_amt = intVal($row['principal_amt_cal']/$row['due_period']);
                    $int_amt = intVal($row['int_amt_cal']/$row['due_period']);
                    $response = calculatePrincipalAndInterest($princ_amt,$int_amt,$balance_amt);//to get the principal and interest amt separate in due amt paid

                    $bal_due = round($balance_amt / $row['due_amt_cal'],1);
                }else{
                    $due_amt = $row['int_amt_cal'];
                    $total_amt = $row['principal_amt_cal'];
                    $balance_amt = intVal($row['principal_amt_cal']) - intVal($row['princ_amt_track']);

                    //for princ and int to be paid
                    $princ_amt = intVal($row['principal_amt_cal']) - intVal($row['princ_amt_track']);//subract total principal with paid princtipal to get balance principal
                    $int_amt = intVal($row['int_amt_cal']) * intVal($row['due_period']);//multiply int amt for int loan with due period to get overall interest
                    $int_amt = $int_amt - intVal($row['int_amt_track']);//subract it with paid interest
                    $response = [ 'principal_paid'=> $princ_amt,'interest_paid'=> $int_amt ];//bind them into response array

                    $bal_due = round($int_amt / $due_amt,1);//interest amt is total of it subracted by paid interst, if that divided by one month due then that will be the bal due
                }
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['line']; ?></td>
                    <td><?php echo $row['loan_id']; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($row['loan_date'])); ?></td>
                    <td><?php echo date('d-m-Y',strtotime($row['maturity_month'])); ?></td>
                    <td><?php echo $row['cus_id']; ?></td>
                    <td><?php echo $row['cus_name']; ?></td>
                    <td><?php echo $row['area_name']; ?></td>
                    <td><?php echo $row['sub_area_name']; ?></td>
                    <td><?php echo $row['loan_cat_name']; ?></td>
                    <td><?php echo $row['sub_category']; ?></td>
                    <td><?php echo $row['ag_name']; ?></td>
                    <td><?php echo moneyFormatIndia($row['loan_amt_cal']); ?></td>
                    <td><?php echo moneyFormatIndia($due_amt); ?></td>
                    <td><?php echo $row['due_period']; ?></td>
                    <td><?php echo moneyFormatIndia($total_amt); ?></td>
                    <td><?php echo moneyFormatIndia($balance_amt); ?></td>
                    <td><?php echo moneyFormatIndia($response['principal_paid']); ?></td>
                    <td><?php echo moneyFormatIndia($response['interest_paid']); ?></td>
                    <td><?php echo moneyFormatIndia($bal_due); ?></td>
                    <td><?php echo 'Present' ?></td>
                    <td><?php echo $statusObj[$row['cus_status']]; ?></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<?php
function moneyFormatIndia($num){
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

function calculatePrincipalAndInterest($principal,  $interest,  $paidAmount):array{
    $principal_paid = 0;
    $interest_paid = 0;
    
    while ($paidAmount > 0) {
        
        if ($paidAmount >= $principal) {
            $principal_paid += $principal;
            $paidAmount -= $principal;
        } else {
            $principal_paid += $paidAmount;
            break;
        }
        
        if ($paidAmount >= $interest) {
            $interest_paid += $interest;
            $paidAmount -= $interest;
        } else {
            $interest_paid += $paidAmount;
            break;
        }
    }
    
    return( [
        'principal_paid' => (int) $principal_paid,
        'interest_paid' => (int) $interest_paid
    ]);
}

?>


<script>
    $(document).ready(function () {
        $('#balance_report_table').DataTable({
            "title":"Balance Report",
            'processing': true,
            'iDisplayLength': 10,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
        });
    });
</script>


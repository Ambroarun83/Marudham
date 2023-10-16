<?php

include '../../ajaxconfig.php';

$qry = $con->query("
            SELECT 
            cp.area_line as line,
            ii.loan_id,
            ii.updated_date as loan_date,
            coll.cus_id,
            coll.cus_name,
            al.area_name,
            sal.sub_area_name,
            (SELECT loan_category_creation_name From loan_category_creation WHERE loan_category_creation_id = lc.loan_category) as loan_cat_name,
            lc.sub_category,
            (SELECT ag_name from agent_creation where ag_id = req.agent_id) as ag_name,
            req.user_type,
            req.user_name,
            coll.coll_date,
            coll.trans_date,
            coll.due_amt_track,
            coll.princ_amt_track,
            coll.int_amt_track,
            coll.penalty_track,
            coll.coll_charge_track,
            coll.total_paid_track,
            req.cus_status

            FROM collection coll
            JOIN acknowlegement_customer_profile cp ON coll.req_id = cp.req_id
            JOIN in_issue ii ON coll.req_id = ii.req_id
            JOIN area_list_creation al ON cp.area_confirm_area = al.area_id
            JOIN sub_area_list_creation sal ON cp.area_confirm_subarea = sal.sub_area_id
            JOIN acknowlegement_loan_calculation lc ON coll.req_id = lc.req_id
            JOIN request_creation req ON coll.req_id = req.req_id
            
            WHERE req.cus_status BETWEEN 14 and 18
            ORDER BY coll.coll_date ASC
            ");

    $statusObj = [
        '14'=> 'Current',
        '15'=> 'Error',
        '16'=> 'Legal',
        '17'=> 'Current',
    ]
?>


<table id="closed_report_table" class="table custom-table">
    <thead>
        <th>S.No</th>
        <th>Line</th>
        <th>Loan ID</th>
        <th>Loan Date</th>
        <th>Cust. ID</th>
        <th>Cust. Name</th>
        <th>Area</th>
        <th>Sub Area</th>
        <th>Loan Category</th>
        <th>Sub Category</th>
        <th>Agent</th>
        <th>User Type</th>
        <th>User</th>
        <th>Receipt Date</th>
        <th>Due Amount</th>
        <th>Principal Amount</th>
        <th>Interest Amount</th>
        <th>Penalty</th>
        <th>Fine</th>
        <th>Total Paid</th>
        <th>Status</th>
        <th>Sub Status</th>
    </thead>
    <tbody>
        <?php
                $i=1;
                while ($row = $qry->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['line']; ?></td>
                        <td><?php echo $row['loan_id']; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($row['loan_date'])); ?></td>
                        <td><?php echo $row['cus_id']; ?></td>
                        <td><?php echo $row['cus_name']; ?></td>
                        <td><?php echo $row['area_name']; ?></td>
                        <td><?php echo $row['sub_area_name']; ?></td>
                        <td><?php echo $row['loan_cat_name']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td><?php echo $row['ag_name']; ?></td>
                        <td><?php echo $row['user_type']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td>
                            <?php 
                                if($row['trans_date'] != '0000-00-00'){
                                    echo date('d-m-Y',strtotime($row['trans_date']));
                                }else{
                                    echo date('d-m-Y',strtotime($row['coll_date']));
                                }
                            ?>
                        </td>
                        <td><?php echo moneyFormatIndia($row['due_amt_track']); ?></td>
                        <td><?php echo moneyFormatIndia($row['princ_amt_track']); ?></td>
                        <td><?php echo moneyFormatIndia($row['int_amt_track']); ?></td>
                        <td><?php echo moneyFormatIndia($row['penalty_track']); ?></td>
                        <td><?php echo moneyFormatIndia($row['coll_charge_track']); ?></td>
                        <td><?php echo moneyFormatIndia($row['total_paid_track']); ?></td>
                        <td><?php echo 'Present'; ?></td>
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
?>


<script>
    $(document).ready(function () {
        $('#closed_report_table').DataTable({
            "title":"Closed Report",
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

<?php
include '../../ajaxconfig.php';

$qry = $con->query("
    SELECT 
        cp.req_id,
        cp.cus_name,
        cp.area_confirm_area as area_id,
        cp.area_confirm_subarea as sub_area_id,
        ii.updated_date as loan_date,
        lc.maturity_month as maturity_date,
        lc.loan_category as loan_cat_id,
        lc.sub_category,
        al.area_name,
        sal.sub_area_name,
        lcc.loan_category_creation_name,
        (SELECT sum(due_amt_track) as due_amt_track FROM collection where req_id = cp.req_id) as total_paid,
        (SELECT bal_amt
        FROM collection
        WHERE req_id = 8 AND (
            (MONTH(DATE(coll_date)) = '".date('m')."' AND YEAR(DATE(coll_date)) = '".date('Y')."' )
            OR (MONTH(DATE(coll_date)) <> '".date('m')."' AND YEAR(DATE(coll_date)) = '".date('Y')."' )
        )
        ORDER BY 
            CASE 
                WHEN MONTH(DATE(coll_date)) = '".date('m')."' THEN 1 
                ELSE 2  
            END, coll_id ASC
        LIMIT 1) as opening_balance
    FROM 
        acknowlegement_customer_profile cp 
        JOIN acknowlegement_loan_calculation lc ON cp.req_id = lc.req_id 
        JOIN loan_issue li ON cp.req_id = li.req_id
        JOIN in_issue ii ON cp.req_id = ii.req_id  
        JOIN area_list_creation al ON cp.area_confirm_area = al.area_id
        JOIN sub_area_list_creation sal ON cp.area_confirm_subarea = sal.sub_area_id
        JOIN loan_category_creation lcc ON lc.loan_category = lcc.loan_category_creation_id
    WHERE 
        ii.cus_status >= 14 AND lc.due_method_scheme = 3");

    $rows = array();
    while($row = $qry->fetch_assoc()){
        $rows[] = $row;
    }
?>


<table class="table custom-table" id="daily_table">
    <thead>
        <th>S.No</th>
        <th>Customer Name</th>
        <th>Area</th>
        <th>Sub Area</th>
        <th>Loan Date</th>
        <th>Maturity Date</th>
        <th>Loan Category</th>
        <th>Sub Category</th>
        <th>Opening Balance</th>
        
        <?php 
            $currMonth = new DateTime();
            $start = new DateTime($currMonth->format('Y-m-01'));
            $end = new DateTime($currMonth->format('Y-m-t'));
            for($date = $start; $date <= $end; $date->modify('+1 day')) {
                ?>

                <th>
                    <?php echo $date->format('d'); ?>
                </th>
        <?php
            }
        ?>
        
        <th>Total Paid</th>
        <th>Balance</th>
    </thead>
    <tbody>
        <?php 
            $i = 1;
            
            if($qry->num_rows > 0){
                foreach($rows as $row) {
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['cus_name']; ?></td>
                        <td><?php echo $row['area_name']; ?></td>
                        <td><?php echo $row['sub_area_name']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['loan_date'])); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['maturity_date'])); ?></td>
                        <td><?php echo $row['loan_category_creation_name']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td><?php echo moneyFormatIndia($row['opening_balance']); ?></td>
                        <?php
                            $currMonth = new DateTime();
                            $start = new DateTime($currMonth->format('Y-m-01'));
                            $end = new DateTime($currMonth->format('Y-m-t')); 
                            for($date = $start; $date <= $end; $date->modify('+1 day')) {
                        ?>
                            <td></td>
                        <?php
                            }
                        ?>
                        <td><?php echo moneyFormatIndia($row['total_paid']); ?></td>
                        <td><?php echo moneyFormatIndia($row['opening_balance'] - $row['total_paid']); ?></td>
                    </tr>
                    
            <?php
                }
            }
        ?>
    </tbody>
</table>

<script type='text/javascript'>
    $(function() {
        $('#daily_table').DataTable({
            "title":"Daily Ledger",
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });
    });
</script>

<?php
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
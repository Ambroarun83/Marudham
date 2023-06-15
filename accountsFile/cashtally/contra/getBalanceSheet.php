<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../../ajaxconfig.php');

$bankqry = $con->query("SELECT `bank_details` FROM `user` WHERE `user_id`= $user_id");
$bank_id = $bankqry->fetch_assoc()['bank_details'];

$sheet_type = $_POST['sheet_type'];

$tableHeaders = '';

if($sheet_type == 1 ){//1 Means contra balance sheet
    
    $tableHeaders = "<th width='50'>S.No</th><th>Date</th><th>Cash Type</th><th>Credit</th><th>Debit</th>";

    $qry = $con->query("SELECT created_date AS 'tdate', from_bank_id AS 'ctype', '' AS 'Credit', amt AS 'Debit', amt AS 'Amount' FROM ct_db_cash_withdraw WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) and FIND_IN_SET(from_bank_id,'$bank_id') UNION ALL SELECT created_date AS 'tdate', 'Hand Cash' AS 'ctype', '' AS 'Credit', amount AS 'Debit', amount AS 'Amount' FROM ct_db_bank_deposit WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) and FIND_IN_SET(to_bank_id,'$bank_id') UNION ALL SELECT created_date AS 'tdate', 'Hand Cash' AS 'ctype', amt AS 'Credit', '' AS 'Debit', amt AS 'Amount' FROM ct_cr_bank_withdraw WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) and FIND_IN_SET(from_bank_id,'$bank_id') UNION ALL SELECT created_date AS 'tdate', to_bank_id AS 'ctype', amt AS 'Credit', '' AS 'Debit', amt AS 'Amount' FROM ct_cr_cash_deposit WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) and FIND_IN_SET(to_bank_id,'$bank_id') ORDER BY 1");


    $i = 1;$creditSum = 0;$debitSum = 0;

    $tabBody = '<tr>';

    while($row = $qry->fetch_assoc()){
        $tabBody .= "<td>$i</td>";
        $tabBody .= "<td>" . date('d-m-Y',strtotime($row['tdate'])) . "</td>";

        if($row['ctype'] != 'Hand Cash'){
            $bnameqry = $con->query("SELECT short_name,acc_no from bank_creation where id = '".$row['ctype']."' ");
            $bnamerun = $bnameqry->fetch_assoc();
            $bname = $bnamerun['short_name'] . ' - ' . substr($bnamerun['acc_no'],-5);

            $tabBody .= "<td>" . $bname . "</td>";
        }else{
            $tabBody .= "<td>" . $row['ctype'] . "</td>";
        }
        $tabBody .= "<td>" . moneyFormatIndia($row['Credit']) . "</td>";
        $tabBody .= "<td>" . moneyFormatIndia($row['Debit']) . "</td>";
        $tabBody .= '</tr>';

        //Store credit and debit for total
        $creditSum = $creditSum + intVal($row['Credit']);
        $debitSum = $debitSum + intVal($row['Debit']);
        $i++;
    }
    $tabBodyEnd = "<tr><td></td><td colspan='2'><b>Total</b></td><td>".moneyFormatIndia($creditSum)."</td><td>".moneyFormatIndia($debitSum)."</td></tr>";
    $tabBodyEnd .= "<tr><td></td><td colspan='2'><b>Difference</b></td><td colspan='2'>".moneyFormatIndia($creditSum - $debitSum)."</td></tr>";
}else if($sheet_type == 2){ // 2 Means Exchange Balance Sheet

    $tableHeaders = "<th width='50'>S.No</th><th>Date</th><th>Cash Type</th><th>Exchange Entry</th><th>Credit</th><th>Debit</th>";

    $qry = $con->query("SELECT created_date AS tdate, 'Hand Cash' AS ctype, insert_login_id AS from_user_id, '' AS Credit, amt AS Debit, amt AS Amount 
    FROM ct_db_hexchange 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND to_user_id = '$user_id'
    
    UNION ALL 
    
    SELECT created_date AS tdate, to_bank_id AS ctype, insert_login_id AS from_user_id, '' AS Credit, amt AS Debit, amt AS Amount 
    FROM ct_db_bexchange 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND FIND_IN_SET(to_bank_id, '$bank_id')
    
    UNION ALL 
    
    SELECT created_date AS tdate, 'Hand Cash' AS ctype, insert_login_id AS from_user_id, amt AS Credit, '' AS Debit, amt AS Amount 
    FROM ct_cr_hexchange 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND to_user_id = '$user_id'
    
    UNION ALL 
    
    SELECT created_date AS tdate, to_bank_id AS ctype, insert_login_id AS from_user_id, amt AS Credit, '' AS Debit, amt AS Amount 
    FROM ct_cr_bexchange 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND FIND_IN_SET(to_bank_id, '$bank_id')
    
    ORDER BY 1
    ");

    $i = 1;$creditSum = 0;$debitSum = 0;

    $tabBody = '<tr>';

    while($row = $qry->fetch_assoc()){
        $tabBody .= "<td>$i</td>";
        $tabBody .= "<td>" . date('d-m-Y',strtotime($row['tdate'])) . "</td>";

        if($row['ctype'] != 'Hand Cash'){
            $bnameqry = $con->query("SELECT short_name,acc_no from bank_creation where id = '".$row['ctype']."' ");
            $bnamerun = $bnameqry->fetch_assoc();
            $bname = $bnamerun['short_name'] . ' - ' . substr($bnamerun['acc_no'],-5);

            $tabBody .= "<td>" . $bname . "</td>";
        }else{
            $tabBody .= "<td>" . $row['ctype'] . "</td>";
        }
        
        $usernameqry = $con->query("SELECT fullname from user where user_id = '".$row['from_user_id']."' ");
        $username = $usernameqry->fetch_assoc()['fullname'];
        $tabBody .= "<td>" . $username . "</td>";


        $tabBody .= "<td>" . moneyFormatIndia($row['Credit']) . "</td>";
        $tabBody .= "<td>" . moneyFormatIndia($row['Debit']) . "</td>";
        $tabBody .= '</tr>';

        //Store credit and debit for total
        $creditSum = $creditSum + intVal($row['Credit']);
        $debitSum = $debitSum + intVal($row['Debit']);
        $i++;
    }
    $difference = $creditSum - $debitSum;

    $tabBodyEnd = "<tr><td></td><td colspan='3'><b>Total</b></td><td>".moneyFormatIndia($creditSum)."</td><td>".moneyFormatIndia($debitSum)."</td></tr>";
    $tabBodyEnd .= "<tr><td></td><td colspan='3'><b>Difference</b></td><td colspan='2'>".moneyFormatIndia($difference)."</td></tr>";
}else if($sheet_type == 3){ // 3 Means Other income Balance Sheet

    $tableHeaders = "<th width='50'>S.No</th><th>Date</th><th>Cash Type</th><th>Category</th><th>Credit Amount</th>";

    $qry = $con->query("SELECT created_date AS tdate, 'Hand Cash' AS ctype, category , amt AS Credit
    FROM ct_cr_hoti 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND insert_login_id = '$user_id'
    
    UNION ALL 
    
    SELECT created_date AS tdate, to_bank_id AS ctype, category, amt AS Credit
    FROM ct_cr_boti 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND FIND_IN_SET(to_bank_id, '$bank_id')
    
    ORDER BY 1
    ");

    $i = 1;$creditSum = 0;$debitSum = 0;

    $tabBody = '<tr>';

    while($row = $qry->fetch_assoc()){
        $tabBody .= "<td>$i</td>";
        $tabBody .= "<td>" . date('d-m-Y',strtotime($row['tdate'])) . "</td>";

        if($row['ctype'] != 'Hand Cash'){
            $bnameqry = $con->query("SELECT short_name,acc_no from bank_creation where id = '".$row['ctype']."' ");
            $bnamerun = $bnameqry->fetch_assoc();
            $bname = $bnamerun['short_name'] . ' - ' . substr($bnamerun['acc_no'],-5);

            $tabBody .= "<td>" . $bname . "</td>";
        }else{
            $tabBody .= "<td>" . $row['ctype'] . "</td>";
        }
        
        
        
        $tabBody .= "<td>" . $row['category'] . "</td>";
        $tabBody .= "<td>" . moneyFormatIndia($row['Credit']) . "</td>";
        $tabBody .= '</tr>';

        //Store credit and debit for total
        $creditSum = $creditSum + intVal($row['Credit']);
        $i++;
    }

    $tabBodyEnd = "<tr><td></td><td colspan='3'><b>Total</b></td><td>".moneyFormatIndia($creditSum)."</td></tr>";
}else if($sheet_type == 4){//4 Means Expense Balance Sheet
    $tableHeaders = "<th width='50'>S.No</th><th>Date</th><th>Cash Type</th><th>Category</th><th>Debit Amount</th>";

    $qry = $con->query("SELECT created_date AS tdate, 'Hand Cash' AS ctype, cat , amt AS Debit
    FROM ct_db_hexpense 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND insert_login_id = '$user_id'
    
    UNION ALL 
    
    SELECT created_date AS tdate, bank_id AS ctype, cat, amt AS Debit
    FROM ct_db_bexpense 
    WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND FIND_IN_SET(bank_id, '$bank_id')
    
    ORDER BY 1
    ");

    $i = 1;$creditSum = 0;$debitSum = 0;

    $tabBody = '<tr>';

    while($row = $qry->fetch_assoc()){
        $tabBody .= "<td>$i</td>";
        $tabBody .= "<td>" . date('d-m-Y',strtotime($row['tdate'])) . "</td>";

        if($row['ctype'] != 'Hand Cash'){
            $bnameqry = $con->query("SELECT short_name,acc_no from bank_creation where id = '".$row['ctype']."' ");
            $bnamerun = $bnameqry->fetch_assoc();
            $bname = $bnamerun['short_name'] . ' - ' . substr($bnamerun['acc_no'],-5);

            $tabBody .= "<td>" . $bname . "</td>";
        }else{
            $tabBody .= "<td>" . $row['ctype'] . "</td>";
        }
        
        $catqry = $con->query("SELECT category from expense_category where id = '".$row['cat']."' ");
        $category = $catqry->fetch_assoc()['category'];
        
        $tabBody .= "<td>" . $category . "</td>";
        $tabBody .= "<td>" . moneyFormatIndia($row['Debit']) . "</td>";
        $tabBody .= '</tr>';

        //Store credit and debit for total
        $debitSum = $debitSum + intVal($row['Debit']);
        $i++;
    }

    $tabBodyEnd = "<tr><td></td><td colspan='3'><b>Total</b></td><td>".moneyFormatIndia($debitSum)."</td></tr>";
}
else{return '';}
?>

<table class="table custom-table" id='blncSheetTable'>
    <thead>
        <tr>
            <?php echo $tableHeaders;?>
        </tr>
    </thead>
    <tbody>
        <?php
            echo $tabBody;
        ?>
    </tbody>
    <tfoot>
        <?php
            echo $tabBodyEnd;
        ?>
    </tfoot>
</table>

<script type='text/javascript'>
    $(function() {
        $('#blncSheetTable').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            //To change total amount dynamically
            // "footerCallback": function () {
            //     var api = this.api();
            //     var columnIdx = 4; // Replace with the index of the desired column
            //     var columnData = api.column(columnIdx, { search: 'applied' }).data();
                
            //     // Calculate the total value of the column
            //     var total = columnData.reduce(function (a, b) {
            //         b = b.replace(',','');
            //         return parseInt(a) + parseInt(b);
            //     }, 0);
                
            //     // Display the total in the table footer
            //     $(api.column(columnIdx).footer()).html( total);
            // }
        });

    });
</script>

<?php
//Format number in Indian Format
function moneyFormatIndia($num1) {
    if($num1 < 0){
        $num = str_replace("-","",$num1);
    }else{
        $num = $num1;
    }
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

    if($num1 < 0 && $num1 != ''){
        $thecash = "-" . $thecash;
    }

    return $thecash;
}
?>
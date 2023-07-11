<?php 
include('../ajaxconfig.php');
if(isset($_POST['cus_id'])){
    $cus_id = $_POST['cus_id'];
}

$records = array();

$result=$con->query("SELECT * FROM request_creation where cus_id = '".strip_tags($cus_id)."' and (cus_status <= 17 and cus_status != 10 and cus_status != 11 and cus_status != 12 and cus_status != 15) ORDER BY created_date DESC ");

if($result->num_rows>0){
    $i=0;
    while($row = $result->fetch_assoc()){

        $records[$i]['dor'] = date('d-m-Y',strtotime($row['dor']));
        
        $loan_category = $row['loan_category'];
        $qry = $con->query("SELECT * FROM loan_category_creation where loan_category_creation_id = $loan_category");
        $row1 = $qry->fetch_assoc();
        $records[$i]['loan_category'] = $row1['loan_category_creation_name'];
        
        $records[$i]['sub_category'] = $row['sub_category'];
        $records[$i]['loan_amt'] = $row['loan_amt'];
        $cus_status = $row['cus_status']; 
        if($cus_status != '10' and $cus_status != '11' and $cus_status != '12'){
            if($cus_status == '0'){$records[$i]['status'] = 'Request'; $records[$i]['sub_status'] = 'Requested';}else
            if($cus_status == '1' or $cus_status == '12'){$records[$i]['status'] = 'Verification';$records[$i]['sub_status'] = 'In Verification';}else
            if($cus_status == '2'){$records[$i]['status'] = 'Approval';$records[$i]['sub_status'] = 'In Approval';}else
            if($cus_status == '3'){$records[$i]['status'] = 'Acknowledgement';$records[$i]['sub_status'] = 'In Acknowledgement';}else
            if($cus_status == '4'){$records[$i]['status'] = 'Request';$records[$i]['sub_status'] = 'Cancelled';}else
            if($cus_status == '5'){$records[$i]['status'] = 'Verification';$records[$i]['sub_status'] = 'Cancelled';}else
            if($cus_status == '6'){$records[$i]['status'] = 'Approval';$records[$i]['sub_status'] = 'Cancelled';}else
            if($cus_status == '7'){$records[$i]['status'] = 'Issue';$records[$i]['sub_status'] = 'Issued';}else
            if($cus_status == '8'){$records[$i]['status'] = 'Request';$records[$i]['sub_status'] = 'Revoked';}
            if($cus_status == '9'){$records[$i]['status'] = 'Verification';$records[$i]['sub_status'] = 'Revoked';}
            if($cus_status == '13'){$records[$i]['status'] = 'Loan Issue';$records[$i]['sub_status'] = 'In Issue';}
            if($cus_status == '14' or $cus_status == '17'){$records[$i]['status'] = 'Collection';$records[$i]['sub_status'] = 'Collection';}
        }
        
        $i++;
    }

    
}

?>

    <thead>
        <tr>
            <th width="25">S. No</th>
            <th>Date</th>
            <th>Loan Category</th>
            <th>Sub Category</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Sub Status</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i=0;$i<sizeof($records);$i++){?>
        <tr>
            <td><?php echo $i+1;?></td>
            <td><?php echo $records[$i]['dor'];?></td>
            <td><?php echo $records[$i]['loan_category'];?></td>
            <td><?php echo $records[$i]['sub_category'];?></td>
            <td><?php echo $records[$i]['loan_amt'];?></td>
            <td><?php echo $records[$i]['status'];?></td>
            <td><?php echo $records[$i]['sub_status'];?></td>
        </tr>
        <?php } ?>
    </tbody>
<script>
    var table = $('#cusHistoryTable').DataTable();
    table.destroy();
    $('#cusHistoryTable').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "createdRow": function(row, data, dataIndex) {
                $(row).find('td:first').html(dataIndex + 1);
            },
            "drawCallback": function(settings) {
                this.api().column(0).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            },
        });
    </script>
<?php

?>


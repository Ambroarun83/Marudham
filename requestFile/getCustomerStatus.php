<?php 
include('../ajaxconfig.php');
if(isset($_POST['cus_id'])){
    $cus_id = $_POST['cus_id'];
}

$records = array();

$result=$con->query("SELECT * FROM request_creation where cus_id = '".strip_tags($cus_id)."' and (cus_status <= 21 and cus_status != 10 and cus_status != 11) ORDER BY created_date DESC ");

if($result->num_rows>0){
    $i=0;
    while($row = $result->fetch_assoc()){

        $records[$i]['dor'] = date('d-m-Y',strtotime($row['dor']));
        
        $loan_category = $row['loan_category'];
        $req_id = $row['req_id'];
        $qry = $con->query("SELECT * FROM loan_category_creation where loan_category_creation_id = $loan_category");
        $row1 = $qry->fetch_assoc();
        $records[$i]['loan_category'] = $row1['loan_category_creation_name'];
        
        $records[$i]['sub_category'] = $row['sub_category'];
        $records[$i]['loan_amt'] = $row['loan_amt'];
        $cus_status = $row['cus_status']; 
        if($cus_status != '10' and $cus_status != '11'){
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
            if($cus_status == '20'){$records[$i]['status'] = 'Closed';$records[$i]['sub_status'] = 'In Closed';}
            if($cus_status == '21'){//21 means in NOC
                // if moved from Closed, then sub status will be consider level of closed window
                $records[$i]['status'] = 'Closed';
                
                $Qry = $con->query("SELECT closed_sts from closed_status where cus_id = $cus_id and req_id = '".$req_id."' ");
                $closed_status = ['','Consider','Waiting List', 'Block List'];// first one is empty because select value of consider sts is starting at 1
                $records[$i]['sub_status'] = $closed_status[ $Qry->fetch_assoc()['closed_sts'] ];
            }
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


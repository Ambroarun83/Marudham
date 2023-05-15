<?php
include('../ajaxconfig.php');
if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
if(isset($_POST['cus_name'])){
    $cus_name = $_POST['cus_name'];
}

?>
<table class="table custom-table" id='chequeTable'>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Holder Type</th>
            <th>Holder Name</th>
            <th>Relationship</th>
            <th>Bank Name</th>
            <th>Cheque No.</th>
            <th>Checklist</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $qry = $con->query("SELECT a.id,a.cheque_holder_type,a.cheque_holder_name,a.cheque_no,a.noc_given,b.cheque_relation,b.chequebank_name from `cheque_no_list` a JOIN cheque_info b on a.cheque_table_id = b.id where a.req_id = $req_id && a.used_status != '1' ");
        while($row = $qry->fetch_assoc()){

            if(is_numeric($row['cheque_holder_name'])){
                $qry1 = $con->query("SELECT famname from verification_family_info where id = '".$row['cheque_holder_name']."' ");
                $row1 = $qry1->fetch_assoc();
                $holder_name = $row1['famname'];
            }else{$holder_name = $row['cheque_holder_name'];}

        ?>
            <tr>
                <td></td>
                <td><?php if($row['cheque_holder_type'] == '0'){echo 'Customer';}elseif($row['cheque_holder_type'] == '1'){echo 'Guarentor';}elseif($row['cheque_holder_type'] == '2'){echo 'Family Member';}else ?></td>
                <td><?php echo $holder_name;?></td>
                <td><?php echo $row['cheque_relation'];?></td>
                <td><?php echo $row['chequebank_name'];?></td>
                <td><?php echo $row['cheque_no'];?></td>
                <td><input type='checkbox' id='cheque_check' name='cheque_check' class="form-control cheque_check" <?php if($row['noc_given'] == '1') echo 'checked disabled';?> data-value='<?php echo $row['id'];//id of cheque list table?>'></td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>

<script type='text/javascript'>
    $(function() {
        $('#chequeTable').DataTable({
            "title":"Signed Document List",
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
    });
</script>
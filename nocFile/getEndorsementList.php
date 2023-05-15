<?php
include('../ajaxconfig.php');
if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
if(isset($_POST['cus_name'])){
    $cus_name = $_POST['cus_name'];
}

?>
<table class="table custom-table" id='endorsementTable'>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Details</th> <!-- Endorsement Process and Rc and Key will be placed if exist in td -->
            <th>Checklist</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $qry = $con->query("SELECT id,endorsement_process,endorsement_process_noc,en_RC,en_RC_noc,en_RC_used,Rc_document_pending,en_Key,en_Key_noc,en_Key_used from acknowlegement_documentation  where req_id=$req_id");
        $row = $qry->fetch_assoc();
        ?>
                <?php if($row['endorsement_process'] == '0'){
                    ?>
                <tr>
                    <td></td>
                    <td>Endorsement Process</td>
                    <td><input type='checkbox' id='endorse_check' name='endorse_check' class="form-control endorse_check" <?php if($row['endorsement_process_noc'] == '1') echo 'checked disabled';?> data-value='<?php echo $row['id'];//id of ack_documentation table?>'></td>
                </tr>
                    <?php
                }?>
                <?php if($row['en_RC'] == '0' && $row['Rc_document_pending'] != 'YES' && $row['en_RC_used'] != '1'){
                    ?>
                <tr>
                    <td></td>
                    <td>RC</td>
                    <td><input type='checkbox' id='endorse_check' name='endorse_check' class="form-control endorse_check" <?php if($row['en_RC_noc'] == '1') echo 'checked disabled';?> data-value='<?php echo $row['id'];//id of ack_documentation table?>'></td>
                </tr>
                    <?php
                }?>
                <?php if($row['en_Key'] == '0' && $row['en_Key_used'] != '1'){
                    ?>
                <tr>
                    <td></td>
                    <td>Key</td>
                    <td><input type='checkbox' id='endorse_check' name='endorse_check' class="form-control endorse_check" <?php if($row['en_Key_noc'] == '1') echo 'checked disabled';?> data-value='<?php echo $row['id'];//id of ack_documentation table?>'></td>
                </tr>
                    <?php
                }?>

    </tbody>
</table>

<script type='text/javascript'>
    $(function() {
        $('#endorsementTable').DataTable({
            "title":"Endorsement List",
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
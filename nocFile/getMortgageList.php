<?php
include('../ajaxconfig.php');
if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
if(isset($_POST['cus_name'])){
    $cus_name = $_POST['cus_name'];
}

?>
<table class="table custom-table" id='mortgageTable'>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Details</th> <!-- Mortgage Process and Document will be placed if exist in td -->
            <th>Checklist</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $qry = $con->query("SELECT id,mortgage_process,mortgage_document,mortgage_document_pending,mortgage_process_noc,mortgage_document_noc,mortgage_document_used from acknowlegement_documentation where req_id=$req_id ");
        $row = $qry->fetch_assoc();
        ?>
                <?php if($row['mortgage_process'] == '0'){
                    ?>
                <tr>
                    <td></td>
                    <td>Mortgage Process</td>
                    <td><input type='checkbox' id='mort_check' name='mort_check' class="form-control mort_check" <?php if($row['mortgage_process_noc'] == '1') echo 'checked disabled';?> data-value='<?php echo $row['id'];//id of ack_documentation list table?>'></td>
                </tr>
                    <?php
                }?>
                <?php if($row['mortgage_document'] == '0' && $row['mortgage_document_pending'] != 'YES' && $row['mortgage_document_used'] != '1'){
                    ?>
                <tr>
                    <td></td>
                    <td>Mortgage Document</td>
                    <td><input type='checkbox' id='mort_check' name='mort_check' class="form-control mort_check" <?php if($row['mortgage_document_noc'] == '1') echo 'checked disabled';?> data-value='<?php echo $row['id'];//id of ack_documentation list table?>'></td>
                </tr>
                    <?php
                }?>

    </tbody>
</table>

<script type='text/javascript'>
    $(function() {
        $('#mortgageTable').DataTable({
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
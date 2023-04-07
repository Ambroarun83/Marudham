<?php
include '../ajaxconfig.php';
?>

<table class="table custom-table " id="grpdatatable">
    <thead>
        <tr>
            <th width="25%">S.No</th>
            <th>Name</th>
            <th>Aadhar Number</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $reqId = $_POST['reqId'];
        $grpInfo = $connect->query("SELECT * FROM `verification_group_info` where req_id='$reqId' order by id desc");

        $i = 1;
        while ($grp = $grpInfo->fetch()) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $grp["group_name"]; ?></td>
                <td><?php echo $grp["group_aadhar"]; ?></td>
                <td>
                    <a id="verification_grp_edit" value="<?php echo $grp['id']; ?>"> <span class="icon-border_color"></span></a> &nbsp
                    <a id="verification_grp_delete" value="<?php echo $grp['id']; ?>"> <span class='icon-trash-2'></span> </a>
                </td>
            </tr>
        <?php $i = $i + 1;
        }
        ?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $('#grpdatatable').DataTable({
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
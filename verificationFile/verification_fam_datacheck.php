<?php
include '../ajaxconfig.php';
?>

<h5> Family Data </h5>
<table class="table custom-table " id="fam_datacheck">
    <thead>
        <tr>
            <th>S.No</th>
            <th> Customer ID </th>
            <th> Name</th>
            <th> Relationship </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($_POST['name'])){
        $name = $_POST['name'];
        }
        if(isset($_POST['req_id'])){
        $req_id = $_POST['req_id'];
        }
        if(isset($_POST['category'])){
            $category = $_POST['category'];
            if($category == '0'){ $category = "famname";}
            if($category == '1'){ $category = "relation_aadhar";}
            if($category == '2'){ $category = "relation_Mobile";}
            }

        $cusInfo = $connect->query("SELECT `famname`,`relationship`,`relation_aadhar` FROM `verification_family_info` WHERE `req_id` != '$req_id' && $category = '$name' order by id desc");

        $i = 1;
        while ($cus = $cusInfo->fetch()) {
        ?>
            <tr>
                <td> <?php echo $i++; ?></td>
                <td> <?php echo $cus['relation_aadhar']; ?></td>
                <td> <?php echo $cus['famname']; ?></td>
                <td> <?php echo $cus['relationship']; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script type="text/javascript">
    // $(function() {
    //     $('#fam_datacheck').DataTable({
    //         'processing': true,
    //         'iDisplayLength': 5,
    //         "lengthMenu": [
    //             [10, 25, 50, -1],
    //             [10, 25, 50, "All"]
    //         ],
    //         "createdRow": function(row, data, dataIndex) {
    //             $(row).find('td:first').html(dataIndex + 1);
    //         },
    //         "drawCallback": function(settings) {
    //             this.api().column(0).nodes().each(function(cell, i) {
    //                 cell.innerHTML = i + 1;
    //             });
    //         },
    //     });
    // });
</script>
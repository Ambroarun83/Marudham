<?php
include '../ajaxconfig.php';

$req_id = $_POST['req_id'];
$cus_name = $_POST['cus_name'];
$cus_id = $_POST['cus_id'];

?>

<table class="table custom-table fingerprintTable">
    <thead>
        <tr>
            <th> S.No </th>
            <th> Name </th>
            <th> Relationship </th>
            <th> Fingerprint </th>
        </tr>
    </thead>
    <tbody>

    <tr>
        <td><?php echo '1'; ?></td>
        <td><input type='hidden' id='adhar_print' name='adhar_print[]' value='<?php echo $cus_id;?>'><?php echo $cus_name;?></td>
        <td><?php echo 'Customer';?></td>
        <td>
            <input type='hidden' id='left_thumb' name='left_thumb[]'>
            <button type="button" class='btn btn-success scanBtn' style='background-color:#009688' onclick="event.preventDefault()" title='Left Thumb'><i class="material-icons">&#xe90d;</i>&nbsp;Left</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='hidden' id='right_thumb' name='right_thumb[]'>
            <button type="button" class='btn btn-success scanBtn' style='background-color:#009688' onclick="event.preventDefault()" title='Right Thumb'>Right&nbsp;<i class="material-icons">&#xe90d;</i></button>
        </td>
    </tr>

        <?php
        
        $qry = $connect->query("SELECT * FROM `verification_family_info` WHERE `req_id`='$req_id' ");

        $i = 2;
        while ($row = $qry->fetch()) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><input type='hidden' id='adhar_print' name='adhar_print[]' value='<?php echo $row['relation_aadhar'];?>'><?php echo $row["famname"]; ?></td>
                <td><?php echo $row["relationship"]; ?></td>
                <td>
                    <input type='hidden' id='left_thumb' name='left_thumb[]'>
                    <button type="button" class='btn btn-success scanBtn' style='background-color:#009688' onclick="event.preventDefault()" title='Left Thumb'><i class="material-icons">&#xe90d;</i>&nbsp;Left</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type='hidden' id='right_thumb' name='right_thumb[]'>
                    <button type="button" class='btn btn-success scanBtn' style='background-color:#009688' onclick="event.preventDefault()" title='Right Thumb'>Right&nbsp;<i class="material-icons">&#xe90d;</i></button>
                </td>

            </tr>

        <?php 
        $i++;
        } 
        ?>
    </tbody>
</table>

<?php
include '../ajaxconfig.php';

$req_id = $_POST['req_id'];
$cus_name = $_POST['cus_name'];

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
        <td><?php echo $cus_name;?></td>
        <td><?php echo 'Customer';?></td>
        <td>
            <button type="button" class='btn btn-success scanBtn' style='background-color:#009688' onclick="event.preventDefault()">Scan<i class="material-icons">&nbsp;&#xe90d;</i></button>
        </td>
    </tr>

        <?php
        
        $qry = $connect->query("SELECT * FROM `verification_family_info` WHERE `req_id`='$req_id' ");

        $i = 2;
        while ($row = $qry->fetch()) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["famname"]; ?></td>
                <td><?php echo $row["relationship"]; ?></td>
                <td>
                    <button type="button" class='btn btn-success scanBtn' style='background-color:#009688' onclick="event.preventDefault()">Scan<i class="material-icons">&nbsp;&#xe90d;</i></button>
                </td>

            </tr>

        <?php 
        $i++;
        } 
        ?>
    </tbody>
</table>

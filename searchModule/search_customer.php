<?php
include '../ajaxconfig.php';

$cus_id = $_POST['cus_id'] ?? '';
$cus_name = $_POST['cus_name'] ?? '';
$area = $_POST['area'] ?? '';
$sub_area = $_POST['sub_area'] ?? '';
$mobile = $_POST['mobile'] ?? '';

$statusLabels = [
    '0' => "In Request",
    '1' => 'In Verification',
    '2' => 'In Approval',
    '3' => 'In Acknowledgement',
    '4' => 'Cancel - Request',
    '5' => 'Cancel - Verification',
    '6' => 'Cancel - Approval',
    '7' => 'Cancel - Acknowledgement',
    '8' => 'Revoke - Request',
    '9' => 'Revoke - Verification',
    '10' => 'In Verification',
    '11' => 'In Verification',
    '12' => 'In Verification',
    '13' => 'In Issue',
    '14' => 'Collection',
    '15' => 'Collection Error',
    '16' => 'Collection Legal',
    '17' => 'Collection',
    '20' => 'Closed',
    '21' => 'NOC',
];

// $sql = "SELECT cus_id from customer_register cr
//         JOIN area_list_creation ac ON 1
//         JOIN sub_area_list_creation sac ON 1
//         WHERE CASE 
//             WHEN '$cus_id' != '' THEN cr.cus_id LIKE '%$cus_id%'
//             WHEN '$cus_name' != '' THEN cr.customer_name LIKE '%$cus_name%'
//             WHEN '$area' != '' THEN ac.area_name LIKE '%$area%'
//             WHEN '$sub_area' != '' THEN sac.sub_area_name LIKE '%$sub_area%'
//             WHEN '$mobile' != '' THEN cr.mobile1 LIKE '%$mobile%' or cr.mobile2 LIKE '%$mobile%'
//             END";
if ($cus_id != '') {

    $sql = "SELECT cus_id from customer_register WHERE cus_id LIKE '%$cus_id%' ";
} else if ($cus_name != '') {
    $sql = "SELECT cus_id from customer_register WHERE cus_name LIKE '%$cus_name%' ";
} else if ($mobile != '') {
    $sql = "SELECT cus_id from customer_register WHERE mobile1 LIKE '%$mobile%' or mobile2 LIKE '%$mobile%' ";
} else if ($area != '') {
    $sql = "SELECT cr.cus_id from area_list_creation ac JOIN customer_register cr ON ac.area_id = cr.area WHERE ac.area_name LIKE '%$area%' ";
} else if ($sub_area != '') {
    $sql = "SELECT cr.cus_id from sub_area_list_creation sac JOIN customer_register cr ON sac.sub_area_id = cr.sub_area WHERE sac.sub_area_name LIKE '%$sub_area%' ";
}

$runSql = $con->query($sql);
if ($runSql->num_rows > 0) {
    $cus_id_fetched = $runSql->fetch_assoc()['cus_id'];
} else {
    $cus_id_fetched = '';
}

if ($cus_id_fetched != '') {

    $sql = "SELECT req_id,cus_status From request_creation where cus_id = $cus_id_fetched";
    $runSql = $con->query($sql);
    // while($row = $runSql->fetch_assoc()){
    //     $cus_status = $row['cus_status'];
    //     $req_id = $row['req_id'];
    //     if($cus_status == '0' || $cus_status == '1'){
    //         $sql = "SELECT req.cus_id,req.cus_name,ac.area_name,sac.sub_area_name,bc.branch_name,alm.line_name,agm.group_name,req.mobile1,req.mobile2 
    //             From request_creation req 
    //             LEFT JOIN area_list_creation ac ON req.area = ac.area_id 
    //             LEFT JOIN sub_area_list_creation sac ON req.sub_area = sac.sub_area_id 
    //             LEFT JOIN area_line_mapping alm ON FIND_IN_SET(sac.sub_area_id,alm.sub_area_id)
    //             LEFT JOIN area_group_mapping agm ON FIND_IN_SET(sac.sub_area_id,agm.sub_area_id)
    //             LEFT JOIN branch_creation bc ON agm.branch_id = bc.branch_id 
    //             where req_id = $req_id ";
    //     }
    // }

}
?>

<table class="table custom-table">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Area</th>
            <th>Sub Area</th>
            <th>Branch</th>
            <th>Line</th>
            <th>Group</th>
            <th>Mobile 1</th>
            <th>Mobile 2</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while ($row = $runSql->fetch_assoc()) {
            $cus_status = $row['cus_status'];
            $req_id = $row['req_id'];
            if ($cus_status == '0' || $cus_status == '1') {
                $sql1 = "SELECT req.cus_id,req.cus_name,ac.area_name,sac.sub_area_name,bc.branch_name,alm.line_name,agm.group_name,req.mobile1,req.mobile2 
                    From request_creation req 
                    LEFT JOIN area_list_creation ac ON req.area = ac.area_id 
                    LEFT JOIN sub_area_list_creation sac ON req.sub_area = sac.sub_area_id 
                    LEFT JOIN area_line_mapping alm ON FIND_IN_SET(sac.sub_area_id,alm.sub_area_id)
                    LEFT JOIN area_group_mapping agm ON FIND_IN_SET(sac.sub_area_id,agm.sub_area_id)
                    LEFT JOIN branch_creation bc ON agm.branch_id = bc.branch_id 
                    where req_id = $req_id ";
            }
            while ($req_row = $con->query($sql1)->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $req_row['cus_id']; ?></td>
                    <td><?php echo $req_row['cus_name']; ?></td>
                    <td><?php echo $req_row['area_name']; ?></td>
                    <td><?php echo $req_row['sub_area_name']; ?></td>
                    <td><?php echo $req_row['branch_name']; ?></td>
                    <td><?php echo $req_row['line_name']; ?></td>
                    <td><?php echo $req_row['group_name']; ?></td>
                    <td><?php echo $req_row['mobile1']; ?></td>
                    <td><?php echo $req_row['mobile2']; ?></td>
                    <td><input type="button" class="view_cust btn btn-primary" value="View" data-toggle="modal" data-target="#customerDetailModal" data-reqId="<?php echo $req_id; ?>"></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
<?php
session_start();
include '../ajaxconfig.php';


$obj = new getUserDetails;

$req_id = $_POST['req_id'] ?? '';
$i = 0;
$data = array();

$qry = $con->query("SELECT cus_status FROM request_creation where req_id = '$req_id' ");
$cus_status = $qry->fetch_assoc()['cus_status'] ?? '';

if ($cus_status != '') {

    // Request
    $qry = $con->query("SELECT sub_area,insert_login_id,created_date from request_creation where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $branch = $obj->getBranchName($con, $row['sub_area'], 'group');
    $data[] = $obj->getTrackDetails($con, 'Request', $row['created_date'], $row['insert_login_id'], $branch);

    // Customer Profile
    $qry = $con->query("SELECT area_confirm_subarea as sub_area,insert_login_id,created_date from customer_profile where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $branch = $obj->getBranchName($con, $row['sub_area'], 'group');
    $data[] = $obj->getTrackDetails($con, 'Customer Profile', $row['created_date'], $row['insert_login_id'], $branch);

    // Documentation
    $qry = $con->query("SELECT insert_login_id,created_date from verification_documentation where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $data[] = $obj->getTrackDetails($con, 'Documentation', $row['created_date'], $row['insert_login_id'], $branch);

    // Loan Calculation
    $qry = $con->query("SELECT insert_login_id,create_date from verification_loan_calculation where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $data[] = $obj->getTrackDetails($con, 'Loan Calculation', $row['create_date'], $row['insert_login_id'], $branch);

    // Approval
    $qry = $con->query("SELECT inserted_user,inserted_date from in_acknowledgement where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $data[] = $obj->getTrackDetails($con, 'Approval', $row['inserted_date'], $row['inserted_user'], $branch);

    // Acknowledgment
    $qry = $con->query("SELECT inserted_user,inserted_date from in_issue where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $qry1 = $con->query("SELECT area_confirm_subarea as sub_area from acknowlegement_customer_profile where req_id = $req_id");
    $sub_area_id = $qry1->fetch_assoc()['sub_area'];
    $branch = $obj->getBranchName($con, $sub_area_id, 'group');
    $data[] = $obj->getTrackDetails($con, 'Acknowledgment', $row['inserted_date'], $row['inserted_user'], $branch);

    // Loan Issue
    $qry = $con->query("SELECT insert_login_id,created_date from loan_issue where req_id = $req_id order by `id` DESC LIMIT 1"); //limit 1 desc because that table will have multiple lines for single customer, so last would be the correct one
    $row = $qry->fetch_assoc();
    $data[] = $obj->getTrackDetails($con, 'Loan Issue', $row['created_date'], $row['insert_login_id'], $branch);

    // Closed
    $qry = $con->query("SELECT insert_login_id,created_date from closed_status where req_id = $req_id");
    $row = $qry->fetch_assoc();
    $branch = $obj->getBranchName($con, $sub_area_id, 'line');
    $data[] = $obj->getTrackDetails($con, 'Closed', $row['created_date'], $row['insert_login_id'], $branch);
}
// echo json_encode($data);
?>

<table>
    <thead>
        <th width="10%">S.No</th>
        <th>Loan Stage</th>
        <th>Date</th>
        <th>User Type</th>
        <th>User Name</th>
        <th>Name</th>
        <th>Branch</th>
    </thead>
    <tbody>
        <?php
        foreach ($data as $item) {
        ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $item['stage']; ?></td>
                <td><?php echo $item['date']; ?></td>
                <td><?php echo $item['usertype']; ?></td>
                <td><?php echo $item['username']; ?></td>
                <td><?php echo $item['fullname']; ?></td>
                <td><?php echo $item['branch']; ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>
</table>

<?php

class getUserDetails
{
    public $usertypeArr = ['', 'Director', 'Agent', 'Staff'];
    public function getTrackDetails($con, $stage, $date, $user_id, $branch)
    {
        $qry = $con->query("SELECT `role`,`user_name`,`fullname` FROM `user` WHERE user_id='" . mysqli_real_escape_string($con, $user_id) . "'");
        $row = $qry->fetch_assoc();

        $date = date('d-m-Y', strtotime($date));
        $usertype = $this->usertypeArr[$row['role']];

        $response = array('stage' => $stage, 'date' => $date, 'usertype' => $usertype, 'username' => $row['user_name'], 'fullname' => $row['fullname'], 'branch' => $branch);

        return $response;
    }
    public function getBranchName($con, $sub_area, $type)
    {
        if ($type == 'group') {
            $qry = $con->query("SELECT bc.branch_name from area_group_mapping agm LEFT JOIN branch_creation bc ON agm.branch_id = bc.branch_id where FIND_IN_SET($sub_area,agm.sub_area_id)");
        } else if ($type == 'line') {
            $qry = $con->query("SELECT bc.branch_name from area_line_mapping alm LEFT JOIN branch_creation bc ON alm.branch_id = bc.branch_id where FIND_IN_SET($sub_area,alm.sub_area_id)");
        }
        $branch_name = $qry->fetch_assoc()['branch_name'];
        return $branch_name;
    }
}
?>
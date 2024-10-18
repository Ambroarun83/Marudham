<?php
@session_start();
include('../../ajaxconfig.php');
include_once('../../api/config-file.php');

if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
}

if ($user_id != 1) {

    $userQry = $con->query("SELECT * FROM USER WHERE user_id = $user_id ");
    while ($rowuser = $userQry->fetch_assoc()) {
        $group_id = $rowuser['group_id'];
        $line_id = $rowuser['line_id'];
    }

    $line_id = explode(',', $line_id);
    $sub_area_list = array();
    foreach ($line_id as $line) {
        $lineQry = $con->query("SELECT * FROM area_line_mapping where map_id = $line ");
        $row_sub = $lineQry->fetch_assoc();
        $sub_area_list[] = $row_sub['sub_area_id'];
    }
    $sub_area_ids = array();
    foreach ($sub_area_list as $subarray) {
        $sub_area_ids = array_merge($sub_area_ids, explode(',', $subarray));
    }
    $sub_area_list = array();
    $sub_area_list = implode(',', $sub_area_ids);
}


$start = $_POST['start'];
$length = $_POST['length'];
$searchValue = $_POST['search'];

$data = [];

$columns = ['cp.id', 'cp.cus_id', 'cp.cus_name'];
$orderDir = $_POST['order'][0]['dir'];
$order = $columns[$_POST['order'][0]['column']] ? "ORDER BY " . $columns[$_POST['order'][0]['column']] . " $orderDir" : "";
$search = $searchValue != '' ? "and (cp.cus_name LIKE '%$searchValue%' or ii.cus_id LIKE '$searchValue%' or cp.mobile1 LIKE '$searchValue%' )" : '';

$query = "SELECT cp.cus_id as cp_cus_id,cp.cus_name,cp.area_confirm_area,cp.area_confirm_subarea,cp.area_line,cp.mobile1, ii.cus_id as ii_cus_id, ii.req_id, cs.sub_status FROM acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id JOIN customer_status cs ON cp.cus_id = cs.cus_id WHERE cs.payable_amnt > 0 AND ii.status = 0 AND (ii.cus_status >= 14 AND ii.cus_status <= 17) $search AND cp.area_confirm_subarea IN ($sub_area_list) GROUP BY ii.cus_id, cs.cus_id $order LIMIT $start, $length"; // 14 and 17 means collection entries, 17 removed from issue list

//this will only take selected req_ids which is payable > 0
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$sno = 1;
foreach ($result as $row) {
    $cus_id = $row['cp_cus_id'];
    $cus_name = $row['cus_name'];
    $area_name = '';
    $sub_area_name = '';
    $branch_name = '';
    $comm_date = '';
    $hint = '';
    $comm_err = '';

    // Fetch area name
    $area_id = $row['area_confirm_area'];
    $qry = $mysqli->query("SELECT * FROM area_list_creation WHERE area_id = $area_id");
    if ($qry->num_rows > 0) {
        $row1 = $qry->fetch_assoc();
        $area_name = $row1['area_name'];
    }

    // Fetch sub-area name
    $sub_area_id = $row['area_confirm_subarea'];
    $qry = $mysqli->query("SELECT * FROM sub_area_list_creation WHERE sub_area_id = $sub_area_id");
    if ($qry->num_rows > 0) {
        $row1 = $qry->fetch_assoc();
        $sub_area_name = $row1['sub_area_name'];
    }

    // Fetch branch name
    $line_name = $row['area_line'];
    $qry = $mysqli->query("SELECT b.branch_name FROM branch_creation b JOIN area_line_mapping l ON l.branch_id = b.branch_id WHERE l.line_name = '$line_name'");
    if ($qry->num_rows > 0) {
        $row1 = $qry->fetch_assoc();
        $branch_name = $row1['branch_name'];
    }

    // Fetch collection date range
    $collDate = $mysqli->query("SELECT CASE WHEN DAYOFMONTH(coll_date) BETWEEN 26 AND 31 THEN '26-30' WHEN DAYOFMONTH(coll_date) BETWEEN 21 AND 25 THEN '21-25' WHEN DAYOFMONTH(coll_date) BETWEEN 16 AND 20 THEN '16-20' WHEN DAYOFMONTH(coll_date) BETWEEN 11 AND 15 THEN '11-15' ELSE '1-10' END AS date_range FROM collection WHERE cus_id='$cus_id' ORDER BY coll_id DESC LIMIT 1");
    $coll_date_qry = $collDate->fetch_assoc();
    $date_range = isset($coll_date_qry['date_range']) ? $coll_date_qry['date_range'] : '';

    // Fetch commitment details
    $sql = $con->query("SELECT comm_date, hint, comm_err FROM commitment WHERE cus_id='$cus_id' ORDER BY id DESC LIMIT 1");
    if ($sql->num_rows > 0) {
        $row1 = $sql->fetch_assoc();
        $hint = $row1['hint'];
        $comm_err = ($row1['comm_err'] == '1') ? 'Error' : (($row1['comm_err'] == '2') ? 'Clear' : '');
        $comm_date = ($row1['comm_date'] != '0000-00-00') ? date('d-m-Y', strtotime($row1['comm_date'])) : '';
    }

    $data[] = [
        $finalData['sno'] = $sno,
        $finalData['cus_id'] = $cus_id,
        $finalData['cus_name'] = $cus_name,
        $finalData['area_name'] = $area_name,
        $finalData['sub_area_name'] = $sub_area_name,
        $finalData['branch_name'] = $branch_name,
        $finalData['line'] = $row['area_line'],
        $finalData['mobile'] = $row['mobile1'],
        $finalData['sub_status'] = $row['sub_status'],
        $finalData['action'] = "<a href='due_followup&upd={$row['req_id']}&cusidupd=$cus_id' title='Edit details'><button class='btn btn-success' style='background-color:#009688;'>View Loans</button></a>",
        $finalData['last_paid_date'] = $date_range,
        $finalData['hint'] = $hint,
        $finalData['comm_err'] = $comm_err,
        $finalData['comm_dat'] = $comm_date
    ];
    $sno++;
}

// Step 3: Return the data in JSON format
echo json_encode([
    "draw" => intval($_POST['draw']),
    "recordsTotal" => getTotalRecords($con),
    "recordsFiltered" => getFilteredRecords($con, $data, $searchValue, $sub_area_list),
    "data" => $data
]);

function getTotalRecords($con)
{
    // Your database query to get the total number of records
    // For example:
    // $query = "SELECT COUNT(*) FROM customers";
    // Execute the query and return the result
    $query = $con->query("SELECT COUNT(*) as total FROM (SELECT cp.cus_id as cp_cus_id FROM acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) GROUP BY ii.cus_id) as subquery ");
    $total = $query->fetch_assoc()['total'];
    return $total;
}

function getFilteredRecords($con, $data, $searchValue, $sub_area_list)
{
    // Your database query to get the total number of filtered records
    // For example:
    // $query = "SELECT COUNT(*) FROM customers WHERE ... LIKE '%$searchValue%'";
    // Execute the query and return the result
    $search = $searchValue != '' ? "and (cp.cus_name LIKE '%$searchValue%' or ii.cus_id LIKE '$searchValue%' or cp.mobile1 LIKE '$searchValue%' )" : '';
    if (count($data) > 0) {
        $query = $con->query("SELECT COUNT(*) as total FROM (SELECT cp.cus_id as cp_cus_id FROM acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) $search and cp.area_confirm_subarea IN ($sub_area_list) GROUP BY ii.cus_id) as subquery ");
        $total = $query->fetch_assoc()['total'];
        return $total;
    } else {
        return 0;
    }
}

$con->close();
$mysqli->close();
$connect = NULL;
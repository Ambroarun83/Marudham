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

// Step 1: Fetch customer IDs
$customerIDs = fetchCustomerIDs($con, $start, $length, $searchValue, $sub_area_list);
// print_r($customerIDs);die;
// Step 2: Process each customer ID to get the final data
$data = [];
foreach ($customerIDs as $cus_id) {
    // Process the customer ID
    $statusResponse = file_get_contents(HOSTPATH . "collectionFile/resetCustomerStatus.php?cus_id=$cus_id");
    // echo $statusResponse;//in case of data not fetching, uncommend this to see the error in calling file
    $statusData = json_decode($statusResponse, true);
    $statusData = getfilteredCusData($statusData);
    $follow_cus_sts = $statusData['follow_cus_sts'];

    if (!is_array($statusData['req_id'])) {
        //if the req_id is not arrray then make it as array for implode
        $statusData['req_id'] = [$statusData['req_id']];
    }
    $req_id = implode(",", $statusData['req_id']);

    $payable = $statusData['payable'];

    $finalResponse = file_get_contents(HOSTPATH . "followupFiles/dueFollowup/ajaxDueFollowupFetch.php?cus_id=$cus_id&req_id=$req_id&follow_cus_sts=$follow_cus_sts&payable=$payable&userid=$user_id");
    // echo $finalResponse;//in case of data not fetching, uncommend this to see the error in calling file
    $finalData = json_decode($finalResponse, true);

    if (!empty($finalData)) {
        $data[] = [
            $finalData['sno'],
            $finalData['cus_id'],
            $finalData['cus_name'],
            $finalData['area_name'],
            $finalData['sub_area_name'],
            $finalData['branch_name'],
            $finalData['line'],
            $finalData['mobile'],
            $finalData['sub_status'],
            $finalData['action'],
            $finalData['last_paid_date'],
            $finalData['hint'],
            $finalData['comm_err'],
            $finalData['comm_dat']
        ];
    }
}

// Step 3: Return the data in JSON format
echo json_encode([
    "draw" => intval($_POST['draw']),
    "recordsTotal" => getTotalRecords($con),
    "recordsFiltered" => getFilteredRecords($con, $data, $searchValue, $sub_area_list),
    "data" => $data
]);

function getfilteredCusData($statusData)
{
    $keys_to_filter = ['follow_cus_sts', 'req_id', 'payable'];
    $result = array();
    foreach ($keys_to_filter as $key) {
        if (isset($statusData[$key])) {
            // Flatten the array if it contains only one element
            $result[$key] = is_array($statusData[$key]) && count($statusData[$key]) === 1 ? array_values($statusData[$key])[0] : $statusData[$key];
        }
    }
    return $result;
}

function fetchCustomerIDs($con, $start, $length, $searchValue, $sub_area_list)
{
    // Your database query to fetch customer IDs based on pagination and search
    // For example:
    // $query = "SELECT cus_id FROM customers WHERE ... LIMIT $start, $length";
    // Execute the query and return the result
    $columns = ['cp.id', 'cp.cus_id', 'cp.cus_name'];
    $orderDir = $_POST['order'][0]['dir'];
    $order = $columns[$_POST['order'][0]['column']] ? "ORDER BY " . $columns[$_POST['order'][0]['column']] . " $orderDir" : "";
    $search = $searchValue != '' ? "and (cp.cus_name LIKE '%$searchValue%' or ii.cus_id LIKE '$searchValue%' or cp.mobile1 LIKE '$searchValue%' )" : '';

    $query = $con->query("SELECT cp.cus_id as cp_cus_id FROM acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) $search and cp.area_confirm_subarea IN ($sub_area_list) GROUP BY ii.cus_id $order LIMIT $start, $length"); // 14 and 17 means collection entries, 17 removed from issue list
    $response = array();
    while ($row = $query->fetch_assoc()) {
        array_push($response, $row['cp_cus_id']);
    }
    return $response;
}

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
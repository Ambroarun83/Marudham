<?php

session_start();
include '../../ajaxconfig.php';

$where = "1";

if (isset($_POST['from_date']) && isset($_POST['to_date']) && $_POST['from_date'] != '' && $_POST['to_date'] != '') {
    $from_date = date('Y-m-d', strtotime($_POST['from_date']));
    $to_date = date('Y-m-d', strtotime($_POST['to_date']));
    $where  = "(date(cs.created_date) >= '" . $from_date . "') and (date(cs.created_date) <= '" . $to_date . "') ";
}

if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}
if ($userid != 1) {

    $userQry = $con->query("SELECT * FROM USER WHERE user_id = $userid ");
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
$closed_sts_arr = [
    '1' => 'Consider',
    '2' => 'Waiting List',
    '3' => 'Block List'
];
$closed_lvl_arr = [
    '1' => 'Bronze',
    '2' => 'Silver',
    '3' => 'Gold',
    '4' => 'Platinum',
    '5' => 'Diamond'
];

$column = array(
    'ii.id',
    'cp.area_line',
    'ii.loan_id',
    'ii.updated_date',
    'cp.cus_id',
    'cp.cus_name',
    'al.area_name',
    'sal.sub_area_name',
    'ii.id',
    'lc.sub_category',
    'ii.id',
    'lc.maturity_month',
    'cs.created_date',
    'ii.id',
    'ii.id',
    'ii.id'
);

$query = "SELECT 
            cp.area_line as line,
            ii.loan_id,
            ii.updated_date as loan_date,
            cp.cus_id,
            cp.cus_name,
            al.area_name,
            sal.sub_area_name,
            (SELECT loan_category_creation_name From loan_category_creation WHERE loan_category_creation_id = lc.loan_category) as loan_cat_name,
            lc.sub_category,
            lc.loan_amt_cal,
            lc.maturity_month,
            cs.created_date,
            (SELECT coll_location FROM collection where req_id = ii.req_id GROUP BY coll_location ORDER BY COUNT(coll_location) DESC LIMIT 1) as coll_format,
            cs.closed_sts,
            cs.consider_level

            FROM in_issue ii
            JOIN acknowlegement_customer_profile cp ON ii.req_id = cp.req_id
            JOIN acknowlegement_loan_calculation lc ON ii.req_id = lc.req_id
            JOIN area_list_creation al ON cp.area_confirm_area = al.area_id
            JOIN sub_area_list_creation sal ON cp.area_confirm_subarea = sal.sub_area_id
            JOIN closed_status cs ON ii.req_id = cs.req_id
            
            WHERE ii.cus_status >= 20 and " . $where . "
            and cp.area_confirm_subarea IN ($sub_area_list) ";


if (isset($_POST['search'])) {
    if ($_POST['search'] != "") {
        $query .= " and (cp.area_line LIKE '%" . $_POST['search'] . "%' OR
            ii.loan_id LIKE '%" . $_POST['search'] . "%' OR
            ii.updated_date LIKE '%" . $_POST['search'] . "%' OR
            cp.cus_id LIKE '%" . $_POST['search'] . "%' OR
            cp.cus_name LIKE '%" . $_POST['search'] . "%' OR
            al.area_name LIKE '%" . $_POST['search'] . "%' OR
            sal.sub_area_name LIKE '%" . $_POST['search'] . "%' OR
            lc.sub_category LIKE '%" . $_POST['search'] . "%' OR
            lc.maturity_month LIKE '%" . $_POST['search'] . "%' OR
            cs.created_date LIKE '%" . $_POST['search'] . "%' ) ";
    }
}
if (isset($_POST['order'])) {
    $query .= " ORDER BY " . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'];
} else {
    $query .= ' ';
}

$query1 = "";
if ($_POST['length'] != -1) {
    $query1 = " LIMIT " . $_POST['start'] . ", " . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();
$sno = 1;
foreach ($result as $row) {
    $sub_array   = array();
    $sub_array[] = $sno;
    $sub_array[] = $row['line'];
    $sub_array[] = $row['loan_id'];
    $sub_array[] = date('d-m-Y', strtotime($row['loan_date']));
    $sub_array[] = $row['cus_id'];
    $sub_array[] = $row['cus_name'];
    $sub_array[] = $row['area_name'];
    $sub_array[] = $row['sub_area_name'];
    $sub_array[] = $row['loan_cat_name'];
    $sub_array[] = $row['sub_category'];
    $sub_array[] = moneyFormatIndia($row['loan_amt_cal']);
    $sub_array[] = date('d-m-Y', strtotime($row['maturity_month']));
    $sub_array[] = date('d-m-Y', strtotime($row['created_date']));
    $sub_array[] = $row['coll_format'] == '1' ? 'By Self' : 'On Spot';
    $sub_array[] = $closed_sts_arr[$row['closed_sts']];
    $sub_array[] = $closed_lvl_arr[$row['consider_level']];

    $data[]      = $sub_array;
    $sno = $sno + 1;
}

function count_all_data($connect)
{
    $query = "SELECT req_id FROM request_creation where cus_status >= 20 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data' => $data
);

echo json_encode($output);
function moneyFormatIndia($num)
{
    $explrestunits = "";
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3);
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits;
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            if ($i == 0) {
                $explrestunits .= (int)$expunit[$i] . ",";
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash;
}

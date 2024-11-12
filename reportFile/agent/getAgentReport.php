<?php
include "../../ajaxconfig.php";
@session_start();
$user_id = $_SESSION['userid'];

$where = "";

if (isset($_POST['from_date']) && isset($_POST['to_date']) && $_POST['from_date'] != '' && $_POST['to_date'] != '') {
    $from_date = date('Y-m-d', strtotime($_POST['from_date']));
    $to_date = date('Y-m-d', strtotime($_POST['to_date']));
    $where  = "and (date(cs.created_date) >= '" . $from_date . "') and (date(cs.created_date) <= '" . $to_date . "') ";
}

$bankqry = $con->query("SELECT `bank_details` FROM `user` WHERE `user_id`= $user_id");
$bank_id = $bankqry->fetch_assoc()['bank_details'];

//get agent user id to get data from collection
$ag_userid_qry = $con->query("SELECT `user_id` from user where FIND_IN_SET( `ag_id`, (SELECT `agentforstaff` from user where `user_id` = '$user_id')) ");
$ids = array();
while ($row = $ag_userid_qry->fetch_assoc()) {
    $ids[] = $row['user_id'];
}
$ag_user_id = implode(',', $ids);

$column = array(
    'tdate',
    'u.ag_id',
    'cl.created_date',
    'cl.total_paid_track'
);

$query = "SELECT ac.ag_name, u.ag_id AS ag_id, date(cl.created_date) as tdate, cl.total_paid_track as coll_amt,'' AS netcash, '' AS Credit, '' AS Debit
    FROM collection cl JOIN user u ON cl.insert_login_id = u.user_id
    JOIN agent_creation ac ON u.ag_id = ac.ag_id
    WHERE cl.total_paid_track != '' AND MONTH(cl.created_date) <= MONTH(CURRENT_DATE()) AND YEAR(cl.created_date) <= YEAR(CURRENT_DATE()) and FIND_IN_SET(cl.insert_login_id,'$ag_user_id')
    
    UNION ALL

    SELECT ac.ag_name, li.agent_id AS ag_id, date(li.created_date) as tdate,'' as coll_amt, li.cash + li.cheque_value + li.transaction_value AS netcash, '' AS Credit, '' AS Debit 
    FROM loan_issue li JOIN user u ON u.user_id = '$user_id'
    JOIN agent_creation ac ON li.agent_id = ac.ag_id
    WHERE MONTH(li.created_date) <= MONTH(CURRENT_DATE()) AND YEAR(li.created_date) <= YEAR(CURRENT_DATE()) and FIND_IN_SET(li.agent_id,u.agentforstaff)

    UNION ALL 

    SELECT ac.ag_name, cdh.ag_id, cdh.created_date AS tdate, '' AS coll_amt,'' AS netcash, '' AS Credit, amt AS Debit 
    FROM ct_db_hag cdh
    JOIN agent_creation ac ON cdh.ag_id = ac.ag_id
    WHERE MONTH(cdh.created_date) <= MONTH(CURRENT_DATE()) AND YEAR(cdh.created_date) <= YEAR(CURRENT_DATE()) AND cdh.insert_login_id = '$user_id'
    
    UNION ALL 
    
    SELECT ac.ag_name, cdb.ag_id, cdb.created_date AS tdate,'' AS coll_amt,'' AS netcash, '' AS Credit, amt AS Debit 
    FROM ct_db_bag cdb
    JOIN agent_creation ac ON cdb.ag_id = ac.ag_id
    WHERE MONTH(cdb.created_date) <= MONTH(CURRENT_DATE()) AND YEAR(cdb.created_date) <= YEAR(CURRENT_DATE()) AND FIND_IN_SET(bank_id, '$bank_id')
    
    UNION ALL 
    
    SELECT ac.ag_name, cch.ag_id, cch.created_date AS tdate,'' AS coll_amt,'' AS netcash, amt AS Credit, '' AS Debit 
    FROM ct_cr_hag cch
    JOIN agent_creation ac ON cch.ag_id = ac.ag_id
    WHERE MONTH(cch.created_date) <= MONTH(CURRENT_DATE()) AND YEAR(cch.created_date) <= YEAR(CURRENT_DATE()) AND cch.insert_login_id = '$user_id'
    
    UNION ALL 
    
    SELECT ac.ag_name, ccb.ag_id, ccb.created_date AS tdate,'' AS coll_amt,'' AS netcash, amt AS Credit, '' AS Debit 
    FROM ct_cr_bag ccb
    JOIN agent_creation ac ON ccb.ag_id = ac.ag_id
    WHERE MONTH(ccb.created_date) <= MONTH(CURRENT_DATE()) AND YEAR(ccb.created_date) <= YEAR(CURRENT_DATE()) AND FIND_IN_SET(bank_id, '$bank_id')
    
    ";

// ORDER BY tdate

if (isset($_POST['search'])) {
    if ($_POST['search'] != "") {
        $query .= " and (u.ag_id LIKE '%" . $_POST['search'] . "%' OR
            cl.created_date LIKE '%" . $_POST['search'] . "%' OR
            cl.total_paid_track LIKE '%" . $_POST['search'] . "%' ) ";
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

if ($_POST['length'] != -1) {
    $statement = $connect->prepare($query . $query1);
    $statement->execute();
}
$result = $statement->fetchAll();

$data = array();
$sno = 1;
foreach ($result as $row) {
    $sub_array   = array();
    $sub_array[] = $sno;
    $sub_array[] = $row['ag_name'];
    $sub_array[] = date('d-m-Y', strtotime($row['tdate']));
    $sub_array[] = moneyFormatIndia($row['coll_amt']);
    $sub_array[] = moneyFormatIndia($row['netcash']);
    $sub_array[] = moneyFormatIndia($row['Credit']);
    $sub_array[] = moneyFormatIndia($row['Debit']);

    $data[]      = $sub_array;
    $sno = $sno + 1;
}

function count_all_data($mysqli)
{
    $query = $mysqli->query("SELECT count(ag_id) as ag_count FROM agent_creation where status = 0 ");
    $statement = $query->fetch_assoc();
    return $statement['ag_count'];
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => count_all_data($mysqli),
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

$con->close();
$mysqli->close();
$connect = null;
?>
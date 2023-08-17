<?php
@session_start();
include('..\ajaxconfig.php');

if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}
if($userid != 1){
    
    $userQry = $con->query("SELECT * FROM USER WHERE user_id = $userid ");
    while($rowuser = $userQry->fetch_assoc()){
        $role = $rowuser['role'];
        $group_id = $rowuser['group_id'];
        $line_id = $rowuser['line_id'];
    }

    $line_id = explode(',',$line_id);
    $sub_area_list = array();
    foreach($line_id as $line){
        $lineQry = $con->query("SELECT * FROM area_line_mapping where map_id = $line ");
        $row_sub = $lineQry->fetch_assoc();
        $sub_area_list[] = $row_sub['sub_area_id'];
    }
    $sub_area_ids = array();
    foreach ($sub_area_list as $subarray) {
        $sub_area_ids = array_merge($sub_area_ids, explode(',',$subarray));
    }
    $sub_area_list = array();
    $sub_area_list = implode(',',$sub_area_ids);
}

$column = array(
    'cp.cus_id',
    'cp.cus_id',
    'cp.cus_name',
    'cp.area_confirm_area',
    'cp.area_confirm_subarea',
    'cp.area_line',
    'cp.area_line',
    'cp.mobile1',
    'cp.status'
);

if($userid == 1){
    $query = 'SELECT cp.cus_id as cp_cus_id,cp.cus_name,cp.area_confirm_area,cp.area_confirm_subarea,cp.area_line,cp.mobile1, ii.cus_id as ii_cus_id, ii.req_id FROM 
    acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id
    where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) GROUP BY ii.cus_id '; // Only Issued and all lines not relying on sub area// 14 and 17 means collection entries, 17 removed from issue list
}else{
    if($role != '2'){
        $query = "SELECT cp.cus_id as cp_cus_id,cp.cus_name,cp.area_confirm_area,cp.area_confirm_subarea,cp.area_line,cp.mobile1, ii.cus_id as ii_cus_id, ii.req_id FROM 
        acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id
        where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) and cp.area_confirm_subarea IN ($sub_area_list) GROUP BY ii.cus_id ";//show only issued customers within the same lines of user. // 14 and 17 means collection entries, 17 removed from issue list
    }else{// if agent then check the possibilities
        $query = "SELECT cp.cus_id as cp_cus_id,cp.cus_name,cp.area_confirm_area,cp.area_confirm_subarea,cp.area_line,cp.mobile1, ii.cus_id as ii_cus_id, ii.req_id FROM 
        acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id JOIN request_creation rc ON ii.req_id = rc.req_id 
        where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) and (rc.user_type = 'Agent' or (rc.agent_id != '' and rc.agent_id != null)  or rc.insert_login_id = '$userid' ) ";// 14 and 17 means collection entries, 17 removed from issue list
    }
}


$query1 = '';

if ($_POST['length'] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
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
    
    $sub_array[] = $row['cp_cus_id'];
    $sub_array[] = $row['cus_name'];
    
    
    
    //Area Name fetch
    $area_id = $row['area_confirm_area'];
    $qry = $mysqli->query("SELECT * FROM area_list_creation where area_id = $area_id ");
    $row1 = $qry->fetch_assoc();
    $area_name = $row1['area_name'];
    
    $sub_array[] = $area_name;

    //Sub Area Name Fetch
    $sub_area_id = $row['area_confirm_subarea'];
    $qry = $mysqli->query("SELECT * FROM sub_area_list_creation where sub_area_id = $sub_area_id ");
    $row1 = $qry->fetch_assoc();
    $sub_area_name = $row1['sub_area_name'];
    
    $sub_array[] = $sub_area_name;
    
    $line_name = $row['area_line'];
    $qry = $mysqli->query("SELECT b.branch_name FROM branch_creation b JOIN area_line_mapping l ON l.branch_id = b.branch_id where l.line_name = '".$line_name."' ");
    $row1 = $qry->fetch_assoc();
    $sub_array[] = $row1['branch_name'];

    $sub_array[] = $row['area_line'];
    $sub_array[] = $row['mobile1'];
    
    $cus_id = $row['cp_cus_id'];
    $id          = $row['req_id'];

    $action="<a href='due_followup&upd=$id&cusidupd=$cus_id' title='Edit details' ><button class='btn btn-success' style='background-color:#009688;'>View Loans</button></a>";
    $sub_array[] = $action;

    $collDate = $mysqli->query("SELECT 
    DAY(coll_date) as coll_date,
    CASE 
        WHEN DAYOFMONTH(coll_date) BETWEEN 26 AND 31 THEN '26-30'
        WHEN DAYOFMONTH(coll_date) BETWEEN 21 AND 25 THEN '21-25'
        WHEN DAYOFMONTH(coll_date) BETWEEN 16 AND 20 THEN '16-20'
        WHEN DAYOFMONTH(coll_date) BETWEEN 11 AND 15 THEN '11-15'
        ELSE ''
    END AS date_range
    FROM collection WHERE `cus_id`='$cus_id' ORDER by coll_id DESC limit 1");
    $coll_date_qry = $collDate->fetch_assoc();
    if(mysqli_num_rows($collDate)>0){
        $date_range = $coll_date_qry['date_range'];
    }else{
        $date_range = '';

    }

    $sub_array[] = $date_range;
    $sub_array[] = '';
    $sub_array[] = '';
    
    $data[]      = $sub_array;
    $sno = $sno+1;
}

function count_all_data($connect)
{
    $query     = "SELECT cp.cus_id as cp_cus_id,cp.cus_name,cp.area_confirm_area,cp.area_confirm_subarea,cp.area_line,cp.mobile1, ii.cus_id as ii_cus_id, ii.req_id FROM 
    acknowlegement_customer_profile cp JOIN in_issue ii ON cp.cus_id = ii.cus_id
    where ii.status = 0 and (ii.cus_status >= 14 and ii.cus_status <= 17) GROUP BY ii.cus_id ";
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

?>
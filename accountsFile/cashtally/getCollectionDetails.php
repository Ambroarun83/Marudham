<?php
include('../../ajaxconfig.php');

if(isset($_POST['branch_id'])){
    $branch_id = explode(',',$_POST['branch_id']);
}
$branch_id = [2,3];
$records = array();
foreach($branch_id as $val){
    $i=0;
    $qry = $con->query("SELECT sum(total_paid_track) as total_paid, insert_login_id from collection where branch = $val and date(created_date) = date(now()) and coll_mode = '1' GROUP BY insert_login_id");
    while($row = $qry->fetch_assoc()){
        //get user id and total paid by user by cash
        $records[$i]['user_id'] = $row['insert_login_id'];
        $records[$i]['collected_amt'] = $row['total_paid'];

        //get username by user id to shortlist
        $usernameqry = $con->query("SELECT us.fullname,us.role,us.line_id,lm.line_name from user us JOIN area_line_mapping lm ON us.line_id = lm.map_id where us.user_id = '".strip_tags($row['insert_login_id'])."' ");
        $row1 = $usernameqry->fetch_assoc();
        if($row1['role'] != '2'){

            $records[$i]['user_name'] = $row1['fullname'];
            $records[$i]['user_type'] = $row1['role'];
            $records[$i]['line_id'] = $row1['line_id'];
            $records[$i]['line_name'] = $row1['line_name'];
            
            //get branchname by branch id
            $branchnameqry = $con->query("SELECT branch_name from branch_creation where branch_id = '".strip_tags($val)."' ");
            $records[$i]['branch_name'] = $branchnameqry->fetch_assoc()['branch_name'];
            
            $i++;
        }
    }
}
print_r($records);
?>
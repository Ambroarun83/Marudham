<?php 
include('../ajaxconfig.php');
if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
}
$detailrecords = array();

$result=$con->query("SELECT * FROM user where status=0 and user_id = $user_id ");
while( $row = $result->fetch_assoc()){
    $agentforstaff = $row['agentforstaff'];
}
$agent_ids = explode(',',$agentforstaff);
$i=0;
foreach($agent_ids as $ag){
    $qry = $con->query("SELECT * From agent_creation where ag_id = '".$ag."' ");
    $row = $qry->fetch_assoc();
    $detailrecords[$i]['ag_id'] = $row['ag_id'];
    $detailrecords[$i]['ag_name'] = $row['ag_name'];
    $i++;
}

echo json_encode($detailrecords);
?>
<?php
include('../ajaxconfig.php');

if(isset($_POST['noc_details'])){
    $noc_details = $_POST['noc_details'];
} 
if(isset($_POST['table_name'])){
    $table_name = $_POST['table_name'];
}

for($i=0;$i<sizeof($noc_details);$i++){
    
    $qry = $con->query("UPDATE ".$table_name." set noc_date = DATE(now()), noc_person = '".$noc_details[$i][1]."', noc_name = '".$noc_details[$i][2]."' where id= '".$noc_details[$i][0]."' ");

}
if($qry){
    $response = "Success";
}else{
    $response = "Error";
}

echo $response;
?>
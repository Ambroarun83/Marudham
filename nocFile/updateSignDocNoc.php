<?php
include('../ajaxconfig.php');

if(isset($_POST['noc_details'])){
    $noc_details = $_POST['noc_details'];// value will be passed in 2 dimentional array// each first dimention has set of date,person,name, req_id
} 
if(isset($_POST['table_name'])){
    $table_name = $_POST['table_name'];
}


if($table_name == 'acknowlegement_documentation'){
    for($i=0;$i<sizeof($noc_details);$i++){

        if($noc_details[$i][1] == 'process'){// process means mortgage process

            $qry = $con->query("UPDATE ".$table_name." set mort_noc_date = DATE(now()), mort_noc_person = '".$noc_details[$i][2]."', mort_noc_name = '".$noc_details[$i][3]."' where id= '".$noc_details[$i][0]."' ");
        
        }else if($noc_details[$i][1] == 'document'){// document means mortgage Document
            
            $qry = $con->query("UPDATE ".$table_name." set mort_doc_noc_date = DATE(now()), mort_doc_noc_person = '".$noc_details[$i][2]."', mort_doc_noc_name = '".$noc_details[$i][3]."' where id= '".$noc_details[$i][0]."' ");

        }else if($noc_details[$i][1] == 'en_process'){// en_process means endorse process
            
            $qry = $con->query("UPDATE ".$table_name." set endor_noc_date = DATE(now()), endor_noc_person = '".$noc_details[$i][2]."', endor_noc_name = '".$noc_details[$i][3]."' where id= '".$noc_details[$i][0]."' ");

        }else if($noc_details[$i][1] == 'en_rc'){// en_rc means endorse rc
            
            $qry = $con->query("UPDATE ".$table_name." set en_rc_noc_date = DATE(now()), en_rc_noc_person = '".$noc_details[$i][2]."', en_rc_noc_name = '".$noc_details[$i][3]."' where id= '".$noc_details[$i][0]."' ");

        }else if($noc_details[$i][1] == 'en_key'){// en_key means endorse key
            
            $qry = $con->query("UPDATE ".$table_name." set en_key_noc_date = DATE(now()), en_key_noc_person = '".$noc_details[$i][2]."', en_key_noc_name = '".$noc_details[$i][3]."' where id= '".$noc_details[$i][0]."' ");

        }
    
    }
}else{
    for($i=0;$i<sizeof($noc_details);$i++){
        
        $qry = $con->query("UPDATE ".$table_name." set noc_date = DATE(now()), noc_person = '".$noc_details[$i][1]."', noc_name = '".$noc_details[$i][2]."' where id= '".$noc_details[$i][0]."' ");
    
    }
}
if($qry){
    $response = "Success";
}else{
    $response = "Error";
}

echo $response;
?>
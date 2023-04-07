<?php 
include('../ajaxconfig.php');
$loan_cat = '3,5';
$sub_cat = '';
if (isset($_POST['loan_cat'])) {
    $loan_cat = $_POST['loan_cat'];
}
$loan_cat_array = array_map('intval',explode(',',$loan_cat));
if (isset($_POST['sub_cat'])) {
    $sub_cat = $_POST['sub_cat'];
}
$sub_cat_array = array_map('intval',explode(',',$sub_cat));

// print_r(sizeof($sub_cat_array));die;
$detailrecords = array();
if(sizeof($loan_cat_array) == 1 and $sub_cat == ''){
    $j=0;
    foreach($loan_cat_array as $loan_cat){
        $k=0;
        foreach($sub_cat_array as $sub_cat){
            if($sub_cat != 0){
                $checkloanQry = $con->query("SELECT * from loan_category where sub_category_name = $sub_cat and loan_category_name =$loan_cat and status = 0");
                if($checkloanQry->num_rows>0){
    
                    $loanCatSelect = "SELECT * FROM loan_scheme WHERE sub_category = $sub_cat and status = 0 "; 
                    $res = $con->query($loanCatSelect) or die("Error in Get All Records");
                    if ($res->num_rows>0)
                    {$i=0;
                        while($row = $res->fetch_object()){	
                            $detailrecords[$j][$k][$i]['scheme_id']      = $row->scheme_id; 
                            $detailrecords[$j][$k][$i]['scheme_name']      = $row->scheme_name; 
                            $i++;
                        }
                    }
                }else{
                    $loanCatSelect = "SELECT * FROM loan_scheme WHERE loan_category = $loan_cat and status = 0 "; 
                    $res = $con->query($loanCatSelect) or die("Error in Get All Records");
                    if ($res->num_rows>0)
                    {$i=0;
                        while($row = $res->fetch_object()){	
                            $detailrecords[$j][$k][$i]['scheme_id']      = $row->scheme_id; 
                            $detailrecords[$j][$k][$i]['scheme_name']      = $row->scheme_name; 
                            $i++;
                        }
                    }
                }
            }else{
                $loanCatSelect = "SELECT * FROM loan_scheme WHERE loan_category = $loan_cat and status = 0 "; 
                $res = $con->query($loanCatSelect) or die("Error in Get All Records");
                if ($res->num_rows>0)
                {$i=0;
                    while($row = $res->fetch_object()){	
                        $detailrecords[$j][$k][$i]['scheme_id']      = $row->scheme_id; 
                        $detailrecords[$j][$k][$i]['scheme_name']      = $row->scheme_name; 
                        $i++;
                    }
                }
            }
            
            $k++;
        }

        
        $j++;
    }
}else
if(sizeof($loan_cat_array) > 1 and $sub_cat == ''){
    $j=0;
    foreach($loan_cat_array as $loan_cat){
        $loanCatSelect = "SELECT * FROM loan_scheme WHERE loan_category = $loan_cat and status = 0 "; 
        $res = $con->query($loanCatSelect) or die("Error in Get All Records");
        if ($res->num_rows>0)
        {$i=0;
            while($row = $res->fetch_object()){	
                $detailrecords[$j][$i]['scheme_id']      = $row->scheme_id; 
                $detailrecords[$j][$i]['scheme_name']      = $row->scheme_name; 
                $i++;
            }
        }
        $j++;
    }
}else
if(sizeof($loan_cat_array) > 1 and $sub_cat_array[0] != 0){
    $j=0;
    foreach($loan_cat_array as $loan_cat){
        $k=0;
        foreach($sub_cat_array as $sub_cat){
            $checkloanQry = $con->query("SELECT * from loan_category where sub_category_name = $sub_cat and loan_category_name =$loan_cat and status = 0");
            if($checkloanQry->num_rows>0){

                $loanCatSelect = "SELECT * FROM loan_scheme WHERE sub_category = $sub_cat and status = 0 "; 
                $res = $con->query($loanCatSelect) or die("Error in Get All Records");
                if ($res->num_rows>0)
                {$i=0;
                    while($row = $res->fetch_object()){	
                        $detailrecords[$j][$k][$i]['scheme_id']      = $row->scheme_id; 
                        $detailrecords[$j][$k][$i]['scheme_name']      = $row->scheme_name; 
                        $i++;
                    }
                }
            }else{
                $loanCatSelect = "SELECT * FROM loan_scheme WHERE loan_category = $loan_cat and status = 0 "; 
                $res = $con->query($loanCatSelect) or die("Error in Get All Records");
                if ($res->num_rows>0)
                {$i=0;
                    while($row = $res->fetch_object()){	
                        $detailrecords[$j][$k][$i]['scheme_id']      = $row->scheme_id; 
                        $detailrecords[$j][$k][$i]['scheme_name']      = $row->scheme_name; 
                        $i++;
                    }
                }
            }
            $k++;
        }
        $j++;
    }
}

echo json_encode($detailrecords);
?>
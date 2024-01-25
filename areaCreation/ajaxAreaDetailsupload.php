<?php
// error_reporting(0);
include("../ajaxconfig.php");
@session_start();
if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}
require_once('../vendor/csvreader/php-excel-reader/excel_reader2.php');
require_once('../vendor/csvreader/SpreadsheetReader.php');
if(isset($_FILES["file"]["type"])){
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if(in_array($_FILES["file"]["type"],$allowedFileType)){
        
        
        $targetPath = '../uploads/area_creation/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets()); 
        
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            foreach ($Reader as $Row){ 

                $state = "";
                if(isset($Row[0])) {
                    $state = mysqli_real_escape_string($con,$Row[0]); 
                }
                
                $district = "";
                if(isset($Row[1])) {
                    $district = mysqli_real_escape_string($con,$Row[1]); 
                }
                
                $taluk = "";
                if(isset($Row[2])) {
                    $taluk = mysqli_real_escape_string($con,$Row[2]); 
                }
                
                $area = "";
                $area_list_creation_id='';
                $last_insert_id =0;
                if(isset($Row[3])) {
                    $area = mysqli_real_escape_string($con,$Row[3]); 
                    $query = "SELECT * FROM area_list_creation where area_name = '".$area."' and status = 0";
                    $result1 = $con->query($query) or die("Error ");
                    if($con->affected_rows > 0){
                        $row = $result1->fetch_assoc();
                        $area_list_creation_id = $row["area_id"];
                    }else{
                        $query = "INSERT into area_list_creation (area_name) values('".strip_tags($area)."')";
                        $result1 = $con->query($query) or die("Error ");
                        $last_insert_id = $con->insert_id;
                        $area_list_creation_id = $con->insert_id;
                    }
                }
                
                $subarea = "";
                $sub_area_list_creation_id='';
                if(isset($Row[4])) {
                    $subarea = mysqli_real_escape_string($con,$Row[4]); 
                    if($subarea !=''){
                        $query = "SELECT * FROM sub_area_list_creation where sub_area_name = '".$subarea."' and status = 0";
                        $result1 = $con->query($query) or die("Error ");
                        if($last_insert_id == 0 and $con->affected_rows >0){
                            $row = $result1->fetch_assoc();
                            $sub_area_list_creation_id = $row["sub_area_id"];
                        }else{
                            $query = "INSERT into sub_area_list_creation (sub_area_name,area_id_ref) values('".strip_tags($subarea)."','".$last_insert_id."')";
                            $result1 = $con->query($query) or die("Error ");
                            $sub_area_list_creation_id = $con->insert_id;
                        }
                    }
                    
                }

                $pincode = "";
                if(isset($Row[5])) {
                    $pincode = mysqli_real_escape_string($con,$Row[5]); 
                }

                
                
                if($i==0 && $state!="State" && $district != "District" && $taluk != "Taluk" && $area !="" && $subarea !="" && $pincode !="" )
                { 
                    $insert=$con->query("INSERT INTO area_creation(area_name_id, sub_area, taluk, district,state,pincode,created_date,insert_login_id) 
                    VALUES('".strip_tags($area_list_creation_id)."', '".strip_tags($sub_area_list_creation_id)."', '".strip_tags($taluk)."',
                    '".strip_tags($district)."','".strip_tags($state)."','".strip_tags($pincode)."', current_timestamp(), '".$userid."')");
                }
            }
        }
        
        if(!empty($insert)) {
        $message = 0;
        }
        else{
        $message = 1;
        }
    }
}else{
    $message = 1;
}
    echo $message;
    ?>

    


<!-- $dor = isset($Row[1]) ? mysqli_real_escape_string($con, $Row[1]) : "";
            $cus_id = isset($Row[2]) ? mysqli_real_escape_string($con, $Row[2]) : "";
            $cus_data = isset($Row[3]) ? mysqli_real_escape_string($con, $Row[3]) : "";
            $cus_exist_type = isset($Row[4]) ? mysqli_real_escape_string($con, $Row[4]) : "";
            $cus_name = isset($Row[5]) ? mysqli_real_escape_string($con, $Row[5]) : "";
            $dob = isset($Row[6]) ? mysqli_real_escape_string($con, $Row[6]) : "";
            $age = isset($Row[7]) ? mysqli_real_escape_string($con, $Row[7]) : "";
            $gender = isset($Row[8]) ? mysqli_real_escape_string($con, $Row[8]) : "";
            $state = isset($Row[9]) ? mysqli_real_escape_string($con, $Row[9]) : "";
            $district = isset($Row[10]) ? mysqli_real_escape_string($con, $Row[10]) : "";
            $taluk = isset($Row[11]) ? mysqli_real_escape_string($con, $Row[11]) : "";
            $area = isset($Row[12]) ? mysqli_real_escape_string($con, $Row[12]) : "";
            $sub_area = isset($Row[13]) ? mysqli_real_escape_string($con, $Row[13]) : "";
            $address = isset($Row[14]) ? mysqli_real_escape_string($con, $Row[14]) : "";
            $mobile1 = isset($Row[15]) ? mysqli_real_escape_string($con, $Row[15]) : "";
            $father_name = isset($Row[16]) ? mysqli_real_escape_string($con, $Row[16]) : "";
            $mother_name = isset($Row[17]) ? mysqli_real_escape_string($con, $Row[17]) : "";
            $marital = isset($Row[18]) ? mysqli_real_escape_string($con, $Row[18]) : "";
            $spouse = isset($Row[19]) ? mysqli_real_escape_string($con, $Row[19]) : "";
            $guarantor_name = isset($Row[20]) ? mysqli_real_escape_string($con, $Row[20]) : "";
            $guarantor_relationship = isset($Row[21]) ? mysqli_real_escape_string($con, $Row[21]) : "";
            $guarantor_adhar = isset($Row[22]) ? mysqli_real_escape_string($con, $Row[22]) : "";
            $guarantor_age = isset($Row[23]) ? mysqli_real_escape_string($con, $Row[23]) : "";
            $guarantor_mobile = isset($Row[24]) ? mysqli_real_escape_string($con, $Row[24]) : "";
            $guarantor_occupation = isset($Row[25]) ? mysqli_real_escape_string($con, $Row[25]) : "";
            $guarantor_income = isset($Row[26]) ? mysqli_real_escape_string($con, $Row[26]) : "";
            $loan_category = isset($Row[27]) ? mysqli_real_escape_string($con, $Row[27]) : "";
            $sub_category = isset($Row[28]) ? mysqli_real_escape_string($con, $Row[28]) : "";
            $tot_amt = isset($Row[29]) ? mysqli_real_escape_string($con, $Row[29]) : "";
            $adv_amt = isset($Row[30]) ? mysqli_real_escape_string($con, $Row[30]) : "";
            $loan_amt = isset($Row[31]) ? mysqli_real_escape_string($con, $Row[31]) : "";
            $poss_type = isset($Row[32]) ? mysqli_real_escape_string($con, $Row[32]) : "";
            $poss_due_amt = isset($Row[33]) ? mysqli_real_escape_string($con, $Row[33]) : "";
            $poss_due_period = isset($Row[34]) ? mysqli_real_escape_string($con, $Row[34]) : "";
            $cal_category1 = isset($Row[35]) ? mysqli_real_escape_string($con, $Row[35]) : "";
            $cal_category2 = isset($Row[36]) ? mysqli_real_escape_string($con, $Row[36]) : "";
            $cal_category3 = isset($Row[37]) ? mysqli_real_escape_string($con, $Row[37]) : "";
            $how_to_know = isset($Row[38]) ? mysqli_real_escape_string($con, $Row[38]) : "";
            $loan_count = isset($Row[39]) ? mysqli_real_escape_string($con, $Row[39]) : "";
            $first_loan_date = isset($Row[40]) ? mysqli_real_escape_string($con, $Row[40]) : "";
            $travel_with_company = isset($Row[41]) ? mysqli_real_escape_string($con, $Row[41]) : "";
            $monthly_income = isset($Row[42]) ? mysqli_real_escape_string($con, $Row[42]) : "";
            $other_income = isset($Row[43]) ? mysqli_real_escape_string($con, $Row[43]) : "";
            $support_income = isset($Row[44]) ? mysqli_real_escape_string($con, $Row[44]) : "";
            $commitment = isset($Row[45]) ? mysqli_real_escape_string($con, $Row[45]) : "";
            $monthly_due_capacity = isset($Row[46]) ? mysqli_real_escape_string($con, $Row[46]) : "";
            $loan_limit = isset($Row[47]) ? mysqli_real_escape_string($con, $Row[47]) : "";
            $about_customer = isset($Row[48]) ? mysqli_real_escape_string($con, $Row[48]) : "";
            $residential_type = isset($Row[49]) ? mysqli_real_escape_string($con, $Row[49]) : "";
            $residential_details = isset($Row[50]) ? mysqli_real_escape_string($con, $Row[50]) : "";
            $residential_address = isset($Row[51]) ? mysqli_real_escape_string($con, $Row[51]) : "";
            $residential_native_address = isset($Row[52]) ? mysqli_real_escape_string($con, $Row[52]) : "";
            $occupation_type = isset($Row[53]) ? mysqli_real_escape_string($con, $Row[53]) : "";
            $occupation_details = isset($Row[54]) ? mysqli_real_escape_string($con, $Row[54]) : "";
            $area_confirm_type = isset($Row[55]) ? mysqli_real_escape_string($con, $Row[55]) : "";
            $area_group = isset($Row[56]) ? mysqli_real_escape_string($con, $Row[56]) : "";
            $area_line = isset($Row[57]) ? mysqli_real_escape_string($con, $Row[57]) : "";
            $mortgage_process = isset($Row[58]) ? mysqli_real_escape_string($con, $Row[58]) : "";
            $endorsement_process = isset($Row[59]) ? mysqli_real_escape_string($con, $Row[59]) : "";
            $loan_date = isset($Row[60]) ? mysqli_real_escape_string($con, $Row[60]) : "";
            $profit_type = isset($Row[61]) ? mysqli_real_escape_string($con, $Row[61]) : "";
            $due_method_calc = isset($Row[62]) ? mysqli_real_escape_string($con, $Row[62]) : "";
            $due_type = isset($Row[63]) ? mysqli_real_escape_string($con, $Row[63]) : "";
            $profit_method = isset($Row[64]) ? mysqli_real_escape_string($con, $Row[64]) : "";
            $due_method_scheme = isset($Row[65]) ? mysqli_real_escape_string($con, $Row[65]) : "";
            $scheme_name = isset($Row[66]) ? mysqli_real_escape_string($con, $Row[66]) : "";
            $int_rate = isset($Row[67]) ? mysqli_real_escape_string($con, $Row[67]) : "";
            $due_period = isset($Row[68]) ? mysqli_real_escape_string($con, $Row[68]) : "";
            $doc_charge = isset($Row[69]) ? mysqli_real_escape_string($con, $Row[69]) : "";
            $proc_fee = isset($Row[70]) ? mysqli_real_escape_string($con, $Row[70]) : "";
            $loan_amt_cal = isset($Row[71]) ? mysqli_real_escape_string($con, $Row[71]) : "";
            $principal_amt_cal = isset($Row[72]) ? mysqli_real_escape_string($con, $Row[72]) : "";
            $int_amt_cal = isset($Row[73]) ? mysqli_real_escape_string($con, $Row[73]) : "";
            $tot_amt_cal = isset($Row[74]) ? mysqli_real_escape_string($con, $Row[74]) : "";
            $due_amt_cal = isset($Row[75]) ? mysqli_real_escape_string($con, $Row[75]) : "";
            $doc_charge_cal = isset($Row[76]) ? mysqli_real_escape_string($con, $Row[76]) : "";
            $proc_fee_cal = isset($Row[77]) ? mysqli_real_escape_string($con, $Row[77]) : "";
            $net_cash_cal = isset($Row[78]) ? mysqli_real_escape_string($con, $Row[78]) : "";
            $due_start_from = isset($Row[79]) ? mysqli_real_escape_string($con, $Row[79]) : "";
            $maturity_month = isset($Row[80]) ? mysqli_real_escape_string($con, $Row[80]) : "";
            $collection_method = isset($Row[81]) ? mysqli_real_escape_string($con, $Row[81]) : "";
            $communication = isset($Row[82]) ? mysqli_real_escape_string($con, $Row[82]) : "";
            $verification_person = isset($Row[83]) ? mysqli_real_escape_string($con, $Row[83]) : "";
            $verification_location = isset($Row[84]) ? mysqli_real_escape_string($con, $Row[84]) : "";
            $issued_to = isset($Row[85]) ? mysqli_real_escape_string($con, $Row[85]) : "";
            $agent_id = isset($Row[86]) ? mysqli_real_escape_string($con, $Row[86]) : "";
            $issued_mode = isset($Row[87]) ? mysqli_real_escape_string($con, $Row[87]) : "";
            $payment_type = isset($Row[88]) ? mysqli_real_escape_string($con, $Row[88]) : "";
            $cash = isset($Row[89]) ? mysqli_real_escape_string($con, $Row[89]) : "";
            $balance_amt = isset($Row[90]) ? mysqli_real_escape_string($con, $Row[90]) : "";
            $cash_guarantor_id = isset($Row[91]) ? mysqli_real_escape_string($con, $Row[91]) : "";
            $cash_guarantor_rel = isset($Row[92]) ? mysqli_real_escape_string($con, $Row[92]) : ""; -->
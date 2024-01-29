<?php

@session_start();
include '../ajaxconfig.php';
$userData = getUserDetails($con);

require_once('../vendor/csvreader/php-excel-reader/excel_reader2.php');
require_once('../vendor/csvreader/SpreadsheetReader.php');

$allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'text/csv', 'text/xml', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
if (in_array($_FILES["excelFile"]["type"], $allowedFileType)) {

    $excelfolder = uploadFiletoFolder();

    $Reader = new SpreadsheetReader($excelfolder);
    $sheetCount = count($Reader->sheets());

    for ($i = 0; $i < $sheetCount; $i++) {
        $Reader->ChangeSheet($i);
        $rowChange = 0;
        foreach ($Reader as $Row) {

            if ($rowChange != 0) { // omitted 0 to avoid headers

                $data = fetchAllRowData($con, $Row);
                $req_code = getRequestCode($con);
                $data['area_id'] = getAreaId($con, $data['area']);
                $data['sub_area_id'] = getSubAreaId($con, $data['sub_area']);
                $data['loan_cat_id'] = getLoanCategoryId($con, $data['loan_category']);
                $data['sub_categoryCheck'] = checkSubCategory($con, $data['sub_category']);
                $data['agent_id'] = checkAgent($con, $data['agent_id']);
                $data['cus_data'] = checkCustomerData($con, $data['cus_id']);

                if (
                    $data['cus_id'] != 'Invalid' && !preg_match('/^\s*$/', $data['cus_name']) && $data['cus_data'] != 'Not Found' && $data['guarantor_adhar'] != 'Invalid' && $data['mobile1'] != 'Invalid' && $data['agent_id'] != 'Not Found' && $data['dor'] != 'Invalid Date' && $data['gender'] != 'Not Found' && $data['area_id'] != 'Not Found' && $data['sub_area_id'] != 'Not Found' && $data['marital'] != 'Not Found' && $data['occupation_type'] != 'Not Found' && $data['loan_cat_id'] != 'Not Found' && $data['sub_categoryCheck'] != 'Not Found' && $data['poss_type'] != 'Not Found' && ($data['cal_category1'] != '' || $data['cal_category2'] != '' || $data['cal_category3'] != '') && $data['residential_type'] != 'Not Found' && $data['area_group'] != '' && $data['area_line'] != ''
                ) {

                    $reqQry = "INSERT INTO `request_creation`(`user_type`, `user_name`, `agent_id`, `responsible`, `remarks`, `declaration`, `req_code`, `dor`, `cus_reg_id`, `cus_id`, `cus_data`, `cus_name`, `dob`, `age`, `gender`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse_name`, `occupation_type`, `occupation`, `pic`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `ad_perc`, `loan_amt`, `poss_type`, `due_amt`, `due_period`, `cus_status`, `prompt_remark`, `status`, `insert_login_id`, `created_date` ) VALUES ( '" . $userData['user_type'] . "', '" . $userData['user_name'] . "', '" . $data['agent_id'] . "', '', '' , '' , '$req_code', '" . $data['dor'] . "', '',  '" . $data['cus_id'] . "', '" . $data['cus_data'] . "', '" . $data['cus_name'] . "', '" . $data['dob'] . "', '" . $data['age'] . "', '" . $data['gender'] . "', '" . $data['state'] . "',  '" . $data['district'] . "',  '" . $data['taluk'] . "', '" . $data['area_id'] . "', '" . $data['sub_area_id'] . "', '" . $data['address'] . "', '" . $data['mobile1'] . "', '', '" . $data['father_name'] . "', '" . $data['mother_name'] . "', '" . $data['marital'] . "', '" . $data['spouse'] . "', '" . $data['occupation_type'] . "', '" . $data['occupation_details'] . "', '', '" . $data['loan_cat_id'] . "', '" . $data['sub_category'] . "', '" . $data['tot_amt'] . "', '" . $data['adv_amt'] . "', '', '" . $data['loan_amt'] . "', '" . $data['poss_type'] . "', '" . $data['poss_due_amt'] . "', '" . $data['poss_due_period'] . "', '0', '', '0', '" . $userData['user_id'] . "', '" . $data['dor'] . "'  ) ";
                    $con->query($reqQry);
                    $req_id = $con->insert_id;

                    //store calculation category if anyone present(min 1)
                    $req_cat_qry1 = "INSERT INTO `request_category_info`( `req_ref_id`, `category_info`) VALUES ('$req_id','" . $data['cal_category1'] . "')";
                    $req_cat_qry2 = "INSERT INTO `request_category_info`( `req_ref_id`, `category_info`) VALUES ('$req_id','" . $data['cal_category2'] . "')";
                    $req_cat_qry3 = "INSERT INTO `request_category_info`( `req_ref_id`, `category_info`) VALUES ('$req_id','" . $data['cal_category3'] . "')";
                    if ($data['cal_category1'] != '') {
                        $con->query($req_cat_qry1);
                    }
                    if ($data['cal_category2'] != '') {
                        $con->query($req_cat_qry2);
                    }
                    if ($data['cal_category3'] != '') {
                        $con->query($req_cat_qry3);
                    }


                    if ($data['cus_data'] == 'New') {
                        $crQry = "INSERT INTO `customer_register`( `req_ref_id`, `cus_id`, `customer_name`, `dob`, `age`, `gender`, `blood_group`, `state`, `district`, `taluk`, `area`, `sub_area`, `address`, `mobile1`, `mobile2`, `father_name`, `mother_name`, `marital`, `spouse`, `occupation_type`, `occupation`, `pic`, `how_to_know`, `loan_count`, `first_loan_date`, `travel_with_company`, `monthly_income`, `other_income`, `support_income`, `commitment`, `monthly_due_capacity`, `loan_limit`, `about_customer`, `residential_type`, `residential_details`, `residential_address`, `residential_native_address`, `occupation_info_occ_type`, `occupation_details`, `occupation_income`, `occupation_address`, `dow`, `abt_occ`, `area_confirm_type`, `area_confirm_state`, `area_confirm_district`, `area_confirm_taluk`, `area_confirm_area`, `area_confirm_subarea`, `area_group`, `area_line`, `cus_status`, `create_time` ) VALUES ('$req_id','" . $data['cus_id'] . "', '" . $data['cus_name'] . "', '" . $data['dob'] . "', '" . $data['age'] . "', '" . $data['gender'] . "', '', '" . $data['state'] . "',  '" . $data['district'] . "',  '" . $data['taluk'] . "', '" . $data['area_id'] . "', '" . $data['sub_area_id'] . "', '" . $data['address'] . "', '" . $data['mobile1'] . "', '', '" . $data['father_name'] . "', '" . $data['mother_name'] . "', '" . $data['marital'] . "', '" . $data['spouse'] . "', '" . $data['occupation_type'] . "', '" . $data['occupation_details'] . "', '','" . $data['how_to_know'] . "','" . $data['loan_count'] . "','" . $data['first_loan_date'] . "','" . $data['travel_with_company'] . "','" . $data['monthly_income'] . "','" . $data['other_income'] . "','" . $data['support_income'] . "','" . $data['commitment'] . "','" . $data['monthly_due_capacity'] . "','" . $data['loan_limit'] . "','" . $data['about_customer'] . "','" . $data['residential_type'] . "','" . $data['residential_details'] . "','" . $data['residential_address'] . "','" . $data['residential_native_address'] . "','" . $data['occupation_type'] . "','" . $data['occupation_details'] . "', '', '', '', '','" . $data['area_confirm_type'] . "', '" . $data['state'] . "',  '" . $data['district'] . "',  '" . $data['taluk'] . "', '" . $data['area_id'] . "', '" . $data['sub_area_id'] . "', '" . $data['area_group'] . "', '" . $data['area_line'] . "', '0', '" . $data['dor'] . "' )";

                        $con->query($crQry);
                        $cus_reg_id = $con->insert_id;

                        $updateQry = "UPDATE `request_creation` SET `cus_reg_id`='$cus_reg_id' where req_id = '$req_id' ";
                        $con->query($updateQry);
                    }

                    // echo $insertQry;
                } else {
                    $message = handleError($data, $rowChange);
                    echo $message;
                    exit();
                }
            }

            $rowChange++;
        }
    }
    $message = 'Bulk Upload Completed!';

} else {
    $message = 'File is not in Excel Format!';
}

echo $message;


function getUserDetails($con)
{

    //get User Data
    $data['user_id'] = $_SESSION["userid"];
    $qry = $con->query("SELECT fullname,role from user where user_id = '" . $data['user_id'] . "' ");
    $row = $qry->fetch_assoc();
    $data['user_name'] = $row['fullname'];
    if ($row['role'] == '1') {
        $data['user_type'] = 'Director';
    } elseif ($row['role'] == '2') {
        $data['user_type'] = 'Agent';
    } else {
        $data['user_type'] = 'Staff';
    }



    return $data;
}
function uploadFiletoFolder()
{
    $excel = $_FILES['excelFile']['name'];
    $excel_temp = $_FILES['excelFile']['tmp_name'];
    $excelfolder = "../uploads/bulk_upload/" . $excel;
    $fileExtension = pathinfo($excelfolder, PATHINFO_EXTENSION); //get the file extention

    $excel = uniqid() . '.' . $fileExtension;
    while (file_exists("../uploads/bulk_upload/" . $excel)) {
        //this loop will continue until it generates a unique file name
        $excel = uniqid() . '.' . $fileExtension;
    }
    $excelfolder = "../uploads/bulk_upload/" . $excel;
    move_uploaded_file($excel_temp, "../uploads/bulk_upload/" . $excel);
    return $excelfolder;
}
function fetchAllRowData($con, $Row)
{
    $dataArray = array(
        'dor' => isset($Row[1]) ? mysqli_real_escape_string($con, $Row[1]) : "",
        'cus_id' => isset($Row[2]) ? mysqli_real_escape_string($con, $Row[2]) : "",
        'cus_data' => isset($Row[3]) ? mysqli_real_escape_string($con, $Row[3]) : "",
        'cus_exist_type' => isset($Row[4]) ? mysqli_real_escape_string($con, $Row[4]) : "",
        'cus_name' => isset($Row[5]) ? mysqli_real_escape_string($con, $Row[5]) : "",
        'dob' => isset($Row[6]) ? mysqli_real_escape_string($con, $Row[6]) : "",
        'age' => isset($Row[7]) ? mysqli_real_escape_string($con, $Row[7]) : "",
        'gender' => isset($Row[8]) ? mysqli_real_escape_string($con, $Row[8]) : "",
        'state' => isset($Row[9]) ? mysqli_real_escape_string($con, $Row[9]) : "",
        'district' => isset($Row[10]) ? mysqli_real_escape_string($con, $Row[10]) : "",
        'taluk' => isset($Row[11]) ? mysqli_real_escape_string($con, $Row[11]) : "",
        'area' => isset($Row[12]) ? mysqli_real_escape_string($con, $Row[12]) : "",
        'sub_area' => isset($Row[13]) ? mysqli_real_escape_string($con, $Row[13]) : "",
        'address' => isset($Row[14]) ? mysqli_real_escape_string($con, $Row[14]) : "",
        'mobile1' => isset($Row[15]) ? mysqli_real_escape_string($con, $Row[15]) : "",
        'father_name' => isset($Row[16]) ? mysqli_real_escape_string($con, $Row[16]) : "",
        'mother_name' => isset($Row[17]) ? mysqli_real_escape_string($con, $Row[17]) : "",
        'marital' => isset($Row[18]) ? mysqli_real_escape_string($con, $Row[18]) : "",
        'spouse' => isset($Row[19]) ? mysqli_real_escape_string($con, $Row[19]) : "",
        'guarantor_name' => isset($Row[20]) ? mysqli_real_escape_string($con, $Row[20]) : "",
        'guarantor_relationship' => isset($Row[21]) ? mysqli_real_escape_string($con, $Row[21]) : "",
        'guarantor_adhar' => isset($Row[22]) ? mysqli_real_escape_string($con, $Row[22]) : "",
        'guarantor_age' => isset($Row[23]) ? mysqli_real_escape_string($con, $Row[23]) : "",
        'guarantor_mobile' => isset($Row[24]) ? mysqli_real_escape_string($con, $Row[24]) : "",
        'guarantor_occupation' => isset($Row[25]) ? mysqli_real_escape_string($con, $Row[25]) : "",
        'guarantor_income' => isset($Row[26]) ? mysqli_real_escape_string($con, $Row[26]) : "",
        'loan_category' => isset($Row[27]) ? mysqli_real_escape_string($con, $Row[27]) : "",
        'sub_category' => isset($Row[28]) ? mysqli_real_escape_string($con, $Row[28]) : "",
        'tot_amt' => isset($Row[29]) ? mysqli_real_escape_string($con, $Row[29]) : "",
        'adv_amt' => isset($Row[30]) ? mysqli_real_escape_string($con, $Row[30]) : "",
        'loan_amt' => isset($Row[31]) ? mysqli_real_escape_string($con, $Row[31]) : "",
        'poss_type' => isset($Row[32]) ? mysqli_real_escape_string($con, $Row[32]) : "",
        'poss_due_amt' => isset($Row[33]) ? mysqli_real_escape_string($con, $Row[33]) : "",
        'poss_due_period' => isset($Row[34]) ? mysqli_real_escape_string($con, $Row[34]) : "",
        'cal_category1' => isset($Row[35]) ? mysqli_real_escape_string($con, $Row[35]) : "",
        'cal_category2' => isset($Row[36]) ? mysqli_real_escape_string($con, $Row[36]) : "",
        'cal_category3' => isset($Row[37]) ? mysqli_real_escape_string($con, $Row[37]) : "",
        'how_to_know' => isset($Row[38]) ? mysqli_real_escape_string($con, $Row[38]) : "",
        'loan_count' => isset($Row[39]) ? mysqli_real_escape_string($con, $Row[39]) : "",
        'first_loan_date' => isset($Row[40]) ? mysqli_real_escape_string($con, $Row[40]) : "",
        'travel_with_company' => isset($Row[41]) ? mysqli_real_escape_string($con, $Row[41]) : "",
        'monthly_income' => isset($Row[42]) ? mysqli_real_escape_string($con, $Row[42]) : "",
        'other_income' => isset($Row[43]) ? mysqli_real_escape_string($con, $Row[43]) : "",
        'support_income' => isset($Row[44]) ? mysqli_real_escape_string($con, $Row[44]) : "",
        'commitment' => isset($Row[45]) ? mysqli_real_escape_string($con, $Row[45]) : "",
        'monthly_due_capacity' => isset($Row[46]) ? mysqli_real_escape_string($con, $Row[46]) : "",
        'loan_limit' => isset($Row[47]) ? mysqli_real_escape_string($con, $Row[47]) : "",
        'about_customer' => isset($Row[48]) ? mysqli_real_escape_string($con, $Row[48]) : "",
        'residential_type' => isset($Row[49]) ? mysqli_real_escape_string($con, $Row[49]) : "",
        'residential_details' => isset($Row[50]) ? mysqli_real_escape_string($con, $Row[50]) : "",
        'residential_address' => isset($Row[51]) ? mysqli_real_escape_string($con, $Row[51]) : "",
        'residential_native_address' => isset($Row[52]) ? mysqli_real_escape_string($con, $Row[52]) : "",
        'occupation_type' => isset($Row[53]) ? mysqli_real_escape_string($con, $Row[53]) : "",
        'occupation_details' => isset($Row[54]) ? mysqli_real_escape_string($con, $Row[54]) : "",
        'area_confirm_type' => isset($Row[55]) ? mysqli_real_escape_string($con, $Row[55]) : "",
        'area_group' => isset($Row[56]) ? mysqli_real_escape_string($con, $Row[56]) : "",
        'area_line' => isset($Row[57]) ? mysqli_real_escape_string($con, $Row[57]) : "",
        'mortgage_process' => isset($Row[58]) ? mysqli_real_escape_string($con, $Row[58]) : "",
        'endorsement_process' => isset($Row[59]) ? mysqli_real_escape_string($con, $Row[59]) : "",
        'loan_date' => isset($Row[60]) ? mysqli_real_escape_string($con, $Row[60]) : "",
        'profit_type' => isset($Row[61]) ? mysqli_real_escape_string($con, $Row[61]) : "",
        'due_method_calc' => isset($Row[62]) ? mysqli_real_escape_string($con, $Row[62]) : "",
        'due_type' => isset($Row[63]) ? mysqli_real_escape_string($con, $Row[63]) : "",
        'profit_method' => isset($Row[64]) ? mysqli_real_escape_string($con, $Row[64]) : "",
        'due_method_scheme' => isset($Row[65]) ? mysqli_real_escape_string($con, $Row[65]) : "",
        'scheme_name' => isset($Row[66]) ? mysqli_real_escape_string($con, $Row[66]) : "",
        'int_rate' => isset($Row[67]) ? mysqli_real_escape_string($con, $Row[67]) : "",
        'due_period' => isset($Row[68]) ? mysqli_real_escape_string($con, $Row[68]) : "",
        'doc_charge' => isset($Row[69]) ? mysqli_real_escape_string($con, $Row[69]) : "",
        'proc_fee' => isset($Row[70]) ? mysqli_real_escape_string($con, $Row[70]) : "",
        'loan_amt_cal' => isset($Row[71]) ? mysqli_real_escape_string($con, $Row[71]) : "",
        'principal_amt_cal' => isset($Row[72]) ? mysqli_real_escape_string($con, $Row[72]) : "",
        'int_amt_cal' => isset($Row[73]) ? mysqli_real_escape_string($con, $Row[73]) : "",
        'tot_amt_cal' => isset($Row[74]) ? mysqli_real_escape_string($con, $Row[74]) : "",
        'due_amt_cal' => isset($Row[75]) ? mysqli_real_escape_string($con, $Row[75]) : "",
        'doc_charge_cal' => isset($Row[76]) ? mysqli_real_escape_string($con, $Row[76]) : "",
        'proc_fee_cal' => isset($Row[77]) ? mysqli_real_escape_string($con, $Row[77]) : "",
        'net_cash_cal' => isset($Row[78]) ? mysqli_real_escape_string($con, $Row[78]) : "",
        'due_start_from' => isset($Row[79]) ? mysqli_real_escape_string($con, $Row[79]) : "",
        'maturity_month' => isset($Row[80]) ? mysqli_real_escape_string($con, $Row[80]) : "",
        'collection_method' => isset($Row[81]) ? mysqli_real_escape_string($con, $Row[81]) : "",
        'communication' => isset($Row[82]) ? mysqli_real_escape_string($con, $Row[82]) : "",
        'verification_person' => isset($Row[83]) ? mysqli_real_escape_string($con, $Row[83]) : "",
        'verification_location' => isset($Row[84]) ? mysqli_real_escape_string($con, $Row[84]) : "",
        'issued_to' => isset($Row[85]) ? mysqli_real_escape_string($con, $Row[85]) : "",
        'agent_id' => isset($Row[86]) ? mysqli_real_escape_string($con, $Row[86]) : "",
        'issued_mode' => isset($Row[87]) ? mysqli_real_escape_string($con, $Row[87]) : "",
        'payment_type' => isset($Row[88]) ? mysqli_real_escape_string($con, $Row[88]) : "",
        'cash' => isset($Row[89]) ? mysqli_real_escape_string($con, $Row[89]) : "",
        'balance_amt' => isset($Row[90]) ? mysqli_real_escape_string($con, $Row[90]) : "",
        'cash_guarantor_id' => isset($Row[91]) ? mysqli_real_escape_string($con, $Row[91]) : "",
        'cash_guarantor_rel' => isset($Row[92]) ? mysqli_real_escape_string($con, $Row[92]) : ""
    );

    $dataArray['cus_id'] = strlen($dataArray['cus_id']) == 12 ? $dataArray['cus_id'] : 'Invalid';
    $dataArray['guarantor_adhar'] = strlen($dataArray['guarantor_adhar']) == 12 ? $dataArray['guarantor_adhar'] : 'Invalid';

    $dataArray['mobile1'] = strlen($dataArray['mobile1']) == 10 ? $dataArray['mobile1'] : 'Invalid';

    $dataArray['dor'] = dateFormatChecker($dataArray['dor']);

    $dob = dateFormatChecker($dataArray['dob']);
    $dataArray['dob'] = ($dob == 'Invalid Date') ? '' : $dob; //cause dob may not be available

    $cus_dataArray = ['New' => 'New', 'Existing' => 'Existing'];
    $dataArray['cus_data'] = arrayItemChecker($cus_dataArray, $dataArray['cus_data']);

    $genderArray = ['Male' => '1', 'Female' => '2', 'Others' => '3'];
    $dataArray['gender'] = arrayItemChecker($genderArray, $dataArray['gender']);

    $maritalArray = ['Yes' => '1', 'No' => '2'];
    $dataArray['marital'] = arrayItemChecker($maritalArray, $dataArray['marital']);

    $occupationArray = ['Govt Job' => '1', 'Pvt Job' => '2', 'Business' => '3', 'Self Employed' => '4', 'Daily wages' => '5', 'Agriculture' => '6', 'Others' => '7'];
    $dataArray['occupation_type'] = arrayItemChecker($occupationArray, $dataArray['occupation_type']);

    $how_to_know_Array = ['Customer Reference' => '0', 'Advertisement' => '1', 'Promotion Activity' => '2', 'Agent Reference' => '3', 'Staff Reference' => '4', 'Other Reference' => '5'];
    $dataArray['how_to_know'] = arrayItemChecker($how_to_know_Array, $dataArray['how_to_know']);

    $residential_typeArray = ['Own' => '0', 'Rental' => '1', 'Lease' => '2', 'Quarters' => '3'];
    $dataArray['residential_type'] = arrayItemChecker($residential_typeArray, $dataArray['residential_type']);

    $area_confirm_typeArray = ['Resident' => '0', 'Occupation' => '1'];
    $dataArray['area_confirm_type'] = arrayItemChecker($area_confirm_typeArray, $dataArray['area_confirm_type']);

    $poss_typeArray = ['Due Amount' => '1', 'Due Period' => '2'];
    $dataArray['poss_type'] = arrayItemChecker($poss_typeArray, $dataArray['poss_type']);

    return $dataArray;
}


function getRequestCode($con)
{
    $myStr = "REQ";
    $selectIC = $con->query("SELECT req_code FROM request_creation WHERE req_code != '' ");
    if ($selectIC->num_rows > 0) {
        $codeAvailable = $con->query("SELECT req_code FROM request_creation WHERE req_code != '' ORDER BY req_id DESC LIMIT 1");
        while ($row = $codeAvailable->fetch_assoc()) {
            $ac2 = $row["req_code"];
        }
        $appno2 = ltrim(strstr($ac2, '-'), '-');
        $appno2 = $appno2 + 1;
        $req_code = $myStr . "-" . "$appno2";
    } else {
        $initialapp = $myStr . "-101";
        $req_code = $initialapp;
    }
    return $req_code;
}
function dateFormatChecker($checkdate)
{
    // Attempt to create a DateTime object from the provided date
    $dateTime = DateTime::createFromFormat('Y-m-d', $checkdate);

    // Check if the date is in the correct format
    if ($dateTime !== false && $dateTime->format('Y-m-d') === $checkdate) {
        // Date is in the correct format, no need to change anything
        return $checkdate;
    } else {
        // Date is not in the correct format, reformat it
        $formattedDor = date('Y-m-d', strtotime($checkdate));
        return $formattedDor;
    }
}
function arrayItemChecker($arrayList, $arrayItem)
{
    if (array_key_exists($arrayItem, $arrayList)) {
        $arrayItem = $arrayList[$arrayItem];
    } else {
        $arrayItem = 'Not Found';
    }
    return $arrayItem;
}

function checkCustomerData($con, $cus_id)
{

    $new_cus_check = $con->query("SELECT cus_reg_id from customer_register where cus_id = '" . strip_tags($cus_id) . "' ");

    if ($new_cus_check->num_rows == 0) {
        $cus_data = 'New';
    } else {
        $cus_data = 'Existing';
    }
    return $cus_data;
}
function getAreaId($con, $area_name)
{
    $query = "SELECT * FROM area_list_creation where area_name = '" . $area_name . "' ";
    $result1 = $con->query($query) or die("Error ");
    if ($con->affected_rows > 0) {
        $row = $result1->fetch_assoc();
        $area_id = $row["area_id"];
    } else {
        $area_id = 'Not Found';
    }
    return $area_id;
}
function getSubAreaId($con, $sub_area_name)
{
    $query = "SELECT * FROM sub_area_list_creation where sub_area_name = '" . $sub_area_name . "' ";
    $result1 = $con->query($query) or die("Error ");
    if ($con->affected_rows > 0) {
        $row = $result1->fetch_assoc();
        $sub_area_id = $row["sub_area_id"];
    } else {
        $sub_area_id = 'Not Found';
    }
    return $sub_area_id;
}
function getLoanCategoryId($con, $loan_category_name)
{
    $query = "SELECT * FROM loan_category_creation where loan_category_creation_name = '" . $loan_category_name . "' ";
    $result1 = $con->query($query) or die("Error ");
    if ($con->affected_rows > 0) {
        $row = $result1->fetch_assoc();
        $loan_cat_id = $row["loan_category_creation_id"];
    } else {
        $loan_cat_id = 'Not Found';
    }
    return $loan_cat_id;
}
function checkSubCategory($con, $sub_cat_name)
{
    $query = "SELECT * FROM loan_category where sub_category_name = '" . $sub_cat_name . "' ";
    $result1 = $con->query($query) or die("Error ");
    if ($con->affected_rows > 0) {
        $sub_categoryCheck = 'Available';
    } else {
        $sub_categoryCheck = 'Not Found';
    }
    return $sub_categoryCheck;
}
function checkAgent($con, $agent_name)
{
    //check if agent available
    if ($agent_name != '') { //because its not mandatory

        $query = "SELECT * FROM agent_creation where ag_name = '" . $agent_name . "' ";
        $result1 = $con->query($query) or die("Error ");
        if ($con->affected_rows > 0) {
            $row = $result1->fetch_assoc();
            $agentCheck = $row["ag_id"];
        } else {
            $agentCheck = 'Not Found';
        }
    } else {
        $agentCheck = '';
    }
    return $agentCheck;
}


function handleError($data, $rownum)
{
    $errcolumns = array();

    if ($data['cus_id'] == 'Invalid') {
        // Condition 1 is true
        $errcolumns[] = 'Customer ID';
    }

    if (preg_match('/^\s*$/', $data['cus_name'])) {
        // Condition 1 is true
        $errcolumns[] = 'Customer Name';
    }

    if ($data['cus_data'] == 'Not Found') {
        // Condition 1 is true
        $errcolumns[] = 'Customer Data';
    }

    if ($data['guarantor_adhar'] == 'Invalid') {
        // Condition 1 is true
        $errcolumns[] = 'Guarantor Adhar';
    }

    if ($data['mobile1'] == 'Invalid') {
        // Condition 1 is true
        $errcolumns[] = 'Mobile Number';
    }

    if ($data['agent_id'] == 'Not Found') {
        // Condition 1 is true
        $errcolumns[] = 'Agent Name';
    }

    if ($data['dor'] == 'Invalid Date') {
        // Condition 2 is true
        $errcolumns[] = 'Date of Request';
    }

    if ($data['gender'] == 'Not Found') {
        // Condition 3 is true
        $errcolumns[] = 'Gender';
    }

    if ($data['area_id'] == 'Not Found') {
        // Condition 4 is true
        $errcolumns[] = 'Area';
    }

    if ($data['sub_area_id'] == 'Not Found') {
        // Condition 5 is true
        $errcolumns[] = 'Sub Area';
    }

    if ($data['area_group'] == '') {
        // Condition 5 is true
        $errcolumns[] = 'Area Group';
    }

    if ($data['area_line'] == '') {
        // Condition 5 is true
        $errcolumns[] = 'Area Line';
    }

    if ($data['marital'] == 'Not Found') {
        // Condition 6 is true
        $errcolumns[] = 'Marital Status';
    }

    if ($data['residential_type'] == 'Not Found') {
        // Condition 7 is true
        $errcolumns[] = 'Residential Type';
    }

    if ($data['occupation_type'] == 'Not Found') {
        // Condition 7 is true
        $errcolumns[] = 'Occupation Type';
    }

    if ($data['loan_cat_id'] == 'Not Found') {
        // Condition 8 is true
        $errcolumns[] = 'Loan Category';
    }

    if ($data['sub_categoryCheck'] == 'Not Found') {
        // Condition 9 is true
        $errcolumns[] = 'Sub Category';
    }

    if ($data['poss_type'] == 'Not Found') {
        // Condition 10 is true
        $errcolumns[] = 'Possibility Type';
    }

    if ($data['cal_category1'] == '' && $data['cal_category2'] == '' && $data['cal_category3'] == '') {
        // Condition 10 is true
        $errcolumns[] = 'Enter Atlease 1 Category info';
    }

    $errtxt = "Please Check the input given in Line no: " . ($rownum + 1) . " on below. <br><br>";
    $errtxt .= "<ul>";
    foreach ($errcolumns as $columns) {
        $errtxt .= "<li>$columns</li>";
    }
    $errtxt .= "</ul><br>";
    $errtxt .= "Insertion completed till Line No: " . $rownum;
    return $errtxt;
}

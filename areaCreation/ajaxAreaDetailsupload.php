<?php
// error_reporting(0);
include("../ajaxconfig.php");
@session_start();
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}
require_once('../vendor/csvreader/php-excel-reader/excel_reader2.php');
require_once('../vendor/csvreader/SpreadsheetReader.php');
if (isset($_FILES["file"]["type"])) {
    $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {


        $targetPath = '../uploads/area_creation/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());

        for ($i = 0; $i < $sheetCount; $i++) {
            $Reader->ChangeSheet($i);
            foreach ($Reader as $Row) {

                if ($Row[0] != 'State' && $Row[0] != '') {

                    if (isset($Row[0])) {
                        $state = mysqli_real_escape_string($con, $Row[0]);
                    }
                    $district = '';
                    if (isset($Row[1])) {
                        $district = mysqli_real_escape_string($con, $Row[1]);
                    }
                    $taluk = '';
                    if (isset($Row[2])) {
                        $taluk = mysqli_real_escape_string($con, $Row[2]);
                    }

                    $area = "";
                    $area_list_creation_id = '';
                    $last_insert_id = 0;
                    if (isset($Row[3])) {
                        $area = mysqli_real_escape_string($con, $Row[3]);
                        $query = "SELECT * FROM area_list_creation where area_name = '" . $area . "' and status = 0";
                        $result1 = $con->query($query) or die("Error ");
                        if ($con->affected_rows > 0) {
                            $row = $result1->fetch_assoc();
                            $area_list_creation_id = $row["area_id"];
                        } else {
                            $query = "INSERT into area_list_creation (area_name, taluk) values('" . strip_tags($area) . "','" . strip_tags($taluk) . "')";
                            $result1 = $con->query($query) or die("Error ");
                            $last_insert_id = $con->insert_id;
                            $area_list_creation_id = $con->insert_id;
                        }
                    }

                    $subarea = "";
                    $sub_area_list_creation_id = '';
                    if (isset($Row[4])) {
                        $subarea = mysqli_real_escape_string($con, $Row[4]);
                        $query = "SELECT * FROM sub_area_list_creation where sub_area_name = '" . $subarea . "' and area_id_ref = '" . $area_list_creation_id . "' and status = 0";
                        $result1 = $con->query($query) or die("Error ");
                        if ($con->affected_rows > 0) {
                            $row = $result1->fetch_assoc();
                            $sub_area_list_creation_id = $row["sub_area_id"];
                        } else {
                            $query = "INSERT into sub_area_list_creation (sub_area_name,area_id_ref) values('" . strip_tags($subarea) . "','" . $area_list_creation_id . "')";
                            $result1 = $con->query($query) or die("Error ");
                            $sub_area_list_creation_id = $con->insert_id;
                        }
                    }

                    $pincode = "";
                    if (isset($Row[5])) {
                        $pincode = mysqli_real_escape_string($con, $Row[5]);
                    }


                    $qry = $con->query("SELECT area_creation_id as id, sub_area FROM area_creation WHERE area_name_id = '" . strip_tags($area_list_creation_id) . "' LIMIT 1 ");
                    if ($qry->num_rows > 0) {

                        $row = $qry->fetch_assoc();
                        $area_creation_id = $row["id"];
                        $sub_area = $row["sub_area"];

                        $sub_area_list_creation_id = $sub_area . ',' . $sub_area_list_creation_id;

                        $qry = $con->query("UPDATE area_creation SET sub_area = '" . strip_tags($sub_area_list_creation_id) . "', taluk = '" . strip_tags($taluk) . "', district = '" . strip_tags($district) . "', state = '" . strip_tags($state) . "', pincode = '" . strip_tags($pincode) . "', updated_date = current_timestamp(), update_login_id = '" . $userid . "' WHERE area_creation_id = '" . strip_tags($area_creation_id) . "' ");
                    } else {

                        $insert = $con->query("INSERT INTO area_creation(area_name_id, sub_area, taluk, district,state,pincode,created_date,insert_login_id) VALUES('" . strip_tags($area_list_creation_id) . "', '" . strip_tags($sub_area_list_creation_id) . "', '" . strip_tags($taluk) . "', '" . strip_tags($district) . "','" . strip_tags($state) . "','" . strip_tags($pincode) . "', current_timestamp(), '" . $userid . "')");
                    }
                }
            }
        }

        if (!empty($insert)) {
            $message = 0;
        } else {
            $message = 1;
        }
    }
} else {
    $message = 1;
}
echo $message;

<?php

class verificaitonClass
{
    public $user_id;
    function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    function getverificaitonCounts($con)
    {
        $response = array();
        $today = date('Y-m-d');
        $sub_area_list = $_POST['sub_area_list'];

        $tot_in_ver = "SELECT COUNT(*) as tot_in_ver from request_creation where cus_status >= 1 ";
        $today_in_ver = "SELECT COUNT(*) as tot_in_ver from request_creation where cus_status IN(1,10,11,12) and date(updated_date) = '$today' ";
        $tot_issue = "SELECT COUNT(*) as tot_issue FROM request_creation req JOIN customer_profile cp ON cp.req_id = req.req_id WHERE req.cus_status >= 14 ";
        $today_issue = "SELECT COUNT(*) as today_issue FROM request_creation req JOIN customer_profile cp ON cp.req_id = req.req_id WHERE req.cus_status >= 14 and date(req.updated_date) = '$today' ";
        $tot_balance = "SELECT COUNT(*) as tot_balance from request_creation where cus_status IN(1,10,11,12)  ";
        $today_balance = "SELECT COUNT(*) as today_balance from request_creation where cus_status IN(1,10,11,12) and date(updated_date) = '$today'  ";

        if (empty($sub_area_list)) {
            $sub_area_list = $this->getUserGroupBasedSubArea($con, $this->user_id);
        }

        $tot_in_ver .= " AND sub_area IN ($sub_area_list) ";
        $today_in_ver .= " AND sub_area IN ($sub_area_list) ";
        $tot_issue .= " AND ( CASE WHEN cp.area_confirm_subarea IS NOT NULL THEN cp.area_confirm_subarea IN ($sub_area_list) ELSE TRUE END )";
        $today_issue .= " AND ( CASE WHEN cp.area_confirm_subarea IS NOT NULL THEN cp.area_confirm_subarea IN ($sub_area_list) ELSE TRUE END )";
        $tot_balance .= " AND sub_area IN ($sub_area_list) ";
        $today_balance .= " AND sub_area IN ($sub_area_list) ";


        $tot_in_verQry = $con->query($tot_in_ver);
        $today_in_verQry = $con->query($today_in_ver);
        $tot_issueQry = $con->query($tot_issue);
        $today_issueQry = $con->query($today_issue);
        $tot_balanceQry = $con->query($tot_balance);
        $today_balanceQry = $con->query($today_balance);

        $response['tot_in_ver'] = $tot_in_verQry->fetch_assoc()['tot_in_ver'];
        $response['today_in_ver'] = $today_in_verQry->fetch_assoc()['tot_in_ver'];
        $response['tot_issue'] = $tot_issueQry->fetch_assoc()['tot_issue'];
        $response['today_issue'] = $today_issueQry->fetch_assoc()['today_issue'];
        $response['tot_balance'] = $tot_balanceQry->fetch_assoc()['tot_balance'];
        $response['today_balance'] = $today_balanceQry->fetch_assoc()['today_balance'];

        return $response;
    }

    function getUserGroupBasedSubArea($con, $user_id)
    {
        $sub_area_list = array();

        $userQry = $con->query("SELECT * FROM USER WHERE user_id = $user_id ");
        while ($rowuser = $userQry->fetch_assoc()) {
            $group_id = $rowuser['group_id'];
        }
        $group_id = explode(',', $group_id);
        foreach ($group_id as $group) {
            $groupQry = $con->query("SELECT * FROM area_group_mapping where map_id = $group ");
            $row_sub = $groupQry->fetch_assoc();
            $sub_area_list[] = $row_sub['sub_area_id'];
        }
        $sub_area_ids = array();
        foreach ($sub_area_list as $subarray) {
            $sub_area_ids = array_merge($sub_area_ids, explode(',', $subarray));
        }
        $sub_area_list = array();
        $sub_area_list = implode(',', $sub_area_ids);

        return $sub_area_list;
    }
}

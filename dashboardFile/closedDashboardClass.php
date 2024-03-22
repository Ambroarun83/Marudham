<?php

class ClosedDashboardClass{
    public $user_id;
    public function __construct($user_id){
        $this->user_id = $user_id;
    }
    public function getClosedCounts($con){
        $response = array();
        $today = date('Y-m-d');
        $sub_area_list = $_POST['sub_area_list'];

        $tot_in_cl = "SELECT COUNT(*) as tot_in_cl FROM request_creation where ( cus_status >= 3 and cus_status NOT IN(4, 5, 6, 8, 9, 10, 11, 12) ) ";


        if (empty($sub_area_list)) {
            $sub_area_list = $this->getUserGroupBasedSubArea($con, $this->user_id);
        }

        $tot_in_cl .= " AND sub_area IN ($sub_area_list) ";

        $tot_in_clQry = $con->query($tot_in_cl);

        $response['tot_in_cl'] = $tot_in_clQry->fetch_assoc()['tot_in_cl'];

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
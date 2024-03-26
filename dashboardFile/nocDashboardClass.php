<?php

use function PHPSTORM_META\map;

class NocClass
{
    public $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getNOCCounts($con)
    {
        $response = array();
        $today = date('Y-m-d');
        $sub_area_list = $_POST['sub_area_list'];

        $tot_noc = "SELECT COUNT(*) as tot_noc FROM request_creation req JOIN acknowlegement_customer_profile cp ON cp.req_id = req.req_id WHERE req.cus_status >= 21 ";
        $tot_noc_issued = "SELECT COUNT(*) AS tot_noc_issued FROM request_creation req JOIN acknowlegement_customer_profile cp ON cp.req_id = req.req_id WHERE req.cus_status >= 21 ";

        if (empty($sub_area_list)) {
            $sub_area_list = $this->getUserGroupBasedSubArea($con, $this->user_id);
        }

        $tot_noc .= " AND ( CASE WHEN cp.area_confirm_subarea IS NOT NULL THEN cp.area_confirm_subarea IN ($sub_area_list) ELSE TRUE END ) ";

        $tot_nocQry = $con->query($tot_noc);
        
        $response['tot_noc'] = $tot_nocQry->fetch_assoc()['tot_noc'];

        return $response;
    }
    private function getNocDocStatus($con){
        $qry = $con->query("SELECT req.req_id FROM request_creation req JOIN acknowlegement_customer_profile cp ON cp.req_id = req.req_id WHERE req.cus_status = 21 ");
        $req_id = $qry->fetch_assoc();
        $noc_status = array_map('getdetails',$req_id);

        function getdetails($req_id){
            $nocstatus = 1;

            //noc status will be 1 refering that noc is completed, and 0 means noc pending
            //now check all the documents tables to check whether the passed req_id having noc_status 0, means noc not completed for that req_id
            //if in all queries the noc status count is set to 1 then the count inside the query will return null or 0
            //if count is >0 then noc status is completed
            // echo $req_id;
            return --$nocstatus;
        }
    }
    private function getUserGroupBasedSubArea($con, $user_id)
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

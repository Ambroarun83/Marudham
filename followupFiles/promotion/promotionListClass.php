<?php
session_start();
class promotionListClass
{
    private $sub_area_list = array();
    public function __construct($con)
    {
        $userid = $_SESSION["userid"];
        if ($userid != 1) {

            $userQry = $con->query("SELECT * FROM USER WHERE user_id = $userid ");
            while ($rowuser = $userQry->fetch_assoc()) {
                $group_id = $rowuser['group_id'];
            }
            $group_id = explode(',', $group_id);
            $sub_area_list = array();
            foreach ($group_id as $group) {
                $groupQry = $con->query("SELECT * FROM area_group_mapping where map_id = $group ");
                $row_sub = $groupQry->fetch_assoc();
                $sub_area_list[] = $row_sub['sub_area_id'];
            }
            $sub_area_ids = array();
            foreach ($sub_area_list as $subarray) {
                $sub_area_ids = array_merge($sub_area_ids, explode(',', $subarray));
            }
            $this->sub_area_list = implode(',', $sub_area_ids);
        }
    }
    function getdetails($con, $type)
    {
        $arr = array();

        if ($type == 'existing') {
            //only closed customers who dont have any loans in current.

            $sql = $con->query("SELECT cs.cus_id,cs.consider_level,cs.updated_date FROM closed_status cs JOIN acknowlegement_customer_profile cp ON cs.req_id = cp.req_id WHERE cs.cus_sts >= '20' and cp.area_confirm_subarea IN ($this->sub_area_list) and cs.closed_sts = 1 ");

            while ($row = $sql->fetch_assoc()) {

                $last_closed_date = date('Y-m-d', strtotime($row['updated_date']));

                $check_req = $con->query("SELECT req_id from request_creation where (cus_status NOT between 4 and 9) and cus_status < 20 and cus_id = '" . $row['cus_id'] . "' ORDER By req_id DESC LIMIT 1 ");
                if ($check_req->num_rows == 0) {
                    $arr[] = array('cus_id' => $row['cus_id'], 'sub_status' => $row['consider_level'], 'last_updated_date' => $last_closed_date);
                }
            }
        } else {

            $sql = $con->query("SELECT req.* FROM request_creation req WHERE (req.cus_status >= 4 AND req.cus_status <= 9) AND (req.sub_area IN ( " . $this->sub_area_list . " ) or  (select area_confirm_subarea from customer_profile where req_id = req.req_id) IN ( " . $this->sub_area_list . " ) ) Group By req.cus_id");
            while ($row = $sql->fetch_assoc()) {

                $last_updated_date = date('Y-m-d', strtotime($row['updated_date']));
                $last_closed_date = '';

                $check_req = $con->query("SELECT req_id from request_creation where (cus_status NOT between 4 and 9) and cus_status < 20 and cus_id = '" . $row['cus_id'] . "' ORDER By req_id DESC LIMIT 1 ");
                if ($check_req->num_rows == 0) {
                    $arr[] = array('cus_id' => $row['cus_id'], 'sub_status' => $row['cus_status'], 'last_updated_date' => $last_updated_date);
                }
            }
        }
        return $arr;
    }

    function getCustomerPromotionType($con, $cus_id)
    {
        $response = 'Loan Progress';

        $sql = $con->query("SELECT cs.cus_id,cs.consider_level,cs.updated_date FROM closed_status cs JOIN acknowlegement_customer_profile cp ON cs.req_id = cp.req_id WHERE cs.cus_sts >= '20' and cs.cus_id = '$cus_id' ");

        while ($row = $sql->fetch_assoc()) {

            $check_req = $con->query("SELECT req_id from request_creation where (cus_status NOT between 4 and 9) and cus_status < 20 and cus_id = '" . $row['cus_id'] . "' ORDER By req_id DESC LIMIT 1 ");
            if ($check_req->num_rows == 0) {
                $response = 'Existing';
            }
        }


        $sql = $con->query("SELECT req.* FROM request_creation req WHERE (req.cus_status >= 4 AND req.cus_status <= 9) and req.cus_id = '$cus_id' ");

        while ($row = $sql->fetch_assoc()) {

            $check_req = $con->query("SELECT req_id from request_creation where (cus_status NOT between 4 and 9) and cus_status < 20 and cus_id = '" . $row['cus_id'] . "' ORDER By req_id DESC LIMIT 1 ");
            if ($check_req->num_rows == 0) {
                $response = 'Repromotion';
            }
        }


        return $response;
    }
}

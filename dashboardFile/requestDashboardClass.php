<?php 
include '../bulk_uploadFile/bulkUploadClass.php';


class RequestClass extends BulkUploadClass{
    protected $user_id,$user_type;
    public function __construct($con) {
        
        $userDetails = $this->getUserDetails($con);
        $this->user_id = $userDetails['user_id'];
        $this->user_type = $userDetails['user_type'];
    }
    function getRequestCounts($con){
        
        $response = array();
        $today = date('Y-m-d');

        //finding total requests of the user
        $qry = $con->query("SELECT count(*) as tot_req FROM request_creation WHERE insert_login_id = '$this->user_id' ");
        $response['tot_req'] = $qry->fetch_assoc()['tot_req'];

        //finding today requests of the user
        $qry = $con->query("SELECT count(*) as today_req FROM request_creation WHERE insert_login_id = '$this->user_id' AND date(created_date) = '$today' ");
        $response['today_req'] = $qry->fetch_assoc()['today_req'];

        //finding total issued of the user
        $qry = $con->query("SELECT count(*) as tot_issue FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_status >= 14 ");
        $response['tot_issue'] = $qry->fetch_assoc()['tot_issue'];

        //finding today issued of the user
        $qry = $con->query("SELECT count(*) as today_issue FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_status >= 14 AND date(created_date) = '$today' ");
        $response['today_issue'] = $qry->fetch_assoc()['today_issue'];

        //finding total balance of the user
        $qry = $con->query("SELECT count(*) as tot_balance FROM request_creation WHERE insert_login_id = '$this->user_id' AND (cus_status < 14 and cus_status NOT IN(4,5,6,7,8,9) ) ");
        $response['tot_balance'] = $qry->fetch_assoc()['tot_balance'];

        //finding today balance of the user
        $qry = $con->query("SELECT count(*) as today_balance FROM request_creation WHERE insert_login_id = '$this->user_id' AND (cus_status < 14 and cus_status NOT IN(4, 5, 6, 7, 8, 9) ) AND date(created_date) = '$today' ");
        $response['today_balance'] = $qry->fetch_assoc()['today_balance'];

        //finding total cencelled request of the user
        $qry = $con->query("SELECT count(*) as tot_cancel FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_status = 4 ");
        $response['tot_cancel'] = $qry->fetch_assoc()['tot_cancel'];

        //finding today cencelled request of the user
        $qry = $con->query("SELECT count(*) as today_cancel FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_status = 4 AND date(created_date) = '$today' ");
        $response['today_cancel'] = $qry->fetch_assoc()['today_cancel'];

        //finding total revoked request of the user
        $qry = $con->query("SELECT count(*) as tot_revoke FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_status = 8 ");
        $response['tot_revoke'] = $qry->fetch_assoc()['tot_revoke'];

        //finding today revoked request of the user
        $qry = $con->query("SELECT count(*) as today_revoke FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_status = 8 AND date(created_date) = '$today' ");
        $response['today_revoke'] = $qry->fetch_assoc()['today_revoke'];

        //finding total new customer by user raised request
        $qry = $con->query("SELECT count(*) as tot_new FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_data = 'New' ");
        $response['tot_new'] = $qry->fetch_assoc()['tot_new'];

        //finding today new customer by user raised request
        $qry = $con->query("SELECT count(*) as today_new FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_data = 'New' AND date(created_date) = '$today' ");
        $response['today_new'] = $qry->fetch_assoc()['today_new'];

        //finding total existing customer by user raised request
        $qry = $con->query("SELECT count(*) as tot_existing FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_data = 'Existing' ");
        $response['tot_existing'] = $qry->fetch_assoc()['tot_existing'];

        //finding today existing customer by user raised request
        $qry = $con->query("SELECT count(*) as today_existing FROM request_creation WHERE insert_login_id = '$this->user_id' AND cus_data = 'Existing' AND date(created_date) = '$today' ");
        $response['today_existing'] = $qry->fetch_assoc()['today_existing'];

        return $response;
    }

    function getCategoryCount($con){
        
    }
}
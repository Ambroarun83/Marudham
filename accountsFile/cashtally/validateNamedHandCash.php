<?php
$name_id = $_POST['name'];
$amt = $_POST['amt'];
$cash_type = $_POST['cash_type'];

$obj = new ValidateNamedHandCash();
if ($cash_type == 'inv') {
    $obj->checkDebitInvestment($name_id, $amt);
} else if ($cash_type == 'dep') {
    $obj->checkDebitDeposit($name_id, $amt);
} else if ($cash_type == 'crel') {
    $obj->checkCreditEL($name_id, $amt);
} else if ($cash_type == 'dbel') {
    $obj->checkDebitEL($name_id, $amt);
}

echo json_encode($obj->response);

class ValidateNamedHandCash
{
    private $con, $mysqli, $connect;
    public $response;
    function __construct()
    {
        include '../../ajaxconfig.php';
        $this->con = $con;
        $this->mysqli = $mysqli;
        $this->connect = $connect;
    }
    function checkDebitInvestment($name_id, $amt)
    {
        $crqry = $this->con->query("SELECT SUM(amt) FROM ct_cr_hinvest WHERE name_id = '$name_id' ");
        $dbqry = $this->con->query("SELECT SUM(amt) FROM ct_db_hinvest WHERE name_id = '$name_id' ");
        $cr = $crqry->fetch_array()[0];
        $db = $dbqry->fetch_array()[0];
        $total_debitable = $cr - $db;
        $this->response['info'] = $total_debitable >= $amt;
    }
    function checkDebitDeposit($name_id, $amt)
    {
        $crqry = $this->con->query("SELECT SUM(amt) FROM ct_cr_hdeposit WHERE name_id = '$name_id' ");
        $dbqry = $this->con->query("SELECT SUM(amt) FROM ct_db_hdeposit WHERE name_id = '$name_id' ");
        $cr = $crqry->fetch_array()[0];
        $db = $dbqry->fetch_array()[0];
        $total_debitable = $cr - $db;
        $this->response['info'] = $total_debitable >= $amt;
    }
    function checkCreditEL($name_id, $amt)
    {
        $crqry = $this->con->query("SELECT SUM(amt) FROM ct_cr_hel WHERE name_id = '$name_id' ");
        $dbqry = $this->con->query("SELECT SUM(amt) FROM ct_db_hel WHERE name_id = '$name_id' ");
        $cr = $crqry->fetch_array()[0];
        $db = $dbqry->fetch_array()[0];
        $total_creditable = $db - $cr;
        $this->response['creditable'] = $total_creditable;
        $this->response['info'] = '';
    }
    function checkDebitEL($name_id, $amt)
    {
        $crqry = $this->con->query("SELECT SUM(amt) FROM ct_cr_hel WHERE name_id = '$name_id' ");
        $dbqry = $this->con->query("SELECT SUM(amt) FROM ct_db_hel WHERE name_id = '$name_id' ");
        $cr = $crqry->fetch_array()[0];
        $db = $dbqry->fetch_array()[0];
        $total_debitable = $cr - $db;
        $this->response['debitable'] = $total_debitable;
        $this->response['info'] = '';
    }
    //Close Connection
    function __destruct()
    {
        $this->con->close();
        $this->mysqli->close();
        $this->connect = null;
    }
}

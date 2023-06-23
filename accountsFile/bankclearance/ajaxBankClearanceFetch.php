<?php
include('../../ajaxconfig.php');
@session_start();

if(isset($_SESSION['userid'])){ //fetch if user has cash tally admin access or not
    $user_id = $_SESSION['userid'];
    $qry = $con->query("SELECT cash_tally_admin from user where user_id = $user_id");
    $admin_access = $qry->fetch_assoc()['cash_tally_admin'];
}else{
    $admin_access = '1';
}


$bank_id = $_POST['bank_id'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$response ='';$i=0;


$qry = $con->query("SELECT * FROM bank_stmt WHERE insert_login_id = '$user_id' and bank_id = '$bank_id' and (trans_date >= '$from_date' and trans_date <= '$to_date' ) ");
if($qry->num_rows > 0){
    //if statements are present in that particular dates then show it in table view
    ?>

    <thead>
        <th width='50'>S.No</th>
        <th>Date</th>
        <th>Narration</th>
        <th>Tansaction ID</th>
        <th>Credit</th>
        <th>Debit</th>
        <th>Balance</th>
        <th>Clear Category</th>
        <th>Ref ID</th>
        <th>Clearance</th>
    </thead>
    <tbody>
        <?php
        while($row = $qry->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo date('d-m-Y',strtotime($row['trans_date']));?></td>
                <td><?php echo $row['narration'];?></td>
                <td><?php echo $row['trans_id'];?></td>
                <td><?php echo $row['credit'];?></td>
                <td><?php echo $row['debit'];?></td>
                <td><?php echo $row['balance'];?></td>
                <td><?php if($row['credit'] != ''){ echo runcreditCategories($con,$admin_access,$bank_id); }elseif($row['debit'] !=''){echo rundebitCategories($con,$admin_access,$bank_id); } ?></td>
                <td><?php echo "<select class='form-control ref-id' ><option value=''>Select Ref ID</option></select>"; ?></td>
                <td><?php echo "<span class='text-danger clr-status' ><b>Unclear</b></span><input type='button' class='btn btn-primary clear_btn' value='Clear' id='' name='' style='display:none'> "; ?></td>
            </tr>
        <?php 
            $i++; 
        }
        ?>
    </tbody>

<?php
    
}else{
    $response = 'Given Date Has No Statements!';
    echo $response;
}




function runcreditCategories($con,$admin_access,$bank_id){

$catqry = "SELECT * from cash_tally_modes where bankcredit = 0  ";
if($admin_access == '1'){
    $catqry .= "and admin_access = 1 ";
}

$runqry = $con->query($catqry);

$selectTxt = "<input type='hidden' value='$bank_id'><select class='form-control clr_cat' ><option value=''>Select Category</option>";
while($catrow = $runqry->fetch_assoc()){
    $selectTxt .= "<option value='".$catrow['id']."'>".$catrow['modes']."</option>";
}
$selectTxt .= "</select><input type='hidden' value='Credit'>";

return $selectTxt;
}

function rundebitCategories($con,$admin_access,$bank_id){

$catqry = "SELECT * from cash_tally_modes where bankdebit = 0  ";
if($admin_access == '1'){
    $catqry .= "and admin_access = 1 ";
}

$runqry = $con->query($catqry);

$selectTxt = "<input type='hidden' value='$bank_id'><select class='form-control clr_cat' ><option value=''>Select Category</option>";
while($catrow = $runqry->fetch_assoc()){
    $selectTxt .= "<option value='".$catrow['id']."'>".$catrow['modes']."</option>";
}
$selectTxt .= "</select><input type='hidden' value='Debit'>";

return $selectTxt;
}

?>
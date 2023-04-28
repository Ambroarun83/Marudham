<?php 
@session_start();
if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}

$id=0;
$user_id        = '';
$full_name      = '';
$user_name      = '';
$password       = '';
$role           = '';
$role_type           = '';
$dir_name           = '';
$ag_name           = '';
$staff_name           = '';
$company_id           = '';
$branch_id           = '';
$line_id           = '';
$group_id           = '';
$mastermodule    = '';
$company_creation      = '';
$branch_creation = '';
$loan_category ='';
$loan_calculation   = '';
$loan_scheme   = '';
$area_creation        = '';
$area_mapping        = '';
$area_status        = '';
$adminmodule = '';
$director_creation = '';
$agent_creation = '';
$staff_creation = '';
$manage_user = '';
$doc_mapping = '';
$requestmodule = '';
$request = '';
$request_list_access = '';
$verificationmodule = '';
$verification = '';
$approvalmodule = '';
$approval = '';
$acknowledgementmodule = '';
$acknowledgement = '';
$loanissuemodule = '';
$loan_issue = '';

$agentNameList = $userObj->getagentNameList($mysqli);

if(isset($_POST['submit_manage_user']) && $_POST['submit_manage_user'] != '')
{
    if(isset($_POST['id']) && $_POST['id'] >0 && is_numeric($_POST['id'])){		
        $id = $_POST['id']; 	
		$updateUser = $userObj->updateUser($mysqli,$id, $userid);  
    ?>
	<script>location.href='<?php echo $HOSTPATH;  ?>edit_manage_user&msc=2';</script>
    <?php	}
    else{   
		$addUser = $userObj->addUser($mysqli, $userid);   
        ?>
    <script>location.href='<?php echo $HOSTPATH;  ?>edit_manage_user&msc=1';</script>
        <?php
    }
}

$del=0;
$costcenter=0;
if(isset($_GET['del']))
{
$del=$_GET['del'];
}
if($del>0)
{
	$deleteUser = $userObj->deleteUser($mysqli,$del, $userid); 
	//die;
	?>
	<script>location.href='<?php echo $HOSTPATH;  ?>edit_manage_user&msc=3';</script>
<?php	
}

if(isset($_GET['upd']))
{
$idupd=$_GET['upd'];
}
$status =0;
if($idupd>0)
{
	$getUser = $userObj->getUser($mysqli,$idupd); 
	if (sizeof($getUser)>0) {
        for($i=0;$i<sizeof($getUser);$i++)  {			
			$user_id                 	 = $getUser['user_id'];
			$fullname          		     = $getUser['fullname'];
			$user_name          		     = $getUser['user_name'];
			$password          		     = $getUser['user_password'];
			$role          		     = $getUser['role'];
			$role_type          		     = $getUser['role_type'];
			$dir_id          		     = $getUser['dir_id'];
			$ag_id          		     = $getUser['ag_id'];
			$staff_id          		     = $getUser['staff_id'];
			$company_id          		     = $getUser['company_id'];
			$branch_id          		     = $getUser['branch_id'];
			$agentforstaff          		     = $getUser['agentforstaff'];
			$line_id          		     = $getUser['line_id'];
			$group_id          		     = $getUser['group_id'];
			$mastermodule          		     = $getUser['mastermodule'];
			$company_creation          		     = $getUser['company_creation'];
			$branch_creation          		     = $getUser['branch_creation'];
			$loan_category          		     = $getUser['loan_category'];
			$loan_calculation          		     = $getUser['loan_calculation'];
			$loan_scheme          		     = $getUser['loan_scheme'];
			$area_creation          		     = $getUser['area_creation'];
			$area_mapping          		     = $getUser['area_mapping'];
			$area_status          		     = $getUser['area_approval'];
			$adminmodule          		     = $getUser['adminmodule'];
			$director_creation          		     = $getUser['director_creation'];
			$agent_creation          		     = $getUser['agent_creation'];
			$staff_creation          		     = $getUser['staff_creation'];
			$manage_user          		     = $getUser['manage_user'];
			$doc_mapping          		     = $getUser['doc_mapping'];
			$requestmodule          		     = $getUser['requestmodule'];
			$request          		     = $getUser['request'];
			$request_list_access          		     = $getUser['request_list_access'];
			$verificationmodule          		     = $getUser['verificationmodule'];
			$verification          		     = $getUser['verification'];
			$approvalmodule          		     = $getUser['approvalmodule'];
			$approval          		     = $getUser['approval'];
			$acknowledgementmodule          		     = $getUser['acknowledgementmodule'];
			$acknowledgement          		     = $getUser['acknowledgement'];
			$loanissuemodule          		     = $getUser['loanissuemodule'];
			$loan_issue          		     = $getUser['loan_issue'];
		}
	}
}
// print_r($getUser);

?>

<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham -  Manage User 
	</div>
</div><br>
<div class="text-right" style="margin-right: 25px;">
	
    <a href="edit_manage_user">
        <button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
    </a>
</div><br><br>
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id = "manage_user_form" name="manage_user_form" action="" method="post" enctype="multipart/form-data"> 
		<input type="hidden" class="form-control" value="<?php if(isset($idupd)) echo $idupd; ?>"  id="id" name="id" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($user_id)) echo $user_id; ?>"  id="user_id_upd" name="user_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($role)) echo $role; ?>"  id="role_upd" name="role_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($role_type)) echo $role_type; ?>"  id="role_type_upd" name="role_type_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($dir_id)) echo $dir_id; ?>"  id="dir_id_upd" name="dir_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($ag_id)) echo $ag_id; ?>"  id="ag_id_upd" name="ag_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($staff_id)) echo $staff_id; ?>"  id="staff_id_upd" name="staff_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($company_id)) echo $company_id; ?>"  id="company_id_upd" name="company_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($branch_id)) echo $branch_id; ?>"  id="branch_id_upd" name="branch_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($agentforstaff)) echo $agentforstaff; ?>"  id="agentforstaff_upd" name="agentforstaff_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($agent_id)) echo $agent_id; ?>"  id="agent_id_upd" name="agent_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($line_id)) echo $line_id; ?>"  id="line_id_upd" name="line_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($group_id)) echo $group_id; ?>"  id="group_id_upd" name="group_id_upd" aria-describedby="id" placeholder="Enter id">
		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">Add User</div>
					</div>
					<div class="card-body">
						<div class="row ">
							<!--Fields -->
							<div class="col-md-12 "> 
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Role</label>&nbsp;<span class="text-danger">*</span>
											<select tabindex="1" type="text" class="form-control" id="role" name="role"  >
												<option value="">Select role</option>   
												<option value="1" <?php if(isset($role)) if($role == '1') echo 'selected'; ?>>Director</option>   
												<option value="2" <?php if(isset($role)) if($role == '2') echo 'selected'; ?>>Agent</option>   
												<option value="3" <?php if(isset($role)) if($role == '3') echo 'selected'; ?>>Staff</option>   
											</select> 
											<span class="text-danger" style='display:none' id='roleCheck'>Please select Role</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group role_type" style="display:none">
                                            <label for="disabledInput">Role Type</label>&nbsp;<span class="text-danger">*</span>
                                            <select tabindex="2" type="text" class="form-control" id="role_type" name="role_type" >
												<option value="">Select Role Type</option>
											</select> 
											<span class="text-danger" style='display:none' id='roleTypeCheck'>Please select Role Type</span>
                                        </div>
                                        <div class="form-group agent" style="display:none">
                                            <label for="disabledInput">Agent Name</label>&nbsp;<span class="text-danger">*</span>
                                            <select tabindex="2" type="text" class="form-control" id="ag_name" name="ag_name" >
												<option value="">Select Agent Name</option>
												<?php if (sizeof($agentNameList)>0) { 
													for($j=0;$j<count($agentNameList);$j++) { ?>
														<option <?php if(isset($ag_id)) { if($agentNameList[$j]['ag_id'] == $ag_id )  echo 'selected'; }  ?> value="<?php echo $agentNameList[$j]['ag_id']; ?>">
														<?php echo $agentNameList[$j]['ag_name'];?></option>
												<?php }} ?> 
											</select> 
											<span class="text-danger" style='display:none' id='agnameCheck'>Please select Agent Name</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12" >
                                        <div class="form-group director" style="display:none">
                                            <label for="disabledInput">Director Name</label>&nbsp;<span class="text-danger">*</span>
                                            <select tabindex="3" type="text" class="form-control" id="dir_name" name="dir_name" >
												<option value="">Select Director Name</option>
											</select> 
											<span class="text-danger" style='display:none' id='dirnameCheck'>Please select Director Name</span>
                                        </div>
										<div class="form-group staff" style="display:none">
                                            <label for="disabledInput">Staff Name</label>&nbsp;<span class="text-danger">*</span>
                                            <select tabindex="3" type="text" class="form-control" id="staff_name" name="staff_name" >
												<option value="">Select Staff Name</option>
											</select> 
											<span class="text-danger" style='display:none' id='staffnameCheck'>Please select Staff Name</span>
                                        </div>
                                    </div>
									<br><br><br><br><br><br>
									<div class="col-md-12 userInfoTable" style='display:none'> 
										<div class="row">
											<div style=" width:100%; padding:12px; font-size: 17px; font-weight:bold; border-radius:5px;">User Details</div>
											<table id="userInfoTable" class="table custom-table">
												<thead>
													<tr>
														<th>ID</th>
														<th>Name</th>
														<th>Mail ID</th>
														
													</tr>
												</thead>
												
											</table>
										</div>
										<div class="row conditionalInfo" style='display:none'>
											<div style=" width:100%; padding:12px; font-size: 17px; font-weight:bold; border-radius:5px;">Conditional Info</div>
											<table id="conditionalInfo" class="table custom-table">
												<thead>
													<tr>
														<th>Loan Category</th>
														<th>Sub Category</th>
														<th>Scheme</th>
														<th>Loan Payment</th>
														<th>Responsible</th>
														<th>Collection Point</th>
													</tr>
												</thead>
												
											</table>
										</div>
										<div class="row occupationInfo" style='display:none'>
											<div style=" width:100%; padding:12px; font-size: 17px; font-weight:bold; border-radius:5px;">Occupation Info</div>
											<table id="occupationInfo" class="table custom-table">
												<thead>
													<tr>
														<th>Company Name</th>
														<th>Department</th>
														<th>Team</th>
														<th>Designation</th>
													</tr>
												</thead>
												
											</table>
										</div>
									</div>
									
									
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" class="form-control" id='full_name' name='full_name' >
				<input type="hidden" class="form-control" id='email' name='email' >
				<div class="card">
					<!-- <div class="card-header">
						<div class="card-title"></div>
					</div> -->
					<div class="card-body">
						<div class="row ">
							<!--Fields -->
							<div class="col-md-12 "> 
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">User ID</label>&nbsp;<span class="text-danger">*</span>
											<input type='text' class='form-control' id='user_id' name='user_id' placeholder="Enter User ID" tabindex='4' value='<?php if(isset($user_name)) echo $user_name; ?>'>
											<span class="text-danger" style='display:none' id='usernameCheck'>Please Enter UserID</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Password</label>&nbsp;<span class="text-danger">*</span>
											<input type='text' class='form-control' id='password' name='password' placeholder="Enter Password" tabindex='5' value='<?php if(isset($password)) echo $password; ?>'>
											<span class="text-danger" style='display:none' id='passCheck'>Please Enter Password</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Confirm Password</label>&nbsp;<span class="text-danger">*</span>
											<input type='text' class='form-control' id='cnf_password' name='cnf_password' placeholder="Confirm Password" tabindex='6' value='<?php if(isset($password)) echo $password; ?>'>
											<span class="text-danger" style='display:none' id='cnfpassCheck'>Please Enter Confirm Password</span><br>
                                            <span class="text-danger" style='display:none' id='passworkCheck'>Password not matching!</span>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<div class="card-title">Mapping Info</div>
					</div>
					<div class="card-body">
						<div class="row ">
							<!--Fields -->
							<div class="col-md-12 "> 
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Company Name</label>&nbsp;<span class="text-danger">*</span>
											<input type='hidden' class='form-control' id='company_id' name='company_id' >
											<input type='text' class='form-control' id='company_name' name='company_name' tabindex='7' readonly>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Branch Name</label>&nbsp;<span class="text-danger">*</span>
											<input type='hidden' class='form-control' id='branch_id' name='branch_id' value="<?php if(isset($branch_id)){echo $branch_id;}?>">
                                            <select tabindex="8" type="text" class="form-control" id="branch_id1" name="branch_id1" multiple>
												<option value="">Select Branch Name</option>
											</select> 
											<span class="text-danger" style='display:none' id='BranchCheck'>Please select Branch Name</span>
                                        </div>	
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 agent_div" style="display: none">
                                        <div class="form-group">
                                            <label for="disabledInput">Agent Name</label>
											<input type='hidden' class='form-control' id='agentforstaff' name='agentforstaff' value="<?php if(isset($agentforstaff)){echo $agentforstaff;}?>">
											<select  tabindex="9" type="text" class="form-control" id="agent1" name="agent1" multiple >
												<option value="">Select Agent Name</option>
											</select>
											<span class="text-danger" style='display:none' id='AgentCheck'>Please select Agent Name</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 line_div">
                                        <div class="form-group">
                                            <label for="disabledInput">Line Name</label>&nbsp;<span class="text-danger">*</span>
											<input type='hidden' class='form-control' id='line' name='line' >
											<select tabindex="9" type="text" class="form-control" id="line1" name="line1" multiple>
												<option value="">Select Line Name</option>
											</select>
											<span class="text-danger" style='display:none' id='lineCheck'>Please select Line Name</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Group Name</label>&nbsp;<span class="text-danger">*</span>
											<input type='hidden' class='form-control' id='group' name='group' >
											<select tabindex="10" type="text" class="form-control" id="group1" name="group1" multiple>
												<option value="">Select Group Name</option>
											</select>
											<span class="text-danger" style='display:none' id='groupCheck'>Please select Group Name</span>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>

                <div class="card">
					<div class="card-header">
						<div class="card-title">Screen Mapping</div>
					</div>
                    <br>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($mastermodule==0){ echo'checked'; }} ?> tabindex="11" class="" id="mastermodule" name="mastermodule" >&nbsp;&nbsp;
                        <label class="custom-control-label" for="mastermodule">
                            <h5>Master</h5>
                        </label>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($company_creation==0){ echo'checked'; }} ?> tabindex="12" class="master-checkbox" id="company_creation" name="company_creation" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="company_creation">Company Creation</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($branch_creation==0){echo'checked';}} ?> tabindex="13" class=" master-checkbox" id="branch_creation" name="branch_creation" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="branch_creation">Branch Creation</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($loan_category==0){ echo'checked'; }} ?> tabindex="14" class=" master-checkbox" id="loan_category" name="loan_category" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="loan_category">Loan Category</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($loan_calculation==0){ echo'checked'; }} ?> tabindex="15" class=" master-checkbox" id="loan_calculation" name="loan_calculation" disabled >&nbsp;&nbsp;
                                <label class="custom-control-label" for="loan_calculation">Loan Calculation</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($loan_scheme==0){ echo'checked'; }} ?> tabindex="16" class=" master-checkbox" id="loan_scheme" name="loan_scheme" disabled >&nbsp;&nbsp;
                                <label class="custom-control-label" for="loan_scheme">Loan Scheme</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($area_creation==0){ echo'checked'; }} ?> tabindex="17" class=" master-checkbox" id="area_creation" name="area_creation" disabled >&nbsp;&nbsp;
                                <label class="custom-control-label" for="area_creation">Area Creation</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($area_mapping==0){ echo'checked'; }} ?> tabindex="18" class=" master-checkbox" id="area_mapping" name="area_mapping" disabled >&nbsp;&nbsp;
                                <label class="custom-control-label" for="area_mapping">Area Mapping</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($area_status==0){ echo'checked'; }} ?> tabindex="19" class=" master-checkbox" id="area_status" name="area_status" disabled >&nbsp;&nbsp;
                                <label class="custom-control-label" for="area_status">Area Approval</label>
                            </div>
                        </div>
                    </div>
                    <!-- admin module end -->

                    <hr>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" value="Yes" <?php if($idupd > 0){ if($adminmodule==0){ echo'checked'; }} ?> tabindex="20" class="" id="adminmodule" name="adminmodule" >&nbsp;&nbsp;
						<label class="custom-control-label" for="adminmodule">
							<h5>Administration</h5>
						</label>
					</div>
					<br>
					<div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($director_creation==0){ echo'checked'; }} ?> tabindex="21" class=" admin-checkbox" id="director_creation" name="director_creation" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="director_creation">Director Creation</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($agent_creation==0){ echo'checked'; }} ?> tabindex="22" class=" admin-checkbox" id="agent_creation" name="agent_creation" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="agent_creation">Agent Creation</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($staff_creation==0){ echo'checked'; }} ?> tabindex="23" class=" admin-checkbox" id="staff_creation" name="staff_creation" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="staff_creation">Staff Creation</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($manage_user==0){ echo'checked'; }} ?> tabindex="24" class=" admin-checkbox" id="manage_user" name="manage_user" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="manage_user">Manage User</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($doc_mapping==0){ echo'checked'; }} ?> tabindex="24" class=" admin-checkbox" id="doc_mapping" name="doc_mapping" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="doc_mapping">Documentation Mapping</label>
                            </div>
                        </div>
					</div>

					<hr>

					<div class="custom-control custom-checkbox">
						<input type="checkbox" value="Yes" <?php if($idupd > 0){ if($requestmodule==0){ echo'checked'; }} ?> tabindex="20" class="" id="requestmodule" name="requestmodule" >&nbsp;&nbsp;
						<label class="custom-control-label" for="requestmodule">
							<h5>Request</h5>
						</label>
					</div>
					<br>
					<div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($request==0){ echo'checked'; }} ?> tabindex="21" class=" request-checkbox" id="request" name="request" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="request">Request</label>
                            </div>
                        </div>
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" value="Yes" <?php if($idupd > 0){ if($request_list_access==0){ echo'checked'; }} ?> tabindex="21" class=" request-checkbox" id="request_list_access" name="request_list_access" disabled>&nbsp;&nbsp;
								<label class="custom-control-label" for="request_list_access">All Request List Access</label>
							</div>
						</div>
					</div>
					
					<hr>

					<div class="custom-control custom-checkbox">
						<input type="checkbox" value="Yes" <?php if($idupd > 0){ if($verificationmodule==0){ echo'checked'; }} ?> tabindex="20" class="" id="verificationmodule" name="verificationmodule" >&nbsp;&nbsp;
						<label class="custom-control-label" for="verificationmodule">
							<h5>Verification</h5>
						</label>
					</div>
					<br>
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($verification==0){ echo'checked'; }} ?> tabindex="21" class="verification-checkbox" id="verification" name="verification" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="verification">Verification</label>
                            </div>
                        </div>
					</div>

					<hr>

					<div class="custom-control custom-checkbox">
						<input type="checkbox" value="Yes" <?php if($idupd > 0){ if($approvalmodule==0){ echo'checked'; }} ?> tabindex="20" class="" id="approvalmodule" name="approvalmodule" >&nbsp;&nbsp;
						<label class="custom-control-label" for="approvalmodule">
							<h5>Approval</h5>
						</label>
					</div>
					<br>
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($approval==0){ echo'checked'; }} ?> tabindex="21" class="approval-checkbox" id="approval" name="approval" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="approval">Approval</label>
                            </div>
                        </div>
					</div>

					<hr>

					<div class="custom-control custom-checkbox">
						<input type="checkbox" value="Yes" <?php if($idupd > 0){ if($acknowledgementmodule==0){ echo'checked'; }} ?> tabindex="20" class="" id="acknowledgementmodule" name="acknowledgementmodule" >&nbsp;&nbsp;
						<label class="custom-control-label" for="acknowledgementmodule">
							<h5>Acknowledgement</h5>
						</label>
					</div>
					<br>
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($acknowledgement==0){ echo'checked'; }} ?> tabindex="21" class="acknowledgement-checkbox" id="acknowledgement" name="acknowledgement" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="acknowledgement">Acknowledgement</label>
                            </div>
                        </div>
					</div>

					<hr>

					<div class="custom-control custom-checkbox">
						<input type="checkbox" value="Yes" <?php if($idupd > 0){ if($loanissuemodule==0){ echo'checked'; }} ?> tabindex="20" class="" id="loanissuemodule" name="loanissuemodule" >&nbsp;&nbsp;
						<label class="custom-control-label" for="loanissuemodule">
							<h5>Loan Issue</h5>
						</label>
					</div>
					<br>
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($loan_issue==0){ echo'checked'; }} ?> tabindex="21" class="loan_issue-checkbox" id="loan_issue" name="loan_issue" disabled>&nbsp;&nbsp;
                                <label class="custom-control-label" for="loan_issue">Loan Issue</label>
                            </div>
                        </div>
					</div>

					<br>
					<br>
                    <!-- Modules end -->
                </div>
				
				<div class="col-md-12 ">
					<div class="text-right">
						<button type="submit" name="submit_manage_user" id="submit_manage_user" class="btn btn-primary" value="Submit" tabindex="14"><span class="icon-check"></span>&nbsp;Submit</button>
						<button type="reset" class="btn btn-outline-secondary" tabindex="15" >Clear</button>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>



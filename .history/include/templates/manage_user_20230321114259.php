<?php 
@session_start();
if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}

$id=0;
$agentNameList = $userObj->getagentNameList($mysqli);

if(isset($_POST['submit_agent_creation']) && $_POST['submit_agent_creation'] != '')
{
    if(isset($_POST['id']) && $_POST['id'] >0 && is_numeric($_POST['id'])){		
        $id = $_POST['id']; 	
		$updateAgentCreation = $userObj->updateAgentCreation($mysqli,$id, $userid);  
    ?>
	<script>location.href='<?php echo $HOSTPATH;  ?>edit_agent_creation&msc=2';</script>
    <?php	}
    else{   
		$addAgentCreation = $userObj->addAgentCreation($mysqli, $userid);   
        ?>
    <script>location.href='<?php echo $HOSTPATH;  ?>edit_agent_creation&msc=1';</script>
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
	$deleteAgentCreation = $userObj->deleteAgentCreation($mysqli,$del, $userid); 
	//die;
	?>
	<script>location.href='<?php echo $HOSTPATH;  ?>edit_agent_creation&msc=3';</script>
<?php	
}

if(isset($_GET['upd']))
{
$idupd=$_GET['upd'];
}
$status =0;
if($idupd>0)
{
	$getAgentCreation = $userObj->getAgentCreation($mysqli,$idupd); 
	if (sizeof($getAgentCreation)>0) {
        for($i=0;$i<sizeof($getAgentCreation);$i++)  {			
			$ag_id                 	 = $getAgentCreation['ag_id'];
			$ag_code          		     = $getAgentCreation['ag_code'];
			$ag_name          		     = $getAgentCreation['ag_name'];
			$ag_group          		     = $getAgentCreation['ag_group'];
			$company_id          		     = $getAgentCreation['company_id'];
			$branch_id          		     = $getAgentCreation['branch_id'];
			$state       			 = $getAgentCreation['state'];
			$district                	 = $getAgentCreation['district'];
			$taluk       		    	 = $getAgentCreation['taluk'];
			$place     			     = $getAgentCreation['place'];
			$pincode        		     = $getAgentCreation['pincode'];
			$loan_category          		     = $getAgentCreation['loan_category'];
			$sub_category          		     = $getAgentCreation['sub_category'];
			$scheme          		     = $getAgentCreation['scheme'];
			$loan_payment          		     = $getAgentCreation['loan_payment'];
			$responsible          		     = $getAgentCreation['responsible'];
			$coll_point          		     = $getAgentCreation['collection_point'];
			$bank_name          		     = $getAgentCreation['bank_name'];
			$holder_name          		     = $getAgentCreation['holder_name'];
			$acc_no          		     = $getAgentCreation['acc_no'];
			$ifsc          		     = $getAgentCreation['ifsc'];
			$bank_branch_name          		     = $getAgentCreation['bank_branch_name'];
			$more_info          		     = $getAgentCreation['more_info'];
			$name          		     = $getAgentCreation['comm_name'];
			$designation          		     = $getAgentCreation['comm_designation'];
			$mobile          		     = $getAgentCreation['comm_mobile'];
			$whatsapp          		     = $getAgentCreation['comm_whatsapp'];
		}
	}
}

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
    <!-- <button type="button" class="btn btn-primary"><span class="icon-border_color"></span>&nbsp Edit Employee Master</button> -->
    </a>
</div><br><br>
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id = "manage_user" name="manage_user" action="" method="post" enctype="multipart/form-data"> 
		<input type="hidden" class="form-control" value="<?php if(isset($idupd)) echo $idupd; ?>"  id="id" name="id" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($ag_id)) echo $ag_id; ?>"  id="ag_id_upd" name="ag_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($company_id)) echo $company_id; ?>"  id="company_id_upd" name="company_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($branch_id)) echo $branch_id; ?>"  id="branch_id_upd" name="branch_id_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($ag_group)) echo $ag_group; ?>"  id="ag_group_upd" name="ag_group_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($scheme)) echo $scheme; ?>"  id="scheme_upd" name="scheme_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($state)) echo $state; ?>"  id="state_upd" name="state_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($district)) echo $district; ?>"  id="district_upd" name="district_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($taluk)) echo $taluk; ?>"  id="taluk_upd" name="taluk_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($loan_category)) echo $loan_category; ?>"  id="loan_category_upd" name="loan_category_upd" aria-describedby="id" placeholder="Enter id">
		<input type="hidden" class="form-control" value="<?php if(isset($sub_category)) echo $sub_category; ?>"  id="sub_category_upd" name="sub_category_upd" aria-describedby="id" placeholder="Enter id">
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
												<option value="1">Director</option>   
												<option value="2">Agent</option>   
												<option value="3">Staff</option>   
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
												MailMailMail												autoIDNameMail
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
				<input type="hidden" class="form-control" id='first_name' name='first_name' >
				<input type="hidden" class="form-control" id='last_name' name='last_name' >
				<input type="hidden" class="form-control" id='full_name' name='full_name' >
				<input type="hidden" class="form-control" id='title' name='title' >
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
											<input type='text' class='form-control' id='user_id' name='user_id' placeholder="Enter User ID" tabindex='4'>
											<span class="text-danger" style='display:none' id='usernameCheck'>Please Enter UserID</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Password</label>&nbsp;<span class="text-danger">*</span>
											<input type='password' class='form-control' id='password' name='password' placeholder="Enter Password" tabindex='5'>
											<span class="text-danger" style='display:none' id='passCheck'>Please Enter Password</span>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Confirm Password</label>&nbsp;<span class="text-danger">*</span>
											<input type='password' class='form-control' id='cnf_password' name='cnf_password' placeholder="Confirm Password" tabindex='6'>
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
                                            <select tabindex="8" type="text" class="form-control" id="branch_id" name="branch_id" multiple>
												<option value="">Select Branch Name</option>
											</select> 
											<span class="text-danger" style='display:none' id='BranchCheck'>Please select Branch Name</span>
                                        </div>	
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Line Name</label><!--&nbsp;<span class="text-danger">*</span>-->
											<select tabindex="9" type="text" class="form-control" id="line" name="line" multiple>
												<option value="">Select Line Name</option>
											</select>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Group Name</label><!--&nbsp;<span class="text-danger">*</span>-->
											<select tabindex="10" type="text" class="form-control" id="group" name="group" multiple>
												<option value="">Select Group Name</option>
											</select>
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
                                <input type="checkbox" value="Yes" <?php if($idupd > 0){ if($company_creation==0){ echo'checked'; }} ?> tabindex="12" class=" master-checkbox" id="company_creation" name="company_creation" disabled>&nbsp;&nbsp;
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



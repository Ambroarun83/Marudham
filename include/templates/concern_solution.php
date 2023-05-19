<?php
$idupd = 0;
if (isset($_GET['upd'])) {
    $idupd = $_GET['upd'];
}

$getConcernCreation = $userObj->getConcernCreation($mysqli, $idupd, $userid);
if (count($getConcernCreation) > 0) {
    $id             = $getConcernCreation['id'];
    $raisingFor     = $getConcernCreation['raising_for'];
    $selfName       = $getConcernCreation['self_name'];
    $selfCode       = $getConcernCreation['self_code'];
    $staffName      = $getConcernCreation['staff_name'];
    $staffDept      = $getConcernCreation['staff_dept_name'];
    $staffTeam      = $getConcernCreation['staff_team_name'];
    $agentName      = $getConcernCreation['ag_name'];
    $ag_grp         = $getConcernCreation['ag_grp'];
    $cus_id         = $getConcernCreation['cus_id'];
    $cus_name       = $getConcernCreation['cus_name'];
    $cus_area       = $getConcernCreation['cus_area'];
    $cus_sub_area   = $getConcernCreation['cus_sub_area'];
    $cus_grp        = $getConcernCreation['cus_group'];
    $cus_line       = $getConcernCreation['cus_line'];
    $conDate        = $getConcernCreation['com_date'];
    $conCode        = $getConcernCreation['com_code'];
    $branchName     = $getConcernCreation['branch_name'];
    $concernTo      = $getConcernCreation['concern_to'];
    $toDeptName     = $getConcernCreation['to_dept_name'];
    $toTeamName     = $getConcernCreation['to_team_name'];
    $conSub         = $getConcernCreation['com_sub'];
    $conRemark      = $getConcernCreation['com_remark'];
    $conPriority    = $getConcernCreation['com_priority'];
    $assignStaffName      = $getConcernCreation['staff_assign_to'];
}

// $getUserDetails = $userObj->getUserDetails($mysqli, $userid);
// // print_r($getUserDetails);
// if ($getUserDetails) {
//     // $branch_id = $getUserDetails['branch_id'];
//     $company_id = $getUserDetails['company_id'];
//     $user_name = $getUserDetails['fullname'];
//     $staff_code = $getUserDetails['staff_code'];
// }

//Getting Branch Name
// $branch_name ='';
// $branchqry = $mysqli->query("SELECT branch_name FROM branch_creation WHERE branch_id in($branch_id) ");
// while($row = $branchqry->fetch_assoc()){
//     $branch_name .= $row['branch_name'].', ';
// }

// $getconSubjectList = $userObj->getconSubject($mysqli);

if (isset($_POST['submit_concern_solution']) && $_POST['submit_concern_solution'] != '') {
    $addConcern = $userObj->addConcernsolution($mysqli, $userid);

?>
    <script>
       location.href = '<?php echo $HOSTPATH; ?>edit_concern_solution&msc=1';
    </script>
<?php
}
?>
<style>
    .img_show {
        height: 150px;
        width: 150px;
        border-radius: 50%;
        object-fit: cover;
        background-color: white;
    }
</style>

<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
        Marudham - Concern Solution
    </div>
</div><br>
<div class="text-right" style="margin-right: 25px;">
    <a href="edit_concern_solution">
        <button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
    </a>
</div><br><br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">

    <!-- Concern Creation form start-->
    <div id="concernDiv">
        <form id="concern_form" name="concern_form" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?php if (isset($idupd)) echo $idupd; ?>">
            <input type="hidden" name="staff_dept" id="staff_dept" value="<?php if (isset($staffDept)) echo $staffDept; ?>">
            <input type="hidden" name="staff_team" id="staff_team" value="<?php if (isset($staffTeam)) echo $staffTeam; ?>">
            <input type="hidden" name="con_sub" id="con_sub" value="<?php if (isset($conSub)) echo $conSub; ?>">
            <!-- Row start -->
            <div class="row gutters">
                <!-- Concern Creation Start -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">Concern Creation <span style="font-weight:bold" class=""></span></div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="Company">Company Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="user_company_name" name="user_company_name" readonly value='<?php if (isset($company_name)) echo $company_name; ?>' tabindex="1">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="branch_name">Branch Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="user_branch_name" name="user_branch_name" readonly value='<?php if (isset($branch_name)) echo $branch_name; ?>' tabindex='2'>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 " >
                                    <div class="form-group">
                                        <label for="user_name">User Name <span class="required">&nbsp;*</span></label>
                                        <input tabindex="3" type="text" class="form-control" id="user_name" name="user_name" value="<?php if (isset($user_name)) echo $user_name; ?>" readonly>
                                    </div>
                                </div> -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="raising">Raising For</label><span class="required">&nbsp;*</span>
                                        <select type="text" class="form-control" id="raising_for" name="raising_for" tabindex='4' disabled>
                                            <option value="">Select Raising For</option>
                                            <option value="1" <?php if (isset($raisingFor) and $raisingFor == '1') echo 'selected'; ?>>Myself</option>
                                            <option value="2" <?php if (isset($raisingFor) and $raisingFor == '2') echo 'selected'; ?>>staff</option>
                                            <option value="3" <?php if (isset($raisingFor) and $raisingFor == '3') echo 'selected'; ?>>Agent</option>
                                            <option value="4" <?php if (isset($raisingFor) and $raisingFor == '4') echo 'selected'; ?>>Customer</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='raisingForCheck'>Please Select Raising For</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="myself" <?php if (isset($raisingFor) and $raisingFor == '1'){ }else{ echo 'style="display: none;"'; } ?>> <!-- When Raising For is Myself Means Myself will show -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="name">Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="self_name" name="self_name" tabindex='5' value="<?php if (isset($selfName)) echo $selfName; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="code">Staff Code</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="self_code" name="self_code" tabindex='6' value="<?php if (isset($selfCode)) echo $selfCode; ?>" readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="staff" <?php if (isset($raisingFor) and $raisingFor == '2'){ }else{ echo 'style="display: none;"'; } ?>> <!-- When Raising For is staff Means staff will show -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="staff_name">Staff Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="staff_name" name="staff_name" tabindex='5' value="<?php if (isset($staffName)) echo $staffName; ?>" readonly>
                                        <span class="text-danger" style='display:none' id='staffnameCheck'>Please Enter Staff Name</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="deptname">Department Name </label> <span class="required">&nbsp;*</span>
                                        <select tabindex="6" type="text" class="form-control" id="staff_dept_name" name="staff_dept_name" disabled>
                                            <option value="">Select Department Name</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='staffdeptnameCheck'>Please Select Department</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="teamname">Team Name </label> <span class="required">&nbsp;*</span>
                                        <select tabindex="6" type="text" class="form-control" id="staff_team_name" name="staff_team_name" disabled>
                                            <option value="">Select Team Name</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='staffteamnameCheck'>Please Select Team</span>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="agent" <?php if (isset($raisingFor) and $raisingFor == '3'){ }else{ echo 'style="display: none;"'; } ?> > <!-- When Raising For is Agent Means Agent will show -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="ag-name">Agent Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="ag_name" name="ag_name" tabindex='5' value="<?php if (isset($agentName)) echo $agentName; ?>" readonly>
                                        <span class="text-danger" style='display:none' id='agentnameCheck'>Please Select Agent Name</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="ag-grp">Agent Group</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="ag_grp" name="ag_grp" tabindex='6' value="<?php if (isset($ag_grp)) echo $ag_grp; ?>" readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="customer" <?php if (isset($raisingFor) and $raisingFor == '4'){ }else{ echo 'style="display: none;"'; } ?> > <!-- When Raising For is customer Means customer will show -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="cus-id">Customer ID</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="cus_id" name="cus_id" data-type="adhaar-number" maxlength="14" tabindex='5' value="<?php if (isset($cus_id)) echo $cus_id; ?>" readonly>
                                        <span class="text-danger" style='display:none' id='cusIdCheck'>Please Enter Customer ID</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="cus_name">Customer Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="cus_name" name="cus_name" tabindex='6' value="<?php if (isset($cus_name)) echo $cus_name; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="area">Area</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="cus_area" name="cus_area" value="<?php if (isset($cus_area)) echo $cus_area; ?>" readonly tabindex='7'>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="subarea">Sub Area</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="cus_sub_area" name="cus_sub_area" value="<?php if (isset($cus_sub_area)) echo $cus_sub_area; ?>"  readonly tabindex='8'>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="group">Group</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="cus_group" name="cus_group"  value="<?php if (isset($cus_grp)) echo $cus_grp; ?>" readonly tabindex='9'>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="line">Line</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="cus_line" name="cus_line" value="<?php if (isset($cus_line)) echo $cus_line; ?>" readonly tabindex='10'>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Concern Creation End -->

                    <!-- Concern Assign START -->
                    <div class="card">
                        <div class="card-header">Concern Assign<span style="font-weight:bold" class=""></span></div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="comdate">Concern Date </label><span class="required">&nbsp;*</span>
                                        <input type="date" class="form-control" id="com_date" name="com_date" tabindex='11' value="<?php echo date('Y-m-d'); ?>" value="<?php if (isset($conDate)) echo $conDate; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="comcode">Concern Code</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="com_code" name="com_code" value="<?php if (isset($conCode)) echo $conCode; ?>" readonly tabindex='12' >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="branch">Branch Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="branch_name" name="branch_name" tabindex='13' value="<?php if (isset($branchName)) echo $branchName; ?>" readonly>
                                        <span class="text-danger" style='display:none' id='branchCheck'>Please Select Branch Name</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="to">Concern To</label><span class="required">&nbsp;*</span>
                                        <select type="text" class="form-control" id="concern_to" name="concern_to" tabindex='14' disabled>
                                            <option value=""> Select Concern To </option>
                                            <option value="1" <?php if (isset($concernTo) and $concernTo == '1') echo 'selected'; ?>> Department </option>
                                            <option value="2" <?php if (isset($concernTo) and $concernTo == '2') echo 'selected'; ?>> Team </option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='comtoCheck'>Please Select Concern To</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 dept" <?php if (isset($concernTo) and $concernTo == '1'){ }else{ echo 'style="display: none;"'; } ?> >
                                    <div class="form-group">
                                        <label for="toname">Department Name </label> <span class="required">&nbsp;*</span>
                                        <input tabindex="15" type="text" class="form-control" id="to_dept_name" name="to_dept_name" value="<?php if (isset($toDeptName)) echo $toDeptName; ?>" readonly>
                                        <span class="text-danger" style='display:none' id='todeptnameCheck'>Please Select Department Name</span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 team" <?php if (isset($concernTo) and $concernTo == '2'){ }else{ echo 'style="display: none;"'; } ?>>
                                    <div class="form-group">
                                        <label for="toname">Team Name </label> <span class="required">&nbsp;*</span>
                                        <input tabindex="15" type="text" class="form-control" id="to_team_name" name="to_team_name" value="<?php if (isset($toTeamName)) echo $toTeamName; ?>" readonly>
                                        <span class="text-danger" style='display:none' id='toteamnameCheck'>Please Select Team Name</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="comsub">Concern Subject</label><span class="required">&nbsp;*</span>
                                        <select type="text" class="form-control" id="com_sub" name="com_sub" tabindex='16' disabled>
                                            <option value=""> Select Concern Subject </option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='concernsubCheck'>Please Select Concern Subject</span>
                                    </div>
                                </div>

                                <!-- <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="add_complaint" name="add_complaint" data-toggle="modal" data-target=".addComplaint" style="padding: 5px 35px; margin-top: 20px;"><span class="icon-add"></span></button>
                                    </div>
                                </div> -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="comremark">Concern Remark</label><span class="required">&nbsp;*</span>
                                        <textarea class="form-control" id="com_remark" name="com_remark" tabindex='17' onkeydown="return /[a-z ]/i.test(event.key)" readonly><?php if (isset($conRemark)) echo $conRemark; ?></textarea>
                                        <span class="text-danger" style='display:none' id='comRemarkCheck'>Please Enter Concern Remark</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="com-priority">Concern Priority</label><span class="required">&nbsp;*</span>
                                        <select class="form-control" id="com_priority" name="com_priority" tabindex='18' disabled>
                                            <option value="">Select Concern Priority</option>
                                            <option value='1' <?php if (isset($conPriority) and $conPriority == '1') echo 'selected'; ?>>High</option>
                                            <option value='2' <?php if (isset($conPriority) and $conPriority == '2') echo 'selected'; ?>>Medium</option>
                                            <option value='3' <?php if (isset($conPriority) and $conPriority == '3') echo 'selected'; ?>>Low</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='conpriorityCheck'>Please Select Concern Priority</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="assign-to">Staff Assign To</label><span class="required">&nbsp;*</span>
                                        <input class="form-control" id="staff_assign_to" name="staff_assign_to" tabindex='19' value="<?php if (isset($assignStaffName)) echo $assignStaffName; ?>" readonly>
                                        <span class="text-danger" style='display:none' id='staffAssignCheck'>Please Select Staff Assign</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Concern Assign END -->

                    <!-- Consern Solution START-->
                    <div class="card">
						<div class="card-header"> Concern Solution <span style="font-weight:bold" class=""></span></div>
						<div class="card-body">
							<div class="row">

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="sol-date"> Solution Date </label> <span class="required">*</span>
										<input type="date" class="form-control" name="solution_date" id="solution_date" tabindex="23" value="<?php echo date('Y-m-d');?>" readonly>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="Communitcation"> Communication </label> <span class="required">*</span>
										<select type="text" class="form-control" name="Com_for_solution" id="Com_for_solution" tabindex="20">
											<option value=""> Select Communication </option>
											<option value="1"> Phone </option>
											<option value="2"> Direct </option>
										</select>
										<span class="text-danger" style='display:none' id='communicationCheck'>Please Select communication </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"  style="display: none;" id="solutionUploads">
									<div class="form-group">
										<label for="Communitcation"> Uploads </label>
										<input type="file" class="form-control" name="concern_upload[]" id="concern_upload" tabindex="21" multiple>
                                        <span class="text-danger" style='display:none' id='updCheck'>Please Upload </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="reamrk"> Solution Remark </label> <span class="required">*</span>
										<textarea type="text" class="form-control" name="solution_remark" id="solution_remark" tabindex="22"></textarea>
										<span class="text-danger" style='display:none' id='solutionRemarkCheck'>Please Enter Solution Remark </span>
									</div>
								</div>

							</div>

						</div>
					</div>
                    <!-- Consern Solution END-->


                    <div class="col-md-12 ">
                        <div class="text-right">
                            <button type="submit" name="submit_concern_solution" id="submit_concern_solution" class="btn btn-primary" value="Submit" tabindex="60"><span class="icon-check"></span>&nbsp;Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" tabindex="61">Clear</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- Concern Creation Form End -->

</div>

<!-- Concern To Modal Start -->
<div class="modal fade addComplaint" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Add Concern Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="DropDownCourse()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- alert messages -->
                <div id="categoryInsertNotOk" class="unsuccessalert">Subject Already Exists, Please Enter a Different Name!
                    <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>

                <div id="categoryInsertOk" class="successalert">Concern Subject Added Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>

                <div id="categoryUpdateOk" class="successalert">Concern Subject Updated Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>

                <div id="categoryDeleteNotOk" class="unsuccessalert">You Don't Have Rights To Delete This Category!
                    <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>

                <div id="categoryDeleteOk" class="successalert">Concern Subject Has been Inactivated!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>

                <br />
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12"></div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="form-group">
                            <label class="label">Concern Subject</label>
                            <input type="hidden" name="con_sub_id" id="con_sub_id">
                            <input type="text" name="com_sub_add" id="com_sub_add" class="form-control" placeholder="Enter Concern Subject">
                            <span class="text-danger" style='display:none' id='comsubCheck'>Please Enter Concern Subject</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
                        <label class="label" style="visibility: hidden;">Submit</label>
                        <button type="button" name="submitConSub" id="submitConSub" class="btn btn-primary">Submit</button>
                    </div>
                </div>

                <div id="updatedconSubTable">
                    <table class="table custom-table" id="coursecategoryTable">
                        <thead>
                            <tr>
                                <th width="15px">S. No</th>
                                <th>SUBJECT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <?php if (sizeof($getconSubjectList) > 0) {
                                        for ($j = 0; $j < count($getconSubjectList); $j++) { ?>
                                <tr>
                                    <td class="col-md-2 col-xl-2"></td>
                                    <td><?php echo $getconSubjectList[$j]['concern_subject']; ?></td>
                                    <td>
                                        <a id="edit_subject" value="<?php echo $getconSubjectList[$j]['concern_sub_id'] ?>"><span class="icon-border_color"></span></a> &nbsp
                                        <a id="delete_subject" value="<?php echo $getconSubjectList[$j]['concern_sub_id'] ?>"><span class='icon-trash-2'></span></a>
                                    </td>
                                </tr>
                            <?php }
                                    } ?> -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="DropDownCourse()">Close</button>
            </div>

        </div>
    </div>
</div>
<!--  Concern To Modal END-->
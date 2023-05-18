<?php 

$getUserDetails = $userObj->getUserDetails($mysqli,$userid);
// print_r($getUserDetails);
if($getUserDetails){
    $branch_id = $getUserDetails['branch_id'];
    $company_name = $getUserDetails['company_name'];
    $user_name = $getUserDetails['fullname'];
}

//Getting Branch Name
$branch_name ='';
$branchqry = $mysqli->query("SELECT branch_name FROM branch_creation WHERE branch_id in($branch_id) ");
while($row = $branchqry->fetch_assoc()){
    $branch_name .= $row['branch_name'].', ';
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
        Marudham - Concern Creation
    </div>
</div><br>
<div class="text-right" style="margin-right: 25px;">
    <a href="edit_concern_creation" >
        <button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
    </a>
</div><br><br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">

    <!-- Concern Creation form start-->
    <div id="considerDiv">
        <form id="consider_form" name="consider_form" action="" method="post" enctype="multipart/form-data">

            <!-- Row start -->
            <div class="row gutters">
                <!-- Concern Creation Start -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">Concern Creation <span style="font-weight:bold" class=""></span></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="Company">Company Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="user_company_name" name="company_name" readonly value='<?php  if(isset($company_name)) echo $company_name; ?>' tabindex="1">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="branch_name">Branch Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="user_branch_name" name="branch_name" readonly value='<?php if(isset($branch_name)) echo $branch_name; ?>' tabindex='2'>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 " >
                                    <div class="form-group">
                                        <label for="user_name">User Name <span class="required">&nbsp;*</span></label>
                                        <input tabindex="3" type="text" class="form-control" id="user_name" name="user_name" value="<?php  if(isset($user_name)) echo $user_name; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="remark">Raising For</label><span class="required">&nbsp;*</span>
                                        <select type="text" class="form-control" id="raising_for" name="raising_for" tabindex='4' > 
                                            <option value="">Select Raising For</option>
                                            <option value="1">Myself</option>
                                            <option value="2">staff</option>
                                            <option value="3">Agent</option>
                                            <option value="4">Customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="myself" style="display: none;"> <!-- When Raising For is Myself Means Myself will show -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="staff_name">Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="self_name" name="self_name" tabindex='5' readonly>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="staff_id">ID</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="self_id" name="self_id" tabindex='6' readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="staff" style="display: none;"> <!-- When Raising For is staff Means staff will show -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="staff_name">Staff Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="staff_name" name="staff_name" tabindex='5' >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="staff_id">Staff ID</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="staff_id" name="staff_id" tabindex='6' >
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="agent" style="display: none;"> <!-- When Raising For is Agent Means Agent will show -->

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="staff_name">Agent Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="ag_name" name="ag_name" tabindex='5' >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="staff_id">ID</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="ag_id" name="ag_id" tabindex='6' >
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="customer" style="display: none;"> <!-- When Raising For is customer Means customer will show -->

                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="cus_id">Customer ID</label><span class="required">&nbsp;*</span>
                                            <input type="text" class="form-control" id="cus_id" name="cus_id"  tabindex='5'>
                                        </div>
                                    </div>
                                    
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
                                    <div class="form-group">
                                        <label for="cus_name">Customer Name</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="cus_name" name="cus_name" tabindex='6' readonly>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="area">Area</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="area" name="cus_area" readonly  tabindex='7'>
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="subarea">Sub Area</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="sub_area" name="cus_sub_area" readonly  tabindex='8'>
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="group">Group</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="group" name="cus_group" readonly  tabindex='9'>
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="line">Line</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="line" name="cus_line" readonly  tabindex='10'>
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
                                        <label for="comdate">Complaint Date </label><span class="required">&nbsp;*</span>
                                        <input type="date" class="form-control" id="com_date" name="com_date" tabindex='11' value="<?php echo date('Y-m-d'); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="comcode">Complaint Code</label><span class="required">&nbsp;*</span>
                                        <input type="text" class="form-control" id="com_code" name="com_code" readonly tabindex='12'>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="branch">Branch Name</label><span class="required">&nbsp;*</span>
                                        <select type="text" class="form-control" id="branch_name" name="branch_name" tabindex='13'> 
                                            <option> Select Branch Name </option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='branchCheck'>Please Select Branch Name</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="to">To</label><span class="required">&nbsp;*</span>
                                        <select type="text" class="form-control" id="complaint_to" name="complaint_to" tabindex='14'> 
                                            <option> Select To </option>
                                            <option value="1"> Department </option>
                                            <option value="2"> Staff </option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='comtoCheck'>Please Select To</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="toname">Department Name </label> <span class="required">&nbsp;*</span>
                                        <select tabindex="15" type="text" class="form-control" id="to_dept_name" name="to_dept_name">
                                            <option value="">Select Department Name</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='todeptnameCheck'>Please Select Name</span>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="toname">Team Name </label> <span class="required">&nbsp;*</span>
                                        <select tabindex="15" type="text" class="form-control" id="to_team_name" name="to_team_name">
                                            <option value="">Select Team Name</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='toteamnameCheck'>Please Select Name</span>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                    <div class="form-group">
                                        <label for="comsub">Complaint Subject</label><span class="required">&nbsp;*</span>
                                        <select type="text" class="form-control" id="com_sub" name="com_sub" tabindex='16'> 
                                            <option value=""> Select Complaint Subject </option>
                                            <option value="1"> Work Based </option>
                                            <option value="2"> Behaviour Based </option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='comRemarkCheck'>Please Enter Complaint Remark</span>
                                    </div>
                                </div>

                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="add_complaint" name="add_complaint" data-toggle="modal" data-target=".addComplaint" style="padding: 5px 35px; margin-top: 20px;"><span class="icon-add"></span></button>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="com_remark">Complaint Remark</label><span class="required">&nbsp;*</span>
                                        <textarea class="form-control" id="com_remark" name="com_remark" tabindex='17'></textarea>
                                        <span class="text-danger" style='display:none' id='comRemarkCheck'>Please Enter Complaint Remark</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="com_remark">Complaint Priority</label><span class="required">&nbsp;*</span>
                                        <select class="form-control" id="com_priority" name="com_priority" tabindex='18'>
                                            <option>Select Complaint Priority</option>
                                            <option>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='comRemarkCheck'>Please Select Complaint Priority</span>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="form-group">
                                        <label for="com_remark">Staff Assign To</label><span class="required">&nbsp;*</span>
                                        <select class="form-control" id="com_priority" name="com_priority" tabindex='19'>
                                            <option>Select Staff Assign To</option>
                                        </select>
                                        <span class="text-danger" style='display:none' id='staffAssignCheck'>Please Select Staff Assign</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Concern Assign END -->            


                    <div class="col-md-12 ">
                        <div class="text-right">
                            <button type="submit" name="submit_verification" id="submit_verification" class="btn btn-primary" value="Submit" tabindex="60"><span class="icon-check"></span>&nbsp;Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" tabindex="61">Clear</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- Concern Creation Form End -->

</div>

<!-- Complaint To Modal Start -->
<div class="modal fade addComplaint" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Concern Assign</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeFamModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="FamInsertNotOk" class="unsuccessalert"> Name Already Exists, Please Enter a Different Name!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="FamInsertOk" class="successalert">Family Info Added Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="famUpdateok" class="successalert">Family Info Updated Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="NotOk" class="unsuccessalert">Please Retry!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="FamDeleteNotOk" class="unsuccessalert"> Please Retry to Delete Family Info!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="FamDeleteOk" class="unsuccessalert"> Family Info Has been Deleted!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="comsub">Complaint Subject</label><span class="required">&nbsp;*</span>
                        <select type="text" class="form-control" id="com_sub" name="com_sub" tabindex='16'> 
                            <option value=""> Select Complaint Subject </option>
                        </select>
                        <span class="text-danger" style='display:none' id='comsubCheck'>Please Enter Complaint Subject</span>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
                    <input type="hidden" name="famID" id="famID">
                    <button type="button" tabindex="2" name="comSubBtn" id="comSubBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
                </div>

				</div>
				</br>

				<div id="updatedComTable">
					<table class="table custom-table">
						<thead>
							<tr>
								<th width="25%">S.No</th>
								<th>Name</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeFamModal()">Close</button>
			</div>
		</div>
	</div>
</div>
<!--  Complaint To Modal END-->
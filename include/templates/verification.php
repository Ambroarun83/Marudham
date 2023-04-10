<?php

if (isset($_GET['upd'])) {
	echo  $idupd = $_GET['upd'];
}
if (isset($_POST['submit_verification']) && $_POST['submit_verification'] != '') {

	$addVerification = $userObj->addVerification($mysqli, $userid);
?>
	<script>
		location.href = '<?php echo $HOSTPATH;  ?>verification_list&msc=1';
	</script>
<?php
}
$del=0;
if(isset($_GET['del']))
{
$del=$_GET['del'];
}
if($del>0)
{
	$deleteVerification = $userObj->deleteVerification($mysqli,$del, $userid); 
	?>
	<script>location.href='<?php echo $HOSTPATH;  ?>verification_list&msc=3';</script>
<?php	
}
$can=0;
if(isset($_GET['can']))
{
$can=$_GET['can'];
}
if($can>0)
{
	$cancelVerification = $userObj->cancelVerification($mysqli,$can, $userid);
	?>
	<script>location.href='<?php echo $HOSTPATH;  ?>verification_list&msc=4';</script>
<?php	
}
$rev=0;
if(isset($_GET['rev']))
{
$rev=$_GET['rev'];
}
if($rev>0)
{
	$revokeVerification = $userObj->revokeVerification($mysqli,$rev, $userid);
	?>
	<script>location.href='<?php echo $HOSTPATH;  ?>verification_list&msc=8';</script>
<?php	
}
$getRequestData = $userObj->getRequestForVerification($mysqli, $idupd);


if (sizeof($getRequestData) > 0) {
	for ($i = 0; $i < sizeof($getRequestData); $i++) {
		$req_id						= $getRequestData['req_id'];
		$user_type					= $getRequestData['user_type'];
		if ($user_type == 'Director') {
			$role = '1';
		} else
			if ($user_type == 'Agent') {
			$role = '2';
		} else
			if ($user_type == 'Staff') {
			$role = '3';
		}
		$user_name					= $getRequestData['user_name'];
		$agent_id					= $getRequestData['agent_id'];
		$responsible					= $getRequestData['responsible'];
		$remarks					= $getRequestData['remarks'];
		$declaration					= $getRequestData['declaration'];
		$req_code					= $getRequestData['req_code'];
		$dor					= $getRequestData['dor'];
		$cus_id					= $getRequestData['cus_id'];
		$cus_data					= $getRequestData['cus_data'];
		$cus_name					= $getRequestData['cus_name'];
		$dob					= $getRequestData['dob'];
		$age					= $getRequestData['age'];
		$gender					= $getRequestData['gender'];
		$state					= $getRequestData['state'];
		$district					= $getRequestData['district'];
		$taluk					= $getRequestData['taluk'];
		$area					= $getRequestData['area'];
		$sub_area					= $getRequestData['sub_area'];
		$address					= $getRequestData['address'];
		$mobile1					= $getRequestData['mobile1'];
		$mobile2					= $getRequestData['mobile2'];
		$father_name					= $getRequestData['father_name'];
		$mother_name					= $getRequestData['mother_name'];
		$marital					= $getRequestData['marital'];
		$spouse_name					= $getRequestData['spouse_name'];
		$occupation_type					= $getRequestData['occupation_type'];
		$occupation					= $getRequestData['occupation'];
		$pic					= $getRequestData['pic'];
		$loan_category					= $getRequestData['loan_category'];
		$sub_category					= $getRequestData['sub_category'];
		$tot_value					= $getRequestData['tot_value'];
		$ad_amt					= $getRequestData['ad_amt'];
		$ad_perc					= $getRequestData['ad_perc'];
		$loan_amt					= $getRequestData['loan_amt'];
		$poss_type					= $getRequestData['poss_type'];
		$due_amt					= $getRequestData['due_amt'];
		$due_period					= $getRequestData['due_period'];
		$cus_status					= $getRequestData['cus_status'];
	}
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
		Marudham - Verification - Customer Profile
	</div>
</div><br>
<div class="page-header sticky-top" id="navbar" style="display: none;" data-toggle="toggle">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px; margin-top:50px;">
		Customer Name - <?php if (isset($cus_name)) {
							echo $cus_name;
						} ?>
	</div>
</div><br>
<div class="text-right" style="margin-right: 25px;">
	<a href="verification_list">
		<button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
		<!-- <button type="button" class="btn btn-primary"><span class="icon-border_color"></span>&nbsp Edit Employee Master</button> -->
	</a>
</div><br><br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id="request" name="request" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="req_id" id="req_id" value="<?php if (isset($req_id)) {echo $req_id;} ?>">
		<input type="hidden" name="loan_amt" id="loan_amt" value="<?php if (isset($tot_value)) {echo $tot_value;} ?>">
		<!-- Row start -->
		<div class="row gutters">
			<!-- Request Info -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-header">Request Info</div>
					<div class="card-body">
						<div class="row">
							<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="user_type">User type</label><span class="required">&nbsp;*</span>
									<input type="text" class="form-control" id="user_type" name="user_type" readonly value='<?php if (isset($user_type)) echo $user_type; ?>' tabindex="1">
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="user">User Name</label><span class="required">&nbsp;*</span>
									<input type="text" class="form-control" id="user" name="user" readonly value='<?php if (isset($user_name)) echo $user_name; ?>' tabindex='2'>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 responsible" <?php if (isset($role)) {
																									if ($role != '1') { ?> style="display: none" <?php }
																																			} ?>>
								<div class="form-group">
									<label for="responsible">Responsible&nbsp;<span class="required">&nbsp;*</span></label>
									<input tabindex="4" type="text" class="form-control" id="responsible" name="responsible" value="<?php if (isset($responsible) and $responsible == '0') {
																																		echo 'Yes';
																																	} else {
																																		echo 'No';
																																	} ?>" readonly>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 remarks" <?php if (isset($role)) {
																								if ($role != '3') { ?>style="display: none" <?php }
																																	} ?>>
								<div class="form-group">
									<label for="remark">Remarks</label><span class="required">&nbsp;*</span>
									<input type="text" class="form-control" id="remarks" name="remarks" value='<?php if (isset($remarks)) echo $remarks; ?>' tabindex='5' placeholder="Enter Remarks" pattern="[a-zA-Z\s]+" readonly>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 declaration" <?php if (isset($role)) {
																									if ($role == '3') { ?>style="display: none" <?php }
																																		} ?>>
								<div class="form-group">
									<label for="declaration">Declaration</label><span class="required">&nbsp;*</span>
									<input type="text" class="form-control" id="declaration" name="declaration" value='<?php if (isset($declaration)) echo $declaration; ?>' tabindex='4' placeholder="Enter Declaration" pattern="[a-zA-Z\s]+" readonly>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="req_code">Request ID</label><span class="required">&nbsp;*</span>
									<input type="text" class="form-control" id="req_code" name="req_code" readonly value='<?php if (isset($req_code)) echo $req_code; ?>' tabindex='7'>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="dor">Date Of request</label><span class="required">&nbsp;*</span>
									<input type="text" class="form-control" id="dor" name="dor" readonly value='<?php if (isset($dor)) {
																													echo $dor;
																												} else {
																													echo date('Y-m-d');
																												} ?>' tabindex='8'>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Personal info START -->
				<div class="card">
					<div class="card-header">Personal Info</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="cus_id">Customer ID</label><span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="cus_id" name="cus_id" tabindex='9' data-type="adhaar-number" maxlength="14" placeholder="Enter Adhaar Number" value='<?php if (isset($cus_id)) {echo $cus_id;} ?>'>
											<span class="text-danger" style='display:none' id='cusidCheck'>Please Enter Customer ID</span>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="cus_name">Customer Name</label><span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="cus_name" name="cus_name" tabindex='10' placeholder="Enter Customer Name" onkeydown="return /[a-z ]/i.test(event.key)" value='<?php if (isset($cus_name)) {echo $cus_name;} ?>'>
											<span class="text-danger" style='display:none' id='cusnameCheck'>Please Enter Customer Name</span>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="gender">Gender&nbsp;<span class="required">&nbsp;*</span></label>
											<select tabindex="14" type="text" class="form-control" id="gender" name="gender">
												<option value="">Select Gender</option>
												<option value="1" <?php if (isset($gender) and $gender == '1') echo 'selected'; ?>>Male</option>
												<option value="2" <?php if (isset($gender) and $gender == '2') echo 'selected'; ?>>Female</option>
												<option value="3" <?php if (isset($gender) and $gender == '3') echo 'selected'; ?>>Other</option>
											</select>
											<span class="text-danger" style='display:none' id='genderCheck'>Please Select Gender</span>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="dob">Date of Birth</label><span class="required">&nbsp;*</span>
											<input type="date" class="form-control" id="dob" name="dob" tabindex='12' value='<?php if (isset($dob)) {
																																	echo $dob;
																																} ?>'>
											<span class="text-danger" style='display:none' id='dobCheck'>Please Select DOB</span>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="age">Age</label>
											<input type="text" class="form-control" id="age" name="age" readonly tabindex='13' placeholder="Select Date of Birth" value='<?php if (isset($age)) {
																																												echo $age;
																																											} ?>'>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="BloodGroup">Blood Group&nbsp;<span class="required">&nbsp;*</span></label>
											<input type="text" class="form-control" id="bloodGroup" name="bloodGroup" tabindex='14' placeholder="Enter Blood Group">
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="mobile1">Mobile No 1</label><span class="required">&nbsp;*</span>
											<input type="number" class="form-control" id="mobile1" name="mobile1" tabindex='15' placeholder="Enter Mobile Number" maxlength="10" onkeypress="if(this.value.length==10) return false;" value='<?php if (isset($mobile1)) {
																																																													echo $mobile1;
																																																												} ?>'>
											<span class="text-danger" style='display:none' id='mobile1Check'>Please Enter Mobile Number</span>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="mobile2">Mobile No 2</label>
											<input type="number" class="form-control" id="mobile2" name="mobile2" tabindex='16' placeholder="Enter Mobile Number" maxlength="10" onKeypress="if(this.value.length==10) return false;" value='<?php if (isset($mobile2)) {
																																																													echo $mobile2;
																																																												} ?>'>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="whatsapp">Whatsapp No </label>
											<input type="number" class="form-control" id="whatsapp_no" name="whatsapp_no" tabindex='17' placeholder="Enter WhatsApp Number" maxlength="10" onkeypress="if(this.value.length==10) return false;">
										</div>
									</div>

								</div>
							</div>

							<div class="col-md-4">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="form-group" style="margin-left: 30px;">
										<label for="pic" style="margin-left: -20px;">Photo</label><span class="required">&nbsp;*</span><br>
										<input type="hidden" name="cus_image" id="cus_image" value="<?php if (isset($pic)) {
																										echo $pic;
																									} ?>">
										<img id='imgshow' class="img_show" src='img/avatar.png' />
										<input type="file" class="form-control" id="pic" name="pic" tabindex='18' value='<?php if (isset($pic)) {
																																echo $pic;
																															} ?>'>
										<span class="text-danger" style='display:none' id='picCheck'>Please Choose Image</span>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Personal info END -->

				<!-- Family info START -->
				<div class="card">
					<div class="card-header">Family Info
						<button type="button" class="btn btn-primary" id="add_group" name="add_group" data-toggle="modal" data-target=".addGroup" style="padding: 5px 35px; float: right;"><span class="icon-add"></span></button>
					</div>
					<span class="text-danger" style='display:none' id='family_infoCheck'>Please Fill Family Info </span>
					<div class="card-body">

						<div class="row">

							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group" id="famList">
									<table class="table custom-table">
										<thead>
											<tr>
												<th>S.No</th>
												<th>Name</th>
												<th>Relationship</th>
												<th>Age</th>
												<th>Aadhar No</th>
												<th>Mobile No</th>
												<th>Occupation</th>
												<th>Income</th>
												<th>Blood Group</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- Family info END -->

				<!-- Guarentor info START -->
				<div class="card">
					<div class="card-header">Guarentor Info</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="GuarentorName"> Guarentor Name </label><span class="required">&nbsp;*</span>
											<select type="text" class="form-control" id="guarentor_name" name="guarentor_name">
												<option> Select Guarantor </option>
											</select>
											<span class="text-danger" style='display:none' id='guarentor_nameCheck'>Please Choose Guarentor Name</span>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="GuarentorRelationship"> Guarentor Relationship </label>
											<input type="text" class="form-control" id="guarentor_relationship" name="guarentor_relationship" readonly>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="form-group" style="margin-left: 30px;">
										<label for="pic" style="margin-left: -20px;"> Guarentor Photo </label><span class="required">&nbsp;*</span><br>
										<img id='imgshows' class="img_show" src='img/avatar.png' />
										<input type="file" class="form-control" id="guarentorpic" name="guarentorpic" value=''>
										<span class="text-danger" style='display:none' id='guarentorpicCheck'>Please Choose Guarentor Image</span>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Guarentor END -->

				<!-- Group Info START -->
				<div class="card">
					<div class="card-header"> Group Info
						<button type="button" class="btn btn-primary" id="group_details_add" name="group_details_add" data-toggle="modal" data-target=".addGroupDetails" style="padding: 5px 35px; float: right; "><span class="icon-add"></span></button>
					</div>
					<span class="text-danger" style='display:none' id='group_infoCheck'>Please Fill Group Info </span>
					<div class="card-body">
						<div class="row">

							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group" id="GroupList">
									<table class="table custom-table modalTable">
										<thead>
											<tr>
												<th>S.No</th>
												<th>Name</th>
												<th>Age</th>
												<th>Aadhar No</th>
												<th>Mobile No</th>
												<th>Gender</th>
												<th>Designation</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- Group Info END -->

				<!-- Data Checking START -->
				<div class="card">
					<div class="card-header"> Data Checking </div>
					<div class="card-body">
						<div class="row">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="cus_name"> Category </label>
									<select type="text" class="form-control" id="category" name="category">
										<option> Select Category </option>
										<option value="0"> Name </option>
										<option value="1"> Aadhar Number </option>
										<option value="2"> Mobile Number </option>
									</select>
								</div>
							</div>

							<div id="nameCheck" style="display: none" class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="name"> Name </label>
									<select type="text" class="form-control" name="check_name" id="check_name">
										<option> Select Name </option>
									</select>
								</div>
							</div>

							<div id="aadharNo" style="display: none" class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="aadharNo"> Aadhar Number </label>
									<select type="text" class="form-control" name="check_aadhar" id="check_aadhar">
										<option> Select Aadhar Number </option>
									</select>
								</div>
							</div>

							<div id="mobileNo" style="display: none" class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="mobileNo"> Mobile Number </label>
									<select type="text" class="form-control" name="check_mobileno" id="check_mobileno">
										<option> Select Mobile Number </option>
									</select>
								</div>
							</div>

						</div>
						<div id="cus_check"></div></br>
						<div id="fam_check"></div></br>
						<div id="group_check"></div>
					</div>
				</div>
				<!-- Data Checking END -->

				<!-- Customer Data START -->
				<div class="card">
					<div class="card-header"> Customer Data </div>
					<div class="card-body">
						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="name"> Customer Type </label>
									<input type="text" class="form-control" name="cus_type" id="cus_type" value="<?php if (isset($cus_data)) {
																														echo $cus_data;
																													} ?>" readonly>
								</div>
							</div>

							<div id="exist_type" <?php if (isset($cus_data)) {
														if ($cus_data != 'Existing') { ?> style="display: none" <?php }
																										} ?> class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
								<div class="form-group">
									<label for="ExistType"> Exist Type </label>
									<input type="text" class="form-control" name="cus_exist_type" id="cus_exist_type" readonly>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Customer Data END -->

				<!-- Residential  Info START -->
				<div class="card">
					<div class="card-header"> Residential Info </div>
					<span class="text-danger" style='display:none' id='res_infoCheck'>Please Fill Residential Info </span>
					<div class="card-body">
						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="resType"> Residential Type </label>
									<select type="text" class="form-control" name="cus_res_type" id="cus_res_type">
										<option> Select Residential Type </option>
										<option value="0"> Own </option>
										<option value="1"> Rental </option>
										<option value="2"> Lease </option>
										<option value="3"> Quarters </option>
									</select>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="ResidentDetails"> Resident Details </label>
									<input type="text" class="form-control" name="cus_res_details" id="cus_res_details" placeholder="Enter Resident Details">
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="resAddress"> Address </label>
									<input type="text" class="form-control" name="cus_res_address" id="cus_res_address" placeholder="Enter Address">
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="resnativeAddress"> Native Address </label>
									<input type="text" class="form-control" name="cus_res_native" id="cus_res_native" placeholder="Enter Native Address">
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Residential  Info END -->

				<!-- Occupation info START -->
				<div class="card">
					<div class="card-header"> Occupation info </div>
					<span class="text-danger" style='display:none' id='occ_infoCheck'>Please Fill Occupation Info </span>
					<div class="card-body">
						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="occType"> Occupation Type </label>
									<select type="text" class="form-control" name="cus_occ_type" id="cus_occ_type">
										<option value="">Select Occupation Type</option>
										<option value="1">Govt Job</option>
										<option value="2">Pvt Job</option>
										<option value="3">Business</option>
										<option value="4">Self Employed</option>
										<option value="5">Daily wages</option>
										<option value="6">Agriculture</option>
										<option value="7">Others</option>
									</select>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="occDetails"> Occupation Detail </label>
									<input type="text" class="form-control" name="cus_occ_detail" id="cus_occ_detail" placeholder="Enter Occupation Detail" onkeydown="return /[a-z ]/i.test(event.key)">
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="occIncome"> Income </label>
									<input type="number" class="form-control" name="cus_occ_income" id="cus_occ_income" placeholder="Enter Income">
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="occAddress"> Address </label>
									<input type="text" class="form-control" name="cus_occ_address" id="cus_occ_address" placeholder="Enter Address">
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Occupation info END -->

				<!-- Area Confirm START -->
				<div class="card">
					<div class="card-header"> Area Confirm </div>
					<div class="card-body">
						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="areaCnfirm"> Area confirm </label><span class="required">&nbsp;*</span>
									<select type="text" class="form-control" name="area_cnfrm" id="area_cnfrm">
										<option value="">Select Area Type</option>
										<option value="0"> Residential Area </option>
										<option value="1"> Occupation Area </option>
									</select>
									<span class="text-danger" style='display:none' id='areacnfrmCheck'>Please Select Confirm Area</span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
								<div class="form-group">
									<label for="disabledInput">State</label>&nbsp;<span class="text-danger">*</span>
									<select type="text" class="form-control" id="state" name="state" tabindex="16">
										<option value="SelectState">Select State</option>
										<option value="TamilNadu">Tamil Nadu</option>
										<option value="Puducherry">Puducherry</option>
									</select>
									<span class="text-danger" style='display:none' id='stateCheck'>Please Select State</span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="disabledInput">District</label>&nbsp;<span class="text-danger">*</span>
									<input type="hidden" class="form-control" id="district1" name="district1">
									<select type="text" class="form-control" id="district" name="district" tabindex='17'>
										<option value="Select District">Select District</option>
									</select>
									<span class="text-danger" style='display:none' id='districtCheck'>Please Select District</span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="disabledInput">Taluk</label>&nbsp;<span class="text-danger">*</span>
									<input type="hidden" class="form-control" id="taluk1" name="taluk1">
									<select type="text" class="form-control" id="taluk" name="taluk" tabindex="18">
										<option value="Select Taluk">Select Taluk</option>
									</select>
									<span class="text-danger" style='display:none' id='talukCheck'>Please Select Taluk</span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="disabledInput">Area</label>&nbsp;<span class="text-danger">*</span>
									<select tabindex="19" type="text" class="form-control" id="area" name="area">
										<option value="">Select Area</option>

									</select>
									<span class="text-danger" style='display:none' id='areaCheck'>Please Select Area</span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="disabledInput">Sub Area</label>&nbsp;<span class="text-danger">*</span>
									<select tabindex="20" type="text" class="form-control" id="sub_area" name="sub_area">
										<option value=''>Select Sub Area</option>
									</select>
									<span class="text-danger" style='display:none' id='subareaCheck'>Please Select Sub Area</span>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Area Confirm END -->

				<!-- Property info START -->
				<div class="card">
					<div class="card-header"> Property info
						<button type="button" class="btn btn-primary" id="property_add" name="property_add" data-toggle="modal" data-target=".addproperty" style="padding: 5px 35px;  float: right; " onclick="propertyHolder()"><span class="icon-add"></span></button>
					</div>
					<span class="text-danger" style='display:none' id='property_infoCheck'>Please Fill Property Info </span>
					<div class="card-body">

						<div class="row">

							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group" id="propertyList">
									<table class="table custom-table modalTable">
										<thead>
											<tr>
												<th width="15%"> S.No </th>
												<th> Property Type </th>
												<th> Property Measurement </th>
												<th> Property Value </th>
												<th> Property Holder </th>
												<th> ACTION </th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Property info END -->

				<!-- Bank info START -->
				<div class="card">
					<div class="card-header"> Bank info
						<button type="button" class="btn btn-primary" id="bank_add" name="bank_add" data-toggle="modal" data-target=".addbank" style="padding: 5px 35px;  float: right;"><span class="icon-add"></span></button>
					</div>
					<span class="text-danger" style='display:none' id='bank_infoCheck'>Please Fill Bank Info </span>
					<div class="card-body">

						<div class="row">

							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group" id="bankResetTable">
									<table class="table custom-table modalTable">
										<thead>
											<tr>
												<th width="15%"> S.No </th>
												<th> Bank Name </th>
												<th> Branch Name </th>
												<th> Account Holder Name </th>
												<th> Account Number </th>
												<th> IFSC Code </th>
												<th> ACTION </th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- Bank info END -->

				<!-- KYC info START -->
				<div class="card">
					<div class="card-header"> KYC info
						<button type="button" class="btn btn-primary" id="kyc_add" name="kyc_add" data-toggle="modal" data-target=".addkyc" style="padding: 5px 35px; float: right; "><span class="icon-add"></span></button>
					</div>
					<span class="text-danger" style='display:none' id='kyc_infoCheck'>Please Fill KYC Info </span>
					<div class="card-body">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group" id="kycListTable">
									<table class="table custom-table modalTable">
										<thead>
											<tr>
												<th width="20%"> S.No </th>
												<th> Proof of </th>
												<th> Proof type </th>
												<th> Proof Number </th>
												<th> Upload </th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- KYC info END -->

				<!-- ///////////////////////////////////////////////// Customer Summary START ///////////////////////////////////////////////////////////// -->
				<div class="card">
					<div class="card-header"> Customer Summary </div>
					<div class="card-body">
						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="summarykmnw"> How to Know </label> <span class="required">*</span>
									<select type="text" class="form-control" name="cus_how_know" id="cus_how_know">
										<option value=""> Select How to Know </option>
										<option value="0"> Customer Reference </option>
										<option value="1"> Advertisement </option>
										<option value="2"> Promotion activity </option>
										<option value="3"> Agent Reference </option>
										<option value="4"> Staff Reference </option>
										<option value="5"> Other Reference </option>
									</select>
									<span class="text-danger" style='display:none' id='howToKnowCheck'>Please Select How To Know </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="loancnt"> Loan Counts </label>
									<input type="text" class="form-control" name="cus_loan_count" id="cus_loan_count" readonly>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="loandate"> First Loan Date </label>
									<input type="text" class="form-control" name="cus_frst_loanDate" id="cus_frst_loanDate" readonly>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="travel"> Travel with Company </label>
									<input type="text" class="form-control" name="cus_travel_cmpy" id="cus_travel_cmpy" readonly>
								</div>
							</div>

						</div>

						<hr>

						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="minvcome"> Monthly Income </label> <span class="required">*</span>
									<input type="number" class="form-control" name="cus_monthly_income" id="cus_monthly_income" placeholder="Enter Monthly Income">
									<span class="text-danger" style='display:none' id='monthlyIncomeCheck'>Please Enter Monthly Income </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="otherincome"> Other Income </label> <span class="required">*</span>
									<input type="number" class="form-control" name="cus_other_income" id="cus_other_income" placeholder="Enter Other Income">
									<span class="text-danger" style='display:none' id='otherIncomeCheck'>Please Enter Other Income </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="suppincome"> Support Income </label> <span class="required">*</span>
									<input type="number" class="form-control" name="cus_support_income" id="cus_support_income" placeholder="Enter Support Income">
									<span class="text-danger" style='display:none' id='supportIncomeCheck'>Please Enter Support Income </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group"> 
									<label for="commit"> Commitment </label> <span class="required">*</span>
									<input type="number" class="form-control" name="cus_Commitment" id="cus_Commitment" placeholder="Enter Commitment">
									<span class="text-danger" style='display:none' id='commitmentCheck'>Please Enter Commitment </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="duecapacity"> Monthly Due Capacity </label> <span class="required">*</span>
									<input type="number" class="form-control" name="cus_monDue_capacity" id="cus_monDue_capacity" placeholder="Enter Monthly Due Capacity">
									<span class="text-danger" style='display:none' id='monthlyDueCapacityCheck'> Please Enter Monthly Due Capacity </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="loanlimit"> Loan Limit </label> <span class="required">*</span>
									<input type="number" class="form-control" name="cus_loan_limit" id="cus_loan_limit" placeholder="Enter Loan Limit">
									<span class="text-danger" style='display:none' id='loanLimitCheck'>Please Enter Loan Limit </span>
								</div>
							</div>

						</div>

						<hr>

						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="Character"> Character </label> <span class="required">*</span>
									<input type="text" class="form-control" name="cus_Character" id="cus_Character" placeholder="Enter Character">
									<span class="text-danger" style='display:none' id='CharacterCheck'>Please Enter Character </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="Approach"> Approach </label> <span class="required">*</span>
									<input type="text" class="form-control" name="cus_Approach" id="cus_Approach" placeholder="Enter Approach">
									<span class="text-danger" style='display:none' id='ApproachCheck'>Please Enter Approach </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="Relationship"> Relationship </label> <span class="required">*</span>
									<input type="text" class="form-control" name="cus_Relationship" id="cus_Relationship" placeholder="Relationship">
									<span class="text-danger" style='display:none' id='cusRelationshipCheck'>Please Enter Relationship </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group"> 
									<label for="Attitude"> Attitude </label> <span class="required">*</span>
									<input type="text" class="form-control" name="cus_Attitude" id="cus_Attitude" placeholder="Enter Attitude">
									<span class="text-danger" style='display:none' id='cusAttitudeCheck'>Please Enter Attitude </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="Behavior"> Behavior </label> <span class="required">*</span>
									<input type="text" class="form-control" name="cus_Behavior" id="cus_Behavior" placeholder="Enter Behavior">
									<span class="text-danger" style='display:none' id='cusBehaviorCheck'>Please Enter Behavior </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="IncidentsRemarks"> Incidents Remarks </label> <span class="required">*</span>
									<input type="text" class="form-control" name="cus_Incidents_Remarks" id="cus_Incidents_Remarks" placeholder="Enter Incidents Remarks">
									<span class="text-danger" style='display:none' id='cusIncidentsRemarksCheck'>Please Enter Incidents Remarks </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="abtCustomer"> About Customer </label> <span class="required">*</span>
									<textarea class="form-control" name="about_cus" id="about_cus"></textarea>
									<span class="text-danger" style='display:none' id='aboutcusCheck'> Please Enter About Customer </span>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- ///////////////////////////////////////////////  Customer Summary  END /////////////////////////////////////////////////////////// -->


				<!-- ///////////////////////////////////////////////// Verification Info START ///////////////////////////////////////////////////////////// -->
				<div class="card">
					<div class="card-header"> Verfication Info </div>
					<div class="card-body">
						<div class="row">

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="Communitcation"> Communitcation </label> <span class="required">*</span>
									<select type="text" class="form-control" name="Communitcation_to_cus" id="Communitcation_to_cus">
										<option value=""> Select Communication </option>
										<option value="0"> Phone </option>
										<option value="1"> Direct </option>
									</select>
									<span class="text-danger" style='display:none' id='communicationCheck'>Please Select communication </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style='display:none' id="verifyaudio">
								<div class="form-group">
									<label for="Communitcation"> Audio </label> 
									<input type="file" class="form-control" name="verification_audio" id="verification_audio" accept=".mp3,audio/*">
								</div>
							</div>


							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="Verificationperson"> Verification person </label> <span class="required">*</span>
									<input type="hidden" id="verifyPerson" name="verifyPerson" value="">
									<select type="text" class="form-control" name="verification_person" id="verification_person" multiple>
										<option value=""> Select Verification Person </option>
									</select>
									<span class="text-danger" style='display:none' id='verificationPersonCheck'>Please Select Verification Person </span>
								</div>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
								<div class="form-group">
									<label for="Verificationlocation"> Verification location </label> <span class="required">*</span>
									<select type="text" class="form-control" name="verification_location" id="verification_location">
										<option value=""> Select Verification location </option>
										<option value="0"> On Spot </option>
										<option value="1"> Customer Spot </option>
									</select>
									<span class="text-danger" style='display:none' id='verificationLocCheck'>Please Select Verification Location </span>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- ///////////////////////////////////////////////  Verification Info  END /////////////////////////////////////////////////////////// -->




				<div class="col-md-12 ">
					<div class="text-right">
						<button type="submit" name="submit_verification" id="submit_verification" class="btn btn-primary" value="Submit" tabindex="19"><span class="icon-check"></span>&nbsp;Submit</button>
						<button type="reset" class="btn btn-outline-secondary" tabindex="20">Clear</button>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>


<!-- Add Family Members Modal -->
<div class="modal fade addGroup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Family Info</h5>
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

				<div class="row" id="editFam">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

						<div class="form-group">
							<label class="label"> Name </label>&nbsp;<span class="text-danger">*</span>
							<input type="text" class="form-control" name="famname" id="famname" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="famnameCheck">Enter Name</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="disabledInput"> Relationship </label> &nbsp;<span class="text-danger">*</span>
							<select tabindex="30" type="text" class="form-control" id="relationship" name="relationship">
								<option value=""> Select Relationship </option>
								<option value="Father"> Father </option>
								<option value="Mother"> Mother </option>
								<option value="Spouse"> Spouse </option>
								<option value="Son"> Son </option>
								<option value="Daughter"> Daughter </option>
								<option value="Brother"> Brother </option>
								<option value="Sister"> Sister </option>
								<option value="Other"> Other </option>
							</select>
							<span class="text-danger" id="famrelationCheck">Select Relationship</span>
						</div>
					</div>

					<div id="remark" style="display: none" class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="disabledInput"> Remark</label>
							<input type="text" class="form-control" name="other_remark" id="other_remark">
							<span class="text-danger" id="famremarkCheck">Enter Remark</span>
						</div>
					</div>

					<div id="address" style="display: none" class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="inputReadOnly"> Address </label>
							<input type="text" class="form-control" name="other_address" id="other_address">
							<span class="text-danger" id="famaddressCheck">Enter Address</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Age </label>&nbsp;<span class="text-danger">*</span>
							<input type="number" class="form-control" name="relation_age" id="relation_age">
							<span class="text-danger" id="famageCheck">Enter Age</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Aadhar No </label>&nbsp;<span class="text-danger">*</span>
							<input type="text" class="form-control" name="relation_aadhar" id="relation_aadhar" data-type="adhaar-number" maxlength="14">
							<span class="text-danger" id="famaadharCheck">Enter Aadhar Number</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Mobile No </label>&nbsp;<span class="text-danger">*</span>
							<input type="number" class="form-control" name="relation_Mobile" id="relation_Mobile" maxlength="10" onkeypress="if(this.value.length==10) return false;">
							<span class="text-danger" id="fammobileCheck">Enter Mobile Number</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Occupation </label>&nbsp;<span class="text-danger">*</span>
							<input type="text" class="form-control" name="relation_Occupation" id="relation_Occupation" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="famoccCheck">Enter Occupation</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Income </label>&nbsp;<span class="text-danger">*</span>
							<input type="number" class="form-control" name="relation_Income" id="relation_Income">
							<span class="text-danger" id="famincomeCheck">Enter Income</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Blood Group </label>&nbsp;
							<input type="text" class="form-control" name="relation_Blood" id="relation_Blood">
						</div>
					</div>


					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="famID" id="famID">
						<button type="button" tabindex="2" name="submitFamInfoBtn" id="submitFamInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="updatedFamTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="25%">S.No</th>
								<th>Name</th>
								<th>Relationship</th>
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
<!-- END  Add Family Members Modal -->


<!-- Add Group Members Modal -->
<div class="modal fade addGroupDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Group Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeGroupModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="grpInsertOk" class="successalert"> Group Details Added Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="grpUpdateok" class="successalert"> Group Info Updated Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="NotOk" class="unsuccessalert"> Please Retry! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="GroupDeleteOk" class="successalert"> Group Info Has been Deleted!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="GroupDeleteNotOk" class="unsuccessalert"> Group Not Deleted! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="cus_name"> Name</label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter Name" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="grpnameCheck">Enter Name</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="age">Age</label><span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="group_age" name="group_age">
							<span class="text-danger" id="grpageCheck">Enter Age</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="group_aadhar">Aadhar Number &nbsp;<span class="required">&nbsp;*</span></label>
							<input type="text" class="form-control" id="group_aadhar" name="group_aadhar" data-type="adhaar-number" maxlength="14">
							<span class="text-danger" id="grpaadharCheck">Enter Aadhar Number</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="mobile1">Mobile No </label><span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="group_mobile" name="group_mobile" placeholder="Enter Mobile Number" onkeypress="if(this.value.length==10) return false;">
							<span class="text-danger" id="grpmbleCheck">Enter Mobile No </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="gender">Gender&nbsp;<span class="required">&nbsp;*</span></label>
							<select type="text" class="form-control" id="group_gender" name="group_gender">
								<option value="">Select Gender</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
								<option value="3">Other</option>
							</select>
							<span class="text-danger" id="grpgenCheck">Enter Gender</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="group_dsgn"> Designation &nbsp;<span class="required">&nbsp;*</span> </label>
							<input type="text" class="form-control" id="group_designation" name="group_designation" placeholder="Enter Designation" onkeypress="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="grpdesgnCheck">Enter Designation</span>
						</div>
					</div>


					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="grpID" id="grpID">
						<button type="button" tabindex="2" name="groupInfoBtn" id="groupInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="GroupTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="25%">S.No</th>
								<th>Name</th>
								<th>Aadhar Number</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeGroupModal()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Group Members Modal -->

<!-- Add Property Modal  START -->
<div class="modal fade addproperty" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Property Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetPropertyinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="prptyInsertOk" class="successalert"> Property Info Added Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyUpdateok" class="successalert"> Property Info Updated Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyNotOk" class="unsuccessalert"> Something Went Wrong!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyDeleteOk" class="successalert"> Property Info Deleted!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyDeleteNotOk" class="unsuccessalert"> Property Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="Property_Type "> Property Type </label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="property_typ" name="property_typ" placeholder="Enter Property Type" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="prtytypeCheck">Enter Property Type</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="PropertyMeasurement"> Property Measurement </label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="property_measurement" name="property_measurement" placeholder="Enter Property Measurement">
							<span class="text-danger" id="prtymeasureCheck">Enter Property Measurement</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="PropertyValue"> Property Value </label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="property_value" name="property_value" placeholder="Enter Property Value">
							<span class="text-danger" id="prtyvalCheck">Enter Property Value</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="PropertyHolder"> Property Holder </label><span class="required">&nbsp;*</span>
							<select type="number" class="form-control" id="property_holder" name="property_holder">
								<option> Select Property Holder </option>
							</select>
							<span class="text-danger" id="prtyholdCheck">Select Property Holder </span>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="propertyID" id="propertyID">
						<button type="button" tabindex="2" name="propertyInfoBtn" id="propertyInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="propertyTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="15%"> S.No </th>
								<th> Property Type </th>
								<!-- <th> Property Measurement </th> -->
								<th> Property Value </th>
								<th> Property Holder </th>
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetPropertyinfoList()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Property Modal -->

<!-- Add Bank info Modal  START -->
<div class="modal fade addbank" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Bank Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetbankinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="bankInsertOk" class="successalert"> Bank Info Added Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankUpdateok" class="successalert"> Bank Info Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankDeleteOk" class="unsuccessalert"> Bank Info Deleted
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankDeleteNotOk" class="unsuccessalert"> Bank Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="BankName "> Bank Name </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="bankNameCheck"> Enter Bank Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="BranchName"> Branch Name </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter Branch Name" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="branchCheck"> Enter Branch Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="AccountName"> Account Holder Name </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="account_holder_name" name="account_holder_name" placeholder="Enter Account Holder Name" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="accholdCheck"> Enter Account Holder Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="AccountNumber"> Account Number </label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number">
							<span class="text-danger" id="accnoCheck"> Enter Account Number </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="IfscCode"> IFSC Code </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="Ifsc_code" name="Ifsc_code" placeholder="Enter IFSC Code">
							<span class="text-danger" id="ifscCheck"> Enter IFSC Code </span>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="bankID" id="bankID">
						<button type="button" tabindex="2" name="bankInfoBtn" id="bankInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="bankTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="15%"> S.No </th>
								<th> Bank Name </th>
								<!-- <th> Branch Name </th> -->
								<th> Account Holder Name </th>
								<th> Account Number </th>
								<!-- <th> IFSC Code </th> -->
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetbankinfoList()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Bank Info Modal -->

<!-- Add KYC info Modal  START -->
<div class="modal fade addkyc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add KYC Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetkycinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->

				<div id="kycInsertOk" class="successalert"> KYC Info Added Succesfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="kycUpdateok" class="successalert"> KYC Info Updated Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="kycNotOk" class="unsuccessalert"> Something Went Wrong <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="kycDeleteOk" class="unsuccessalert"> KYC Info Deleted!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="kycDeleteNotOk" class="unsuccessalert"> Kyc Info not Deleted! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="Proofof"> Proof of </label> <span class="required">&nbsp;*</span>
							<select type="text" class="form-control" id="proofof" name="proofof">
								<option value=""> Select Proof Of </option>
								<option value="0"> Applicant </option>
								<option value="1"> Guarantor </option>
								<option value="2"> Family Members </option>
								<option value="3"> Group Members </option>
							</select>
							<span class="text-danger" id="proofCheck"> Select Proof </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="ProofType"> Proof Type </label> <span class="required">&nbsp;*</span>
							<select type="text" class="form-control proofdis" id="proof_type" name="proof_type">
								<option value=""> Select Proof Type </option>
								<option value="1"> Aadhar </option>
								<option value="2"> Smart Card </option>
								<option value="3"> Voter ID </option>
								<option value="4"> Driving License </option>
								<option value="5"> PAN Card </option>
								<option value="6"> Passport </option>
								<option value="7"> Occupation ID </option>
								<option value="8"> Salary Slip </option>
								<option value="9"> Bank statement </option>
								<option value="10"> EB Bill </option>
								<option value="11"> Business Proof </option>
							</select>
							<span class="text-danger" id="proofTypeCheck"> Select Proof Type </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="ProofNumber"> Proof Number </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="proof_number" name="proof_number" placeholder="Enter Proof Number">
							<span class="text-danger" id="proofnoCheck"> Enter Proof Number </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="Upload"> Upload </label> <span class="required">&nbsp;*</span>
							<input type="file" class="form-control" id="upload" name="upload" accept=".pdf,.jpg,.png,.jpeg">
							<span class="text-danger" id="proofUploadCheck"> Upload </span>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="kyc_upload" id="kyc_upload">
						<input type="hidden" name="kycID" id="kycID">
						<button type="button" name="kycInfoBtn" id="kycInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="kycTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="20%"> S.No </th>
								<th> Proof of </th>
								<th> Proof type </th>
								<th> Proof Number </th>
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetkycinfoList()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add KYC Info Modal -->
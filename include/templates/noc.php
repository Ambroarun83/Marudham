<?php



if(isset($_POST['submit_loanIssue']) && $_POST['submit_loanIssue'] != ''){

	// $addDocVerification = $userObj->addloanIssue($mysqli, $userid);
?>
	<!-- <script> alert('Loan Issued Details Submitted'); </script> -->
	<script>location.href='<?php echo $HOSTPATH;  ?>edit_noc&msc=1';</script>
<?php
}

if (isset($_GET['upd'])) {
	$idupd = $_GET['upd'];
}
if (isset($_GET['cusidupd'])) {
	$cusidupd = $_GET['cusidupd'];
}
$getLoanList = $userObj->getLoanList($mysqli, $idupd);
if (sizeof($getLoanList) > 0) {
	for ($i = 0; $i < sizeof($getLoanList); $i++) {
		$cus_id						= $getLoanList['cus_id'];
		$cus_name					= $getLoanList['cus_name'];
		$area_id					= $getLoanList['area_confirm_area'];
		$area_name					= $getLoanList['area_name'];
		$sub_area_id				= $getLoanList['area_confirm_subarea'];
		$sub_area_name				= $getLoanList['sub_area_name'];
		$branch_id					= $getLoanList['branch_id'];
		$branch_name				= $getLoanList['branch_name'];
		$line_id					= $getLoanList['line_id'];
		$line_name					= $getLoanList['area_line'];
		$mobile					= $getLoanList['mobile1'];
		$cus_pic					= $getLoanList['cus_pic'];
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
.overlay {
	position: fixed;
	z-index: 9999;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5); /* Add semi-transparent black background */
	display: flex;
	justify-content: center;
	align-items: center;
}

.loader {
	border: 4px solid #f3f3f3;
	border-top: 4px solid #3498db;
	border-radius: 50%;
	width: 30px;
	height: 30px;
	animation: spin 2s linear infinite;
}

@keyframes spin {
	0% { transform: rotate(0deg); }
	100% { transform: rotate(360deg); }
}
.overlay-text {
	color: white;
	font-size: 1.5rem;
	margin-left: 10px;
}

</style>

<!-- Page header start -->
<br><br>
<div class="page-header">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham - NOC
	</div>
</div><br>
<div class="text-right" style="margin-right: 25px;">
	<a href="edit_noc">
		<button type="button" class="btn btn-primary" id='back-button'><span class="icon-arrow-left"></span>&nbsp; Back</button>
	</a>
	<button class="btn btn-primary" id='close-noc-card' >&times;&nbsp;&nbsp;Cancel</button>
</div><br><br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">
	
	<!--form start-->
	<div>
		<form id="noc_form" name="noc_form" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="idupd" id="idupd" value="<?php if (isset($idupd)) {echo $idupd;} ?>" />
		<input type="hidden" name="cusidupd" id="cusidupd" value="<?php if (isset($cusidupd)) {echo $cusidupd;} ?>" />
		<input type="hidden" name="req_id" id="req_id" value='' />

		<!-- Row start -->
		<div class="row gutters">
			<!-- Request Info -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

				<!-- Personal info START -->
				<div class="card">
					<div class="card-header">Personal Info <span style="font-weight:bold" class="" ></span></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="cus_id">Customer ID</label><span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="cus_id" name="cus_id" value='<?php if (isset($cus_id)) {echo $cus_id;} ?>' readonly>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="cus_name">Customer Name</label><span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="cus_name" name="cus_name" value='<?php if (isset($cus_name)) {echo $cus_name;} ?>' readonly >
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="area"> Area </label> <span class="required"> * </span>
											<input type="hidden" id='area_id' name='area_id' value='<?php if(isset($area_id)) echo $area_id;?>'>
											<input  type="text" class="form-control" id="area" name="area" value="<?php if (isset($area_name)) echo $area_name; ?>" readonly>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="sub_area"> Sub Area </label> <span class="required"> * </span>
											<input type="hidden" id='sub_area_id' name='sub_area_id' value='<?php if(isset($sub_area_id)) echo $sub_area_id;?>'>
											<input type="text" class="form-control" id="sub_area" name="sub_area" value='<?php if (isset($sub_area_name)) echo $sub_area_name; ?>' readonly>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="branch"> Branch </label> <span class="required"> * </span>
											<input type="hidden" id='branch_id' name='branch_id' value='<?php if(isset($branch_id)) echo $branch_id;?>'>
											<input type="text" class="form-control" id="branch" name="branch" value='<?php if (isset($branch_name)) echo $branch_name; ?>' readonly>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="branch"> Line </label> <span class="required"> * </span>
											<input type="hidden" class="form-control" id="line_id" name="line_id" value='<?php if (isset($line_id)) echo $line_id; ?>' readonly>
											<input type="text" class="form-control" id="line" name="line" value='<?php if (isset($line_name)) echo $line_name; ?>' readonly>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="mobile1">Mobile No</label><span class="required">&nbsp;*</span>
											<input type="number" class="form-control" id="mobile" name="mobile" value='<?php if (isset($mobile)) {echo $mobile;} ?>' readonly>
										</div>
									</div>

								</div>
							</div>

							<div class="col-md-4">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="form-group" style="margin-left: 30px;">
										<label for="pic" style="margin-left: -20px;">Photo</label><span class="required">&nbsp;*</span><br>
										<input type="hidden" name="cus_pic" id="cus_pic" value="<?php if (isset($cus_pic)) {echo $cus_pic;} ?>">
										<img id='imgshow' class="img_show" src=<?php if (isset($cus_pic)) {echo 'uploads/request/customer/'.$cus_pic;}else{echo 'img/avatar.png';} ?> />
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Personal info END -->

				<!-- Loan List Start -->
				<div class="card loanlist_card">
					<div class="card-header">
						<div class="card-title">Loan List</div>
					</div>
					<div class="card-body">
						<div class="row ">
							<!--Fields -->
							<div class="col-md-12 ">
								<div class="row">

									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group" id='loanListTableDiv'>
											<table class="table custom-table" id='loanListTable'>
												<thead>
													<tr>
														<th>Loan ID</th>
														<th>Loan Category</th>
														<th>Sub Category</th>
														<th>Agent</th>
														<th>Loan date</th>
														<th>Loan Amount</th>
														<th>Closed Date</th>
														<th>Status</th>
														<th>Sub Status</th>
														<th>Level</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Loan List End -->
				<!-- NOC window -->
				<div class="card noc-card" >
					<div class="card-header">NOC Window</div>
					<div class="card-body">
						<!-- Signed Document start -->
						<div class="row">
							<div class="col-md-12 ">
								<div class="row">
									<h5 style='margin-left:18px;margin-bottom:30px;'>Signed Document List</h5>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group" id='signDocDiv'>
											<table class="table custom-table" id='signDocTable'>
												<thead>
													<tr>
														<th>S.No</th>
														<th>Doc Name</th>
														<th>Sign Type</th>
														<th>Document</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Signed Document End -->
						<hr>
						<!-- Cheque List Start -->
						<div class="row">
							<div class="col-md-12 ">
								<div class="row">
									<h5 style='margin-left:18px;margin-bottom:30px;'>Cheque List</h5>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group" id='chequeDiv'>
											<table class="table custom-table" id='chequeTable'>
												<thead>
													<tr>
														<th>S.No</th>
														<th>Holder Type</th>
														<th>Holder Name</th>
														<th>Relationship</th>
														<th>Bank Name</th>
														<th>Cheque No.</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!-- Cheque List End -->
							<hr>
							<!-- Mortgage List Start -->
						<div class="row">
							<div class="col-md-12 ">
								<div class="row">
									<h5 style='margin-left:18px;margin-bottom:30px;'>Mortgage List</h5>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group" id='mortgageDiv'>
											<table class="table custom-table" id='mortgageTable'>
												<thead>
													<tr>
														<th>S.No</th>
														<th>Details</th> <!-- Mortgage Process and Document will be placed if exist in td -->
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!-- Mortgage List End -->
							<hr>
							<!-- Endorsement List Start -->
						<div class="row">
							<div class="col-md-12 ">
								<div class="row">
									<h5 style='margin-left:18px;margin-bottom:30px;'>Endorsement List</h5>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group" id='endorsementDiv'>
											<table class="table custom-table" id='endorsementTable'>
												<thead>
													<tr>
														<th>S.No</th>
														<th>Details</th> <!-- Endorsement Process and Rc and Key will be placed if exist in td -->
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!-- Endorsement List End -->
							<hr>
							<!-- Gold List Start -->
						<div class="row">
							<div class="col-md-12 ">
								<div class="row">
									<h5 style='margin-left:18px;margin-bottom:30px;'>Gold List</h5>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group" id='goldDiv'>
											<table class="table custom-table" id='goldTable'>
												<thead>
													<tr>
														<th>S.No</th>
														<th>Gold Type</th>
														<th>Purity</th>
														<th>Count</th>
														<th>Weight</th>
														<th>Value</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!-- Gold List End -->
							<hr>
							<!-- Document Info Start -->
						<div class="row">
							<div class="col-md-12 ">
								<div class="row">
									<h5 style='margin-left:18px;margin-bottom:30px;'>Document List</h5>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group" id='documentDiv'>
											<table class="table custom-table" id='documentTable'>
												<thead>
													<tr>
														<th>S.No</th>
														<th>Document Name</th> 
														<th>Document Details</th> 
														<th>Document Holder</th> 
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
							<!-- Document Info End -->
						<div class="row">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
								<div class="form-group">
									<label for="noc_date">Date Of NOC</label><span class="required">&nbsp;*</span>
									<input type="text" class="form-control" id="noc_date" name="noc_date" value='<?php echo date('d-m-Y'); ?>' readonly>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
								<div class="form-group">
									<label for="noc_member">Member</label><span class="required">&nbsp;*</span>
									<select type='text' id='noc_member' name='noc_member' class="form-control">
										<option value="">Select Member</option>
										<option value="1">Customer</option>
										<option value="2">Guarentor</option>
										<option value="3">Family Memeber</option>
									</select>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8 mem_relation_name">
								<div class="form-group">
									<label for="mem_relation_name">Member Name</label><span class="required">&nbsp;*</span>
									<select type='text' id='mem_relation_name' name='mem_relation_name' class="form-control">
										<option value="">Select Member Name</option>
									</select>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8 mem_name">
								<div class="form-group">
									<label for="mem_name">Member Name</label><span class="required">&nbsp;*</span>
									<input type="hidden"id="mem_id" name="mem_id" value='' readonly>
									<input type="text" class="form-control" id="mem_name" name="mem_name" value='' readonly>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
								<div class="form-group">
									<label for="ack_fingerprint">Acknowledgement</label><span class="required">&nbsp;*</span>
									<input type="hidden" class="form-control" id="compare_finger" name="compare_finger" value='' readonly >
									<input type="hidden" class="form-control" id="ack_fingerprint" name="ack_fingerprint" value='' readonly >
									<input type="text" class="form-control" value='' readonly style="visibility:hidden;"><!--Just for spacing-->
									<button type="button" class='btn btn-success scanBtn' id="" name="" style='background-color:#009688;margin-top: -50px;width: 509px;' 
									onclick="event.preventDefault()" title='Put Your Thumb'><i class="material-icons" id="icon-flipped">&#xe90d;</i>&nbsp;Scan</button>
								</div>
							</div>
						</div>

						</div>
					</div>
				</div>
				<!-- NOC window List -->

				<!-- Submit Button Start -->
				<div class="col-md-12 ">
					<div class="text-right">
						<button type="submit" name="submit_noc" id="submit_noc" class="btn btn-primary" value="Submit"><span class="icon-check"></span>&nbsp;Submit</button>
					</div>
				</div>
				<!-- Submit Button End -->

			</div>
		</div>
	</form>
</div>
	<!-- Form End -->

</div>
<!-- Finger print font cdn -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Finger print jquery Library -->
<script src="vendor/mfs100/Library/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="vendor/mfs100/Library/js/mfs100.js"></script>
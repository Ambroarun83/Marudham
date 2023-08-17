<?php

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}


if(isset($_POST['submit_collection']) && $_POST['submit_collection'] != ''){
	if(isset($_POST['req_id'])){$req_id = $_POST['req_id'];}
	if(isset($_POST['collection_id'])){$coll_id = $_POST['collection_id'];}
	$addCollection = $userObj->addCollection($mysqli,$req_id,$userid);
	
	?>
	<!-- <script>location.href='<?php echo $HOSTPATH; ?>edit_collection&msc=1&id=<?php echo $coll_id ?>';</script> -->
	<script>location.href='<?php echo $HOSTPATH; ?>collection&upd=<?php echo $_GET['upd'];?>&cusidupd=<?php echo $_GET['cusidupd'];?>';</script>
<?php
}

$idupd=0;
if(isset($_GET['upd']))
{
$idupd=$_GET['upd'];
$cusidupd=$_GET['cusidupd'];
}
if($idupd>0)
{
	$getLoanList = $userObj->getLoanList($mysqli,$idupd); 
	// print_r($getLoanList);
	if (sizeof($getLoanList)>0) {
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
			$mobile1					= $getLoanList['mobile1'];
			$cus_pic					= $getLoanList['cus_pic'];
	}
	
	$getRequestData = $userObj->getRequestForVerification($mysqli, $idupd);
	if (sizeof($getRequestData) > 0) {
		$user_type = $getRequestData['user_type'];
		if ($user_type == 'Director') { $role = '1'; } else if ($user_type == 'Agent') { $role = '2'; } else if ($user_type == 'Staff') { $role = '3'; }
		$user_name = $getRequestData['user_name'];
		$responsible = $getRequestData['responsible'];
		$declaration = $getRequestData['declaration'];
		$remarks = $getRequestData['remarks'];
	}

	$getuser = $userObj->getuser($mysqli,$userid);
	$collection_access = $getuser['collection_access'];
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
		Marudham - Due Follow Up
	</div>
</div>
<br>
<div class="page-header sticky-top" id="navbar" style="display: none;" data-toggle="toggle">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px; margin-top:50px;">
		Customer Name - <?php if (isset($cus_name)) {echo $cus_name;} ?>
		,&nbsp;&nbsp;Area - <?php if (isset($area_name)) {echo $area_name;} ?>
		,&nbsp;&nbsp;Sub Area - <?php if (isset($sub_area_name)) {echo $sub_area_name;} ?>
	</div>
</div>
<br>
	<div class="text-right" style="margin-right: 25px;">
		<a href="edit_due_followup">
			<button type="button" class="btn btn-primary back-button"><span class="icon-arrow-left"></span>&nbsp; Back</button>
		</a>
		<button class="btn btn-primary" id='close_collection_card' >&times;&nbsp;&nbsp;Cancel</button>
	</div><br><br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id="cus_Profiles" name="cus_Profiles" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="idupd" id="idupd" value="<?php if (isset($idupd)) {echo $idupd;} ?>" />
		<input type="hidden" name="req_id" id="req_id" value="<?php if (isset($req_id)) {echo $req_id;} ?>" />
		<input type="hidden" name="cusidupd" id="cusidupd" value="<?php if (isset($cusidupd)) {echo $cusidupd;} ?>" />
		<input type="hidden" name="cuspicupd" id="cuspicupd" value="<?php if (isset($cus_pic)) {echo $cus_pic;} ?>" />
		<input type="hidden" name="collection_access" id="collection_access" value="<?php if (isset($collection_access)) {echo $collection_access;} ?>" />
		<input type="hidden" name="pending_sts" id="pending_sts" value="" />
		<input type="hidden" name="od_sts" id="od_sts" value="" />
		<input type="hidden" name="due_nil_sts" id="due_nil_sts" value="" />
		<input type="hidden" name="closed_sts" id="closed_sts" value="" />
		<input type="hidden" name="colluserid" id="colluserid" value="<?php if (isset($userid)) {echo $userid;} ?>" />

		<!-- Row start -->
		<div class="row gutters">
			<!-- Request Info -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				
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
														<th width="50">Loan ID</th>
														<th>Loan Category</th>
														<th>Sub Category</th>
														<th>Agent</th>
														<th>Loan date</th>
														<th>Loan Amount</th>
														<th>Banlance Amount</th>
														<th>Collection Format</th>
														<th>Status</th>
														<th>Sub Status</th>
														<th>Collect</th>
														<th>Charts</th>
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

				<!-- Loan History START -->
				<div class="card loan_history_card">
					<div class="card-header"> Loan History </div>
					<div class="card-body">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group" id="loanHistoryDiv">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Loan History END -->

				<!-- Document History START -->
				<div class="card doc_history_card">
					<div class="card-header"> Documents History </div>
					<div class="card-body">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group" id="docHistoryDiv">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Document History END -->				
			</div>
		</div>
	</form>
	<!-- Form End -->
</div>
<div id="printcollection" style="display: none"></div>

<!-- /////////////////////////////////////////////////////////////////// Due Chart Modal START ////////////////////////////////////////////////////////////////////// -->
<div class="modal fade DueChart" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <input type="hidden" name="req_id" id="req_id" value="<?php if(isset($idupd)){echo $idupd;} ?>" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel"> Due Chart Icon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="dueChartTableDiv">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th> S.No </th>
                                <th> Due Month </th>
                                <th> Month </th>
                                <th> Due Amount </th>
                                <th> Pending </th>
                                <th> Payable </th>
                                <th> Collection  Date </th>
                                <th> Collection Amount </th>
                                <th> Balance Amount </th>
                                <th> Collection Track </th>
                                <th> Role </th>
                                <th> User ID </th>
                                <th> Collection Location </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////// Due Chart Modal END ////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////// Penalty Char Modal START ////////////////////////////////////////////////////////////////////// -->
<div class="modal fade PenaltyChart" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <input type="hidden" name="req_id" id="req_id" value="<?php if(isset($idupd)){echo $idupd;} ?>" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel"> Penalty Chart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="penaltyChartTableDiv">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th> S.No </th>
                                <th> Penalty Date </th>
                                <th> Penalty  </th>
                                <th> Paid Date </th>
                                <th> Paid Amount </th>
                                <th> Balance Amount </th>
                                <th> Waiver Amount </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////// Penalty Chart Modal END ////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////// Fine Chart Modal START ////////////////////////////////////////////////////////////// -->
<div class="modal fade collectionChargeChart" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <input type="hidden" name="req_id" id="req_id" value="<?php if(isset($idupd)){echo $idupd;} ?>" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel"> Fine Chart </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="collectionChargeDiv">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th> S.No </th>
                                <th> Date </th>
                                <th> Fine  </th>
                                <th> Purpose </th>
                                <th> Paid Date </th>
                                <th> Paid  </th>
                                <th> Balance </th>
                                <th> Waiver </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////// Fine Chart Modal END ////////////////////////////////////////////////////////////////////// -->

<!-- /////////////////////////////////////////////////////////////////// Commitment Add Modal Start ////////////////////////////////////////////////////////////////////// -->
<div class="modal fade addcommitmentChart" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Commitment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetCommitment()">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div id="collChargeInsertOk" class="successalert">Commitment Added Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>
				<div id="collChargeNotOk" class="unsuccessalert">Something Went Wrong!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>
				<br />
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="collectionCharge_date">Date</label> <span class="required">&nbsp;*</span>
							<input type="hidden" class="form-control" id="cc_req_id" name="cc_req_id">
							<input type="date" class="form-control" id="collectionCharge_date" name="collectionCharge_date">
							<span class="text-danger" id="collectionChargeDateCheck" style="display: none;">Select Date</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="collectionCharge_purpose">Purpose</label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="collectionCharge_purpose" name="collectionCharge_purpose" placeholder="Enter Purpose" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="purposeCheck" style="display: none;">Enter Purpose</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="collectionCharge_Amnt">Amount</label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="collectionCharge_Amnt" name="collectionCharge_Amnt" placeholder="Enter Amount">
							<span class="text-danger" id="amntCheck" style="display: none;">Enter Amount</span>
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<button type="button" tabindex="2" name="collChargeBtn" id="collChargeBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>
				</div>
				<br />
				<div id="collChargeTableDiv">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="15%">S.No</th>
								<th>Date</th>
								<th>Purpose</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetCommitment()">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- /////////////////////////////////////////////////////////////////// Commitment Add Modal END ////////////////////////////////////////////////////////////////////// -->
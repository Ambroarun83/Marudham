
<?php 
@session_start();
if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}

?>

<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
       Marudham -  Bank Clearance 
   </div>
</div><br>
<div class="text-right" style="margin-right: 25px;display:none" id='back_to_band_details'>
    <button type="button" class="btn btn-primary" ><span class="icon-arrow-left"></span>&nbsp; Back</button>
</div><br><br>
<head>
</head>
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id = "bank_clearance_form" name="bank_clearance_form" action="" method="post" enctype="multipart/form-data"> 
		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card" id='bank_details_card'>
					<div class="card-header">
						<div class="card-title">Bank Details</div>
					</div>
					<div class="card-body">
						<div class="row ">
							<!--Fields -->
							<div class="col-md-12 "> 
								<div class="row">

                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for='bank_name'>Bank Name</label><span class="text-danger">&nbsp;*</span>
                                            <select id='bank_name' name='bank_name' class="form-control" tabindex='1'>
                                                <option value="">Select Bank Name</option>
                                            </select>
                                            <span class="text-danger" style='display:none' id='bank_nameCheck'>Please Select Bank Name</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for='acc_no'>Account Number</label><span class="text-danger">&nbsp;*</span>
                                            <select id='acc_no' name='acc_no' class="form-control" tabindex='2'>
                                                <option value="">Select Account Number</option>
                                            </select>
                                            <span class="text-danger" style='display:none' id='acc_noCheck'>Please Select Account Number</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for='from_date'>From Date</label><span class="text-danger">&nbsp;*</span>
                                            <input type='date' id='from_date' name='from_date' class="form-control" tabindex='3'>
                                            <span class="text-danger" style='display:none' id='from_dateCheck'>Please Select From Date</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for='to_date'>To Date</label><span class="text-danger">&nbsp;*</span>
                                            <input type='date' id='to_date' name='to_date' class="form-control" tabindex='4'>
                                            <span class="text-danger" style='display:none' id='to_dateCheck'>Please Select To Date</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<button type="button"  tabindex="5"  id="download_bank_stmt" name="download_bank_stmt" class="btn btn-primary"><span class="icon-download"></span>&nbsp;Download Format</button>
										<button type="button" data-toggle="modal" data-target="#bankUploadModal" tabindex="6"  id="upload_bank_stmt" name="upload_bank_stmt" class="btn btn-primary"><span class="icon-upload"></span>&nbsp;Upload</button>		
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card" id='bank_clearance_card' style="display:none">
					<div class="card-header">
						<div class="card-title">Bank Clearance</div>
					</div>
					<div class="card-body">
						<div class="row ">
							<!--Fields -->
							<div class="col-md-12 "> 
								<div class="row" id="bank_clearanceDiv">

								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 ">
                    <div class="text-right">
                        <button type="submit" name="submit_bank_details" id="submit_bank_details" class="btn btn-primary" value="Submit" tabindex="11"><span class="icon-check"></span>&nbsp;Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" tabindex="12" >Clear</button>
                    </div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Modal for upload -->
<div class="modal fade" id="bankUploadModal" tabindex="-1" role="dialog" aria-labelledby="vCenterModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="vCenterModalTitle">Area Bulk Upload</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post" enctype="multipart/form-data" name="bank_upd" id="bank_upd">
					<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12"></div>
						<div class="col-xl-6 col-lg-6 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label">Select File</label>
							<input type="file" name="file" id="file" class="form-control">
							<div id="insertsuccess" style="color: green; font-weight: bold; display:none">Bank statement Added Successfully</div>
							<div id="notinsertsuccess" style="color: red; font-weight: bold;display:none">Problem Importing File or Duplicate Entry found</div>
						</div>
						</div> 
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="submit_stmt_upload" name="submit_stmt_upload">Upload</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id='close_upd_modal' >Close</button>
			</div>
		</div>
	</div>
</div>



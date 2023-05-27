<?php

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}


if(isset($_POST['submit_collection']) && $_POST['submit_collection'] != ''){
	if(isset($_POST['id'])){$id = $_POST['id'];}

	$addCollection = $userObj->addCollection($mysqli,$req_id,$userid);
	
?>
	<script>location.href='<?php echo $HOSTPATH; ?>edit_collection&msc=1&id=<?php echo $coll_id ?>';</script>
<?php
}

$idupd=0;
if(isset($_GET['upd']))
{
$idupd=$_GET['upd'];
}
if($idupd>0)
{

}
$getuser = $userObj->getuser($mysqli,$userid);
$bank_details = $getuser['bank_details'];
$branch_id = $getuser['branch_id'];

//To get bank name details for mentioning it on opening and closing balance
if($bank_details != null){
	$bank_details_arr = explode(',',$getuser['bank_details']);
	foreach($bank_details_arr as $val){
		$qry11 = $mysqli->query("SELECT id,short_name, acc_no from bank_creation where id = '".strip_tags($val)."' ");
		$row = $qry11->fetch_assoc();
		$bank_name_arr[] = $row['short_name'] . ' - ' . substr($row['acc_no'],-5);
		$bank_id_arr[] = $row['id'];
	}
}

?>

<style>
.modal {
    width: 100% !important;
}
.modal-lg {
    max-width: 70% !important;
}

.lable-style{
	font-size:15px;
	/* font-weight:normal; */
	font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}
input[type="radio"]{
	top: 2px;
}
.radio-style{
	font-size:15px;
	font-weight:normal;
}
</style>

<!-- Page header start -->
<br><br>
<div class="page-header">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham - Cash Tally
	</div>
</div>
<br>
<br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id="cash_tally" name="cash_tally" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" id='user_branch_id' name='user_branch_id' value='<?php if(isset($branch_id)) echo $branch_id;?>'>
		<!-- Row start -->
		<div class="row gutters">
			<!-- Request Info -->
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				
<!-- //////////////////////////////////////////////////////////// Opening Balance Card ////////////////////////////////////////////////////////////////////////////-->
				<div class="card">
					<!-- <div class="card-header">Cash Tally</div> -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
										<div class="form-group">
											<label for="" style='font-size:18px;font-weight:bold;'>Opening Balance</label>
										</div>
									</div>
									<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12" ></div>
									<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12" style="max-width: 140px;text-align:right">
										<div class="form-group">
											<label for="op_date" class="lable-style">Opening Date: </label><br>
										</div>
									</div>
									<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
										<div class="form-group">
											<label class="lable-style" id='op_date'><?php echo date('d-m-Y');?></label><br>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12"></div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12" style="max-width: 198px;">
										<div class="form-group">
											<label class="lable-style">Hand Cash</label><br>
											<?php if(isset($bank_name_arr)){
												for($i=0;$i<sizeof($bank_name_arr);$i++){?>
													<label class="lable-style"><?php echo $bank_name_arr[$i];?></label><br>
												<?php }}?>
											<label class="lable-style">Agent Cash</label><br><br><hr>
											<label class="lable-style">Total Opening Balance</label>
										</div>
									</div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12" style="max-width: 20px;">
										<div class="form-group">
											<label class="lable-style">:</label><br>
											<?php if(isset($bank_name_arr)){
												for($i=0;$i<sizeof($bank_name_arr);$i++){?>
												<label class="lable-style">:</label><br>
											<?php }}?>
											<label class="lable-style">:</label><br><br><hr>
											<label class="lable-style">:</label>
										</div>
									</div>
									
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12"  style="max-width: 150px;">
										<div class="form-group">
											<label class="lable-style" id='hand_cash'>150000</label><br>
											<?php if(isset($bank_name_arr)){
												for($i=0;$i<sizeof($bank_name_arr);$i++){?>
													<label class="lable-style"><?php echo '0';?></label><br>
												<?php }}?>
											<label class="lable-style" id='agent_cash'>16510</label><br><br><hr>
											<label class="lable-style" id='agent_cash'>348010</label>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
<!-- //////////////////////////////////////////////////////////// Opening Balance Card ////////////////////////////////////////////////////////////////////////////-->
		
<!-- //////////////////////////////////////////////////////////// Cash tally Card ////////////////////////////////////////////////////////////////////////////-->
				<div class="card">
					<div class="card-header" style='font-size:18px;font-weight:bold;'>Cash Tally</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"></div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
										<div class="form-group">
											<input type="radio" id="hand_cash_radio" name="cash_type" value='0' />&emsp;<label class='radio-style'>Hand Cash</label>&emsp;
										</div>
									</div>
									<?php if(isset($bank_details) && $bank_details != null){
										for($i=0;$i<sizeof($bank_name_arr);$i++){?>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12" style="max-width: 30%;">
										<div class="form-group">
											<input type="radio" id="bank_cash_radio" name="cash_type" value="<?php echo $bank_id_arr[$i];?>" class="bank_cash_radio" />&emsp;<label  class='radio-style'><?php echo $bank_name_arr[$i];?></label>
										</div>
									</div>
									<?php } }?>
								</div>
								<div class="row">
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12"></div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
										<div class="form-group">
											<label for='credit_type'>Credit</label>
											<select class="form-control" id='credit_type' name='credit_type' >
												<option value=''>Select Credit Type</option>
											</select>
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
										<div class="form-group">
											<label for='debit_type'>Debit</label>
											<select class="form-control" id='debit_type' name='debit_type' >
												<option value=''>Select Debit Type</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<!-- //////////////////////////////////////////////////////////// Cash tally Card ////////////////////////////////////////////////////////////////////////////-->

<!-- //////////////////////////////////////////////////////////// Collection Card ////////////////////////////////////////////////////////////////////////////-->
				<div class="card">
					<div class="card-header" style='font-size:18px;font-weight:bold;'>Collection</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									
								<div class="modal-body">
									<div id="collectionTableDiv">
									</div>
								</div>

								</div>
							</div>
						</div>
					</div>
				</div>
<!-- //////////////////////////////////////////////////////////// Collection Card ////////////////////////////////////////////////////////////////////////////-->

<!-- //////////////////////////////////////////////////////////// Closing Balance Card ////////////////////////////////////////////////////////////////////////////-->
				<div class="card">
					<!-- <div class="card-header">Cash Tally</div> -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
										<div class="form-group">
											<label for="" style='font-size:18px;font-weight:bold;'>Closing Balance</label>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12"></div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12" style="max-width: 198px;">
										<div class="form-group">
											<label class="lable-style"> Hand Cash</label><br>
											<?php if(isset($bank_name_arr)){
												for($i=0;$i<sizeof($bank_name_arr);$i++){?>
													<label class="lable-style"><?php echo $bank_name_arr[$i];?></label><br>
												<?php }}?>
											<label class="lable-style">Agent Cash</label><br><br><hr>
											<label class="lable-style">Total Closing Balance</label>
										</div>
									</div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12" style="max-width: 20px;">
										<div class="form-group">
											<label class="lable-style">:</label><br>
											<?php if(isset($bank_name_arr)){
												for($i=0;$i<sizeof($bank_name_arr);$i++){?>
												<label class="lable-style">:</label><br>
											<?php }}?>
											<label class="lable-style">:</label><br><br><hr>
											<label class="lable-style">:</label>
										</div>
									</div>
									
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12"  style="max-width: 150px;">
										<div class="form-group">
											<label class="lable-style" id='hand_cash'>150000</label><br>
											<?php if(isset($bank_name_arr)){
												for($i=0;$i<sizeof($bank_name_arr);$i++){?>
													<label class="lable-style"><?php echo '0';?></label><br>
												<?php }}?>
											<label class="lable-style" id='agent_cash'>16510</label><br><br><hr>
											<label class="lable-style" id='agent_cash'>348010</label>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
<!-- //////////////////////////////////////////////////////////// Closing Balance Card ////////////////////////////////////////////////////////////////////////////-->

				<!-- Submit Button Start -->
				<div class="col-md-12 ">
					<div class="text-right">
						<button type="submit" name="submit_collection" id="submit_collection" class="btn btn-primary" value="Submit"><span class="icon-check"></span>&nbsp;Submit</button>
						<!-- <button type="reset" class="btn btn-outline-secondary" tabindex="20">Clear</button> -->
					</div>
				</div>
				<!-- Submit Button End -->
				
			</div>
		</div>
	</form>
	<!-- Form End -->
</div>

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
<!-- /////////////////////////////////////////////////////////////////// Collection Charges Chart Modal START ////////////////////////////////////////////////////////////// -->
<div class="modal fade collectionChargeChart" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <input type="hidden" name="req_id" id="req_id" value="<?php if(isset($idupd)){echo $idupd;} ?>" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel"> Collection Charge Chart </h5>
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
                                <th> Collection Charges  </th>
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
<!-- /////////////////////////////////////////////////////////////////// Collection Charges Chart Modal END ////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////// Collection Charges Add Modal START ////////////////////////////////////////////////////////////// -->
<div class="modal fade collectionCharges" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Collection charges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetcollCharges()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- alert messages -->
                <div id="collChargeInsertOk" class="successalert"> Collection Charges Added Successfully
                    <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>
                <!-- <div id="bankUpdateok" class="successalert"> Bank Info Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div> -->
                <div id="collChargeNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>
                <!-- <div id="bankDeleteOk" class="unsuccessalert"> Bank Info Deleted
                    <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div>
                <div id="bankDeleteNotOk" class="unsuccessalert"> Bank Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
                </div> -->
                <br />
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="coll_date "> Date  </label> <span class="required">&nbsp;*</span>
                            <input type="hidden" class="form-control" id="cc_req_id" name="cc_req_id" >
                            <input type="date" class="form-control" id="collectionCharge_date" name="collectionCharge_date" >
                            <span class="text-danger" id="collectionChargeDateCheck"> Select Date </span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="coll_purpose"> Purpose  </label> <span class="required">&nbsp;*</span>
                            <input type="text" class="form-control" id="collectionCharge_purpose" name="collectionCharge_purpose" placeholder="Enter Purpose" onkeydown="return /[a-z ]/i.test(event.key)">
                            <span class="text-danger" id="purposeCheck"> Enter Purpose </span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="coll_amnt"> Amount </label> <span class="required">&nbsp;*</span>
                            <input type="number" class="form-control" id="collectionCharge_Amnt" name="collectionCharge_Amnt" placeholder="Enter Amount" >
                            <span class="text-danger" id="amntCheck"> Enter Amount </span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
                        <!-- <input type="hidden" name="bankID" id="bankID"> -->
                        <button type="button" tabindex="2" name="collChargeBtn" id="collChargeBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
                    </div>
                </div>
                </br>
                <div id="collChargeTableDiv">
                    <table class="table custom-table modalTable">
                        <thead>
                            <tr>
                                <th width="15%"> S.No </th>
                                <th> Date </th>
                                <th> Purpose </th>
                                <th> Amount </th>
                                <!-- <th> ACTION </th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetcollCharges()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////// Collection Charges Add Modal END ////////////////////////////////////////////////////////////////////// -->
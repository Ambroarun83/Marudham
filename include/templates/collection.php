<?php
if (isset($_GET['upd'])) {
	$idupd = $_GET['upd'];
}

if(isset($_POST['submit_loanIssue']) && $_POST['submit_loanIssue'] != ''){

	$addDocVerification = $userObj->addloanIssue($mysqli, $userid);
?>
	<!-- <script> alert('Loan Issued Details Submitted'); </script> -->
	<script>location.href='<?php echo $HOSTPATH;  ?>edit_loan_issue&msc=1';</script>
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
		Marudham - Collection
	</div>

<div class="text-right" style="margin-right: 25px;">
	<a href="edit_collection">
		<button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
	</a>
</div><br><br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">
	
	<!--form start-->
	<div>
		<form id="cus_Profiles" name="cus_Profiles" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="req_id" id="req_id" value="<?php if (isset($req_id)) {echo $req_id;} ?>" />

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
											<input type="text" class="form-control" id="cus_id" name="cus_id" value='<?php if (isset($cp_cus_id)) {echo $cp_cus_id;} ?>' readonly>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="cus_name">Customer Name</label><span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="cus_name" name="cus_name" value='<?php if (isset($cp_cus_name)) {echo $cp_cus_name;} ?>' readonly >
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="DocArea"> Area </label> <span class="required"> * </span>
											<input  type="text" class="form-control" id="doc_area" name="doc_area" value="<?php if (isset($doc_area_name)) echo $doc_area_name; ?>" readonly>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="DocSubArea"> Sub Area </label> <span class="required"> * </span>
											<input type="text" class="form-control" id="doc_Sub_Area" name="doc_Sub_Area" value='<?php if (isset($doc_sub_area_name)) echo $doc_sub_area_name; ?>' readonly>
										</div>
									</div>
									
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="name"> Customer Type </label>
											<input type="text" class="form-control" name="cus_type" id="cus_type" value="<?php if (isset($cus_type)) { echo $cus_type; } ?>" readonly>
										</div>
									</div>

									<div id="exist_type" <?php if (isset($cus_type)) {	if ($cus_type != 'Existing') { ?> style="display: none" <?php } } ?> class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="ExistType"> Exist Type </label>
											<input type="text" class="form-control" name="cus_exist_type" id="cus_exist_type" value="<?php if (isset($cus_exist_type)) { echo $cus_exist_type; } ?>" readonly>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="mobile1">Mobile No 1</label><span class="required">&nbsp;*</span>
											<input type="number" class="form-control" id="mobile1" name="mobile1" value='<?php if (isset($cp_mobile1)) {echo $cp_mobile1;} ?>' readonly>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="mobile2">Mobile No 2</label>
											<input type="number" class="form-control" id="mobile2" name="mobile2" value='<?php if (isset($cp_mobile2)) {echo $cp_mobile2;} ?>' readonly>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="whatsapp">Whatsapp No </label>
											<input type="number" class="form-control" id="whatsapp_no" name="whatsapp_no" value="<?php if(isset($cp_whatsapp)){echo $cp_whatsapp; }?>" readonly>
										</div>
									</div>

									

								</div>
							</div>

							<div class="col-md-4">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="form-group" style="margin-left: 30px;">
										<label for="pic" style="margin-left: -20px;">Photo</label><span class="required">&nbsp;*</span><br>
										<input type="hidden" name="cus_image" id="cus_image" value="<?php if (isset($cp_cus_pic)) {echo $cp_cus_pic;} ?>">
										<img id='imgshow' class="img_show" src='img/avatar.png' />
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Personal info END -->

				<!-- Guarentor info START -->
				<div class="card">
					<div class="card-header">Guarentor Info <span style="font-weight:bold" class="" ></span></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="GuarentorName"> Guarentor Name </label><span class="required">&nbsp;*</span>
											<select type="text" class="form-control" id="guarentor_name" name="guarentor_name" disabled>
												<option> Select Guarantor </option>
											</select>
										</div>
									</div>

									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
										<div class="form-group">
											<label for="GuarentorRelationship"> Guarentor Relationship </label>
											<input type="text" class="form-control" id="guarentor_relationship" name="guarentor_relationship" value='<?php if (isset($guarentor_relation)) {echo $guarentor_relation;} ?>' readonly>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="form-group" style="margin-left: 30px;">
										<label for="pic" style="margin-left: -20px;"> Guarentor Photo </label><span class="required">&nbsp;*</span><br>
										<input type="hidden" name="guarentor_image" id="guarentor_image" value="<?php if (isset($guarentor_photo)) {echo $guarentor_photo;} ?>">
										<img id='imgshows' class="img_show" src='img/avatar.png' />
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Guarentor END -->

                <!-- Loan Info START -->
				<div class="card">
					<div class="card-header">Loan Info <span style="font-weight:bold" class="" ></span></div>
					<div class="card-body">
						<div class="row">
                                    
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="LoanCategory"> Loan Category </label><span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="loan_category" name="loan_category" readonly>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="Subcategory"> Sub category </label>
											<input type="text" class="form-control" id="sub_category" name="sub_category" value="<?php if (isset($sub_category_lc)) {echo $sub_category_lc;} ?>" readonly>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="Agent"> Agent </label>
											<input type="text" class="form-control" id="agent" name="agent"  readonly>
										</div>
									</div>

									<div class="col-md-12">
										<label for="disabledInput">Category Info</label>&nbsp;<span class="text-danger">*</span><br><br>
												<table id="moduleTable" class="table custom-table">
													<tbody>	</tbody>
												</table>
										<br><br>
									</div>

                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 advance_yes" > <!--style="display:none" -->
											<div class="form-group">
												<label for="disabledInput">Total Value</label>&nbsp;<span class="text-danger">*</span>
												<input tabindex="4" type="text" class="form-control" id="tot_value" name="tot_value" value='<?php if (isset($tot_value_lc)) {echo $tot_value_lc;}elseif(isset($tot_value)) {echo $tot_value;}?>' readonly>
											</div>
									</div>
                                        
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 advance_yes" > <!-- style="display:none"-->
											<div class="form-group">
												<label for="disabledInput">Advance Amount</label>&nbsp;<span class="text-danger">*</span>
												<input tabindex="5" type="text" class="form-control" id="ad_amt" name="ad_amt" value='<?php if (isset($ad_amt_lc)) {echo $ad_amt_lc;}elseif(isset($ad_amt)) {echo $ad_amt;}?>' readonly>
											</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Loan Amount</label>&nbsp;<span class="text-danger">*</span>
												<input tabindex="6" type="text" class="form-control" id="loan_amt" name="loan_amt" value='<?php if (isset($loan_amt_lc)) {echo $loan_amt_lc;}elseif(isset($loan_amt)) {echo $loan_amt;}?>' readonly>
											</div>
									</div>

						</div>
					</div>
				</div>
				<!-- Loan Info END -->

                	<!-- Loan Calculation Start -->
					<div class="card">
						<div class="card-header">Loan Calculation <span style="font-weight:bold" class="" ></span></div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Loan Amount</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="loan_amt_cal" name="loan_amt_cal" value='<?php if(isset($loan_amt_cal)) echo $loan_amt_cal;?>'>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Principal Amount</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="principal_amt_cal" name="principal_amt_cal" value='<?php if(isset($principal_amt_cal)) echo $principal_amt_cal;?>'>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Interest Amount</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="int_amt_cal" name="int_amt_cal" value='<?php if(isset($int_amt_cal)) echo $int_amt_cal;?>'>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Total Amount</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="tot_amt_cal" name="tot_amt_cal" value='<?php if(isset($tot_amt_cal)) echo $tot_amt_cal;?>'>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Due Amount</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="due_amt_cal" name="due_amt_cal" value='<?php if(isset($due_amt_cal)) echo $due_amt_cal;?>'>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Document Charges</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="doc_charge_cal" name="doc_charge_cal" value='<?php if(isset($doc_charge_cal)) echo $doc_charge_cal;?>'>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Processing Fee</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="proc_fee_cal" name="proc_fee_cal" value='<?php if(isset($proc_fee_cal)) echo $proc_fee_cal;?>'>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Net Cash</label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" readonly id="net_cash_cal" name="net_cash_cal" value='<?php if(isset($net_cash_cal)) echo $net_cash_cal;?>'>
												<!-- <input type="hidden" class="form-control"  id="net_cash" name="net_cash" > -->
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Loan info End -->

					<!-- Collection Info Start -->
					<div class="card">
						<div class="card-header">Collection Info <span style="font-weight:bold" class="" ></span></div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Due Start From</label>&nbsp;<span class="text-danger">*</span>
												<input type="date" class="form-control" id="due_start_from" name="due_start_from" value='<?php if(isset($due_start_from)) echo $due_start_from;?>' readonly>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Maturity Month</label>&nbsp;<span class="text-danger">*</span>
												<input type="date" class="form-control" id="maturity_month" name="maturity_month" value='<?php if(isset($maturity_month)) echo $maturity_month;?>' readonly>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Collection Method</label>&nbsp;<span class="text-danger">*</span>
												<select type="text" class="form-control" id="collection_method" name="collection_method" disabled>
													<option value="">Select Collection Method</option> 
													<option value="1" <?php if(isset($collection_method) and $collection_method == '1') echo 'selected';?>>BySelf</option> 
													<option value="2" <?php if(isset($collection_method) and $collection_method == '2') echo 'selected';?>>Spot Collection</option> 
													<option value="3" <?php if(isset($collection_method) and $collection_method == '3') echo 'selected';?>>Cheque Collection</option> 
													<option value="4" <?php if(isset($collection_method) and $collection_method == '4') echo 'selected';?>>ESC</option> 
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Collection Info End -->

                    <!-- Issued Info Start -->
					<div class="card">
						<div class="card-header">Issued Info <span style="font-weight:bold" class="" ></span></div>
						<span class="text-danger" style="display: none;" id="val_check"> Please Enter Any One of the Value </span>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="row">

									   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput"> Balance To Issue </label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control"  id="net_cash" name="net_cash" readonly>
											</div>
										</div>

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
											<div class="form-group">
												<label for="disabledInput">Issued to </label>&nbsp;<span class="text-danger">*</span>
												<input type="text" class="form-control" id="issue_to" name="issue_to" readonly>
												<input type="hidden" class="form-control" id="agent_id" name="agent_id">
											</div>
										</div>

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" >
											<div class="form-group">
												<label for="disabledInput">Issued mode</label>&nbsp;<span class="text-danger">*</span>
												<select type="text" class="form-control" id="issued_mode" name="issued_mode" >
                                                <option value=""> Select Issued Mood</option>
                                                <option value="0"> Split Payment </option>
                                                <option value="1"> Single Payment </option>
                                                </select>
												<span class="text-danger" style="display: none;" id="issue"> Please Select Issued Mode </span>
											</div>
										</div>

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 paymentType" style="display:none">
											<div class="form-group">
												<label for="disabledInput">Payment Type </label>&nbsp;<span class="text-danger">*</span>
												<select type="text" class="form-control" id="payment_type" name="payment_type" >
                                                <option value=""> Select Payment Type</option>
                                                <option value="0"> Cash </option>
                                                <option value="1"> Cheque </option>
                                                <option value="2"> Account Transfer </option>
                                                </select>
												<span class="text-danger" style="display: none;" id="pay_type"> Please Select Payment Type </span>
											</div>
										</div>
									</div>
									
									<div class="row">

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 cash_issue" style="display:none"> 
											<div class="form-group">
												<label for="disabledInput">Cash</label>
												<input type="number" class="form-control" id="cash" name="cash" >
												<span class="text-danger" style="display: none;" id="cash_amnt"> Please Enter Cash </span>
											</div>
										</div>
									</div>
									
									<div class="row">

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 checque" style="display:none"> 
											<div class="form-group">
												<label for="disabledInput">Cheque number</label>
												<input type="number" class="form-control" id="chequeno" name="chequeno" >
												<span class="text-danger" style="display: none;" id="cheque_num"> Please Enter Cheque Number </span>
											</div>
										</div>

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 checque" style="display:none"> 
											<div class="form-group">
												<label for="disabledInput">cheque Value</label>
												<input type="number" class="form-control" id="chequeValue" name="chequeValue" >
												<span class="text-danger" style="display: none;" id="cheque_val"> Please Enter Cheque Value </span>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 checque" style="display:none"> 
											<div class="form-group">
												<label for="disabledInput">cheque Remark</label>
												<input type="text" class="form-control" id="chequeRemark" name="chequeRemark" >
												<span class="text-danger" style="display: none;" id="cheque_remark"> Please Enter Cheque Remark </span>
											</div>
										</div>
										
									</div>
									
									<div class="row">

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 transaction" style="display:none">  
											<div class="form-group">
												<label for="disabledInput">Transaction ID</label>
												<input type="number" class="form-control" id="transaction_id" name="transaction_id" >
												<span class="text-danger" style="display: none;" id="transact_id"> Please Enter Transaction ID </span>
											</div>
										</div>

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 transaction" style="display:none"> 
											<div class="form-group">
												<label for="disabledInput">Transaction Value </label>
												<input type="number" class="form-control" id="transaction_value" name="transaction_value" >
												<span class="text-danger" style="display: none;" id="transact_val"> Please Enter Transaction Value </span>
											</div>
										</div>
										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 transaction" style="display:none"> 
											<div class="form-group">
												<label for="disabledInput">Transaction Remark </label>
												<input type="text" class="form-control" id="transaction_remark" name="transaction_remark" >
												<span class="text-danger" style="display: none;" id="transact_remark"> Please Enter Transaction Remark </span>
											</div>
										</div>

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 balance" style="display:none"> 
											<div class="form-group">
												<label for="disabledInput">Balance Amount </label>
												<input type="text" class="form-control" id="balance" name="balance" readonly>
											</div>
										</div>


									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Issued Info End -->

					 <!-- Cash Acknowledgement  Start -->
					 <div class="card">
						<div class="card-header">Cash Acknowledgement <span style="font-weight:bold" class="" ></span></div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="row">

										<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="GuarentorName"> Name </label><span class="required">&nbsp;*</span>
											<select type="text" class="form-control" id="cash_guarentor_name" name="cash_guarentor_name">
												<option> Select Guarantor </option>
											</select>
											<span class="text-danger" style="display: none;" id="cash_guarentor"> Please Select the Name </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="GuarentorRelationship">  Relationship </label>
											<input type="text" class="form-control" id="relationship" name="relationship" readonly>
										</div>
									</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- cash Acknowledgement Info End -->


					<!-- Submit Button Start -->
					<div class="col-md-12 ">
                        <div class="text-right">
                            <button type="submit" name="submit_loanIssue" id="submit_loanIssue" class="btn btn-primary" value="Submit"><span class="icon-check"></span>&nbsp;Submit</button>
                            <!-- <button type="reset" class="btn btn-outline-secondary" tabindex="20">Clear</button> -->
                        </div>
                    </div>
					<!-- Submit Button End -->

			</div>
		</div>
	</form>
</div>
	 <!-- Form End -->

</div>

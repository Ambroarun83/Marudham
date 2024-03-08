<?php
@session_start();
if (isset($_SESSION["userid"])) {
	$userid = $_SESSION["userid"];
}

$userRole = $userObj->getuser($mysqli, $userid)['role'];

$getValues = $userObj->getDataForDashboard($mysqli, $userid);

?>
<!-- for fadeIn animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/css/libs/animate.min.css" rel="stylesheet">
<!-- for counter -->
<script src="https://unpkg.com/counterup2@2.0.2/dist/index.js"></script>
<link rel="stylesheet" href="css/dashboard.css">


<!-- Page header start -->
<br><br>
<br><br>
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id="dashboard_form" name="dashboard_form" action="" method="post" enctype="multipart/form-data">

		<?php if ($userRole == 2) { ?>
			<!-- Row start -->
			<p class="heading-list wow fadeInUp">Request</p>

			<div class="row gutters">
				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card  wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Today's Request</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['today_request']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card  wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Month's Request</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['month_request']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Row start -->
			<p class="heading-list wow fadeInUp">Loan</p>
			<div class="row gutters">
				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card  wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Today's Issued Loan</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['today_loan']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card  wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Month's Issued Loan</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['month_loan']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Row start -->
			<p class="heading-list wow fadeInUp">Collection</p>
			<div class="row gutters">
				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Today's No of Collection</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['today_collection_no']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Month's No of Collection</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['month_collection_no']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Today's Collection</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['today_collection']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
					<div class="card wow">
						<div class="card-header">
							<div class="card-title"></div>
						</div>
						<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
							<div class="row">
								<div class="col-12">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Month's Collection</p>
										<p class="counter wow fadeInUp"><?php echo $getValues['month_collection']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<?php if ($userRole == 1) { ?>
				<?php } ?>
				<div class="branch-div">
					<select name="by_branch" id="by_branch" class="branch-dropdown">
						<option value="">Choose Branch</option>
					</select>
				</div>
			<div class="card" id="request_card">
				<div class="card-header" id="req_title">
					<div class="card-title" style="display:flex;justify-content:center;align-items: center;font-size:1.5rem;cursor:pointer">Request</div>
				</div>
				<div class="card-body" id="req_body" style="display:none">
					<div class="row cards-row" style="display:flex;justify-content:flex-start;">
						<div class="col-2">
							<div class="card">
								<div class="card-body counter-cards">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Total Requests</p>
										<p class="counter wow fadeInUp" id="tot_req"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="card">
								<div class="card-body counter-cards">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Total Issued</p>
										<p class="counter wow fadeInUp" id="tot_issue"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="card">
								<div class="card-body counter-cards">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Total Balance</p>
										<p class="counter wow fadeInUp" id="tot_bal"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="card">
								<div class="card-body counter-cards today-card">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Today Requests</p>
										<p class="counter wow fadeInUp" id="today_req"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="card">
								<div class="card-body counter-cards today-card">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Today Issued</p>
										<p class="counter wow fadeInUp" id="today_issue"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-2">
							<div class="card">
								<div class="card-body counter-cards today-card">
									<div class="form-group text-center">
										<p class='counter-head wow fadeIn'>Today Balance</p>
										<p class="counter wow fadeInUp" id="today_bal"></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="card" style="border:3px solid #009688">
								<div class="card-body">
									<div class="radio-container">
										<div class="selector">
											<div class="selector-item">
												<input type="radio" id="radio1" name="chart_selector" class="selector-item_radio" checked>
												<label for="radio1" class="selector-item_label">Cancel & Revoke</label>
											</div>
											<div class="selector-item">
												<input type="radio" id="radio2" name="chart_selector" class="selector-item_radio">
												<label for="radio2" class="selector-item_label">Customer Type</label>
											</div>
											<!-- <div class="selector-item">
												<input type="radio" id="radio3" name="chart_selector" class="selector-item_radio">
												<label for="radio3" class="selector-item_label">Loan Category</label>
											</div> -->
										</div>
									</div>
									<br>
									<div class="row">
										<!-- <div class="col-12"> -->
										<div class="col-6">
											<div class="charts" id="chart1"></div>
										</div>
										<div class="col-6">
											<div class="charts" id="chart2"></div>
										</div>
										<!-- </div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</form>
</div>


<script src="vendor/canvasjs/canvasjs.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src='js/dashboard.js'></script>
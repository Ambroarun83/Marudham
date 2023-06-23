<?php 
@session_start();

if(isset($_SESSION['fullname'])){
	$fullname  = $_SESSION['fullname'];
}
if(isset($_SESSION['userid'])){
	$userid  = $_SESSION['userid'];
}

$msc=0;
if(isset($_GET['msc']))
{
	$msc=$_GET['msc'];
}
$current_page = isset($_GET['page']) ? $_GET['page'] : null; 
define('iEditValid', 1);
include('api/main.php'); // Database Connection File   
?>

<!doctype html>
<html lang="en">

<!-- downlaod customer excel div -->
<div id="backup_customer" style="display:none"></div>
<div id="accountdata" style="display:none"></div>
<!-- end customer excel div -->

<!-- Important -->
<?php  if( $current_page != 'vendorcreation' and $current_page != 'auction_details' ) { ?>
<?php include "include/common/dashboardhead.php"?>
<?php  } ?>


<?php if($current_page == 'vendorcreation') { ?>
<?php include "include/common/dashboardfinancedatatablehead.php"?>
<?php } ?>
<?php if($current_page == 'auction_details') { ?>
<?php include "include/common/dashboardfinancedatatablehead.php"?>
<?php } ?>

<body>
	<!-- Page wrapper start -->
	<div class="page-wrapper">
		<?php 
		if($_SESSION['userid']=="")
		{
			echo "<script>location.href='index.php'</script>"; 
		}
		include "include/common/leftbar.php"?>

		<!-- Page content start  -->
		<div class="page-content">

			<!-- Header start -->
			<header class="header">
				<div class="toggle-btns">
					<a id="toggle-sidebar" href="#">
						<i class="icon-list"></i>
					</a>
					<a id="pin-sidebar" href="#">
						<i class="icon-list"></i>
					</a>
				</div>
				<div class="header-items">
					<!-- Custom search start -->
					<div class="custom-search">
						<input type="text" class="search-query" placeholder="Search here ..." >
						<i class="icon-search1"></i>
					</div>
					<!-- Custom search end -->

					<!-- Header actions start -->
					<ul class="header-actions">
						<li class="dropdown"></li>
						<li class="dropdown">
							<a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
								<i class="icon-bell"></i>
								<span
									class="count-label"><?php //echo count($notification); // count($notificationmax); ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
								<div class="dropdown-menu-header">
									Notifications
								</div>
								<div class="customScroll5 quickscard">
									<ul class="header-notifications"></ul>
								</div>
							</div>
						</li>
						<li class="dropdown">
							<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown"
								aria-haspopup="true">
								<span class="user-name"><?php echo $fullname; ?></span>
								<span class="avatar">
									<img src="img/user22.png" alt="avatar">
									<span class="status busy"></span>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
								<div class="header-profile-actions">
									<div class="header-user-profile">
										<div class="header-user">
											<img src="img/user22.png" alt="Admin Template">
										</div>
										<h5><?php echo $fullname; ?></h5>
										<p><?php echo $fullname; ?></p>
									</div>
									<a href="#"><i class="icon-user1"></i> My Profile</a>
									<a href="logout.php"><i class="icon-log-out1"></i> Sign Out</a>
								</div>
							</div>
						</li>
					</ul>
					<!-- Header actions end -->
				</div>
			</header>
			<!-- Header end -->

			<!-- Master Module-->
			<?php if($current_page == 'company_creation') { ?>
			<?php include "include/templates/company_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_company_creation') { ?>
			<?php include "include/templates/edit_company_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'branch_creation') { ?>
			<?php include "include/templates/branch_creation.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'edit_branch_creation') { ?>
			<?php include "include/templates/edit_branch_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'loan_category') { ?>
			<?php include "include/templates/loan_category.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_loan_category') { ?>
			<?php include "include/templates/edit_loan_category.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'loan_calculation') { ?>
			<?php include "include/templates/loan_calculation.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_loan_calculation') { ?>
			<?php include "include/templates/edit_loan_calculation.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'loan_scheme') { ?>
			<?php include "include/templates/loan_scheme.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'edit_loan_scheme') { ?>
			<?php include "include/templates/edit_loan_scheme.php" ?>
			<?php } ?>

			<?php if($current_page == 'area_creation') { ?>
			<?php include "include/templates/area_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_area_creation') { ?>
			<?php include "include/templates/edit_area_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'area_mapping') { ?>
			<?php include "include/templates/area_mapping.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_area_mapping') { ?>
			<?php include "include/templates/edit_area_mapping.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'area_status') { ?>
			<?php include "include/templates/area_status.php" ?>
			<?php } ?>

			<!-- Administration Module-->
			<?php if($current_page == 'director_creation') { ?>
			<?php include "include/templates/director_creation.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'edit_director_creation') { ?>
			<?php include "include/templates/edit_director_creation.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'agent_creation') { ?>
			<?php include "include/templates/agent_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_agent_creation') { ?>
			<?php include "include/templates/edit_agent_creation.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'staff_creation') { ?>
			<?php include "include/templates/staff_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_staff_creation') { ?>
			<?php include "include/templates/edit_staff_creation.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'manage_user') { ?>
			<?php include "include/templates/manage_user.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_manage_user') { ?>
			<?php include "include/templates/edit_manage_user.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'doc_mapping') { ?>
			<?php include "include/templates/doc_mapping.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_doc_mapping') { ?>
			<?php include "include/templates/edit_doc_mapping.php" ?>
			<?php } ?>

			<!-- Request Module -->
			<?php if($current_page == 'request') { ?>
			<?php include "include/templates/request.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_request') { ?>
			<?php include "include/templates/edit_request.php" ?>
			<?php } ?>
			
			<!-- Verification -->
			<?php if($current_page == 'verification_list') { ?>
			<?php include "include/templates/verification_list.php" ?>
			<?php } ?>

			<?php if($current_page == 'verification') { ?>
			<?php include "include/templates/verification.php" ?>
			<?php } ?>

			<!-- Approval -->
			<?php if($current_page == 'approval_list') { ?>
			<?php include "include/templates/approval_list.php" ?>
			<?php } ?>

			<?php if($current_page == 'approval') { ?>
			<?php include "include/templates/approval.php" ?>
			<?php } ?>
			
			<!-- Acknowledgement -->
			<?php if($current_page == 'edit_acknowledgement_list') { ?>
			<?php include "include/templates/edit_acknowledgement_list.php" ?>
			<?php } ?>

			<?php if($current_page == 'acknowledgement_creation') { ?>
			<?php include "include/templates/acknowledgement_creation.php" ?>
			<?php } ?>

			<!-- Loan Issue -->
			<?php if($current_page == 'edit_loan_issue') { ?>
			<?php include "include/templates/edit_loan_issue.php" ?>
			<?php } ?>

			<?php if($current_page == 'loan_issue') { ?>
			<?php include "include/templates/loan_issue.php" ?>
			<?php } ?>
			
			<!-- Collection -->
			<?php if($current_page == 'edit_collection') { ?>
			<?php include "include/templates/edit_collection.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'collection') { ?>
			<?php include "include/templates/collection.php" ?>
			<?php } ?>
			
			<!-- Closed -->
            <?php if($current_page == 'edit_closed') { ?>
            <?php include "include/templates/edit_closed.php" ?>
            <?php } ?>
            <?php if($current_page == 'closed') { ?>
            <?php include "include/templates/closed.php" ?>
            <?php } ?>
			
			<!-- NOC -->
			<?php if($current_page == 'edit_noc') { ?>
			<?php include "include/templates/edit_noc.php" ?>
			<?php } ?>

			<?php if($current_page == 'noc') { ?>
			<?php include "include/templates/noc.php" ?>
			<?php } ?>

			<!-- Concern Creation -->
			<?php if($current_page == 'edit_concern_creation') { ?>
			<?php include "include/templates/edit_concern_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'concern_creation') { ?>
			<?php include "include/templates/concern_creation.php" ?>
			<?php } ?>

			<!-- Concern Solution -->
			<?php if($current_page == 'edit_concern_solution') { ?>
			<?php include "include/templates/edit_concern_solution.php" ?>
			<?php } ?>

			<?php if($current_page == 'concern_solution') { ?>
			<?php include "include/templates/concern_solution.php" ?>
			<?php } ?>

			<?php if($current_page == 'concern_solution_view') { ?>
			<?php include "include/templates/concern_solution_view.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_concern_feedback') { ?>
            <?php include "include/templates/edit_concern_feedback.php" ?>
            <?php } ?>

            <?php if($current_page == 'concern_feedback') { ?>
            <?php include "include/templates/concern_feedback.php" ?>
            <?php } ?>

			<!-- Update Screen -->
            <?php if($current_page == 'edit_update') { ?>
            <?php include "include/templates/edit_update.php" ?>
            <?php } ?>

            <?php if($current_page == 'update') { ?>
            <?php include "include/templates/update.php" ?>
            <?php } ?>

			<!-- Bank Creation -->
			<?php if($current_page == 'bank_creation') { ?>
			<?php include "include/templates/bank_creation.php" ?>
			<?php } ?>

			<?php if($current_page == 'edit_bank_creation') { ?>
			<?php include "include/templates/edit_bank_creation.php" ?>
			<?php } ?>

			<!-- Cash Tally -->
			<?php if($current_page == 'cash_tally') { ?>
			<?php include "include/templates/cash_tally.php" ?>
			<?php } ?>
			
			<!-- Bank Clearance -->
			<?php if($current_page == 'bank_clearance') { ?>
			<?php include "include/templates/bank_clearance.php" ?>
			<?php } ?>
			
			<?php if($current_page == 'edit_bank_clearance') { ?>
			<?php include "include/templates/edit_bank_clearance.php" ?>
			<?php } ?>

		</div>
		<!-- Page content end -->

	</div>
	<!-- Page wrapper end -->

	<!-- Important -->
	<!-- This the important section for download excel file and script adding with our screen -->
	<?php if( $current_page != 'vendorcreation') { ?>
	<?php include "include/common/dashboardfooter.php"?>
	<?php } ?>

	<?php
		if($current_page == 'vendorcreation') { ?>
	<?php include "include/common/dashboardfinancedatatablefooter.php" ?>
	<?php } ?>
	

	
	
</body>
</html>
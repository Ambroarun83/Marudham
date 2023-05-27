<?php
if(isset($_SESSION["userid"])){
	$userid = $_SESSION["userid"];
}
$current_page = isset($_GET['page']) ? $_GET['page'] : null; 
$verif_check = isset($_GET['pge']) ? $_GET['pge'] : null; 

if($current_page == 'edit_company_creation' ||$current_page == 'company_creation' || $current_page == 'edit_branch_creation' ||$current_page == 'branch_creation' || 
$current_page == 'edit_loan_category' || $current_page == 'loan_category' || $current_page == 'edit_loan_calculation' || $current_page == 'loan_calculation' || 
$current_page == 'edit_loan_scheme' || $current_page == 'loan_scheme' || $current_page == 'edit_area_creation' || $current_page == 'area_creation' || 
$current_page == 'edit_area_mapping' || $current_page == 'area_mapping' || $current_page == 'area_status' ){

	$current_module = 'master';

}else if($current_page == 'edit_director_creation' ||$current_page == 'director_creation' || $current_page == 'edit_agent_creation' || $current_page == 'agent_creation' || 
$current_page == 'edit_staff_creation' || $current_page == 'staff_creation' || $current_page == 'edit_manage_user'|| $current_page == 'manage_user' || $current_page == 'edit_doc_mapping'
|| $current_page == 'doc_mapping' || $current_page == 'edit_bank_creation' || $current_page == 'bank_creation'){

	$current_module = 'admin';

}else if($current_page == 'edit_request' || $current_page == 'request' ){

	$current_module = 'request';

}else if($current_page == 'verification_list' || $current_page == 'verification' ){
	
	if($verif_check != '' && $verif_check == '2'){ //Due to same page for two screens, first check pge number to verify it is for approval or verification
		$current_module = 'approval';
	}else{
		$current_module = 'verification';
	}

}else if($current_page == 'approval_list' || $current_page == 'approval'){

	$current_module = 'approval';

}else if($current_page == 'edit_acknowledgement_list' || $current_page == 'acknowledgement_creation' ){

	$current_module = 'acknowledgement';

}else if($current_page == 'edit_loan_issue' || $current_page == 'loan_issue' ){

	$current_module = 'loanissue';

}else if($current_page == 'edit_collection' || $current_page == 'collection' ){

	$current_module = 'collection';

}else if($current_page == 'edit_closed' || $current_page == 'closed' ){

	$current_module = 'closed';

}else if($current_page == 'edit_noc' || $current_page == 'noc' ){

	$current_module = 'noc';

}else if($current_page == 'edit_concern_creation' || $current_page == 'edit_concern_solution' || $current_page == 'concern_creation' || $current_page == 'concern_solution' || $current_page == 'concern_solution_view' || $current_page == 'edit_concern_feedback' || $current_page == 'concern_feedback'){

	$current_module = 'concerncreation';

}else if($current_page == 'cash_tally' ){

	$current_module = 'accounts';

}else{
	$current_module = '';
}
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
	setTimeout(() => {
		var currentPage = "<?php echo $current_page; ?>"; // set the current page value to local variable
		var verif_check = "<?php echo $verif_check; ?>"; // set the verification page pge value to local variable

		var sidebarLinks = document.querySelectorAll('.page-wrapper .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu ul li a');

		sidebarLinks.forEach(function(link) {
			var href = link.getAttribute('href');
			if (href === currentPage || href.includes(currentPage)) {
				link.style.backgroundColor = '#646969d9';
			}
		});
	}, 1000);
</script>

<?php
$user_id        = '';
$full_name      = '';
$user_name      = '';
$password       = '';
$role           = '';
$role_type           = '';
$dir_name           = '';
$ag_name           = '';
$staff_name           = '';
$company_id           = '';
$branch_id           = '';
$line_id           = '';
$group_id           = '';
$mastermodule    = '';
$company_creation      = '';
$branch_creation = '';
$loan_category ='';
$loan_calculation   = '';
$loan_scheme   = '';
$area_creation        = '';
$area_mapping        = '';
$area_status        = '';
$adminmodule = '';
$director_creation = '';
$agent_creation = '';
$staff_creation = '';
$manage_user = '';
$doc_mapping = '';
$bank_creation = '';
$requestmodule = '';
$request = '';
$verificationmodule = '';
$verification = '';
$approvalmodule = '';
$approval = '';
$acknowledgementmodule = '';
$acknowledgement = '';
$loanissuemodule = '';
$loan_issue = '';
$collectionmodule = '';
$collection = '';
$closedmodule = '';
$closed = '';
$nocmodule = '';
$noc = '';
$concernmodule = '';
$concern_creation = '';
$concern_solution = '';
$concern_feedback = '';
$accountsmodule = '';
$cash_tally = '';

$getUser = $userObj->getUser($mysqli,$userid); 
if (sizeof($getUser)>0) {
	for($i=0;$i<sizeof($getUser);$i++)  {			
		$user_id                 	 = $getUser['user_id'];
		$fullname          		     = $getUser['fullname'];
		$user_name          		     = $getUser['user_name'];
		$user_password          		     = $getUser['user_password'];
		$role          		     = $getUser['role'];
		$role_type          		     = $getUser['role_type'];
		$dir_id          		     = $getUser['dir_id'];
		$ag_id          		     = $getUser['ag_id'];
		$staff_id          		     = $getUser['staff_id'];
		$company_id          		     = $getUser['company_id'];
		$branch_id          		     = $getUser['branch_id'];
		$line_id          		     = $getUser['line_id'];
		$group_id          		     = $getUser['group_id'];
		$mastermodule          		     = $getUser['mastermodule'];
		$company_creation          		     = $getUser['company_creation'];
		$branch_creation          		     = $getUser['branch_creation'];
		$loan_category          		     = $getUser['loan_category'];
		$loan_calculation          		     = $getUser['loan_calculation'];
		$loan_scheme          		     = $getUser['loan_scheme'];
		$area_creation          		     = $getUser['area_creation'];
		$area_mapping          		     = $getUser['area_mapping'];
		$area_status          		     = $getUser['area_approval'];
		$adminmodule          		     = $getUser['adminmodule'];
		$director_creation          		     = $getUser['director_creation'];
		$agent_creation          		     = $getUser['agent_creation'];
		$staff_creation          		     = $getUser['staff_creation'];
		$manage_user          		     = $getUser['manage_user'];
		$doc_mapping          		     = $getUser['doc_mapping'];
		$bank_creation          		     = $getUser['bank_creation'];
		$requestmodule          		     = $getUser['requestmodule'];
		$request          		     = $getUser['request'];
		$verificationmodule          		     = $getUser['verificationmodule'];
		$verification          		     = $getUser['verification'];
		$approvalmodule          		     = $getUser['approvalmodule'];
		$approval          		     = $getUser['approval'];
		$acknowledgementmodule          		     = $getUser['acknowledgementmodule'];
		$acknowledgement          		     = $getUser['acknowledgement'];
		$loanissuemodule          		     = $getUser['loanissuemodule'];
		$loan_issue          		     = $getUser['loan_issue'];
		$collectionmodule          		     = $getUser['collectionmodule'];
		$collection          		     = $getUser['collection'];
		$closedmodule          		     = $getUser['closedmodule'];
		$closed          		     = $getUser['closed'];
		$nocmodule          		     = $getUser['nocmodule'];
		$noc          		     = $getUser['noc'];
		$concernmodule          		     = $getUser['concernmodule'];
		$concern_creation          		     = $getUser['concern_creation'];
		$concern_solution          		     = $getUser['concern_solution'];
		$concern_feedback          		     = $getUser['concern_feedback'];
		$accountsmodule          		     = $getUser['accountsmodule'];
		$cash_tally          		     = $getUser['cash_tally'];
	}
}
?>

<style>
	body {
	font-family: "Lato", sans-serif;
	}

	.svg-icon {
        width: 24px; /* Set the desired width */
        height: 24px; /* Set the desired height */
		fill: white;
      }
	/* Fixed sidenav, full height */
	.sidenav {
	height: 100%;
	width: 200px;
	position: fixed;
	z-index: 1;
	top: 0;
	left: 0;
	background-color: #111;
	overflow-x: hidden;
	padding-top: 20px;
	}

	/* Style the sidenav links and the dropdown button */
	.sidenav a, .dropdown-btn1 {
	padding: 6px 8px 6px 16px;
	text-decoration: none;
	
	color: #818181;
	display: block;
	border: none;
	background: none;
	width: 100%;
	text-align: left;
	cursor: pointer;
	outline: none;
	}

	/* On mouse-over */
	.sidenav a:hover, .dropdown-btn1:hover {
	color: #2f958bd9;
	}

	.sidenav a, .dropdown-btn {
	padding: 6px 8px 6px 16px;
	text-decoration: none;
	
	color: #818181;
	display: block;
	border: none;
	background: none;
	width: 100%;
	text-align: left;
	cursor: pointer;
	outline: none;
	}

	/* On mouse-over */
	.sidenav a:hover, .dropdown-btn:hover {
	color: #2f958bd9;
	}

	/* On mouse-over */
	.sidenav a:hover, .dropdown-btn1:hover {
	color: #2f958bd9;
	}
	/* Main content */
	.main {
	margin-left: 200px; /* Same as the width of the sidenav */
	
	padding: 0px 10px;
	}

	/* Add an active class to the active dropdown button */
	.active {
	
	color: white;
	}

	/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
	.dropdown-container {
	display: none;

	padding-left: 8px;
	}

	.dropdown-container1 {
	display: none;

	padding-left: 8px;
	}
	/* Optional: Style the caret down icon */
	.fa-caret-down {
	float: right;
	padding-right: 8px;
	}

	/* Some media queries for responsiveness */
	@media screen and (max-height: 450px) {
	.sidenav {padding-top: 15px;}
	.sidenav a {font-size: 18px;}
	}
</style>

	<!-- Sidebar wrapper start -->
	<nav id="sidebar" class="sidebar-wrapper" style="background-color:#009688;">
		
		<!-- Sidebar brand start  -->
		<div class="sidebar-brand" style="background-color: #009688">
			<a href="javascript:void(0)" class="logo">
				<h2 class="ml-1" style="color: white">MARUDHAM</h2>
				<!-- <img src="img/logo.png" alt="Auction Dashboard" /> -->
			</a>
		</div>

		<div class="sidebar-content">

		<!-- sidebar menu start -->
		<div class="sidebar-menu">
			<ul>	
				<?php if($mastermodule == 0){?>
					<li class="sidebar-dropdown master">
						<a href="javascript:void(0)">
							<i class="icon-globe"></i>
							<span class="menu-text">Master</span>
						</a>
						<div class="sidebar-submenu" <?php if($current_module=='master') echo 'style="display:block" '; ?> >
							<ul>
								<?php if($company_creation == 0){?>
									<li>
										<a href="edit_company_creation"><i class="icon-assignment"></i>Company Creation</a>
									</li>
								<?php  }if($branch_creation == 0){ ?>
									<li>
										<a href="edit_branch_creation"><i class="icon-format_list_bulleted"></i>Branch Creation</a>
									</li>
								<?php  }if($loan_category == 0){ ?>
									<li>
										<a href="edit_loan_category"><i class="icon-package"></i>Loan Category</a>
									</li>
								<?php  }if($loan_calculation == 0){ ?>
									<li>
										<a href="edit_loan_calculation"><i class="icon-percent"></i>Loan Calculation</a>
									</li>
								<?php  }if($loan_scheme == 0){ ?>
									<li>
										<a href="edit_loan_scheme"><i class="icon-credit-card"></i>Loan Scheme</a>
									</li>
								<?php  }if($area_creation == 0){ ?>
									<li>
										<a href="edit_area_creation"><i class="icon-octagon"></i>Area Creation</a>
									</li>
								<?php  }if($area_mapping == 0){ ?>
									<li>
										<a href="edit_area_mapping"><i class="icon-documents"></i>Area Mapping</a>
									</li>
								<?php  }if($area_status == 0){ ?>
									<li>
										<a href="area_status"><i class="icon-check"></i>Area Approval</a>
									</li>
								<?php  }?>
							</ul>
						</div>
					</li>
				<?php  } ?>
				<?php if($adminmodule == 0){?>
					<li class="sidebar-dropdown administration">
						<a href="javascript:void(0)">
							<i class="icon-layers2"></i>
							<span class="menu-text">Administration</span>
						</a>
						<div class="sidebar-submenu" <?php if($current_module=='admin') echo 'style="display:block" '; ?>>
							<ul>
								<?php  if($director_creation == 0){ ?>
									<li>
										<a href="edit_director_creation"><i class="icon-event_note"></i>Director Creation</a>
									</li>
								<?php  }if($agent_creation == 0){ ?>
									<li>
										<a href="edit_agent_creation"><i class="icon-users"></i>Agent Creation</a>
									</li>
								<?php  }if($staff_creation == 0){ ?>
									<li>
										<a href="edit_staff_creation"><i class="icon-user-plus"></i>Staff Creation</a>
									</li>
								<?php  }if($bank_creation == 0){ ?>
									<li>
										<a href="edit_bank_creation"><i><object class="svg-icon" data="svg/bank.svg" type="image/svg+xml"></object></i>Bank Creation</a>
									</li>
								<?php  }if($manage_user == 0){ ?>
									<li>
										<a href="edit_manage_user"><i class="icon-cog"></i>Manage User</a>
									</li>
								<?php  }if($doc_mapping == 0){ ?>
									<!-- <li>
										<a href="edit_doc_mapping"><i class="icon-briefcase"></i>Documentation Mapping</a>
									</li> -->
								<?php  } ?>
							</ul>
						</div>
					</li>
				<?php  } ?>
				<?php if($requestmodule == 0){ ?>
					<li class="sidebar-dropdown request">
						<a href="javascript:void(0)">
							<i class="icon-playlist_add"></i>
							<span class="menu-text">Request</span>
						</a>
						<div class="sidebar-submenu" <?php if($current_module=='request') echo 'style="display:block" '; ?>>
							<ul>
								<?php  if($request == 0){ ?>
									<li>
										<a href="edit_request"><i class="icon-playlist_add"></i>Request</a>
									</li>
								<?php  } ?>

								

							</ul>
						</div>
					</li>
				<?php  } ?>
				<?php if($verificationmodule == 0){?>
					<li class="sidebar-dropdown request">
						<a href="javascript:void(0)">
							<i class="icon-recent_actors"></i>
							<span class="menu-text">Verification</span>
						</a>
						<div class="sidebar-submenu" <?php if($current_module=='verification') echo 'style="display:block" '; ?>>
							<ul>
								<?php  if($verification == 0){ ?>
									<li>
										<a href="verification_list"><i class="icon-recent_actors"></i>Verification</a>
									</li>
								<?php  } ?>
							</ul>
						</div>
					</li>
				<?php  } ?>
				<?php if($approvalmodule == 0){?>
					<li class="sidebar-dropdown approve">
						<a href="javascript:void(0)">
							<i class="icon-offline_pin"></i>
							<span class="menu-text">Approval</span>
						</a>
						<div class="sidebar-submenu" <?php if($current_module=='approval') echo 'style="display:block" '; ?>>
							<ul>
								<?php  if($approval == 0){ ?>
									<li>
										<a href="approval_list"><i class="icon-offline_pin"></i>Approval</a>
									</li>
								<?php  } ?>
							</ul>
						</div>
					</li>
				<?php  } ?>
				<?php if($acknowledgementmodule == 0){?>
                    <li class="sidebar-dropdown acknowledge">
                        <a href="javascript:void(0)">
                            <i class="icon-accessibility"></i>
                            <span class="menu-text">Acknowledgement</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='acknowledgement') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($acknowledgement == 0){ ?>
                                    <li>
                                        <a href="edit_acknowledgement_list"><i class="icon-accessibility"></i>Acknowledgement</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
				<?php if($loanissuemodule == 0){?>
                    <li class="sidebar-dropdown acknowledge">
                        <a href="javascript:void(0)">
							<i><object class="svg-icon" data="svg/issue.svg" type="image/svg+xml"></object></i>
                            <span class="menu-text">Loan Issue</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='loanissue') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($loan_issue == 0){ ?>
                                    <li>
                                        <a href="edit_loan_issue"><i><object class="svg-icon" data="svg/issue.svg" type="image/svg+xml"></object></i>Loan Issue</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
				<?php if($collectionmodule == 0){?>
                    <li class="sidebar-dropdown acknowledge">
                        <a href="javascript:void(0)">
						<i><object class="svg-icon" data="svg/collection.svg" type="image/svg+xml"></object></i>
                            <span class="menu-text">Collection</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='collection') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($collection == 0){ ?>
                                    <li>
                                        <a href="edit_collection"><i><object class="svg-icon" data="svg/collection.svg" type="image/svg+xml"></object></i>Collection</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
				<?php if($closedmodule == 0){?>
                    <li class="sidebar-dropdown closed">
                        <a href="javascript:void(0)">
							<i><object class="svg-icon" data="svg/closed.svg" type="image/svg+xml"></object></i>
                            <span class="menu-text">Closed</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='closed') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($closed == 0){ ?>
                                    <li>
                                        <a href="edit_closed"><i><object class="svg-icon" data="svg/closed.svg" type="image/svg+xml"></object></i>Closed</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
				<?php if($nocmodule == 0){?>
                    <li class="sidebar-dropdown acknowledge">
                        <a href="javascript:void(0)">
							<i><object class="svg-icon" data="svg/noc.svg" type="image/svg+xml"></object></i>
                            <span class="menu-text">NOC</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='noc') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($noc == 0){ ?>
                                    <li>
                                        <a href="edit_noc"><i><object class="svg-icon" data="svg/noc.svg" type="image/svg+xml"></object></i>NOC</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
				<?php if($concernmodule == 0){ ?>
                    <li class="sidebar-dropdown ">
                        <a href="javascript:void(0)">
							<i><object class="svg-icon" data="svg/update.svg" type="image/svg+xml"></object></i>
                            <span class="menu-text">Update</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='concerncreation') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($concern_creation == 0){ ?>
                                    <li>
                                        <a href="edit_update"><i><object class="svg-icon" data="svg/update.svg" type="image/svg+xml"></object></i>Update</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
				<?php if($concernmodule == 0){ ?>
                    <li class="sidebar-dropdown ">
                        <a href="javascript:void(0)">
							<i><object class="svg-icon" data="svg/concern.svg" type="image/svg+xml"></object></i>
                            <span class="menu-text">Concern</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='concerncreation') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($concern_creation == 0){ ?>
                                    <li>
                                        <a href="edit_concern_creation"><i><object class="svg-icon" data="svg/concern.svg" type="image/svg+xml"></object></i>Concern Creation</a>
                                    </li>
                                <?php  } ?>
                                <?php  if($concern_solution == 0){ ?>
                                    <li>
                                        <a href="edit_concern_solution"><i><object class="svg-icon" data="svg/concern.svg" type="image/svg+xml"></object></i>Concern Solution</a>
                                    </li>
                                <?php  } ?>
								<?php  if($concern_feedback == 0){ ?>
                                    <li>
                                        <a href="edit_concern_feedback"><i><object class="svg-icon" data="svg/concern.svg" type="image/svg+xml"></object></i>Concern Feedback</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
				<?php if($accountsmodule == 0){ ?>
                    <li class="sidebar-dropdown ">
                        <a href="javascript:void(0)">
							<i><object class="svg-icon" data="svg/accounts.svg" type="image/svg+xml"></object></i>
                            <span class="menu-text">Accounts</span>
                        </a>
                        <div class="sidebar-submenu" <?php if($current_module=='accounts') echo 'style="display:block" '; ?>>
                            <ul>
                                <?php  if($cash_tally == 0){ ?>
                                    <li>
                                        <a href="cash_tally"><i><object class="svg-icon" data="svg/cash_tally.svg" type="image/svg+xml"></object></i>Cash Tally</a>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </li>
                <?php  } ?>
			</ul>
		</div>
		<!-- sidebar menu end -->
	</div>
</nav>
	<!-- Sidebar wrapper end -->

<?php //$current_page = $_GET[''];?>
	<!-- <input type="hidden" id='current_page' name='current_page' value="<?php //echo $current_page; ?>" -->

<?php
$user_id        = '';
$full_name      = '';
$user_name      = '';
$password       = '';
$role           = '';
$role_type           = '';
$dir_name           = '';
$ag_name           = '';
$staff_name           = '';
$company_id           = '';
$branch_id           = '';
$line_id           = '';
$group_id           = '';
$mastermodule    = '';
$company_creation      = '';
$branch_creation = '';
$loan_category ='';
$loan_calculation   = '';
$loan_scheme   = '';
$area_creation        = '';
$area_mapping        = '';
$area_status        = '';
$adminmodule = '';
$director_creation = '';
$agent_creation = '';
$staff_creation = '';
$manage_user = '';
$doc_mapping = '';
$bank_creation = '';
$requestmodule = '';
$request = '';
$verificationmodule = '';
$verification = '';
$approvalmodule = '';
$approval = '';
$acknowledgementmodule = '';
$acknowledgement = '';
$loanissuemodule = '';
$loan_issue = '';
$collectionmodule = '';
$collection = '';
$closedmodule = '';
$closed = '';
$nocmodule = '';
$noc = '';
$concernmodule = '';
$concern_creation = '';
$concern_solution = '';
$concern_feedback = '';
$accountsmodule = '';
$cash_tally = '';
?>
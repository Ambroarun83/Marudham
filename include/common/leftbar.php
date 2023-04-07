<?php
if(isset($_SESSION["userid"])){
	$userid = $_SESSION["userid"];
}

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
$requestmodule = '';
$request = '';
$verification = '';

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
		$requestmodule          		     = $getUser['requestmodule'];
		$request          		     = $getUser['request'];
		$verification          		     = $getUser['verification'];
	}
}
?>

<style>
	body {
	font-family: "Lato", sans-serif;
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
						<div class="sidebar-submenu">
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
							<i class="icon-folder"></i>
							<span class="menu-text">Administration</span>
						</a>
						<div class="sidebar-submenu">
							<ul>
								<?php  if($director_creation == 0){ ?>
									<li>
										<a href="edit_director_creation"><i class="icon-list"></i>Director Creation</a>
									</li>
								<?php  }if($agent_creation == 0){ ?>
									<li>
										<a href="edit_agent_creation"><i class="icon-list"></i>Agent Creation</a>
									</li>
								<?php  }if($staff_creation == 0){ ?>
									<li>
										<a href="edit_staff_creation"><i class="icon-list"></i>Staff Creation</a>
									</li>
								<?php  }if($manage_user == 0){ ?>
									<li>
										<a href="edit_manage_user"><i class="icon-list"></i>Manage User</a>
									</li>
								<?php  }if($doc_mapping == 0){ ?>
									<li>
										<a href="edit_doc_mapping"><i class="icon-list"></i>Documentation Mapping</a>
									</li>
								<?php  } ?>
							</ul>
						</div>
					</li>
				<?php  } ?>
				<?php if($requestmodule == 0){?>
					<li class="sidebar-dropdown request">
						<a href="javascript:void(0)">
							<i class="icon-folder"></i>
							<span class="menu-text">Request</span>
						</a>
						<div class="sidebar-submenu">
							<ul>
								<?php  if($request == 0){ ?>
									<li>
										<a href="edit_request"><i class="icon-list"></i>Request</a>
									</li>
								<?php  } ?>

								<?php  if($verification == 0){ ?>
									<li>
										<a href="verification_list"><i class="icon-list"></i>Verification</a>
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
<script>
	
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
// var dropdown = document.getElementsByClassName("dropdown-btn");
// var i;

// for (i = 0; i < dropdown.length; i++) {
//   dropdown[i].addEventListener("click", function() {
//   this.classList.toggle("active");
//   var dropdownContent = this.nextElementSibling;
//   if (dropdownContent.style.display === "block") {
//   	dropdownContent.style.display = "none";
//   } else {
//   	dropdownContent.style.display = "block";
//   }
//   });
// }

// var dropdown1 = document.getElementsByClassName("dropdown-btn1");
// var i;

// for (i = 0; i < dropdown1.length; i++) {
//   dropdown1[i].addEventListener("click", function() {
// 	this.classList.toggle("active");
// 	var dropdownContent = this.nextElementSibling;
// 	if (dropdownContent.style.display === "block") {
// 		dropdownContent.style.display = "none";
// 	} else {
// 		dropdownContent.style.display = "block";
// 	}
//   });
// }

// Set a cookie to store the menu state
// function setMenuStateCookie(state,menu) {
//   document.cookie = "menuState=" + state + ";menu=" + menu ;alert(menu)
// }

// // Get the value of the menu state cookie
// function getMenuStateCookie() {
//   var name = "menuState=";
//   var decodedCookie = decodeURIComponent(document.cookie);
//   var ca = decodedCookie.split(';');
//   for(var i = 0; i <ca.length; i++) {
//     var c = ca[i];
//     while (c.charAt(0) == ' ') {
//       c = c.substring(1);
//     }
//     if (c.indexOf(name) == 0) {
//       return c.substring(name.length, c.length);
//     }
//   }
//   return "";
// }

// // Keep track of the menu state using a cookie
// var dropdowns = document.getElementsByClassName("master");
// for (var i = 0; i < dropdowns.length; i++) {
//   dropdowns[i].addEventListener("click", function() {
//     this.classList.toggle("active");
//     var dropdownContent = this.nextElementSibling;
//     if (dropdownContent.style.display === "block") {
//       dropdownContent.style.display = "none";
//       setMenuStateCookie("open","master");
//     } else {
//       dropdownContent.style.display = "block";
//       setMenuStateCookie("open","master");
//     }
//   });
// }
// // var dropdowns = document.getElementsByClassName("administration");
// // for (var i = 0; i < dropdowns.length; i++) {
// //   dropdowns[i].addEventListener("click", function() {
// //     this.classList.toggle("active");
// //     var dropdownContent = this.nextElementSibling;
// //     if (dropdowns.style.display === "block") {
// //       dropdowns.style.display = "none";
// //       setMenuStateCookie("open");
// //     } else {
// //       dropdowns.style.display = "block";
// //       setMenuStateCookie("open");
// //     }
// //   });
// // }

// // Set the initial menu state based on the cookie value
// window.onload = function() {
//   var menuState = getMenuStateCookie();
//   if (menuState === "open" ) {
//     document.querySelector(".master").classList.add("active");
//     // document.querySelector(".administration").classList.add("active");
//     document.querySelector(".sidebar-submenu").style.display = "block";
//     // document.querySelector(".administration .sidebar-submenu").style.display = "block";
//   }
// }
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
$requestmodule = '';
$request = '';
$verification = '';
?>
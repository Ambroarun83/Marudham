<?php	
date_default_timezone_set('Asia/Calcutta');
@session_start();

$id=0;
include("api/main.php");
$msg="";

/* Log In Start  */

if(isset($_POST['lusername'])) {  

	$username  = $_POST['lusername'];
	$password  =  $_POST['lpassword'];

	$qry     = "SELECT * FROM user WHERE user_name = '".$username."' AND user_password = '".$password."' and status=0"; 
	
	$res = mysqli_query($mysqli, $qry)or die("Error in Get All Records"); 
	$result = mysqli_fetch_array($res);
	if ($mysqli->affected_rows>0)
	{  
		$_SESSION['username']    = $result['user_name']; 
		$_SESSION['userid']      = $result['user_id']; 
		$_SESSION['fullname']    = $result['fullname']; 
		$_SESSION['request_list_access']    = $result['request_list_access']; 
		?>
		<script>location.href='<?php echo $HOSTPATH; ?>dashboard';</script>  
		<?php
	}	
	else
	{ 
		$msg="Enter Valid Email Id and Password";
	} 
}

?>

		<?php include("include/common/accounthead.php"); ?>
			<form  id="loginform" name="loginform" action="" method="post">
				<div class="row justify-content-md-center">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box">
								<a href="#" class="login-logo">
									<h3 style="color: #009688; padding-left: 12px;">MARUDHAM SOFTWARE</h3>
									<!-- <img src="img/logo.png" alt="Auction Dashboard" /> -->
								</a>
								<span class="text-danger" id="cinnocheck">		 
								<?php
								if($msg != '')
								{
									echo $msg;
								}
								?>
								</span>
								<h5>Welcome back,<br />Please Login to your Account.</h5>
								<div class="form-group mt-4">
									<label for="lusername">User Name</label>
									<input type="text" name="lusername" id="lusername"  tabindex="1"  class="form-control" value="" placeholder="Enter Email" />
									<span id="usernamecheck" class="text-danger">Enter Email</span>    
								</div>
								<div class="form-group mt-4">
									<label for="lpassword">Password</label>
									<input type="password" name="lpassword" id="lpassword"  tabindex="2"  class="form-control" value="" placeholder="Enter Password" />
									<span id="passwordcheck" class="text-danger">Enter Password</span>    
								</div>		
	
								<div class="actions" style="margin-top: 80px;">
									<button type="submit"  id="lbutton"  tabindex="6" name="lbutton" class="form-control btn btn-primary" >Login</button>
								</div>
								
								<hr>

							</div>
						</div>
					</div>
				</div>
			</form>
			<?php $current_page = isset($_GET['page']) ? $_GET['page'] : null; ?>
	
<?php include("include/common/dashboardfooter.php"); ?>
		
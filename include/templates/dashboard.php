<?php 
@session_start();
if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}
?>
<style>
.card {
	height: 80vh;
}


@media (max-width: 768px) {
	.card {
		height: 80vh;
	}
}

@media (max-width: 600px) {
	.card {
		height: 77vh;
	}
}
@media (max-width: 320px) {
	.card {
		height: 65vh;
	}
}


</style>
<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
        Marudham -  Dashboard 
   </div>
</div><br>
<!-- <div class="text-right" style="margin-right: 25px;">
    <a href="edit_bank_creation">
        <button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
    </a>
</div><br><br> -->
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id = "dashboard_form" name="dashboard_form" action="" method="post" enctype="multipart/form-data"> 
		
		<!-- Row start -->
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

				<div class="card">
					<div class="card-header">
						<div class="card-title"></div>
					</div>
					<div class="card-body" style="display:flex;justify-content:center;align-items: center;">
						<div class="row ">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group text-center">
									<h2>Marudham Dashboard</h2>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>



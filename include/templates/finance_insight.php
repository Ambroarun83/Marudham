<?php 
@session_start();
if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}
?>
<style>
.card {
  min-height: 80vh;
  margin: 10px;
}

.split-card {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}

@media (max-width: 992px) {
  .split-card {
    flex-wrap: wrap;
  }
  .card {
    flex: 0 0 45%; /* Each card will take 45% of the container's width */
    margin: 10px;
  }
}

@media (max-width: 768px) {
  .card {
    height: 50vh;
  }
}

@media (max-width: 576px) {
  .card {
    height: 30vh;
    flex: 0 0 100%; /* Each card will take 100% of the container's width */
  }
}


</style>
<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
        Marudham -  Financial Insights 
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
	<form id = "finance_insight_form" name="finance_insight_form" action="" method="post" enctype="multipart/form-data"> 
		
	<div class="row gutters">
		<div class="split-card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
				<div class="card-header">
					<div class="card-title">Balance Sheet</div>
				</div>
				<div class="card-body">
					<div class="row balance-sheet-card">
						
					</div>
				</div>
			</div>
			<div class="card col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
				<div class="card-header">
					<div class="card-title">Benefits</div>
				</div>
				<div class="card-body">
					<div class="row benefits-card">
						
					</div>
				</div>
			</div>
			<div class="card col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
				<div class="card-header">
					<div class="card-title">Benefits Check</div>
				</div>
				<div class="card-body">
					<div class="row benefits-check-card">
						
					</div>
				</div>
			</div>
		</div>
	</div>

	</form>
</div>



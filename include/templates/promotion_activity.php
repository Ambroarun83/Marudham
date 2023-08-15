<link rel="stylesheet" type="text/css" href="css/promotion_activity.css" />

<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
        Marudham -  Promotion Activity 
	</div>
</div><br>


<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id = "finance_insight_form" name="finance_insight_form" action="" method="post" enctype="multipart/form-data"> 
	
	<div class="row gutters">
		
		<div class="toggle-container col-12">
			<input type="button" class="toggle-button active" value='Existing'>
			<input type="button" class="toggle-button" value='New'>
			<input type="button" class="toggle-button" value= 'Repromotion'>
		</div>
	</div>

	<div class="row gutters existing_card" style="display:none">
		<div class="card col-12">
			<div class="card-header">Existing Customer</div>
			<div class="card-body">
				
			</div>
		</div>
	</div>

	<div class="row gutters new_card" style="display:none">
		<div class="card col-12">
			<div class="card-header">Promotion</div>
			<div class="card-body">
				<div class="row">
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
						<div class="form-group">
							<label for="cus_id">Customer ID</label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="cus_id" name="cus_id" value='' placeholder='Enter Customer ID'>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
						<div class="form-group">
							<label for="cus_name">Customer Name</label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="cus_name" name="cus_name" value='' placeholder='Enter Customer Name'>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
						<div class="form-group">
							<label for="cus_mobile">Mobile</label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="cus_mobile" name="cus_mobile" value='' placeholder='Enter Mobile Number'>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
						<div class="form-group">
							<button class="" id='search_cus' name='search_cus'>Search&nbsp;<i class="fa fa-search"></i>
						</div>
					</div>

					<div class="col-12">
						<div class="alert alert-danger" role="alert" style="display: none;">
							<div class="alert-text">Customer Already Existing!</div>
						</div> 
						<div class="alert alert-success" role="alert" style="display: none;">
							<div class="alert-text">Customer is New to Promotion!</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row gutters repromotion_card" style="display:none">
		<div class="card col-12">
			<div class="card-header">Repromotion</div>
			<div class="card-body">
				
			</div>
		</div>
	</div>

	</form>
</div>


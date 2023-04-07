
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .dropbtn {
		color: white;
		/* background-color: #009688; */
		/* padding: 10px; */
		font-size: 10px;
		border: none;
		cursor: pointer;
	}
	.dropdown {
		position: relative;
		display: inline-block;
	}
	.dropdown-content {
		display: none;
		position: absolute;
		right: 0;
		background-color: #F9F9F9;
		min-width: 160px;
		margin-top:-50px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
	}
	.dropdown-content a {
		color: black;
		padding: 10px 10px;
		text-decoration: none;
		display: block;
	}
	.dropdown-content a:hover {background-color: #fafafa;}
	.dropdown:hover .dropdown-content {
		display: block;
	}
	.dropdown:hover .dropbtn {
		background-color: #3E8E41;
	}
</style>

<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham -  Verification List 
	</div>
</div><br>
<!-- <div class="text-right" style="margin-right: 25px;">
    <a href="verification">
        <button type="button" class="btn btn-primary"><span class="icon-add"></span>&nbsp; Add verification</button>
    </a>
</div><br><br> -->
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container" >
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="table-container" >

				<div class="table-responsive">
					<?php
					$mscid=0;
					if(isset($_GET['msc']))
					{
					$mscid=$_GET['msc'];
					if($mscid==1)
					{?>
					<div class="alert alert-success" role="alert">
						<div class="alert-text">Customer Verfication Successful!</div>
					</div> 
					<?php
					}
					if($mscid==2)
					{?>
						<div class="alert alert-success" role="alert">
						<div class="alert-text">Verication Cancelled Successfully!</div>
					</div>
					<?php
					}
					if($mscid==3)
					{?>
					<div class="alert alert-danger" role="alert">
						<div class="alert-text">Verfication Removed Successfully!</div>
					</div>
					<?php
					}
					if($mscid==4)
					{?>
					<div class="alert alert-danger" role="alert">
						<div class="alert-text">Request Cancelled Successfully!</div>
					</div>
					<?php
					}
					if($mscid==8)
					{?>
					<div class="alert alert-danger" role="alert">
						<div class="alert-text">Request Revoked Successfully!</div>
					</div>
					<?php
					}
					}
					?>
					<table id="verification_table" class="table custom-table" >
						<thead>
							<tr>
								<th width="50">S.No.</th>
								<th>Requested Date</th>
								<th>Customer ID</th>
								<th>Customer Name</th>
								<th>Branch</th>
								<th>Group</th>
								<th>Line</th>
								<th>Area</th>
								<th>Sub Area</th>
								<th>Loan Category</th>
								<th>Sub Category</th>
								<th>Loan Amount</th>
								<th>User Type</th>
								<th>User</th>
								<th>Agent Name</th>
								<th>Responsible</th>
								<th>Customer Data</th>
								<th>Customer Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Row end -->
</div>
<!-- Main container end -->

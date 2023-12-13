<style>
	.table thead th{
		vertical-align: middle !important; 
	}
</style>

<br><br>
<div class="page-header">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham - Search
	</div>

</div><br>

<div class="text-right" style="margin-right: 25px;">
	<!-- <button class="btn btn-primary" id='close_history_card' style="display: none;" >&times;&nbsp;&nbsp;Cancel</button> -->
</div>

<!-- Main container start -->
<div class="main-container">
	<!--form start-->
	<form id="search_module_form" name="search_module_form" action="" method="post" enctype="multipart/form-data">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="card">
					<div class="card-header">Search Customer</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="cus_id">Customer ID</label>
											<input type="text" class="form-control" id="cus_id" name="cus_id" placeholder="Enter Customer ID" maxlength="14">
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="cus_name">Customer Name</label>
											<input type="text" class="form-control" id="cus_name" name="cus_name" placeholder="Enter Customer Name">
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="cus_area">Area</label>
											<input type="text" class="form-control" id="cus_area" name="cus_area" placeholder="Enter Area">
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="cus_sub_area">Sub Area</label>
											<input type="text" class="form-control" id="cus_sub_area" name="cus_sub_area" placeholder="Enter Sub Area">
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="mobile">Mobile Number</label>
											<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number">
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="text-align:center">
										<div class="form-group">
											<label for="" style="visibility:hidden"></label>
											<!-- <input type="button" class="form-control btn btn-primary" id="search" name="search" value="Search" data-toggle="modal" data-target="#customerDetailModal"> -->
											<input type="button" class="form-control btn btn-primary" id="search" name="search" value="Search">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card " id="customer_list_card" style="display: none;">
					<div class="card-header">Customer List</div>
					<div class="card-body">
						<div id="customer_list" style="overflow-x:auto">
							<table class="table custom-table">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Customer ID</th>
										<th>Customer Name</th>
										<th>Area</th>
										<th>Sub Area</th>
										<th>Branch</th>
										<th>Line</th>
										<th>Group</th>
										<th>Mobile 1</th>
										<th>Mobile 2</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>


<!-- Modal for Customer Status   -->
<div class="modal fade" id="customerStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Customer Status</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid" id='customerStatusDiv'>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th rowspan="2">S.No</th>
								<th rowspan="2">Date</th>
								<th rowspan="2">Req ID/Loan ID</th>
								<th rowspan="2">Loan Category</th>
								<th rowspan="2">Sub Category</th>
								<th rowspan="2">Loan Amount</th>
								<th colspan="2">Loan Status</th>
								<th colspan="4">Document Status</th>
							</tr>
							<tr>
								<th>Status</th>
								<th>Sub Status</th>
								<th>Status</th>
								<th>Info</th>
								<th>Chart</th>
								<th>Summary</th>
							</tr>
						</thead>
						<tbody>
							<!-- <tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr> -->
						</tbody>
					</table>

				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" tabindex="">Close</button>
			</div>
		</div>
	</div>
</div>
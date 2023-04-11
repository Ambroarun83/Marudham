<?php $current_page = isset($_GET['page']) ? $_GET['page'] : null; ?>

<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/jspdf.js"></script>
<script src="js/xlsx.js"></script>
<script src="vendor/apex/apexcharts.min.js"></script>

<script src="js/logincreation.js"></script>

<!-- Slimscroll JS -->
<script src="vendor/slimscroll/slimscroll.min.js"></script>
<script src="vendor/slimscroll/custom-scrollbar.js"></script>
 
<!-- Daterange -->
<script src="vendor/daterange/daterange.js"></script>
<script src="vendor/daterange/custom-daterange.js"></script>

<script src="vendor/bs-select/bs-select.min.js"></script>
<!-- Font -->
<script src="js/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!-- Multi select Plugin -->
<script src="vendor/multiselect/public/assets/scripts/choices.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.7/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript" src="jsd/datatables.min.js"></script>
<script type="text/javascript" language="javascript">

$(document).ready(function() {
		var company_creation_table = $('#company_creation_table').DataTable({
			"order": [[ 0, "desc" ]],
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			//'searching': false, // Remove default Search Control
			'ajax': {
				'url':'ajaxFetch/ajaxCompanyCreationFetch.php',
				'data': function(data){
					var search = $('#search').val();
					data.search = search;
				}
			},
			
			dom: 'lBfrtip', 
			buttons: [	
				// {
				// 	extend: 'csv',
				// 	exportOptions: {
				// 		columns: [ 0, 1, 2 ,3, 4, 5, 6, 7, 8, 9 ]
				// 	}
				// },
				{
					extend: 'excel',
					title: "Company List"
				},
				{		 
					extend:'colvis',
					collectionLayout: 'fixed four-column',
				},

			],	
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			]
		});

		var loan_creation_table = $('#loan_creation_table').DataTable({
			"order": [[ 0, "desc" ]],
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			//'searching': false, // Remove default Search Control
			'ajax': {
				'url':'ajaxFetch/ajaxLoanCategoryFetch.php',
				'data': function(data){
					var search = $('#search').val();
					data.search = search;
				}
			},
			
			dom: 'lBfrtip', 
			buttons: [		
				// {
				// 	extend: 'csv',
				// 	exportOptions: {
				// 		columns: [ 0, 1, 2 ,3, 4, 5, 6, 7, 8, 9 ]
				// 	}
				// },
				{
					extend: 'excel',
					title: "Loan Category List"
				},
				{		 
					extend:'colvis',
					collectionLayout: 'fixed four-column',
				}

			],	
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			]
		});

		var branch_creation_info = $('#branch_creation_info').DataTable({
			"order": [[ 0, "desc" ]],
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			//'searching': false, // Remove default Search Control
			'ajax': {
				'url':'ajaxFetch/ajaxBranchCreationFetch.php',
				'data': function(data){
					var search = $('#search').val();
					data.search = search;
				}
			},
			
			dom: 'lBfrtip', 
			buttons: [		
				// {
				// 	extend: 'csv',
				// 	exportOptions: {
				// 		columns: [ 0, 1, 2 ,3, 4, 5, 6, 7, 8, 9 ]
				// 	}
				// },
				{
					extend: 'excel',
					title: "Branch List"
				},
				{		 
					extend:'colvis',
					collectionLayout: 'fixed four-column',
				}

			],	
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			]
		});

		var area_creation_info = $('#area_creation_info').DataTable({
			"order": [[ 0, "desc" ]],
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			//'searching': false, // Remove default Search Control
			'ajax': {
				'url':'ajaxFetch/ajaxAreaCreationFetch.php',
				'data': function(data){
					var search = $('#search').val();
					data.search = search;
				}
			},
			
			dom: 'lBfrtip', 
			buttons: [		
				// {
				// 	extend: 'csv',
				// 	exportOptions: {
				// 		columns: [ 0, 1, 2 ,3, 4, 5, 6, 7, 8, 9 ]
				// 	}
				// },
				{
					extend: 'excel',
					title: "Area List"
				},
				{		 
					extend:'colvis',
					collectionLayout: 'fixed four-column',
				}

			],	
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			]
		});

        // Loan Calculation datatable
        var loan_calculation_info = $('#loan_calculation_info').DataTable({
            "order": [[ 0, "desc" ]],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            //'searching': false, // Remove default Search Control
            'ajax': {
                'url':'ajaxFetch/ajaxLoanCalculationFetch.php',
                'data': function(data){
                    var search = $('#search').val();
                    // Append to data
                    data.search      = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [ 0, 1, 2 ,3,4,5,6,7,8,9,10,11]
                //     }
                // },
                {
                    extend: 'excel',
                    title: "Loan Calculation List"
                },
                {
                    extend:'colvis',
                    collectionLayout: 'fixed four-column',
                },
                // {
                // 	extend:'print',
                // 	exportOptions: {
                // 		columns: [ 0, 1, 2 ,3,4,5,6,7,8,9,10]
                // }
                // }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        
    
    
        // Director Creation datatable
        var director_creation_table = $('#director_creation_table').DataTable({
            "order": [[ 0, "desc" ]],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'ajaxFetch/ajaxDirectorCreationFetch.php',
                'data': function(data){
                    var search = $('#search').val();
                    data.search      = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [ 0, 1, 2 ,3,4,5,6,7,8,9,10,11]
                //     }
                // },
                {
                    extend: 'excel',
                    title: "Loan Scheme List"
                },
                {
                    extend:'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
        // Agent Creation datatable
        var agent_creation_table = $('#agent_creation_table').DataTable({
            "order": [[ 0, "desc" ]],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'ajaxFetch/ajaxAgentCreationFetch.php',
                'data': function(data){
                    var search = $('#search').val();
                    data.search      = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [ 0, 1, 2 ,3,4,5,6,7,8,9,10,11]
                //     }
                // },
                {
                    extend: 'excel',
                    title: "Loan Scheme List"
                },
                {
                    extend:'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            
        });
        // Staff Creation datatable
        var staff_creation_table = $('#staff_creation_table').DataTable({
            "order": [[ 0, "desc" ]],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'ajaxFetch/ajaxStaffCreationFetch.php',
                'data': function(data){
                    var search = $('#search').val();
                    data.search      = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [ 0, 1, 2 ,3,4,5,6,7,8,9,10,11]
                //     }
                // },
                {
                    extend: 'excel',
                    title: "Loan Scheme List"
                },
                {
                    extend:'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            
        });

        // Manage user datatable
        var manage_user_table = $('#manage_user_table').DataTable({
            "order": [[ 0, "desc" ]],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'ajaxFetch/ajaxManageUserFetch.php',
                'data': function(data){
                    var search = $('#search').val();
                    data.search      = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: [ 0, 1, 2 ,3,4,5,6,7,8,9,10,11]
                //     }
                // },
                {
                    extend: 'excel',
                    title: "Loan Scheme List"
                },
                {
                    extend:'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            
        });
        // Documentation Mapping datatable
        var doc_mapping_table = $('#doc_mapping_table').DataTable({
            "order": [[ 0, "desc" ]],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'ajaxFetch/ajaxDocumentationMappingFetch.php',
                'data': function(data){
                    var search = $('#search').val();
                    data.search      = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    title: "Loan Scheme List"
                },
                {
                    extend:'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            
        });
        // Request datatable
        var request_table = $('#request_table').DataTable({
            "order": [[ 0, "desc" ]],
            "ordering": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'ajaxFetch/ajaxRequestFetch.php',
                'data': function(data){
                    var search = $('#search').val();
                    data.search      = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    title: "Loan Scheme List"
                },
                {
                    extend:'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            // "columnDefs": [ {
            //     "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
            //     "orderable": false
            // } ]
            
        });
        

        // Verification datatable
        var verification_table = $('#verification_table').DataTable({
            "order": [
                [0, "desc"]
            ],
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajaxFetch/ajaxVerificationFetch.php',
                'data': function(data) {
                    var search = $('#search').val();
                    data.search = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    title: "Loan Scheme List"
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });
        
        $('#search').change(function(){
            company_creation_table.draw();
            loan_creation_table.draw();
            branch_creation_info.draw();
            area_creation_info.draw();
            loan_calculation_info.draw();
            loan_scheme_monthly_table.draw();
            director_creation_table.draw();
            staff_creation_table.draw();
            manage_user_table.draw();
            doc_mapping_table.draw();
            request_table.draw();
            verification_table.draw();
        });
        
});//Document Ready End
</script>

<?php 
// Master Module
if($current_page == 'company_creation') { ?>
<script src="js/company_creation.js"></script>
<?php }

if($current_page == 'branch_creation') { ?>
<script src="js/branch_creation.js"></script>
<?php }

if($current_page == 'loan_category') { ?>
<script src="js/loan_category.js"></script>
<?php }

if($current_page == 'loan_calculation') { ?>
<script src="js/loan_calculation.js"></script>
<?php }

if($current_page == 'loan_scheme') { ?>
<script src="js/loan_scheme.js"></script>
<?php }
if($current_page == 'edit_loan_scheme') { ?>
<script src="js/edit_loan_scheme.js"></script>
<?php }

if($current_page == 'area_creation') { ?>
<script src="js/area_creation.js"></script>
<?php }

if($current_page == 'area_mapping') { ?>
<script src="js/area_mapping.js"></script>
<?php }
if($current_page == 'edit_area_mapping') { ?>
<script src="js/edit_area_mapping.js"></script>
<?php }

if($current_page == 'area_status') { ?>
<script src="js/area_status.js"></script>
<?php }

// Administration Module

if($current_page == 'director_creation') { ?>
    <script src="js/director_creation.js"></script>
    <?php }

if($current_page == 'agent_creation') { ?>
    <script src="js/agent_creation.js"></script>
    <?php }

if($current_page == 'staff_creation') { ?>
    <script src="js/staff_creation.js"></script>
    <?php }

if($current_page == 'manage_user') { ?>
    <script src="js/manage_user.js"></script>
    <?php }

if($current_page == 'doc_mapping') { ?>
    <script src="js/doc_mapping.js"></script>
    <?php }

// Request Module
if($current_page == 'request') { ?>
    <script src="js/request.js"></script>
    <?php }
if($current_page == 'edit_request') { ?>
    <script src="js/edit_request.js"></script>
    <?php }
    
if($current_page == 'verification') { ?>
    <script src="js/verification.js"></script>
    <?php }
    
if($current_page == 'verification_list') { ?>
    <script src="js/verification_list.js"></script>
    <?php }

?> 

<script src="js/logincreation.js"></script>

<!-- Slimscroll JS -->
<script src="vendor/slimscroll/slimscroll.min.js"></script>
<script src="vendor/slimscroll/custom-scrollbar.js"></script>


<!-- Datepickers -->
<script src="vendor/datepicker/js/picker.js"></script>
<script src="vendor/datepicker/js/picker.date.js"></script>
<script src="vendor/datepicker/js/custom-picker.js"></script>

<script type="text/javascript">
	// item delete
    $(document).on("click", '.delete_company', function(){
        var dlt = confirm("Do you want to delete this Company ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });

	// loan category delete
    $(document).on("click", '.delete_loan_calculation', function(){
        var dlt = confirm("Do you want to delete this Loan Category ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
	// loan category delete
    $(document).on("click", '.loan_category_delete', function(){
        var dlt = confirm("Do you want to delete this Loan Category ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
	
	// Branch Creation delete
    $(document).on("click", '.delete_branch', function(){
        var dlt = confirm("Do you want to delete this Branch ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
	// Area Creation delete
    $(document).on("click", '.delete_area', function(){
        var dlt = confirm("Do you want to delete this Area ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
	// Loan Scheme delete
    $(document).on("click", '.delete_loan_scheme', function(){
        var dlt = confirm("Do you want to delete this Scheme ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
	// Area Mapping delete
    $(document).on("click", '.delete_area_mapping', function(){
        var dlt = confirm("Do you want to delete this Mapping ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
	
    // Director creation delete
    $(document).on("click", '.delete_dir', function(){
        var dlt = confirm("Do you want to delete this Director ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    // Agent creation delete
    $(document).on("click", '.delete_ag', function(){
        var dlt = confirm("Do you want to delete this Agent ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    // Staff creation delete
    $(document).on("click", '.delete_staff', function(){
        var dlt = confirm("Do you want to delete this Staff ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    // Manage user delete
    $(document).on("click", '.delete_user', function(){
        var dlt = confirm("Do you want to delete this User ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    // Documentation Mapping delete
    $(document).on("click", '.delete_doc_mapping', function(){
        var dlt = confirm("Do you want to delete this Documentation Mapping ?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    
    // Request Actions
    $(document).on("click", '.cancelrequest', function(){
        var dlt = confirm("Do you want to Cancel this Request?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    $(document).on("click", '.revokerequest', function(){
        var dlt = confirm("Do you want to Revoke this Request?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    $(document).on("click", '.removerequest', function(){
        var dlt = confirm("Do you want to Remove this Request?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });

    // Verification Actions
    $(document).on("click", '.cancelverification', function(){
        var dlt = confirm("Do you want to Cancel this Verification?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });
    $(document).on("click", '.removeverification', function(){
        var dlt = confirm("Do you want to Remove this Verification?");
        if(dlt){
                return true;
            }else{
                return false;
            }
    });


</script>

<script>
	setTimeout(function() {
		$('.alert').fadeOut('slow');
	}, 2000);
</script>

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
            "ordering": false,
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
            "ordering": false,
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
            "ordering": false,
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
            "ordering": false,
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
            "ordering": false,
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
            "ordering": false,
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
                    title: "Director List"
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
            "ordering": false,
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
                    title: "Agent List"
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
            "ordering": false,
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
                    title: "Staff List"
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
            "ordering": false,
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
                    title: "User List"
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
            "ordering": false,
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
                    title: "Documentation Mapping List"
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
                    title: "Request List"
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
            "ordering": false,
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
                    title: "Verification List"
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


        // Approval datatable
        var approval_table = $('#approval_table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "ordering": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajaxFetch/ajaxApprovalFetch.php',
                'data': function(data) {
                    var search = $('#search').val();
                    data.search = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    title: "Approval List"
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

        // Acknowledgement List
        var acknowledge_table = $('#acknowledge_table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "ordering": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajaxFetch/ajaxAcknowledgementFetch.php',
                'data': function(data) {
                    var search = $('#search').val();
                    data.search = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    title: "Acknowledgement List"
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
        
        // Loan Issue List
        var loanIssue_table = $('#loanIssue_table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "ordering": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajaxFetch/ajaxLoanIssueFetch.php',
                'data': function(data) {
                    var search = $('#search').val();
                    data.search = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    title: "Loan Issue List"
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
        // Collection List
        var collection_table = $('#collection_table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "ordering": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajaxFetch/ajaxCollectionFetch.php',
                'data': function(data) {
                    var search = $('#search').val();
                    data.search = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    title: "Collection List"
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

        // Closed
        var closed_table = $('#closed_table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "ordering": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajaxFetch/ajaxClosedFetch.php',
                'data': function(data) {
                    var search = $('#search').val();
                    data.search = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    title: "Closed List"
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

        //NOC Table
        var noc_table = $('#noc_table').DataTable({
            "order": [
                [0, "desc"]
            ],
            "ordering": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajaxFetch/ajaxNocFetch.php',
                'data': function(data) {
                    var search = $('#search').val();
                    data.search = search;
                }
            },
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'excel',
                    title: "NOC List"
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed four-column',
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
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
            approval_table.draw();
            acknowledge_table.draw();
            loanIssue_table.draw();
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

if($current_page == 'approval_list') { ?>
    <script src="js/approval_list.js"></script>
    <?php }

//Acknowledgement screen
if($current_page == 'edit_acknowledgement_list') { ?>
    <script src="js/edit_acknowledgement_list.js"></script>
    <?php }

if($current_page == 'acknowledgement_creation') { ?>
    <script src="js/acknowledgement_creation.js"></script>
    <?php }

//Loan Issue screen
if($current_page == 'edit_loan_issue') { ?>
    <script src="js/edit_loan_issue.js"></script>
    <?php }

if($current_page == 'loan_issue') { ?>
    <script src="js/loan_issue.js"></script>
    <?php }

if($current_page == 'collection') { ?>
    <script src="js/collection.js"></script>
    <?php }

if($current_page == 'noc') { ?>
    <script src="js/noc.js"></script>
    <?php }

//Closed
if($current_page == 'edit_closed') { ?>
    <script src="js/edit_closed.js"></script>
    <?php }

if($current_page == 'closed') { ?>
    <script src="js/closed.js"></script>
    <?php }
?>
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

    // Approval Actions
    $(document).on("click", '.cancelapproval', function(){
        var aprvedlt = confirm("Do you want to Cancel this Approval?");
        if(aprvedlt){
                return true;
            }else{
                return false;
            }
    });

    $(document).on("click", '.removeapproval', function(){
        var appdlt = confirm("Do you want to Remove this Approval?");
        if(appdlt){
                return true;
            }else{
                return false;
            }
    });

    $(document).on("click", '.ack-cancel', function(){
        var appdlt = confirm("Do you want to Cancel this Acknowledgement?");
        if(appdlt){
                return true;
            }else{
                return false;
            }
    });
    $(document).on("click", '.ack-remove', function(){
        var appdlt = confirm("Do you want to remove this Acknowledgement?");
        if(appdlt){
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
    
    // $('input').attr('autocomplete','off');


    function moneyFormatIndia(num) {
        var explrestunits = "";
        if (num.toString().length > 3) {
            var lastthree = num.toString().substr(num.toString().length - 3);
            var restunits = num.toString().substr(0, num.toString().length - 3);
            restunits = (restunits.length % 2 == 1) ? "0" + restunits : restunits;
            var expunit = restunits.match(/.{1,2}/g);
            for (var i = 0; i < expunit.length; i++) {
                if (i == 0) {
                    explrestunits += parseInt(expunit[i]) + ",";
                } else {
                    explrestunits += expunit[i] + ",";
                }
            }
            var thecash = explrestunits + lastthree;
        } else {
            var thecash = num;
        }
        return thecash;
    }

</script>

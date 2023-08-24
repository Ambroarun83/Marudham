
<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham -  Due Follow Up
	</div>
</div><br>

<!-- Main container start -->
<div class="main-container" >
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="table-container" >
				<div class="table-responsive">
					<table id="due_followup_table" class="table custom-table" >
						<thead>
							<tr>
								<th width="50">S.No.</th>
								<th>Customer ID</th>
								<th>Customer Name</th>
								<th>Area</th>
								<th>Sub Area</th>
								<th>Branch</th>
								<th>Line</th>
								<th>Mobile</th>
								<th>Action</th>
								<th>Last Paid Date</th>
								<th>Hint</th>
								<th>Commitment Date</th>
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
<div id="printcollection" style="display: none"></div>

<script>
	function enableDateColoring(){
		//for coloring
		$('#due_followup_table tbody tr').not('th').each(function(){
			let tddate = $(this).find('td:eq(11)').text(); // Get the text content of the 11th td element (Follow date)
			let datecorrection = tddate.split("-").reverse().join("-").replaceAll(/\s/g, ''); // Correct the date format
			let values = new Date(datecorrection); // Create a Date object from the corrected date
			values.setHours(0, 0, 0, 0); // Set the time to midnight for accurate date comparison

			let curDate = new Date(); // Get the current date
			curDate.setHours(0, 0, 0, 0); // Set the time to midnight for accurate date comparison

			let colors = {'past':'FireBrick','current':'DarkGreen','future':'CornflowerBlue'}; // Define colors for different date types

			if(tddate != '' && values != 'Invalid Date'){ // Check if the extracted date and the created Date object are valid

				if(values < curDate){ // Compare the extracted date with the current date
					$(this).find('td:eq(11)').css({'background-color':colors.past, 'color':'white'}); // Apply styling for past dates
				}else if(values > curDate){
					$(this).find('td:eq(11)').css({'background-color': colors.future, 'color':'white'}); // Apply styling for future dates
				}else {
					$(this).find('td:eq(11)').css({'background-color':colors.current, 'color':'white'}); // Apply styling for the current date
				}
			}
		});
	}
</script>

<script>
	var sortOrder = 1; // 1 for ascending, -1 for descending

	document.querySelectorAll('th').forEach(function(th) {
	th.addEventListener('click', function() {
		var columnIndex = this.cellIndex;
		document.querySelector('tbody').innerHTML = '';
		dT();
		setTimeout(function() {
		var tableRows = Array.prototype.slice.call(document.querySelectorAll('tbody tr'));

		tableRows.sort(function(a, b) {
			var textA = a.querySelectorAll('td')[columnIndex].textContent.toUpperCase();
			var textB = b.querySelectorAll('td')[columnIndex].textContent.toUpperCase();

			if (textA < textB) {
			return -1 * sortOrder;
			}
			if (textA > textB) {
			return 1 * sortOrder;
			}
			return 0;
		});

		tableRows.forEach(function(row) {
			document.querySelector('tbody').appendChild(row);
		});

		sortOrder = -1 * sortOrder;

		// update the serial numbers
		document.querySelectorAll('tbody tr').forEach(function(row, index) {
			row.querySelectorAll('td')[0].textContent = index + 1;
		});
		}, 1000);
	});
	});

	function dT() {
		// Collection datatable
		var due_followup_table = $('#due_followup_table').DataTable();
		due_followup_table.destroy();
		var due_followup_table = $('#due_followup_table').DataTable({
			"order": [[ 0, "desc" ]],
			"ordering": false,
			'paging':false,
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': {
			'url': 'ajaxFetch/ajaxDueFollowupFetch.php',
			'data': function(data) {
				var search = document.querySelector('#search').value;
				data.search = search;
			}
			},
			dom: 'lBfrtip',
			buttons: [
			{
				extend: 'excel',
				title: "Due Followup"
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
			// "columnDefs": [ {
			//     "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
			//     "orderable": false
			// } ]

		});
	}
	var id = $('#id').val();
	if(id != 0){
		setTimeout(()=>{
			Swal.fire({
				title: 'Print',
				text: 'Do you want to print this collection?',
				// icon: 'question',
				// showConfirmButton: true,
				// confirmButtonColor: '#009688',
				imageUrl: 'img/printer.png',
				imageWidth: 300,
				imageHeight: 210,
				imageAlt: 'Custom image',
				showCancelButton: true,
				confirmButtonColor: '#009688',
				cancelButtonColor: '#d33',
				cancelButtonText: 'No',
				confirmButtonText: 'Yes'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url:'collectionFile/print_collection.php',
						data:{'coll_id':id},
						type:'post',
						cache:false,
						success:function(html){
							$('#printcollection').html(html)
							// Get the content of the div element
							var content = $("#printcollection").html();

							// Create a new window
							var w = window.open();

							// Write the content to the new window
							$(w.document.body).html(content);

							// Print the new window
							w.print();

							// Close the new window
							w.close();
						}
					})
				}
			})
		},2000)
	}
</script>
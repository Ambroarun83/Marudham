$(document).ready(function(){

    dueFollowuptableFetch();
    getFilterInputs();

    {
        let curDate = new Date();
        $('#by_comm_date').attr('min', curDate.getFullYear()+'-0'+(curDate.getMonth()+1)+'-'+curDate.getDate()); // setting minimum date for to date, so before start date will be disabled
    }
});



function dueFollowuptableFetch(){
    showOverlay();
    $.ajax({
		//in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
		url: 'followupFiles/dueFollowup/ajaxDueFollowupFetch.php',
		data: {},
		type:'post',
		cache: false,
		success: function(response){
			$('#dueFollwupDiv').empty()
			$('#dueFollwupDiv').html(response);
            hideOverlay();
		}
	}).then(function(){
		enableDateColoring();
        showOverlay();
        setTimeout(() => {
			$('#due_followup_table').DataTable({
				'processing': true,
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
				],
			});
            hideOverlay();
		}, 1500);
	});
}

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

function getFilterInputs(){
    //to get filter modal inputs 

    $.post('followupFiles/dueFollowup/getFilterInputs.php',function(response){
        
        $('#by_branch,#loan_cat,#agent').empty().append(`<option value="">Select Branch Name</option>`)
        for(let i=0; i<response['branch'].length; i++){
            $('#by_branch').append(`<option value="${response['branch'][i].id}">${response['branch'][i].name}</option>`)
        }
        for(let i=0; i<response['loan_cat'].length; i++){
            $('#by_loan_cat').append(`<option value="${response['loan_cat'][i].id}">${response['loan_cat'][i].name}</option>`)
        }
        for(let i=0; i<response['agent'].length; i++){
            $('#by_agent').append(`<option value="${response['agent'][i].id}">${response['agent'][i].name}</option>`)
        }


        $('#by_branch').change(function(){
            if($(this).val() == ''){
                $('#by_line').empty().append(`<option value="">Select Line</option>`)
                return;
            }else{
                $('#by_line').empty().append(`<option value="">Select Line</option>`)
                for(let i=0; i<response['line'].length; i++){
                    if(response['line'][i].branch_id == $('#by_branch').val()){
                        $('#by_line').append(`<option value="${response['line'][i].id}">${response['line'][i].name}</option>`)
                    }
                
                }
            }
        });

        $('#by_line').change(function(){
            if($('#by_line').val() == '' || $('#by_branch').val() == ''){

                $('#by_area').empty().append(`<option value="">Select Area Name</option>`)
                return;

            }else{
                $('#by_area').empty().append(`<option value="">Select Area Name</option>`)

                //this code will first check for selected line id
                for(let i=0; i<response['line'].length; i++){

                    if(response['line'][i].id == $('#by_line').val() ) {
                        //if the selected line id matches, the it will take that respective area ids

                        for(let k=0;k<response['area'].length; k++){//then loop over area table

                            //check for the area id in the line table and if it matches, then append to the area select box.
                            //if the area id is not in the line table, then it will not append to the area select box.
                            if(response['line'][i]['area_id'].includes(response['area'][k]['id'])){

                                $('#by_area').append(`<option value="${response['area'][k].id}">${response['area'][k].name}</option>`)
                            }
                        }
                    }
                }
            }
        
        });

        $('#by_area').change(function(){
            if($('#by_area').val() == '' || $('#by_line').val() == '' || $('#by_branch').val() == ''){
                $('#by_sub_area').empty().append(`<option value="">Select Sub Area Name</option>`)
                return;
            }else{
                $('#by_sub_area').empty().append(`<option value="">Select Sub Area Name</option>`)
                for(let i=0; i<response['sub_area'].length; i++){
                    if(response['sub_area'][i].area_id == $('#by_area').val()){
                        $('#by_sub_area').append(`<option value="${response['sub_area'][i].id}">${response['sub_area'][i].name}</option>`)
                    }
                }
            
            }
        });

        $('#by_loan_cat').change(function(){
            if($('#by_loan_cat').val() == ''){
                $('#by_sub_cat').empty().append(`<option value="">Select Sub Category</option>`)
                return;
            }else{
                $('#by_sub_cat').empty().append(`<option value="">Select Sub Category</option>`)
                for(let i=0; i<response['sub_cat'].length; i++){
                    if(response['sub_cat'][i].loan_cat == $('#by_loan_cat').val()){
                        $('#by_sub_cat').append(`<option value="${response['sub_cat'][i].id}">${response['sub_cat'][i].name}</option>`)
                    }
                }
            }
        
        });

    },'json')
}


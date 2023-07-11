
// Document is ready
$(document).ready(function () {
    // callOnClickEvents();
    
});//document ready end


function callOnClickEvents(){
    setTimeout(() => {console.log('Called on click function')

        $('a.customer-status').click(function(){
            var cus_id = $(this).data('value');
            var req_id = $(this).data('value1');
            $.ajax({
                url:'requestFile/getCustomerStatus.php',
                data: {"cus_id":cus_id},
                // dataType: 'json',
                type:'post',
                cachec: false,
                success: function(response){
                    $('#cusHistoryTable').empty();
                    $('#cusHistoryTable').html(response);
                }
            })
            // $.ajax({
            //     url:'requestFile/getCustomerStatus1.php',
            //     data: {"cus_id":cus_id,"req_id":req_id},
            //     type:'post',
            //     cachec: false,
            //     success: function(response){
            //         $('#exist_type').val(response);
            //     }
            // })
        });
        $('a.loan-summary').click(function(){
            var cus_id = $(this).data('value');
            var req_id = $(this).data('value1');
            $.ajax({
                url:'requestFile/getLoanSummary.php',
                data: {"cus_id":cus_id,"req_id":req_id},
                // dataType: 'json',
                type:'post',
                cachec: false,
                success: function(response){
                    $('#loanSummaryTable').empty();
                    $('#loanSummaryTable').html(response);
                }
            })
        });
        $('.complete_issue').click(function(){
            var req_id = $(this).val();
            if(confirm('Do You want to Complete this Issue?')){
                $.ajax({
                    // url: 'verificationFile/sendToIssue.php',
                    url: 'loanIssueFile/sendToCollection.php',
                    dataType: 'json',
                    type: 'post',
                    data:{'req_id':req_id},
                    cache:false,
                    success:function(response){
                        if(response.includes('Completed')){
                            Swal.fire({
                                timerProgressBar: true,
                                timer: 2000,
                                title: response,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                            setTimeout(function(){
                                window.location= 'edit_loan_issue';
                            },2000)
                        }
                    }
                })
            }
        });

        $('.iss-remove').click(function(){
            event.preventDefault();
            let req_id = $(this).data('value');
            if(confirm('Do you want to Remove this Issue From the List?')){
                $.ajax({
                    url: 'loanIssueFile/removeIssue.php',
                    dataType: 'json',
                    type: 'post',
                    data:{'req_id':req_id},
                    cache:false,
                    success:function(response){
                        if(response.includes('Removed')){
                            Swal.fire({
                                timerProgressBar: true,
                                timer: 2000,
                                title: response,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                            setTimeout(function(){
                                window.location= 'edit_loan_issue';
                            },2000)
                        }else if(response.includes('Error')){
                            Swal.fire({
                                timerProgressBar: true,
                                timer: 2000,
                                title: response,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                        }
                    }
                })
            }
        })
        
    }, 1000);
}

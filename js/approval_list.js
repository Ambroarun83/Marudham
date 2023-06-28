
// Document is ready
$(document).ready(function () {
    callOnClickEvents();
    
});//document ready end


function callOnClickEvents() {
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
        $('.move_acknowledgement').click(function(){
            var req_id = $(this).val();
            if(confirm('Do You want to Approve?')){
                $.ajax({
                    url: 'approveFile/sendToAcknowledgement.php',
                    dataType: 'json',
                    type: 'post',
                    data:{'req_id':req_id},
                    cache:false,
                    success:function(response){
                        if(response.includes('Approved')){
                            Swal.fire({
                                timerProgressBar: true,
                                timer: 2000,
                                title: response,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                            setTimeout(function(){
                                window.location= 'approval_list';
                            },2000)
                        }
                    }
                })
            }
        });
        
    }, 1000);
}

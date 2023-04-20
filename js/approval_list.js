
// Document is ready
$(document).ready(function () {
    setTimeout(() => {

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
        
        $('.approved').click(function(){
            var req_id = $(this).val();
            if(confirm('Do You want to Approve?')){
                $.ajax({
                    url: 'approveFile/approvedVerification.php',
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



});//document ready end



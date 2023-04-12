
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
        $('.move_approval').click(function(){
            var req_id = $(this).val();
            if(confirm('Do You want to Send this for Approval?')){
                $.ajax({
                    url: 'verificationFile/sendToApproval.php',
                    dataType: 'json',
                    type: 'post',
                    data:{'req_id':req_id},
                    cache:false,
                    success:function(response){
                        if(response.includes('Moved')){
                            Swal.fire({
                                timerProgressBar: true,
                                timer: 2000,
                                title: response,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                            setTimeout(function(){
                                window.location= 'verification_list';
                            },2000)
                        }
                    }
                })
            }
        });
        
    }, 1000);



});//document ready end



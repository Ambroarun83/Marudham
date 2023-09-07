
// Document is ready
$(document).ready(function () {
    // callOnClickEvents();
    
});//document ready end

function callOnClickEvents(){
    setTimeout(() => {console.log('Called on click events')

        $('a.customer-status').click(function(){
            var cus_id = $(this).data('value');
            var req_id = $(this).data('value1');
            $.ajax({
                url:'requestFile/getCustomerStatus.php',
                data: {"cus_id":cus_id},
                // dataType: 'json',
                type:'post',
                cache: false,
                success: function(response){
                    $('#cusHistoryTable').empty();
                    $('#cusHistoryTable').html(response);
                }
            })
            // $.ajax({
            //     url:'requestFile/getCustomerStatus1.php',
            //     data: {"cus_id":cus_id,"req_id":req_id},
            //     type:'post',
            //     cache: false,
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
                cache: false,
                success: function(response){
                    $('#loanSummaryTable').empty();
                    $('#loanSummaryTable').html(response);
                }
            })
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

        // Verification list Actions
        $(document).on("click", '.cancelverification', function(){
            var remark = prompt("Do you want to Cancel this Verification?");
            if(remark != null){
                $.post('requestFile/changeRequestState.php', {req_id:$(this).data('reqid'),state:'cancel',remark,screen:'verification'}, function(data){
                    if(data.includes('Success')){
                        successSwal('Cancelled!','Verification has been Cancelled.');
                    }else{
                        warningSwal('Error!','Something went wrong.');
                    }
                })
                return true;
            }else{
                return false;
            }
        });
        $(document).on("click", '.revokeverification', function(){
            var remark = prompt("Do you want to Revoke this Verification?");
            if(remark != null){
                $.post('requestFile/changeRequestState.php', {req_id:$(this).data('reqid'),state:'revoke',remark,screen:'verification'}, function(data){
                    if(data.includes('Success')){
                        successSwal('Revoked!','Verification has been Revoked.');
                    }else{
                        warningSwal('Error!','Something went wrong.');
                    }
                })
                return true;
            }else{
                return false;
            }
        });
        
    }, 1000);
}


function warningSwal(title,text){
    Swal.fire({
        title: title,
        html: text,
        icon: 'warning',
        showConfirmButton:false,
        timerProgressBar:true,
        timer: 2000,
    });
}

function successSwal(title,text){
    Swal.fire({
        title: title,
        html: text,
        icon: 'success',
        showConfirmButton:false,
        timerProgressBar:true,
        timer: 2000,
    })
    setTimeout(() => {
        location.reload();
    }, 2000);
}

// Document is ready
$(document).ready(function () {
    // callOnClickEvents();
    
    
    
    
});//document ready end
function callOnClickEvents(){

    setTimeout(() => { console.log('Called on click events')
        // $('.sub_verification').off('click');
        $('.sub_verification').click(function(){
            var req_id = $(this).val();
            var cus_id = $(this).attr('data-value');
            if(confirm('Do You want to Send this Request for Verification?')){
                $.ajax({
                    url: 'requestFile/sendToVerificaiton.php',
                    dataType: 'json',
                    type: 'post',
                    data:{'req_id':req_id,"cus_id":cus_id},
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
                                window.location= 'edit_request';
                            },2000)
                        }
                    }
                })
            }
        });
        // $('a.customer-status').off('click');
        $('a.customer-status').click(function(){event.preventDefault();
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
            $.ajax({
                url:'requestFile/getCustomerStatus1.php',
                data: {"cus_id":cus_id,"req_id":req_id},
                type:'post',
                cache: false,
                success: function(response){
                    $('#exist_type').val(response);
                }
            })
        })
        // $('a.loan-summary').off('click');
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

        // Request Actions
        $(document).on("click", '.cancelrequest', function(){
            var remark = prompt("Do you want to Cancel this Request?");
            if(remark != null){
                $.post('requestFile/changeRequestState.php', {req_id:$(this).data('reqid'),state:'cancel',remark,screen:'request'}, function(data){
                    if(data.includes('Success')){
                        successSwal('Cancelled!','Request has been Cancelled.');
                    }else{
                        warningSwal('Error!','Something went wrong.');
                    }
                })
                return true;
            }else{
                return false;
            }
        });
        $(document).on("click", '.revokerequest', function(){
            var remark = prompt("Do you want to Revoke this Request?");
            if(remark != null){
                $.post('requestFile/changeRequestState.php', {req_id:$(this).data('reqid'),state:'revoke',remark,screen:'request'}, function(data){
                    if(data.includes('Success')){
                        successSwal('Revoked!','Request has been Revoked.');
                    }else{
                        warningSwal('Error!','Something went wrong.');
                    }
                })
                return true;
            }else{
                return false;
            }
        });
        
    }, 500);
}


function warningSwal(title,text){
    Swal.fire({
        title: title,
        html: text,
        icon: 'warning',
        showConfirmButton:false,
        timerProgressBar:true,
        timer: 2000
    });
}

function successSwal(title,text){
    Swal.fire({
        title: title,
        html: text,
        icon: 'success',
        showConfirmButton:false,
        timerProgressBar:true,
        timer: 2000
    })
    setTimeout(() => {
        location.reload();
    }, 2000);
}
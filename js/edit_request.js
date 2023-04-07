
// Document is ready
$(document).ready(function () {
    setTimeout(() => {
        $('.sub_verification').click(function(){
            var req_id = $(this).val();
            if(confirm('Do You want to Send this Request for Verification?')){
                $.ajax({
                    url: 'requestFile/sendToVerificaiton.php',
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
                                window.location= 'edit_request';
                            },2000)
                        }
                    }
                })
            }
        });

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
            $.ajax({
                url:'requestFile/getCustomerStatus1.php',
                data: {"cus_id":cus_id,"req_id":req_id},
                type:'post',
                cachec: false,
                success: function(response){
                    $('#exist_type').val(response);
                }
            })
        })
        
    }, 500);

    // var sortOrder = 1; // 1 for ascending, -1 for descending
    // $('th').click(function() {
    // var columnIndex = $(this).index();
    // var $tableRows = $('tbody tr');
    // $tableRows.sort(function(a, b) {
    //     var textA = $(a).find('td').eq(columnIndex).text().toUpperCase();
    //     var textB = $(b).find('td').eq(columnIndex).text().toUpperCase();
    //     if (textA < textB) {
    //     return -1 * sortOrder;
    //     }
    //     if (textA > textB) {
    //     return 1 * sortOrder;
    //     }
    //     return 0;
    // });
    // $('tbody').empty().append($tableRows); // clear and append the sorted rows
    // sortOrder = -1 * sortOrder; // reverse the sort order
    // });


      

});//document ready end



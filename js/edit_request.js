
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

    var sortOrder = 1; // 1 for ascending, -1 for descending
    $('th').click(function() {
    var columnIndex = $(this).index();
    $('tbody').empty();
    dT();
    setTimeout(function() {
        var $tableRows = $('tbody tr');
        $tableRows.sort(function(a, b) {
            var textA = $(a).find('td').eq(columnIndex).text().toUpperCase();
            var textB = $(b).find('td').eq(columnIndex).text().toUpperCase();
            if (textA < textB) {
                return -1 * sortOrder;
            }
            if (textA > textB) {
                return 1 * sortOrder;
            }
            return 0;
        });
        $('tbody').append($tableRows);
        sortOrder = -1 * sortOrder;

        // update the serial numbers
        $('tbody tr').each(function(index) {
            $(this).find('td').eq(0).text(index + 1);
        });
    }, 500)
});



});//document ready end


function dT(){
    // Request datatable
    var request_table = $('#request_table').DataTable();
    request_table.destroy();
    var request_table = $('#request_table').DataTable({
        "order": [[ 0, "desc" ]],
        "ordering": false,
        // 'paging':false,
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
                title: "Loan Scheme List"
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
}
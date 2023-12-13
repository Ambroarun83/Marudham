$(document).ready(function () {
    $('#cus_id').keyup(function () {
        var value = $(this).val();
        value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
        $(this).val(value);
    });

    $('#search').click(function () {
        let cus_id = $('#cus_id').val(); let cus_name = $('#cus_name').val(); let area = $('#cus_area').val();
        let sub_area = $('#cus_sub_area').val(); let mobile = $('#mobile').val();
        cus_id = cus_id.replace(/\s+/g, '');//removes spaces in adhar number
        if (validate()) {
            $.ajax({
                url: 'searchModule/search_customer.php',
                type: 'POST',
                data: { cus_id, cus_name, area, sub_area, mobile },
                success: function (data) {
                    $('#customer_list_card').show();
                    $('#customer_list').empty().html(data);
                }
            }).then(function () {
                viewCusOnClick();
            })
        } else {
            $('#customer_list_card').hide();
        }
    })
})


function validate() {
    let response = true;
    let cus_id = $('#cus_id').val(); let cus_name = $('#cus_name').val(); let area = $('#area').val(); let sub_area = $('#sub_area').val(); let mobile = $('#mobile').val();

    if (cus_id == '' && cus_name == '' && area == '' && sub_area == '' && mobile == '') {
        response = false;
        event.preventDefault();
        alert('Please fill any one field to search!')
    }

    return response;
}

function viewCusOnClick() {
    $('.view_cust').off().click(function () {
        $('#customerStatusDiv').empty();
        let cus_id = $(this).data('cusid');
        callresetCustomerStatus(cus_id); //this function will give the customer's status like pending od current
        showOverlay(); //loader start
        setTimeout(() => {
            var pending_sts = $('#pending_sts').val();
            var od_sts = $('#od_sts').val();
            var due_nil_sts = $('#due_nil_sts').val();
            var closed_sts = $('#closed_sts').val()
            $.post("searchModule/getCustomerStatus.php", { cus_id, pending_sts, od_sts, due_nil_sts, closed_sts }, function (response) {
                $('#customerStatusDiv').html(response);
            });
            hideOverlay();
        }, 1000);
    });
}
function callresetCustomerStatus(cus_id) {
    //To get loan sub Status
    var pending_arr = [];
    var od_arr = [];
    var due_nil_arr = [];
    var closed_arr = [];
    var balAmnt = [];
    $.ajax({
        url: 'collectionFile/resetCustomerStatus.php',
        data: {
            'cus_id': cus_id
        },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response) {
            if (response.length != 0) {

                for (var i = 0; i < response['pending_customer'].length; i++) {
                    pending_arr[i] = response['pending_customer'][i]
                    od_arr[i] = response['od_customer'][i]
                    due_nil_arr[i] = response['due_nil_customer'][i]
                    closed_arr[i] = response['closed_customer'][i]
                    balAmnt[i] = response['balAmnt'][i]
                }
                var pending_sts = pending_arr.join(',');
                $('#pending_sts').val(pending_sts);
                var od_sts = od_arr.join(',');
                $('#od_sts').val(od_sts);
                var due_nil_sts = due_nil_arr.join(',');
                $('#due_nil_sts').val(due_nil_sts);
                var closed_sts = closed_arr.join(',');
                $('#closed_sts').val(closed_sts);
            };
        }
    });
}
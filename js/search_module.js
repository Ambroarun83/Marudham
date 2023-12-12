$(document).ready(function () {
    $('#cus_id').keyup(function() {
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
                data: {cus_id,cus_name,area,sub_area,mobile},
                success: function (data) {
                    $('#customer_list_card').show();
                    $('#customer_list').html(data);
                }
            })
        }else{
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

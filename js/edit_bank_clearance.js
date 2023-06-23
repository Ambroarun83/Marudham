$(document).ready(function(){





    $('#from_date').change(function() {
        var fromDate = new Date($(this).val()); // take as date format
        var toDate = new Date($('#to_date').val()); // take as date format, if nothing selected will de invalid date

        if (fromDate > toDate) { // check if from date is greater than to date, if yes then remove to date
            $('#to_date').val('');
        }
    
        $('#to_date').attr('min', $(this).val()); // setting minimum date for to date, so before start date will be disabled
    });
    
    $('#to_date').change(function() {
        var fromDate = new Date($('#from_date').val());
        var toDate = new Date($(this).val());

        if (fromDate > toDate) { // if anyone enters to date manually in to date less than from date, it empty's the to date value
            $(this).val('');
        }
    });

    $('#view_table').click(function(){
        if(validation() == 0){
            var bank_id = $('#bank_name').val();var from_date = $('#from_date').val();var to_date = $('#to_date').val();
            $.ajax({
                url: 'accountsFile/bankclearance/ajaxBankClearanceFetch.php',
                data: {'bank_id':bank_id,'from_date':from_date,'to_date':to_date},
                type: 'post',
                cache: false,
                success: function(response){
                    if(response.includes('Given')){
                        Swal.fire({
                            title: response,
                            text: 'Please Try Different Dates',
                            icon: 'warning',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688'
                        })
                        $('#bank_clr_table').hide();
                        return false;
                    }else{
                        $('#bank_clr_table').show();
                        $('#bank_clearance_list').empty();
                        $('#bank_clearance_list').html(response);
                        initializeDT();
                    }
                }
            }).then(function(){
                clrcatClickEvent();
            })
        }
    })












    
})// document ready END



$(function(){

    getBankNames();//get bank names

});// auto call functions END


function getBankNames(){
    $.ajax({
        url:'accountsFile/bankclearance/getBankNames.php',
        data:{},
        type: 'post',
        dataType: 'json',
        cache: false,
        success:function(response){
            $('#bank_name').empty();
            $('#bank_name').append('<option value="">Select Bank Name</option>');
            $.each(response,function(index,val){
                $('#bank_name').append("<option value='"+val['bank_id']+"'>"+val['bank_name']+"</option>");
            })
        }
    });
}


function validation(){
    var bank_id = $('#bank_name').val();var from_date = $('#from_date').val();var to_date = $('#to_date').val();
    var response = 0;

    function validateField(value, fieldId) {
        if (value === '') {
            response = 1;
            event.preventDefault();
            $(fieldId).show();
        } else {
            $(fieldId).hide();
        }
    }
    
    // validateField(ucl_trans_id, '#ucl_trans_id_exfCheck');
    validateField(bank_id, '#bank_nameCheck');
    validateField(from_date, '#from_dateCheck');
    validateField(to_date, '#to_dateCheck');
    return response;
}


function initializeDT(){
    var bank_clearance_list = $('#bank_clearance_list').DataTable();
    bank_clearance_list.destroy();

    $('#bank_clearance_list').DataTable({
        "title":"Bank Clearance List",
        'processing': true,
        'iDisplayLength': 10,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "createdRow": function(row, data, dataIndex) {
            $(row).find('td:first').html(dataIndex + 1);
        },
        "drawCallback": function(settings) {
            this.api().column(0).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        },
    });
    

}


//function for click event when user clicks on a cash tally modes to get the ref codes
function clrcatClickEvent(){    
    $('.clr_cat').change(function(){
        var clr_cat = $(this).val();
        var bank_id = $(this).prev().val();
        var crdb = $(this).next().val();
        var trans_id = $(this).parent().prev().prev().prev().prev().text();
        var clr_cat_box = $(this);
        var ref_id_box = $(this).parent().next().children();//represents ref id select box
        var span_box = $(this).parent().next().next().children();//represents span box
        var clear_btn = $(this).parent().next().next().children().next();//represents clear btn box
        console.log(clear_btn);
        $.ajax({
            url: 'accountsFile/bankclearance/getRefCodetoClear.php',
            data: {'clr_cat':clr_cat,'bank_id':bank_id,'crdb':crdb,'trans_id':trans_id},
            dataType: 'json',
            type: 'post',
            cache: false,
            success: function(response){
                ref_id_box.empty(); 
                ref_id_box.append("<option value=''>Select Ref ID</option>");
                $.each(response,function(ind,val){
                    ref_id_box.append("<option value='"+val['ref_code']+"'>"+val['ref_code']+"</option>")
                })
                
            }
        }).then(function(){
            $(ref_id_box).change(function(){
                $(clear_btn).show()
                $(span_box).hide()
                $(span_box).text('Clear')
                $(span_box).removeClass('text-danger')
                $(span_box).addClass('text-success')

                $(clr_cat_box).attr('disabled',true)
                $(ref_id_box).attr('disabled',true)
            })
        })
    })
}
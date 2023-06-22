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

    // Download button
    $('#download_bank_stmt').click(function () {
        window.location.href='uploads/excel_format/bank_stmt_format.xlsx';
    });

    $("#submit_stmt_upload").click(function(){
    
        if(validation() == 0){

            var file_data = $('#file').prop('files')[0];   
            var bank_id = $('#bank_name').val();var acc_no = $('#acc_no').val();var from_date = $('#from_date').val();var to_date = $('#to_date').val();
            var area = new FormData();                  
            area.append('file', file_data);
            area.append('bank_id', bank_id);
            area.append('acc_no', acc_no);
            area.append('from_date', from_date);
            area.append('to_date', to_date);

            if(file.files.length == 0 ){
                warningSwal('Please Select File!','');
                return false;
            }
            $.ajax({
                url: 'accountsFile/bankclearance/submitUploadedBankStmt.php',
                type: 'POST',
                data: area,
                // dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('#file').attr("disabled",  true);
                    $('#submit_stmt_upload').attr("disabled", true);
                },
                success: function(data){
                    if(data == 0){
                        $("#file").val('');
                        Swal.fire({
                            title: 'File Uploaded!',
                            // text: 'Do you want to Go to Bank clearance?',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688',
                            // cancelButtonColor: '#d33',
                            // cancelButtonText: 'No',
                            // confirmButtonText: 'Yes'
                        }).then(function(result){
                            if(result.isConfirmed) {
                                getBankClearanceTable();
                            }
                        })
                    }else if(data == 1){
                        $("#file").val('');
                        warningSwal('File Not Uploaded!','Problem whil reading file')
                    }
                },
                complete: function(){
                    $('#file').attr("disabled",  false);
                    $('#submit_stmt_upload').attr("disabled", false);         
                }
            });
        }else{
            $('#close_upd_modal').trigger('click');
            warningSwal('Please Fill All !','Mentioned as <span class="text-danger">*</span> are Mandatory')
        }
    });


    $('#back_to_band_details').click(function(){
        $('#bank_details_card').show();
        $('#bank_clearance_card').hide();
        $('#back_to_band_details').hide();
    })

});// document ready end



$(function(){

    getBankNames();

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
                $('#bank_name').append("<option value='"+val['bank_id']+"'>"+val['bank_fullname']+"</option>");
            })

            $('#bank_name').change(function(){
                var bank_id = $(this).val(); 
                if(bank_id != ''){
                    $('#acc_no').empty();
                    $('#acc_no').append('<option value="">Select Account Number</option>');
                    $.each(response,function(index,val){
                        if(bank_id == val['bank_id']){
                            $('#acc_no').append("<option value='"+val['acc_no']+"'>"+val['acc_no']+"</option>");
                        }
                    })
                }else{
                    $('#acc_no').empty();
                    $('#acc_no').append('<option value="">Select Account Number</option>');
                }
            })
        }
    });
}

//function to validate bank id and account number has been selected before uploading statement.
//because to store statement in table, we need bank id
function validation(){
    var bank_id = $('#bank_name').val();var acc_no = $('#acc_no').val();var from_date = $('#from_date').val();var to_date = $('#to_date').val();
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
    validateField(acc_no, '#acc_noCheck');
    validateField(from_date, '#from_dateCheck');
    validateField(to_date, '#to_dateCheck');
    return response;
}


function getBankClearanceTable(){
    $('#close_upd_modal').trigger('click');
    $('#bank_details_card').hide();
    $('#bank_clearance_card').show();
    $('#back_to_band_details').show();
    
    var bank_id = $('#bank_name').val();var from_date = $('#from_date').val();var to_date = $('#to_date').val();

    $.ajax({
        url: 'accountsFile/bankclearance/getBankClearanceTable.php',
        data: {'bank_id':bank_id,'from_date':from_date,'to_date':to_date},
        type: 'post',
        cache: false,
        success:function(response){
            $('#bank_clearanceDiv').empty()
            $('#bank_clearanceDiv').html(response)
        }
    })
    
}

function warningSwal(title,text){
    Swal.fire({
        title: title,
        html: text,
        icon: 'warning',
        showConfirmButton: true,
        confirmButtonColor: '#009688'
    });
}

function successSwal(title,text){
    Swal.fire({
        title: title,
        html: text,
        icon: 'success',
        showConfirmButton: true,
        confirmButtonColor: '#009688'
    })
}
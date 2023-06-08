$(document).ready(function(){

    $('#hand_cash_radio , .bank_cash_radio').click(function(){
        hideAllCardsfunction();
        var cash_type =$('input[name=cash_type]:checked').val();
        if(cash_type == '0'){//hand cash
            appendHandCreditDropdown();
            appendHandDebitDropdown();
        }else if(cash_type > 0){//Bank cash
            appendBankCreditDropdown();
            appendBankDebitDropdown();
        }
    })

    //On change of types other type shoult be empty
    $('#credit_type').change(function(){
        var credit_type = $(this).val();
        if(credit_type != ''){
            $('#debit_type').val('');
        }
    })
    $('#debit_type').change(function(){
        var debit_type = $(this).val();
        if(debit_type != ''){
            $('#credit_type').val('');
        }
    })


    //Credit Type on change event
    $('#credit_type').change(function(){
        hideAllCardsfunction()
        var credit_type = $(this).val();
        var cash_type =$('input[name=cash_type]:checked').val();
        
        if(credit_type != ''){
            
            /////////////////////// For Collection Credit types ////////////////////////////
            if(credit_type == 1 && cash_type == '0'){ 
                // 1 means Collection and cash type is hand cash
                $('.collection_card').show();
                getCollectionDetails();
            }else if(credit_type == 1 && cash_type > 0){
                // 1 means Collection and cash type is bank cash
                $('.collection_card').show();
                getBankCollectionDetails(cash_type);
            }else if(credit_type == 5 && cash_type > 0){
                // 5 means cash deposit and cash type is bank
                $('.contra_card').show();
                getCashDepositDetails(cash_type);
            }
            else{
                
            }

            
        }
    })

    $('#debit_type').change(function(){
        hideAllCardsfunction()
        var debit_type = $(this).val();
        var cash_type =$('input[name=cash_type]:checked').val();

        if(debit_type != ''){

            ////////////////////// For Contra Debit Types ///////////////////////
            if(debit_type == 6 && cash_type == '0'){
                // 6 means Bank Deposit and cash type is hand cash
                // it meanst, amount from hand has been taken for deposit into bank
                $('.contra_card').show();
                getBankDepositDetails();
            }else if(debit_type == 7 && cash_type > 0){
                // 7 means Cash Withdrawal and cash type is Bank cash
                // it meanst, amount from bank has been withdrawal for hand use
                $('.contra_card').show();
            }
        }
    })

})//Document ready END




function appendHandCreditDropdown(){

    $.ajax({
        url: 'accountsFile/cashtally/getCashTallyDropdown.php',
        data: {'mode':'handcredit'},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){

            $('#credit_type').empty();
            $('#credit_type').append("<option value=''>Select Credit Type</option>");
            for(var i=0;i<response.length;i++){
                $('#credit_type').append("<option value='"+response[i]['id']+"'>"+response[i]['modes']+"</option>");
            }
            sortDropdowns()
            
        }
    })

}
function appendHandDebitDropdown(){
    $.ajax({
        url: 'accountsFile/cashtally/getCashTallyDropdown.php',
        data: {'mode':'handdebit'},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){

            $('#debit_type').empty();
            $('#debit_type').append("<option value=''>Select Debit Type</option>");
            for(var i=0;i<response.length;i++){
                $('#debit_type').append("<option value='"+response[i]['id']+"'>"+response[i]['modes']+"</option>");
            }
            sortDropdowns()
        }
    })
}

function appendBankCreditDropdown(){
    $.ajax({
        url: 'accountsFile/cashtally/getCashTallyDropdown.php',
        data: {'mode':'bankcredit'},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){

            $('#credit_type').empty();
            $('#credit_type').append("<option value=''>Select Credit Type</option>");
            for(var i=0;i<response.length;i++){
                $('#credit_type').append("<option value='"+response[i]['id']+"'>"+response[i]['modes']+"</option>");
            }
            sortDropdowns()
        }
    })
}
function appendBankDebitDropdown(){
    $.ajax({
        url: 'accountsFile/cashtally/getCashTallyDropdown.php',
        data: {'mode':'bankdebit'},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){

            $('#debit_type').empty();
            $('#debit_type').append("<option value=''>Select Debit Type</option>");
            for(var i=0;i<response.length;i++){
                $('#debit_type').append("<option value='"+response[i]['id']+"'>"+response[i]['modes']+"</option>");
            }
            sortDropdowns()
        }
    });
}

function sortDropdowns() {
    var firstOption = $("#credit_type option:first-child");
    $("#credit_type").html($("#credit_type option:not(:first-child)").sort(function(a, b) {
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
    }));
    $("#credit_type").prepend(firstOption);

    var firstOption = $("#debit_type option:first-child");
    $("#debit_type").html($("#debit_type option:not(:first-child)").sort(function(a, b) {
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
    }));
    $("#debit_type").prepend(firstOption);
}

function hideAllCardsfunction(){
    $('.collection_card').hide();
    $('#collectionTableDiv').empty();// empty the card fileds when hiding

    $('.contra_card').hide();
    $('#contraTableDiv').empty();// empty the card fileds when hiding
}


// /////////////////////// Hand Collection ///////////////////////////// //
function getCollectionDetails(){
    var user_branch_id = $('#user_branch_id').val();
    $.ajax({
        url:'accountsFile/cashtally/getCollectionDetails.php',
        data: {'branch_id':user_branch_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#collectionTableDiv').empty();
            $('#collectionTableDiv').html(response);
        }
    })
    // .then(function(){
        // $('.collect_btn').click(function(){
        //     console.log('asdf')
        //     var user_id = $(this).data('value');
        //     $.ajax({
        //         url:'accountsFile/cashtally/receiveAmtModal.php',
        //         data: {'user_id':user_id},
        //         type: 'post',
        //         cache: false,
        //         success: function(response){
        //             $('#receiveAmtDiv').empty();
        //             $('#receiveAmtDiv').html(response);
        //         }
        //     }).then(function(){
        //         $('#submit_rec').click(function(){
        //             var formData = $('#coll_rec_form').serialize(); // Serialize the form inputs to send all data
        //             $.ajax({
        //                 url: 'accountsFile/cashtally/submitReceivedCollection.php',
        //                 data: formData,
        //                 type: 'post',
        //                 cache: false,
        //                 success: function(response){
        //                     if(response.includes('Successfully')){
        //                         Swal.fire({
        //                             title: response,
        //                             icon: 'success',
        //                             showConfirmButton: true,
        //                             confirmButtonColor: '#009688'
        //                         }).then(function(result){
        //                             if(result.isConfirmed){
        //                                 var user_id = $('#user_id_rec').val();
        //                                 $.ajax({
        //                                     url:'accountsFile/cashtally/receiveAmtModal.php',
        //                                     data: {'user_id':user_id},
        //                                     type: 'post',
        //                                     cache: false,
        //                                     success: function(response){
        //                                         $('#receiveAmtDiv').empty();
        //                                         $('#receiveAmtDiv').html(response);
        //                                     }
        //                                 })
        //                             }
        //                         })
        //                     }else{
        //                         Swal.fire({
        //                             title: response,
        //                             icon: 'error',
        //                             showConfirmButton: true,
        //                             confirmButtonColor: '#009688'
        //                         });
        //                     }
        //                 }
        //             })
        //         })
        //     })
        // })
    // })

}

function collectBtnClick(user_id){
    // $('.collect_btn').click(function(){
        var user_id = $(user_id).data('value');
        $.ajax({
            url:'accountsFile/cashtally/receiveAmtModal.php',
            data: {'user_id':user_id},
            type: 'post',
            cache: false,
            success: function(response){
                $('#receiveAmtDiv').empty();
                $('#receiveAmtDiv').html(response);
            }
        }).then(function(){
            $('#submit_rec').click(function(){
                var formData = $('#coll_rec_form').serialize(); // Serialize the form inputs to send all data
                
                if($('#rec_amt').val() != ''){
                    $('#rec_amt_check').hide();
                    $.ajax({
                        url: 'accountsFile/cashtally/submitReceivedCollection.php',
                        data: formData,
                        type: 'post',
                        cache: false,
                        success: function(response){
                            if(response.includes('Successfully')){
                                Swal.fire({
                                    title: response,
                                    icon: 'success',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#009688'
                                }).then(function(result){
                                    if(result.isConfirmed){
                                        var user_id = $('#user_id_rec').val();
                                        $.ajax({
                                            url:'accountsFile/cashtally/receiveAmtModal.php',
                                            data: {'user_id':user_id},
                                            type: 'post',
                                            cache: false,
                                            success: function(response){
                                                $('#receiveAmtDiv').empty();
                                                $('#receiveAmtDiv').html(response);
                                            }
                                        })
                                    }
                                })
                            }else{
                                Swal.fire({
                                    title: response,
                                    icon: 'error',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#009688'
                                });
                            }
                        }
                    })
                }else{
                    $('#rec_amt_check').show();
                }
            })
        })
    // })
}

function closeReceiveModal(){
    var user_branch_id = $('#user_branch_id').val();
    $.ajax({
        url:'accountsFile/cashtally/getCollectionDetails.php',
        data: {'branch_id':user_branch_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#collectionTableDiv').empty();
            $('#collectionTableDiv').html(response);
        }
    })
}
// /////////////////////// Hand Collection ///////////////////////////// //


// /////////////////////// Bank Collection ///////////////////////////// //
function getBankCollectionDetails(bank_id){
    $('#collectionTableDiv').empty();// empty the card fileds when hiding
    var fieldsAppend = `<div class='col-md-12'><div class='row'>
    <div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12'><div class='form-group'>
    <input type='hidden' id='bank_id' name='bank_id' value='`+bank_id+`'> 
    <label for='bank_credit_amt'> Bank Credit Amount</label>
    <input type='number' id='bank_credit_amt' name='bank_credit_amt' class='form-control' Placeholder='Enter Credited Amount' title='Enter 0 if no Transaction'>
    <span class='text-danger' id='bank_credit_check' style='display:none'>Please Enter Credited Amount</span></div></div>
    <div class='col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12'><div class='form-group'>
    <label for='' style='visibility:hidden'> Bank Credit Submit</label><br>
    <input type='button' id='submit_bank_credit' name='submit_bank_credit' value='Submit' class='btn btn-primary'></div></div>
    </div></div>`;
    $('#collectionTableDiv').html(fieldsAppend);

    $('#submit_bank_credit').click(function(){
        var bank_id = $('#bank_id').val()
        var credited_amt = $('#bank_credit_amt').val();
        if(credited_amt != ''){
            $('#bank_credit_check').hide();
            $.ajax({
                url: 'accountsFile/cashtally/submitBankCredit.php',
                data: {'bank_id':bank_id,'credited_amt':credited_amt},
                type: 'post',
                cache: false,
                success: function(response){
                    if(response.includes('Successfully')){
                        Swal.fire({
                            title: response,
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688'
                        })
                    }else if(response.includes('Error')){
                        Swal.fire({
                            title: response,
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688'
                        });
                    }else if(response.includes('Already')){
                        Swal.fire({
                            title: response,
                            icon: 'info',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688'
                        });
                    }
                    $('#bank_credit_amt').val('');
                }
            })
        }else{
            $('#bank_credit_check').show();
        }
    })
}
// /////////////////////// Bank Collection ///////////////////////////// //


// /////////////////////// Contra  ///////////////////////////// //

function getBankDepositDetails(){
    var appendTxt = `
        
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="to_bank_bdep">To Bank</label>
                <select id="to_bank_bdep" name="to_bank_bdep" class="form-control">
                    
                </select>
                <span class="text-danger" id='to_bank_bdepCheck' style="display:none">Please Select Bank Name</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="location_bdep">Location</label>
                <input type="text" id="location_bdep" name="location_bdep" class="form-control" placeholder="Please Enter Location">
                <span class="text-danger" id='location_bdepCheck' style="display:none">Please Enter Location</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="remark_bdep">Remark</label>
                <input type="text" id="remark_bdep" name="remark_bdep" class="form-control" placeholder="Please Enter Remark">
                <span class="text-danger" id='remark_bdepCheck' style="display:none">Please Enter Remark</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="amt_bdep">Amount</label>
                <input type="number" id="amt_bdep" name="amt_bdep" class="form-control" placeholder="Please Enter amt">
                <span class="text-danger" id='amt_bdepCheck' style="display:none">Please Enter amt</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label style="visibility:hidden">amt</label><br>
                <input type="button" id="submit_bdep" name="submit_bdep" class="btn btn-primary" value="Submit">
            </div>
        </div>`;
    $('.contra_card_header').text('Contra - Bank Deposit')
    $('#contraTableDiv').addClass('row', !$('#contraTableDiv').hasClass('row'));
    $('#contraTableDiv').empty()
    $('#contraTableDiv').html(appendTxt);

    $.ajax({
        url:'accountsFile/cashtally/contra/getBankDepositDetails.php',
        data:{},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#to_bank_bdep').empty()
            $('#to_bank_bdep').append(`<option value=''>Select Bank Name</option>`)
            for(var i=0;i<response.length;i++){
                $('#to_bank_bdep').append(`<option value='`+response[i]['bank_id']+`'>`+response[i]['bank_name']+`</option>`)
            }
        }
    }).then(function(){
        $('#submit_bdep').click(function(){
            if(validationBankDeposit() == 0){
                var to_bank_bdep = $('#to_bank_bdep').val();
                var location_bdep = $('#location_bdep').val();
                var remark_bdep = $('#remark_bdep').val();
                var amt_bdep = $('#amt_bdep').val();
                $.ajax({
                    url: 'accountsFile/cashtally/contra/submitBankDeposit.php',
                    data: {'to_bank_bdep':to_bank_bdep,'location_bdep':location_bdep,'remark_bdep':remark_bdep,'amt_bdep':amt_bdep},
                    type: 'post',
                    cache: false,
                    success: function(response){
                        if(response.includes('Successfully')){
                            Swal.fire({
                                title: response,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            })
                        }else if(response.includes('Error')){
                            Swal.fire({
                                title: response,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                        }
                        $('#to_bank_bdep').val('');
                        $('#location_bdep').val('');
                        $('#remark_bdep').val('');
                        $('#amt_bdep').val('');
                    }
                });
            }
        })
    })
}

function validationBankDeposit(){
    var to_bank_bdep = $('#to_bank_bdep').val();
    var location_bdep = $('#location_bdep').val();
    var remark_bdep = $('#remark_bdep').val();
    var amt_bdep = $('#amt_bdep').val();
    var retval = 0;

    function validateField(value, fieldId) {
        if (value === '') {
            retval = 1;
            event.preventDefault();
            $(fieldId).show();
        } else {
            $(fieldId).hide();
        }
    }
    
    validateField(to_bank_bdep, '#to_bank_bdepCheck');
    validateField(location_bdep, '#location_bdepCheck');
    validateField(remark_bdep, '#remark_bdepCheck');
    validateField(amt_bdep, '#amt_bdepCheck');
    return retval;
}

function getCashDepositDetails(bank_id){
    
    $.ajax({
        url: 'accountsFile/cashtally/contra/getCashDepositDetails.php',
        data:{'bank_id':bank_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#contraTableDiv').removeClass('row')
            $('#contraTableDiv').empty()
            $('#contraTableDiv').html(response)
        }
    })
}

// function receivecdBtnClick(bdep_id){
//     $.ajax({
//         url:'accountsFile/cashtally/contra/receivecdAmtModal.php',
//         data: {'bdep_id':bdep_id},
//         type: 'post',
//         cache: false,
//         success: function(response){
//             $('#receivecdAmtModal').empty();
//             $('#receivecdAmtModal').html(response);
//         }
//     })
// }
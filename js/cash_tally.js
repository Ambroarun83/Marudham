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
            }else if(credit_type == 2 && cash_type == '0'){
                // 2 means Bank Withdrawal and cash type is hand
                $('.contra_card').show();
                getBankWithdrawalDetails();
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
                getCashWithdrawalDetails();
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

//inputs for bank deposit 
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
                <input type="number" id="amt_bdep" name="amt_bdep" class="form-control" placeholder="Please Enter Amount">
                <span class="text-danger" id='amt_bdepCheck' style="display:none">Please Enter Amount</span>
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
        url:'accountsFile/cashtally/contra/getBankDetails.php',
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

//Bank deposit validation
function validationBankDeposit(){
    var to_bank_bdep = $('#to_bank_bdep').val();
    var location_bdep = $('#location_bdep').val();
    var remark_bdep = $('#remark_bdep').val();
    var amt_bdep = $('#amt_bdep').val();
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
    
    validateField(to_bank_bdep, '#to_bank_bdepCheck');
    validateField(location_bdep, '#location_bdepCheck');
    validateField(remark_bdep, '#remark_bdepCheck');
    validateField(amt_bdep, '#amt_bdepCheck');
    return response;
}

//get BAnk deposited amount detail table for Cash Deposit 
function getCashDepositDetails(bank_id){
    $.ajax({
        url: 'accountsFile/cashtally/contra/getCashDepositDetails.php',
        data:{'bank_id':bank_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('.contra_card_header').text('Contra - Cash Deposit')
            $('#contraTableDiv').removeClass('row')
            $('#contraTableDiv').empty()
            $('#contraTableDiv').html(response)
        }
    })
}

//Open modal when receive button clicked
function receivecdBtnClick(bdep_id1){
    var bdep_id = $(bdep_id1).data('value');
    $.ajax({
        url:'accountsFile/cashtally/contra/receivecdAmtModal.php',
        data: {'bdep_id':bdep_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#receivecdAmtDiv').empty();
            $('#receivecdAmtDiv').html(response);
        }
    }).then(function(){
        $('#submit_cd').off('click');
        $('#submit_cd').click(function(){
            var formData = $('#cr_cd_form').serialize(); // Serialize the form inputs to send all data
            console.log(cdValidation())
            if(cdValidation() == 0){
                $.ajax({
                    url: 'accountsFile/cashtally/contra/submitCashDeposit.php',
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
                                text:'Please close this module',
                                icon: 'warning',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                        }
                        $('#closeCdModal').trigger('click');
                        
                    }
                })
            }
        })
    })
}

//Validation for Cash Deposit
function cdValidation(){
    var trans_id = $('#trans_id_cd').val();var remark_cd = $('#remark_cd').val();var response = 0;
    if(trans_id == ''){
        event.preventDefault();
        $('#trans_id_cdCheck').show();
        response = 1;
    }else{
        $('#trans_id_cdCheck').hide();
    }
    if(remark_cd == ''){
        event.preventDefault();
        $('#remark_cdCheck').show();
        response = 1;
    }else{
        $('#remark_cdCheck').hide();
    }
    return response;
}

//reset Bank Deposit table when Cash Deposit modal closed
function closCdModal(){
    //reset bank deposit modal
    var cash_type =$('input[name=cash_type]:checked').val();
    getCashDepositDetails(cash_type);
}

//get Cash withrawal from bank account input details
function getCashWithdrawalDetails(){
    var appendTxt = `
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="ref_code_cwd">Ref Code</label>
                <input type="text" id="ref_code_cwd" name="ref_code_cwd" class="form-control" readonly>
                <span class="text-danger" id='ref_code_cwdCheck' style="display:none">Please Enter Ref Code</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="trans_id_cwd">Transaction ID</label>
                <input type="number" id="trans_id_cwd" name="trans_id_cwd" class="form-control" placeholder="Enter Transaction ID">
                <span class="text-danger" id='trans_id_cwdCheck' style="display:none">Please Enter Transaction ID</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="from_bank_cwd">From Bank</label>
                <!-- <select id="from_bank_cwd" name="from_bank_cwd" class="form-control"> -->
                <!-- </select> -->
                <input type='hidden' class='form-control' id='from_bank_id_cwd' name='from_bank_id_cwd' readonly>
                <input type='text' class='form-control' id='from_bank_cwd' name='from_bank_cwd' readonly>
                <span class="text-danger" id='from_bank_cwdCheck' style="display:none">Please Select Bank Name</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="acc_no_cwd">From Bank</label>
                <input type='text' class='form-control' id='acc_no_cwd' name='acc_no_cwd' readonly>
                <span class="text-danger" id='acc_no_cwdCheck' style="display:none">Please Select Account Number</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="cheque_cwd">Cheque No.</label>
                <input type="number" id="cheque_cwd" name="cheque_cwd" class="form-control" placeholder="Enter Cheque No.">
                <span class="text-danger" id='cheque_cwdCheck' style="display:none">Please Enter Cheque No.</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="remark_cwd">Remark</label>
                <input type="text" id="remark_cwd" name="remark_cwd" class="form-control" placeholder="Enter Remark">
                <span class="text-danger" id='remark_cwdCheck' style="display:none">Please Enter Remark</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
            <div class="form-group">
                <label for="amt_cwd">Amount</label>
                <input type="number" id="amt_cwd" name="amt_cwd" class="form-control" placeholder="Enter Amount">
                <span class="text-danger" id='amt_cwdCheck' style="display:none">Please Enter Amount</span>
            </div>
        </div>
        <div class="col-12">
            <div class="text-right">
                <label style="visibility:hidden"></label><br>
                <input type="button" id="submit_cwd" name="submit_cwd" class="btn btn-primary" value="Submit">
            </div>
        </div>`;
    $('.contra_card_header').text('Contra - Cash Withdrawal')
    $('#contraTableDiv').addClass('row', !$('#contraTableDiv').hasClass('row'));
    $('#contraTableDiv').empty()
    $('#contraTableDiv').html(appendTxt);
    
    $.ajax({
        url:'accountsFile/cashtally/contra/getRefCodeCWD.php',
        data:{},
        type: 'post',
        cache: false,
        success: function(response){
            $('#ref_code_cwd').empty()
            $('#ref_code_cwd').val(response)
        }
    })
    
    var bank_id =$('input[name=cash_type]:checked').val();    

    $.ajax({
        url:'accountsFile/cashtally/contra/getBankDetails.php',
        data:{},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#from_bank_cwd').empty()
            // $('#from_bank_cwd').append(`<option value=''>Select Bank Name</option>`)
            for(var i=0;i<response.length;i++){
                // $('#from_bank_cwd').append(`<option value='`+response[i]['bank_id']+`'>`+response[i]['bank_name']+`</option>`)
                if(bank_id == response[i]['bank_id']){
                    $('#from_bank_id_cwd').val(response[i]['bank_id'])
                    $('#from_bank_cwd').val(response[i]['bank_fullname'])
                    $('#acc_no_cwd').val(response[i]['acc_no'])
                }
            }
        }
    }).then(function(){
        $('#submit_cwd').off('click');
        $('#submit_cwd').click(function(){
            if(cwdvalidation() == 0){
                var ref_code_cwd = $('#ref_code_cwd').val();
                var trans_id_cwd = $('#trans_id_cwd').val();
                var from_bank_cwd = $('#from_bank_id_cwd').val();
                var cheque_cwd = $('#cheque_cwd').val();
                var remark_cwd = $('#remark_cwd').val();
                var amt_cwd = $('#amt_cwd').val();
                $.ajax({
                    url: 'accountsFile/cashtally/contra/submitCashWithdrawal.php',
                    data: {'ref_code':ref_code_cwd,'trans_id':trans_id_cwd,'from_bank':from_bank_cwd,'cheque':cheque_cwd,'remark':remark_cwd,'amt':amt_cwd},
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
                        getCashWithdrawalDetails();
                    }
                });
            }
        })
    })
}

//Cash withdrawal validation
function cwdvalidation(){
    var ref_code_cwd = $('#ref_code_cwd').val();
    var trans_id_cwd = $('#trans_id_cwd').val();
    var from_bank_cwd = $('#from_bank_cwd').val();
    var cheque_cwd = $('#cheque_cwd').val();
    var remark_cwd = $('#remark_cwd').val();
    var amt_cwd = $('#amt_cwd').val();
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
    
    validateField(trans_id_cwd, '#trans_id_cwdCheck');
    validateField(cheque_cwd, '#cheque_cwdCheck');
    validateField(remark_cwd, '#remark_cwdCheck');
    validateField(amt_cwd, '#amt_cwdCheck');
    return response;
}

//get Cash withdrawal entries in table for Bank withdrawal
function getBankWithdrawalDetails(){
    $.ajax({
        url: 'accountsFile/cashtally/contra/getBankWithdrawalDetails.php',
        data:{},
        type: 'post',
        cache: false,
        success: function(response){
            $('.contra_card_header').text('Contra - Bank Withdrawal')
            $('#contraTableDiv').removeClass('row')
            $('#contraTableDiv').empty()
            $('#contraTableDiv').html(response)
        }
    })
}

//To get cash withdrawal details on Bank withdrawal modal 
function receivebwdBtnClick(bwd_id1){
    var bwd_id = $(bwd_id1).data('value');
    $.ajax({
        url:'accountsFile/cashtally/contra/receivebwdAmtModal.php',
        data: {'bwd_id':bwd_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#receivebwdAmtDiv').empty();
            $('#receivebwdAmtDiv').html(response);
        }
    }).then(function(){
        $('#submit_bwd').off('click');
        $('#submit_bwd').click(function(){
            var formData = $('#cr_bwd_form').serialize(); // Serialize the form inputs to send all data

            if(bwdValidation() == 0){
                $.ajax({
                    url: 'accountsFile/cashtally/contra/submitBankWithdrawal.php',
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
                                text:'Please close this module',
                                icon: 'warning',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                        }
                        $('#closebwdModal').trigger('click');
                        
                    }
                })
            }
        })
    })
}

//Validation for Bank Withdrawal
function bwdValidation(){
    var remark_bwd = $('#remark_bwd').val();var response = 0;
    if(remark_bwd == ''){
        event.preventDefault();
        $('#remark_bwdCheck').show();
        response = 1;
    }else{
        $('#remark_bwdCheck').hide();
    }

    return response;
}


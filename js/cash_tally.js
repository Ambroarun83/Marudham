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
            }else if(credit_type == 4 && cash_type == '0'){
                //4 Means Exchange and cash type hand cash
                $('.exchange_card').show();
                getCreditHexchangeDetails();
            }else if(credit_type == 4 && cash_type > 0){
                //4 Means Exchange and cash type Bank cash
                $('.exchange_card').show();
                getCreditBexchangeDetails();
            }else if(credit_type == 3 && cash_type == '0'){
                //3 Means Other income and cash type Hand cash
                $('.oti_card').show();
                getHotherincomeDetails();
            }else if(credit_type == 3 && cash_type > 0){
                //3 Means Other income and cash type Bank cash
                $('.oti_card').show();
                getBotherincomeDetails();
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
            }else if(debit_type == 4 && cash_type == '0'){
                //4 Means Exchange and cash type hand cash
                $('.exchange_card').show();
                getHandExchangeInputs();
            }else if(debit_type == 4 && cash_type > 0){
                //4 Means Exchange and cash type Bank cash
                $('.exchange_card').show();
                getBankExchangeInputs();
            }else if(debit_type == 13 && cash_type == '0'){
                //13 Means Issued and cash type Hand cash
                $('.issued_card').show();
                getHissuedTable();
            }else if(debit_type == 13 && cash_type > 0){
                //13 Means Issued and cash type Bank cash
                $('.issued_card').show();
                getBissuedTable();
            }
        }
    })

    $('#sheet_type').change(function(){
        var sheet_type = $(this).val();
        if(sheet_type != '' ){
            $.ajax({
                url: 'accountsFile/cashtally/contra/getBalanceSheet.php',
                data:{'sheet_type':sheet_type},
                type: 'post',
                cache: false,
                success: function(response){
                    $('#blncSheetDiv').empty()
                    $('#blncSheetDiv').html(response)
                }
            })
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
    $('#collectionTableDiv').empty();// empty the card fields when hiding
    $('#receiveAmtDiv').empty();// empty the Modal fields when hiding

    $('.contra_card').hide();
    $('#contraTableDiv').empty();// empty the card fields when hiding
    $('#receivecdAmtDiv').empty();// empty the Modal fields when hiding
    $('#receivebwdAmtDiv').empty();// empty the Modal fields when hiding
    
    $('#blncSheetDiv').empty();// empty the Balance sheet Modal fields when hiding
    
    $('.exchange_card').hide();
    $('#exchangeDiv').empty(); //empty the card fields when hiding
    $('#hexchangeDiv').empty(); //empty the Modal fields when hiding
    $('#bexchangeDiv').empty(); //empty the Modal fields when hiding

    $('.oti_card').hide();
    $('#otiDiv').empty();//empy the card 
    
    $('.issued_card').hide();
    $('#issuedDiv').empty();//empy the card 
    $('#bissuedDiv').empty();//empy the Modal
}


// //////////////////////////////////////////////////// Hand Collection //////////////////////////////////////////////// //
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
// ///////////////////////////////////////////////////// Hand Collection /////////////////////////////////////////////// //


// ///////////////////////////////////////////////////// Bank Collection /////////////////////////////////////////////// //
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
// //////////////////////////////////////////////////// Bank Collection //////////////////////////////////////////////// //


// //////////////////////////////////////////////////// Contra Start //////////////////////////////////////////////////////// //

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

/********************************************************* Deposit Ends *******************************************************/

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

/******************************************************** Withdrawal End ******************************************************/

function resetBlncSheet(){
    $('#credit_type').val('');
    $('#debit_type').val('');
    $('#sheet_type').val('');
    $('#blncSheetDiv').empty();
}

// //////////////////////////////////////////////////// Contra END //////////////////////////////////////////////////////// //

// //////////////////////////////////////////////////// Exhange Start //////////////////////////////////////////////////////// //

// To get hand exchange inputs as html and submit action
function getHandExchangeInputs(){
    var appendText = `<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="user_id_hed">User Name</label>
            <select id="user_id_hed" name="user_id_hed" class="form-control" >
                <option value=''>Select User Name</option>
            </select>
            <span class="text-danger" id='user_id_hedCheck' style="display:none">Please Select User Name</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="user_type_hed">User Type</label>
            <input type="text" id="user_type_hed" name="user_type_hed" class="form-control" readonly>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="remark_hed">Remark</label>
            <input type="text" id="remark_hed" name="remark_hed" class="form-control" placeholder="Enter Remarks">
            <span class="text-danger" id='remark_hedCheck' style="display:none">Please Enter Remarks</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="amt_hed">Amount</label>
            <input type="number" id="amt_hed" name="amt_hed" class="form-control" placeholder="Enter Amount">
            <span class="text-danger" id='amt_hedCheck' style="display:none">Please Enter Amount</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label style="visibility:hidden"></label><br>
            <input type="button" id="submit_hed" name="submit_hed" class="btn btn-primary" value="Submit">
        </div>
    </div>`;

    $('#exchangeDiv').addClass('row', !$('#exchangeDiv').hasClass('row'));
    $('#exchangeDiv').empty()
    $('#exchangeDiv').html(appendText);

    $.ajax({
        url: 'accountsFile/cashtally/exchange/getHexchangeTableforDelete.php',
        data: {},
        type: 'post',
        cache: false,
        success: function(response){
            $('#exchangeDiv').append("<div class='col-12'><div class='form-group'>"+response+"</div></div>");
        }
    }).then(function(){
        $('.delete_hex').click(function(){
            if(confirm('Do You want to delete this?')){
                var hex_id = $(this).data('value');
                $.ajax({
                    url: 'accountsFile/cashtally/exchange/getHexchangeDelete.php',
                    data: {'hex_id':hex_id},
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
                            getHandExchangeInputs();
                        }else if(response.includes('Error')){
                            Swal.fire({
                                title: response,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                        }
                    }
                })
            }
        })
    })

    $.ajax({
        url: 'accountsFile/cashtally/exchange/getHandExchangeInputs.php',
        data:{},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            
            $('#user_id_hed').empty();
            $('#user_id_hed').append("<option value=''>Select User Name</option>");
            for(var i=0;i<response.length;i++){
                $('#user_id_hed').append("<option value='"+response[i]['user_id']+"'>"+response[i]['user_name']+"</option>");
            }
            $('#user_id_hed').change(function(){
                var user_id = $(this).val();
                if(user_id != ''){
                    for(var i=0;i<response.length;i++){
                        if(user_id == response[i]['user_id']){
                            var role = response[i]['role'];
                            var rolename = (role == '1') ? "Director" : (role == '3') ? "Staff" : '';
                            $('#user_type_hed').val(rolename);
                        }
                    }
            }}) 

        }
    }).then(function(){
        $('#submit_hed').click(function(){
            if(handExchangeValidation() != 1){
                var user_id = $('#user_id_hed').val(); var remark = $('#remark_hed').val(); var amt = $('#amt_hed').val();
                $.ajax({
                    url: 'accountsFile/cashtally/exchange/submitdbHandExchange.php',
                    data: {'user_id':user_id,'remark':remark,'amt':amt},
                    type: 'post',
                    cache: false,
                    success:function(response){
                        if(response.includes('Successfully')){
                            Swal.fire({
                                title: response,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            })
                            $('#user_id_hed').val('');$('#user_type_hed').val('');$('#remark_hed').val('');$('#amt_hed').val('');
                            getHandExchangeInputs();
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
                        
                    }
                })
            }
            
        })
    })

}

function handExchangeValidation(){
    var user_id = $('#user_id_hed').val(); var remark = $('#remark_hed').val(); var amt = $('#amt_hed').val();var res = 0;
    if(user_id == ''){
        event.preventDefault();
        $('#user_id_hedCheck').show();
        res = 1;
    }else{
        $('#user_id_hedCheck').hide();
    }
    if(remark == ''){
        event.preventDefault();
        $('#remark_hedCheck').show();
        res = 1;
    }else{
        $('#remark_hedCheck').hide();
    }
    if(amt == ''){
        event.preventDefault();
        $('#amt_hedCheck').show();
        res = 1;
    }else{
        $('#amt_hedCheck').hide();
    }
    return res;
}


//to get hand exchange credit input table
function getCreditHexchangeDetails(){
    $.ajax({
        url: 'accountsFile/cashtally/exchange/getCreditHexchangeDetails.php',
        data: {},
        type: 'post',
        cache: false,
        success: function(response){
            $('#exchangeDiv').removeClass('row')
            $('#exchangeDiv').empty();
            $('#exchangeDiv').html(response);
        }
    })
}

//To trigger modal and fetch details for hand exchange
function hexCollectBtnClick(hex_id1){
    var hex_id = $(hex_id1).data('value');
    $.ajax({
        url:'accountsFile/cashtally/exchange/getHexchangeDetailModal.php',
        data: {'hex_id':hex_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#hexchangeDiv').empty();
            $('#hexchangeDiv').html(response);
        }
    }).then(function(){
        $('#submit_hex').click(function(){
            var formdata = $('#cr_hex_form').serialize();
            $.ajax({
                url: 'accountsFile/cashtally/exchange/submitcrHandExchange.php',
                data: formdata,
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
                    }else if(response.includes('Debited')){
                        Swal.fire({
                            title: response,
                            icon: 'info',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688'
                        });
                    }
                    $('#closeHexchangeModal').trigger('click');
                    getCreditHexchangeDetails();
                }
            })
        })
    })
}

//To get bank debit exchange details and submit button
function getBankExchangeInputs(){
    var appendText = `<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="ref_code_bex">Ref ID</label>
            <input type='text' id="ref_code_bex" name="ref_code_bex" class="form-control" readonly>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="from_acc_bex">From Account</label>
            <input type="hidden" id="from_acc_id_bex" name="from_acc_id_bex" class="form-control" readonly>
            <input type="text" id="from_acc_bex" name="from_acc_bex" class="form-control" readonly>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="to_bank_bex">To Bank</label>
            <select id="to_bank_bex" name="to_bank_bex" class="form-control">
            </select>
            <span class="text-danger" id='to_bank_bexCheck' style="display:none">Please Select Bank</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="user_name_bex">User Name</label>
            <input type="hidden" id="user_id_bex" name="user_id_bex" class="form-control" readonly>
            <input type="text" id="user_name_bex" name="user_name_bex" class="form-control" readonly>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="trans_id_bex">Transaction ID</label>
            <input type="text" id="trans_id_bex" name="trans_id_bex" class="form-control" placeholder="Enter Transaction ID">
            <span id="trans_id_bexCheck" class="text-danger" style="display:none">Please Enter Transaction ID </span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="remark_bex">Remark</label>
            <input type="text" id="remark_bex" name="remark_bex" class="form-control" placeholder="Enter Remark">
            <span id="remark_bexCheck" class="text-danger" style="display:none">Please Enter Remarks</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="amt_bex">Amount</label>
            <input type="number" id="amt_bex" name="amt_bex" class="form-control" placeholder="Enter Amount">
            <span id="amt_bexCheck" class="text-danger" style="display:none">Please Enter Amount</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label style="visibility:hidden"></label><br>
            <input type="button" id="submit_bex" name="submit_bex" class="btn btn-primary" value="Submit">
        </div>
    </div>`;

    $('#exchangeDiv').addClass('row', !$('#exchangeDiv').hasClass('row'));
    $('#exchangeDiv').empty()
    $('#exchangeDiv').html(appendText);

    var cash_type =$('input[name=cash_type]:checked').val();

    $.ajax({
        url: 'accountsFile/cashtally/exchange/getBankExchangeInputs.php',
        data: {'cash_type':cash_type},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#ref_code_bex').val(response[0]['ref_code']);
            $('#from_acc_id_bex').val(response[0]['bank_id']);
            $('#from_acc_bex').val(response[0]['bank_name']);

            $('#to_bank_bex').empty();
            $('#to_bank_bex').append("<option value=''>Select Bank Name</option>");
            for(var i=0;i<response.length;i++){
                $('#to_bank_bex').append("<option value='"+response[i]['to_bank_id']+"'>"+response[i]['to_bank_name']+"</option>");
            }

            //to fetch user name based on to bank id selected
            $('#to_bank_bex').change(function(){
                var to_bank_id = $(this).val();
                if(to_bank_id != ''){
                    for(var i=0;i<response.length;i++){
                        if(to_bank_id == response[i]['to_bank_id']){
                            $('#user_id_bex').val(response[i]['bank_user_id'])
                            $('#user_name_bex').val(response[i]['bank_user_name'])
                        }
                    }
                }
            })
        }
    }).then(function(){
        $('#submit_bex').click(function(){
            if(bankExchangeValidation() != 1){
                var ref_code = $('#ref_code_bex').val();var from_acc_id_bex = $('#from_acc_id_bex').val();var from_acc_bex = $('#from_acc_bex').val();var to_bank_bex = $('#to_bank_bex').val();var trans_id_bex = $('#trans_id_bex').val();
                var user_id_bex = $('#user_id_bex').val();var remark_bex = $('#remark_bex').val();var amt_bex = $('#amt_bex').val();
                var formdata = {ref_code: ref_code,from_acc_id_bex:from_acc_id_bex,from_acc_bex: from_acc_bex,to_bank_bex: to_bank_bex,trans_id_bex: trans_id_bex,user_id_bex: user_id_bex,remark_bex: remark_bex,amt_bex: amt_bex};
                $.ajax({
                    url: 'accountsFile/cashtally/exchange/submitdbBankExchange.php',
                    data: formdata,
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
                            getBankExchangeInputs();
                        }else if(response.includes('Error')){
                            Swal.fire({
                                title: response,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                        }
                    }
                })
            }
        })
    })

}

function bankExchangeValidation(){
    var to_bank_bex = $('#to_bank_bex').val();var trans_id_bex = $('#trans_id_bex').val();var remark_bex = $('#remark_bex').val();var amt_bex = $('#amt_bex').val();
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
    
    validateField(to_bank_bex, '#to_bank_bexCheck');
    validateField(trans_id_bex, '#trans_id_bexCheck');
    validateField(remark_bex, '#remark_bexCheck');
    validateField(amt_bex, '#amt_bexCheck');
    return response;
}

//to get Bank exchange credit input table
function getCreditBexchangeDetails(){
    var bank_id =$('input[name=cash_type]:checked').val();
    $.ajax({
        url: 'accountsFile/cashtally/exchange/getCreditBexchangeDetails.php',
        data: {'bank_id':bank_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#exchangeDiv').removeClass('row')
            $('#exchangeDiv').empty();
            $('#exchangeDiv').html(response);
        }
    })
}

// to fetch details for Bank exchange credit modal
function bexCollectBtnClick(bex_id1){
    var bex_id = $(bex_id1).data('value');
    $.ajax({
        url:'accountsFile/cashtally/exchange/getBexchangeDetailModal.php',
        data: {'bex_id':bex_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#bexchangeDiv').empty();
            $('#bexchangeDiv').html(response);
        }
    }).then(function(){

        $('#submit_bex').click(function(){
            var formdata = $('#cr_bex_form').serialize();
            if(bexValidation() != 1){
                $.ajax({
                    url: 'accountsFile/cashtally/exchange/submitcrBankExchange.php',
                    data: formdata,
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
                            $('#closebexchangeModal').trigger('click');
                        }else if(response.includes('Error')){
                            Swal.fire({
                                title: response,
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonColor: '#009688'
                            });
                        }
                    }
                })
            }
        })
    })
}

function bexValidation(){
    var trans_id = $('#trans_id').val();var remark = $('#remark').val();var response=0;
    if(trans_id == ''){
        event.preventDefault();
        $('#trans_idCheck').show();
        response = 1;
    }else{
        $('#trans_idCheck').hide();
    }
    if(remark == ''){
        event.preventDefault();
        $('#remarkCheck').show();
        response = 1;
    }else{
        $('#remarkCheck').hide();
    }
    return response;
}

// //////////////////////////////////////////////////// Exhange End //////////////////////////////////////////////////////// //

// //////////////////////////////////////////////////// Other Income Start //////////////////////////////////////////////////////// //

//to get the hand other income inputs and submit button action
function getHotherincomeDetails(){
    var appendText = `<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="cat_info">Category</label>
            <input type='text' id="cat_info" name="cat_info" class="form-control" placeholder="Enter Category">
            <span id='cat_infoCheck' class="text-danger" style="display:none">Please Enter Category</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="remark">Remark</label>
            <input type="text" id="remark" name="remark" class="form-control" placeholder="Enter Remark">
            <span id='remarkCheck' class="text-danger" style="display:none">Please Enter Remark</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="amt">Amount</label>
            <input type="number" id="amt" name="amt" class="form-control" placeholder="Enter Amount">
            <span id='amtCheck' class="text-danger" style="display:none">Please Enter Amount</span>
        </div>
    </div>
    <div class="col-8"></div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="text-right">
            <label style="visibility:hidden"></label><br>
            <input type="button" id="submit_hoti" name="submit_hoti" class="btn btn-primary" value="Submit">
        </div>
    </div>`;

    $('#otiDiv').addClass('row', !$('#otiDiv').hasClass('row'));
    $('#otiDiv').empty()
    $('#otiDiv').html(appendText);

    $('#submit_hoti').click(function(){
        if(otiValidation() == 0){
            var cat_info = $('#cat_info').val();var remark = $('#remark').val();var amt = $('#amt').val();
            $.ajax({
                url:'accountsFile/cashtally/otherincome/submitHotherincome.php',
                data: {'cat_info':cat_info,'remark':remark,'amt':amt},
                type: 'post',
                cache: false,
                success:function(response){
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
                    getHotherincomeDetails();
                }
            })
        }
    })
}

//validation fot hand other income
function otiValidation(){
    var cat_info = $('#cat_info').val();var remark = $('#remark').val();var amt = $('#amt').val();
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
    
    validateField(cat_info, '#cat_infoCheck');
    validateField(remark, '#remarkCheck');
    validateField(amt, '#amtCheck');
    return response;
}

//to get the Bank other income inputs and submit button action
function getBotherincomeDetails(){
    var appendText = `
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="ref_code_boti">Ref ID</label>
            <input type='text' id="ref_code_boti" name="ref_code_boti" class="form-control" readonly>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="cat_info">Category</label>
            <input type='text' id="cat_info" name="cat_info" class="form-control" placeholder="Enter Category">
            <span id='cat_infoCheck' class="text-danger" style="display:none">Please Enter Category</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="trans_id">Transaction ID</label>
            <input type='number' id="trans_id" name="trans_id" class="form-control" placeholder="Enter Transaction ID">
            <span id='trans_idCheck' class="text-danger" style="display:none">Please Enter Transaction ID</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="remark">Remark</label>
            <input type="text" id="remark" name="remark" class="form-control" placeholder="Enter Remark">
            <span id='remarkCheck' class="text-danger" style="display:none">Please Enter Remark</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label for="amt">Amount</label>
            <input type="number" id="amt" name="amt" class="form-control" placeholder="Enter Amount">
            <span id='amtCheck' class="text-danger" style="display:none">Please Enter Amount</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
        <div class="form-group">
            <label style="visibility:hidden"></label><br>
            <input type="button" id="submit_boti" name="submit_boti" class="btn btn-primary" value="Submit">
        </div>
    </div>`;

    $('#otiDiv').addClass('row', !$('#otiDiv').hasClass('row'));
    $('#otiDiv').empty()
    $('#otiDiv').html(appendText);

    $.ajax({
        url:'accountsFile/cashtally/otherincome/getrefcodeBoti.php',
        data: {},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#ref_code_boti').val(response);
        }
    })
    $('#submit_boti').click(function(){
        if(botiValidation() == 0){
            var ref_code = $('#ref_code_boti').val();var cat_info = $('#cat_info').val();var trans_id = $('#trans_id').val();var remark = $('#remark').val();var amt = $('#amt').val();
            var bank_id =$('input[name=cash_type]:checked').val();
            $.ajax({
                url:'accountsFile/cashtally/otherincome/submitBotherincome.php',
                data: {'bank_id':bank_id,'ref_code':ref_code,'cat_info':cat_info,'trans_id':trans_id,'remark':remark,'amt':amt},
                type: 'post',
                cache: false,
                success:function(response){
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
                    getBotherincomeDetails();
                }
            })
        }
    })
}

//validation fot hand other income
function botiValidation(){
    var cat_info = $('#cat_info').val();var remark = $('#remark').val();var amt = $('#amt').val();var trans_id = $('#trans_id').val();
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
    
    validateField(cat_info, '#cat_infoCheck');
    validateField(trans_id, '#trans_idCheck');
    validateField(remark, '#remarkCheck');
    validateField(amt, '#amtCheck');
    return response;
}

// //////////////////////////////////////////////////// Other Income End //////////////////////////////////////////////////////// //

// //////////////////////////////////////////////////// Issued Start //////////////////////////////////////////////////////// //

//get table Details for Hand issued from loan issue tables and submit button
function getHissuedTable(){
    $.ajax({
        url: 'accountsFile/cashtally/issued/getHissuedTable.php',
        data: {},
        type: 'post',
        cache: false,
        success: function(response){
            $('#issuedDiv').removeClass('row')
            $('#issuedDiv').empty();
            $('#issuedDiv').html(response);
        }
    }).then(function(){
        $('.hissued_btn').click(function(){
            var amt = $(this).parent().prev().text();
            var netcash = $(this).parent().prev().prev().text();
            var username = $(this).parent().prev().prev().prev().text();
            var usertype = $(this).parent().prev().prev().prev().prev().text();
            var user_id = $(this).data('value');
            
            var fomrdata = {amt:amt,netcash:netcash,username:username,usertype:usertype,user_id:user_id}
            if(confirm("Are you sure to submit this?")){

                $.ajax({
                    url: 'accountsFile/cashtally/issued/submitHissued.php',
                    data: fomrdata,
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
                        getHissuedTable();
                    }
                })
            }
        })

    })
}

//get table Details for Bank issued from loan issue tables and submit button
function getBissuedTable(){
    var bank_id =$('input[name=cash_type]:checked').val();    
    $.ajax({
        url: 'accountsFile/cashtally/issued/getBissuedTable.php',
        data: {'bank_id':bank_id},
        type: 'post',
        cache: false,
        success: function(response){
            $('#issuedDiv').removeClass('row')
            $('#issuedDiv').empty();
            $('#issuedDiv').html(response);
        }
    }).then(function(){
        $('.bissued_btn').click(function(){
            var user_id = $(this).data('value');
            var li_id = $(this).data('id');
            $.ajax({
                url: 'accountsFile/cashtally/issued/getBissuedForModal.php',
                data: {'user_id':user_id,'li_id':li_id},
                type: 'post',
                cache: false,
                success: function(response){
                    $('#bissuedDiv').empty();
                    $('#bissuedDiv').html(response);
                }
            }).then(function(){
                $('#submit_bissued').click(function(){
                    var formdata = $('#db_bissued_form').serialize();
                    $.ajax({
                        url:'accountsFile/cashtally/issued/submitBissued.php',
                        data: formdata,
                        type: 'post',
                        cache: false,
                        success:function(response){
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
                            getBissuedTable();
                            $('#closeissuedModal').trigger('click');
                        }
                    })
                })
            })
        })
    })
}


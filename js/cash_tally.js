$(document).ready(function(){

    $('#hand_cash_radio , .bank_cash_radio').click(function(){
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
        var credit_type = $(this).val();
        if(credit_type != ''){
            
            if(credit_type == 1){ 
                // 1 means Collection
                getCollectionDetails();
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


function getCollectionDetails(){
    var user_branch_id = $('#user_branch_id').val();
    $.ajax({
        url:'accountsFile/cashtally/getCollectionDetails.php',
        data: {'branch_id':user_branch_id},
        dataType: 'post',
        type: 'json',
        cache: false,
        success: function(response){

        }
    })

}
$(document).ready(function () {

    // Issue Mode
    $('#issued_mode').change(function () {
        var mode = $(this).val();

        
        $('#cash').removeAttr('readonly');
        $('#chequeValue').removeAttr('readonly');
        $('#transaction_value').removeAttr('readonly');

        if (mode == '0') {
            $('.cash_issue').show();
            $('.checque').show();
            $('.transaction').show();
            $('.balance').show();

            $('.paymentType').hide();

        } else if (mode == '1') {
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').hide();
            $('.paymentType').show();
            $('.balance').hide();

        } else {
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').hide();
            $('.paymentType').hide();
            $('.balance').hide();
        }

        $('#cash').val('');
        $('#chequeno').val('');
        $('#chequeValue').val('');
        $('#chequeRemark').val('');
        $('#transaction_id').val('');
        $('#transaction_value').val('');
        $('#transaction_remark').val('');
        $('#payment_type').val('');

        hideCheckSpan()
    })

    // Payment Type
    $('#payment_type').change(function () {
        $('#cash').val('');
        $('#chequeno').val('');
        $('#chequeValue').val('');
        $('#chequeRemark').val('');
        $('#transaction_id').val('');
        $('#transaction_value').val('');
        $('#transaction_remark').val('');
        var type = $(this).val();
        var netcash = $('#net_cash').val();

        if (type == '0') {
            $('.cash_issue').show();
            $('#cash').val(netcash);
            $('#cash').attr('readonly', true);
            $('#balance').val('0');
            $('.checque').hide();
            $('.transaction').hide();

        } else if (type == '1') {
            $('.cash_issue').hide();
            $('.checque').show();
            $('#chequeValue').val(netcash);
            $('#chequeValue').attr('readonly', true);
            $('#balance').val('0');
            $('.transaction').hide();

        } else if (type == '2') {
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').show();
            $('#transaction_value').val(netcash);
            $('#transaction_value').attr('readonly', true);
            $('#balance').val('0');

        } else {
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').hide();
            $('#balance').val('');
        }

        hideCheckSpan();
    })

    //Check Cash limit based on Net Cash
    $('#cash').change(function () {
        checkIssuedAmount('0');
    });
    $('#chequeValue').change(function () {
        checkIssuedAmount('1');
    });
    $('#transaction_value').change(function () {
        checkIssuedAmount('2');
    });

    $('#cash_guarentor_name').change(function () { //Select Guarantor Name relationship will show in input.

        let famId = document.querySelector("#cash_guarentor_name").value;
    
        $.ajax({
            url: 'verificationFile/verification_guarantor.php',
            type: 'POST',
            data: { "famid": famId },
            dataType: 'json',
            cache: false,
            success: function (result) {
    
                $("#relationship").val(result['relation']);
    
            }
        });
    
    });

    $('#submit_loanIssue').click(function(){ // loan Issue Submit Validation.
        hideCheckSpan();

        loanIssueSumitValidation();

    });
});

$(document).ready(function() {
    $("#scanBtn").click(function() {event.preventDefault();
        		var quality = 60; //(1 to 100) (recommended minimum 55)
                var timeout = 10; // seconds (minimum=10(recommended), maximum=60, unlimited=0)
                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) {
                    document.getElementById('txtStatus').value = "ErrorCode: " + res.data.ErrorCode + "ErrorDescription: " + res.data.ErrorDescription;
                    if (res.data.ErrorCode == "0") {
                        console.log(res.data);
                        document.getElementById('txtStatus').value = res.data.AnsiTemplate;
                        document.getElementById('imgShow').src = "data:image/bmp;base64," + res.data.BitmapData;
                    }
                }
                else {
                    alert(res.err);
                }
    });
});

$(function () {
    getImage(); // To show customer image when window onload.
    guarentorName(); //To Show Guarentor Name.
    getLc(); // To get loan Category.

    getCategoryInfo(); //To show Category Info.
    getAgentDetails(); //To Get Agent Details.

    cashAckName(); // To show Cash Acknowledgement Name.
    checkBalance(); // To check in DB.

});

// Cus img show onload.
function getImage() {
    let imgName = $('#cus_image').val();
    $('#imgshow').attr('src', "uploads/request/customer/" + imgName + " ");

    var guarentorimg = $('#guarentor_image').val();
    $('#imgshows').attr('src', "uploads/verification/guarentor/" + guarentorimg + " ");
}

//Guarentor Name
function guarentorName() {
    let req_id = $('#req_id').val();
    var guarentor_name = $('#guarentor_name_upd').val();
    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#guarentor_name").empty();
            $("#guarentor_name").append("<option value=''>" + 'Select Guarantor' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                var selected = '';
                if (guarentor_name != '' && guarentor_name == fam_id) {
                    selected = 'selected';
                }
                $("#guarentor_name").append("<option value='" + fam_id + "' " + selected + ">" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#guarentor_name option:first-child");
                $("#guarentor_name").html($("#guarentor_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#guarentor_name").prepend(firstOption);
            }
        }
    });
}

//Loan Category
function getLc() {
    var lc_id = $('#loan_category_lc').val();

    $.ajax({
        url: 'loanIssueFile/getLoanCategoryforIssue.php',
        type: 'POST',
        data: { "lc_id": lc_id },
        dataType: 'json',
        success: function (result) {
            $('#loan_category').val(result);
        }
    })
}

//Get Category info From Request
function getCategoryInfo() {
    var sub_category_upd = $('#sub_category_upd').val();
    var sub_cat = $('#sub_category').val();
    $.ajax({
        url: 'requestFile/getCategoryInfo.php',
        data: { 'sub_cat': sub_cat },
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function (response) {
            category_info = ''
            $('#moduleTable').empty();
            $('#moduleTable').append('<tbody><tr>');
            if (response.length != 0) {
                var tb = 35;
                for (var i = 0; i < response.length; i++) {
                    $('#moduleTable tbody tr').append(`<td><label for="disabledInput">` + response[i]['loan_category_ref_name'] + `</label><span class="required">&nbsp;*</span><input type="text" class="form-control" id="category_info" name="category_info[]" 
                    value='`+ category_info + `' tabindex='` + tb + `'readonly required placeholder='Enter ` + response[i]['loan_category_ref_name'] + `'></td>`);
                    tb++;
                }
                $('#moduleTable').append(`</tr></tbody>`);

                var category_content = $('#moduleTable tbody tr').html(); //To get the appended category list

                var category_count = $('#moduleTable tbody tr').find('td').length;//To find input fields count
                getCategoryInputs(category_count, category_content, sub_category_upd);

            }
        }
    });


    function getCategoryInputs(category_count, category_content, sub_category_upd) {

        var req_id = $('#req_id').val();
        $.ajax({
            url: 'loanIssueFile/getCategoryInfoForIssue.php',
            data: { 'req_id': req_id, 'sub_category_upd': sub_category_upd },
            dataType: 'json',
            type: 'post',
            cachec: false,
            success: function (response) {
                var trCount = Math.ceil(response.length / category_count); // number of rows needed

                for(var j =0;j<trCount-1;j++){
                    $('#moduleTable tbody').append('<tr>'+category_content+'</tr>');
                    // $('#moduleTable tbody tr:last input').filter(':last').val('');
                }
                for (var i = 0; i < response.length; i++) {
                    $('#moduleTable tbody input').each(function (index) {
                        $(this).val(response[index]);
                    });
                }
            }
        })
    }

}

//Get Agent Name 
function getAgentDetails() {
    var req_id = $('#req_id').val();

    $.ajax({
        url: 'loanIssueFile/getAgentDetails.php',
        type: 'POST',
        data: { "req_id": req_id },
        dataType: 'json',
        success: function (result) {
            var ag_name = result['ag_name'];
            var lp = result['loan_payment'];
            var agent_id = result['agent_id'];

            if (agent_id != '' && lp == '0') {
                $('#agent').val(ag_name);
                $('#issue_to').val(ag_name);
                $('#agent_id').val(agent_id);

            } else {
                var cus_name = $('#cus_name').val();
                // $('#agent').val(cus_name);
                $('#issue_to').val(cus_name);
            }

        }
    })
}

//Check Issue Amount is equal to Net Cash.
function checkIssuedAmount(type) {
    var totalValue = 0 ; 
    var netCash = 0 ;

    function calcBal(){
    var cashValue = parseInt($('#cash').val());
    var chequeValue = parseInt($('#chequeValue').val());
    var transactionValue = parseInt($('#transaction_value').val());
    totalValue = (isNaN(cashValue) ? 0 : cashValue) + (isNaN(chequeValue) ? 0 : chequeValue) + (isNaN(transactionValue) ? 0 : transactionValue);
    netCash = parseInt($('#net_cash').val());
    var bal = parseInt(netCash) - parseInt(totalValue);
    if(bal >= 0){
        $('#balance').val(bal);
    }
    }

    calcBal();
    var issueMode = $('#issued_mode').val();

    if (issueMode == '0') { //Split payment.

        if (type == '0') { //Cash
            if (totalValue > netCash) {
                alert('Please Enter the Amount Less than "Balance To Issue!"');
                $('#cash').val('');
                calcBal()
            }
        } else if (type == '1') { //Cheque Value
            if (totalValue > netCash) { 
                alert('Please Enter the Amount Less than "Balance To Issue!"!');
                $('#chequeValue').val('');
                calcBal()
            }

        } else if (type == '2') {
            if (totalValue > netCash) { //Transaction 
                alert('Please Enter the Amount Less than "Balance To Issue!"!');
                $('#transaction_value').val('');
                calcBal()
            }
        }

    }
}

//cash Acknowledgement Name 
function cashAckName() {
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#cash_guarentor_name").empty();
            $("#cash_guarentor_name").append("<option value=''>" + 'Select Guarantor' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#cash_guarentor_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#cash_guarentor_name option:first-child");
                $("#cash_guarentor_name").html($("#cash_guarentor_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#cash_guarentor_name").prepend(firstOption);
            }
        }
    });
}

//To Check Loan Balance
function checkBalance(){
    var req_id = $('#req_id').val();
    $.ajax({
        url: 'loanIssueFile/getLoanBalance.php',
        type: 'POST',
        data: {"req_id": req_id},
        dataType: 'json',
        success: function(response){
            if(response['rowCnt'] > '0'){
                $('#net_cash').val(response['balance_amount']);
                if(response['balance_amount'] == '0'){
                    $('#issued_mode').attr('disabled',true);
                }
            }else{
                var netcashamnt = parseInt($('#net_cash_cal').val());
                $('#net_cash').val(netcashamnt);

            }

        }
    })

}

//Submit Validation
function loanIssueSumitValidation(){
    var issueMode = $('#issued_mode').val(); var paymenType =  $('#payment_type').val(); var cash =  $('#cash').val(); var chequeNum =  $('#chequeno').val(); var chequeVal =  $('#chequeValue').val(); var chequeRemark = $('#chequeRemark').val(); var transactionID = $('#transaction_id').val(); var transactionVal =  $('#transaction_value').val(); var transactionRemark = $('#transaction_remark').val(); var guarentorName = $('#cash_guarentor_name').val();
    //Check Issue Mode
    if(issueMode == ''){
        event.preventDefault();
        $('#issue').show();
    }else{
        $('#issue').hide();
    }
   
    //Issue Mode Split
    if(issueMode == '0'){
        //Check cheque If Cheque details enter
        if(chequeNum != '' || chequeVal != '' || chequeRemark != ''){
            if(chequeNum == ''){
                event.preventDefault();
                $('#cheque_num').show();
            }else{
                $('#cheque_num').hide();
            }
            if(chequeVal == ''){
                event.preventDefault();
                $('#cheque_val').show();
            }else{
                $('#cheque_val').hide();
            }
            if(chequeRemark == ''){
                event.preventDefault();
                $('#cheque_remark').show();
            }else{
                $('#cheque_remark').hide();
            }
        }

        //Check Transaction If Transaction details enter
        if(transactionID != '' || transactionVal != '' || transactionRemark != ''){
            if(transactionID == ''){
                event.preventDefault();
                $('#transact_id').show();
            }else{
                $('#transact_id').hide();
            }
            if(transactionVal == ''){
                event.preventDefault();
                $('#transact_val').show();
            }else{
                $('#transact_val').hide();
            }
            if(transactionRemark == ''){
                event.preventDefault();
                $('#transact_remark').show();
            }else{
                $('#transact_remark').hide();
            }
        }
    
        if(cash !='' || chequeVal != '' || transactionVal != ''){
            $('#val_check').hide();
        }else{
            event.preventDefault();
            $('#val_check').show();
        }
   } //Split END//

    //Issue Mode Single Payment
    if(issueMode == '1'){
        if(paymenType == ''){
            event.preventDefault();
            $('#pay_type').show();
        }else{
            $('#pay_type').hide();
        }
    }
    //Cash
    if(issueMode == '1' && paymenType == '0'){
        if(cash == ''){
            event.preventDefault();
            $('#cash_amnt').show();
        }else{
            $('#cash_amnt').hide();
        }
    }

    //Cheque
    if(issueMode == '1' && paymenType == '1'){
        if(chequeNum == ''){
            event.preventDefault();
            $('#cheque_num').show();
        }else{
            $('#cheque_num').hide();
        }

        if(chequeVal == ''){
            event.preventDefault();
            $('#cheque_val').show();
        }else{
            $('#cheque_val').hide();
        }

        if(chequeRemark == ''){
            event.preventDefault();
            $('#cheque_remark').show();
        }else{
            $('#cheque_remark').hide();
        }
    }

    //Transaction
    if(issueMode == '1' && paymenType == '2'){
        if(transactionID == ''){
            event.preventDefault();
            $('#transact_id').show();
        }else{
            $('#transact_id').hide();
        }

        if(transactionVal == ''){
            event.preventDefault();
            $('#transact_val').show();
        }else{
            $('#transact_val').hide();
        }

        if(transactionRemark == ''){
            event.preventDefault();
            $('#transact_remark').show();
        }else{
            $('#transact_remark').hide();
        }
    }

    if(cash != ''){
    if(guarentorName == ''){
        event.preventDefault();
        $('#cash_guarentor').show();
    }else{
        $('#cash_guarentor').hide();
    }
  }


}

//Span Hide
function hideCheckSpan(){
    $('#cheque_num').hide();$('#cheque_val').hide();$('#cheque_remark').hide();$('#transact_id').hide();$('#transact_val').hide();$('#transact_remark').hide(); $('#pay_type').hide();$('#cash_amnt').hide();$('#cash_guarentor').hide(); $('#val_check').hide();
}

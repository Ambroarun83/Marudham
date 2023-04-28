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
        var netcash = $('#net_cash_cal').val();

        if (type == '0') {
            $('.cash_issue').show();
            $('#cash').val(netcash);
            $('#cash').attr('readonly', true);
            $('.checque').hide();
            $('.transaction').hide();

        } else if (type == '1') {
            $('.cash_issue').hide();
            $('.checque').show();
            $('#chequeValue').val(netcash);
            $('#chequeValue').attr('readonly', true);
            $('.transaction').hide();

        } else if (type == '2') {
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').show();
            $('#transaction_value').val(netcash);
            $('#transaction_value').attr('readonly', true);

        } else {
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').hide();
        }


    })

    //Check Cash limit based on Net Cash
    $('#cash').change(function () {
        console.log('cash function running')
        checkIssuedAmount('0');
    });
    $('#chequeValue').change(function () {
        console.log('cheque function running')
        checkIssuedAmount('1');
    });
    $('#transaction_value').change(function () {
        console.log('transaction function running')
        checkIssuedAmount('2');
    });
});


$(function () {
    getImage(); // To show customer image when window onload.
    guarentorName(); //To Show Guarentor Name.
    getLc(); // To get loan Category.

    getCategoryInfo(); //To show Category Info.
    getAgentDetails(); //To Get Agent Details.

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

                var category_count = $('#moduleTable tbody tr').find('td').length - 2;//To find input fields count
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
    var cashValue = parseInt($('#cash').val());
    var chequeValue = parseInt($('#chequeValue').val());
    var transactionValue = parseInt($('#transaction_value').val());
    var totalValue = cashValue + chequeValue + transactionValue;
    var netCash = parseInt($('#net_cash_cal').val());
    var bal = parseInt(netCash) - parseInt(totalValue);
   // $('#balance').val(bal);
    var issueMode = $('#issued_mode').val();

    if (issueMode == '0') {

        if (type == '0') { //Cash
            if (totalValue > netCash) {
                alert('Please Enter the Amount Less than Net Cash!');
                $('#cash').val('');
            }
        } else if (type == '1') { //Cheque Value
            if (totalValue > netCash) { 
                alert('Please Enter the Amount Less than Net Cash!');
                $('#chequeValue').val('');
            }

        } else if (type == '2') {
            if (totalValue > netCash) { //Transaction 
                alert('Please Enter the Amount Less than Net Cash!');
                $('#transaction_value').val('');
            }
        }

    }
}
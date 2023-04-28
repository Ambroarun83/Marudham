$(document).ready(function(){

    $('#issued_mode').change(function(){ // Issue Mode 
        var mode = $(this).val();

        if(mode == '0'){
            $('.cash_issue').show();
            $('.paymentType').hide();

        }else if(mode == '1'){
            $('.cash_issue').hide();
            $('.paymentType').show();

        }else{
            $('.cash_issue').hide();
            $('.paymentType').hide();
        }

        $('.checque').hide();
        $('.transaction').hide();

        $('#cash').val('');
        $('#payment_type').val('');
    })

    $('#payment_type').change(function(){ // Payment Type 
        var type = $(this).val();

        if(type == '0'){
            $('.cash_issue').show();
            $('.checque').hide();
            $('.transaction').hide();

        }else if(type == '1'){
            $('.cash_issue').hide();
            $('.checque').show();
            $('.transaction').hide();

        }else if(type == '2'){
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').show();

        }else{
            $('.cash_issue').hide();
            $('.checque').hide();
            $('.transaction').hide();
        }

        $('#cash').val('');
        $('#chequeno').val('');
        $('#chequeRemark').val('');
        $('#transaction_id').val('');
        $('#transaction_remark').val('');
    })
});


$(function () {
   getImage(); // To show customer image when window onload.
   guarentorName(); //To Show Guarentor Name.
   getLc(); // To get loan Category.

   getCategoryInfo(); //To show Category Info.
   getAgentDetails(); //To Get Agent Details.

});

function getImage() { // Cus img show onload.
    let imgName = $('#cus_image').val();
    $('#imgshow').attr('src', "uploads/request/customer/" + imgName + " ");

    var  guarentorimg = $('#guarentor_image').val();
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
                if(guarentor_name != '' && guarentor_name == fam_id){
                    selected = 'selected';
                }
                $("#guarentor_name").append("<option value='" + fam_id + "' " + selected+ ">" + fam_name + "</option>");
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
function getLc(){
    var lc_id = $('#loan_category_lc').val();

    $.ajax({
        url:'loanIssueFile/getLoanCategoryforIssue.php',
        type: 'POST',
        data: {"lc_id":lc_id},
        dataType: 'json',
        success: function(result){
          $('#loan_category').val(result);
        }
    })
}

//Get Category info From Request
function getCategoryInfo(){
    var sub_category_upd = $('#sub_category_upd').val();
    var sub_cat = $('#sub_category').val();
    $.ajax({
        url:'requestFile/getCategoryInfo.php',
        data:{'sub_cat':sub_cat},
        dataType:'json',
        type:'post',
        cache:false,
        success:function(response){
            category_info=''
            $('#moduleTable').empty();
            $('#moduleTable').append('<tbody><tr>');
            if(response.length != 0){
                var tb = 35;
                for(var i=0;i<response.length;i++){
                    $('#moduleTable tbody tr').append( `<td><label for="disabledInput">`+response[i]['loan_category_ref_name']+`</label><span class="required">&nbsp;*</span><input type="text" class="form-control" id="category_info" name="category_info[]" 
                    value='`+category_info+`' tabindex='`+tb+`'readonly required placeholder='Enter `+response[i]['loan_category_ref_name']+`'></td>`);
                    tb++;
                }
                $('#moduleTable').append(`</tr></tbody>`);

                var category_content = $('#moduleTable tbody tr').html(); //To get the appended category list
                
                var category_count = $('#moduleTable tbody tr').find('td').length - 2;//To find input fields count
                getCategoryInputs(category_count,category_content,sub_category_upd);

            }
        }
    });
    
    
    function getCategoryInputs(category_count,category_content,sub_category_upd){
        
        var req_id = $('#req_id').val();
        $.ajax({
            url:'loanIssueFile/getCategoryInfoForIssue.php',
            data:{'req_id':req_id,'sub_category_upd':sub_category_upd},
            dataType: 'json',
            type: 'post',
            cachec: false,
            success: function(response){
                var trCount = Math.ceil(response.length / category_count); // number of rows needed
         
                for(var i=0;i<response.length;i++){
                    $('#moduleTable tbody input').each(function(index){
                        $(this).val(response[index]);
                    });
                }
            }
        })
    }

}

//Get Agent Name 
function getAgentDetails(){
    var req_id = $('#req_id').val();

    $.ajax({
        url:'loanIssueFile/getAgentDetails.php',
        type: 'POST',
        data: {"req_id":req_id},
        dataType: 'json',
        success: function(result){
            var ag_name = result['ag_name'];
            var lp = result['loan_payment'];
            var agent_id = result['agent_id'];
            console.log(`agName: ${ag_name}  ,lp: ${lp} ,agId:  ${agent_id}`);

            if(agent_id != '' && lp == '0'){
                $('#agent').val(ag_name);
                $('#issue_to').val(ag_name);

            }else{
                var cus_name = $('#cus_name').val();
                // $('#agent').val(cus_name);
                $('#issue_to').val(cus_name);
            }

        }
    })
}
$(document).ready(function(){

    $('#collection_mode').change(function(){
        var collection_mode = $(this).val();
        if(collection_mode == '2'){
            //if Checque choosen, clear all othre
            $('#trans_id').val('')
            $('#trans_date').val('')
            $('#cheque_no').val('')

            //if Cheque Chosen
            $('.cheque').show();
            $('.transaction').show();
            $('.other').hide();//Extra div for alignment
            getChequeNoList();//to get Cheque Numbers list based on the request id
        }else if(collection_mode >= '3' && collection_mode <= '5'){ 
            // clear all others
            $('#trans_id').val('')
            $('#trans_date').val('')
            $('#cheque_no').val('')

            //If other than cash and cheque
            $('.cheque').hide();
            $('.transaction').show();
            $('.other').show();//Extra div for alignment
        }else if(collection_mode == '1'){
            //if Cash choosen, clear all othre
            $('#trans_id').val('')
            $('#trans_date').val('')
            $('#cheque_no').val('')

            $('.cheque').hide();
            $('.transaction').hide();
            $('.other').hide();//Extra div for alignment
        }else{
            //If nothing chosen
            $('.cheque').hide();
            $('.transaction').hide();
            $('.other').hide();//Extra div for alignment
        }
    })

    $('#due_amt_track , #penalty_track , #coll_charge_track').blur(function(){
        if($('#due_amt_track').val() != ''){
            var due_amt_track = $('#due_amt_track').val();
        }else{
            var due_amt_track = 0;
        }
        if($('#penalty_track').val() != ''){
            var penalty_track = $('#penalty_track').val();
        }else{
            var penalty_track = 0;
        }
        if($('#coll_charge_track').val() != ''){
            var coll_charge_track = $('#coll_charge_track').val();
        }else{
            var coll_charge_track = 0;
        }
        var total_paid_track = parseInt(due_amt_track) + parseInt(penalty_track) + parseInt(coll_charge_track);
        $('#total_paid_track').val(total_paid_track)
    })

    $('#pre_close_waiver , #penalty_waiver , #coll_charge_waiver').blur(function(){
        if($('#pre_close_waiver').val() != ''){
            var pre_close_waiver = $('#pre_close_waiver').val();
        }else{
            var pre_close_waiver = 0;
        }
        if($('#penalty_waiver').val() != ''){
            var penalty_waiver = $('#penalty_waiver').val();
        }else{
            var penalty_waiver = 0;
        }
        if($('#coll_charge_waiver').val() != ''){
            var coll_charge_waiver = $('#coll_charge_waiver').val();
        }else{
            var coll_charge_waiver = 0;
        }
        var total_waiver = parseInt(pre_close_waiver) + parseInt(penalty_waiver) + parseInt(coll_charge_waiver);
        $('#total_waiver').val(total_waiver)
    })


    //Collection Charge
$('#collectionChargeDateCheck').hide();$('#purposeCheck').hide();$('#amntCheck').hide();
$('#collChargeBtn').click(function () {
    let req_id = $('#cc_req_id').val();
    let customer_id = $('#cusidupd').val();
    let colluserid = $('#colluserid').val();
    let collectionCharge_date = $("#collectionCharge_date").val();
    let collectionCharge_purpose = $("#collectionCharge_purpose").val();
    let collectionCharge_Amnt = $("#collectionCharge_Amnt").val();
    if (collectionCharge_date != "" && collectionCharge_purpose != "" && collectionCharge_Amnt != "" && req_id != "") {
        $.ajax({
            url: 'collectionFile/collection_charges_submit.php',
            type: 'POST',
            data: { "collDate": collectionCharge_date, "collPurpose": collectionCharge_purpose, "collAmnt": collectionCharge_Amnt, "reqId": req_id,"cust_id": customer_id,"userId": colluserid},
            cache: false,
            success: function (response) {
                var insresult = response.includes("Inserted");
                // var updresult = response.includes("Updated");
                if (insresult) {
                    $('#collChargeInsertOk').show();
                    setTimeout(function () {
                        $('#collChargeInsertOk').fadeOut('fast');
                    }, 2000);
                }
                // else if (updresult) {
                //     $('#bankUpdateok').show();
                //     setTimeout(function () {
                //         $('#bankUpdateok').fadeOut('fast');
                //     }, 2000);
                // }
                else {
                    $('#collChargeNotOk').show();
                    setTimeout(function () {
                        $('#collChargeNotOk').fadeOut('fast');
                    }, 2000);
                }
                resetcollCharges(req_id);
            }
        });
        $('#collectionChargeDateCheck').hide();$('#purposeCheck').hide();$('#amntCheck').hide();
    }
    else {
        if (collectionCharge_date == "") {
            $('#collectionChargeDateCheck').show();
        } else {
            $('#collectionChargeDateCheck').hide();
        }
        if (collectionCharge_purpose == "") {
            $('#purposeCheck').show();
        } else {
            $('#purposeCheck').hide();
        }
        if (collectionCharge_Amnt == "") {
            $('#amntCheck').show();
        } else {
            $('#amntCheck').hide();
        }
    }
});
    //Current Date
    //To Set the date input not to choose future date
    var mintoday = new Date();
    var mindd = mintoday.getDate();
    var minmm = mintoday.getMonth()+1; //January is 0 so need to add 1 to make it 1!
    var minyyyy = mintoday.getFullYear();
    if(mindd<10){
        mindate='0'+mindd
    }else{
        mindate=mindd
    }
    if(minmm<10){
        minmm='0'+minmm
    }else{
        minmm=minmm
    }
    mintoday = minyyyy+'-'+minmm+'-'+mindate;
    // Set Maximum date
    document.getElementById("collectionCharge_date").setAttribute("max", mintoday);



    $('#submit_collection').click(function(){ 
        validations();
    })
    

})//Document Ready End


//On Load Event
$(function(){

    $('.collection_card').hide(); //Hide collection window at the starting
    $('#close_collection_card').hide();//Hide collection close button at the starting
    $('#submit_collection').hide();//Hide Submit button at the starting, because submit is only for collection

    var req_id = $('#idupd').val()
    const cus_id = $('#cusidupd').val()
    OnLoadFunctions(req_id,cus_id);
})

function OnLoadFunctions(req_id,cus_id){
    //To get loan sub Status
    var pending_arr = [];
    var od_arr = [];
    var due_nil_arr = [];
    var closed_arr = [];
    $.ajax({
        url: 'collectionFile/resetCustomerStatus.php',
        data: {'cus_id':cus_id},
        dataType:'json',
        type:'post',
        cache: false,
        success: function(response){
            
            for(var i=0;i< response['pending_customer'].length;i++){
                pending_arr[i] = response['pending_customer'][i]
                od_arr[i] = response['od_customer'][i]
                due_nil_arr[i] = response['due_nil_customer'][i]
                closed_arr[i] = response['closed_customer'][i]
            }
            var pending_sts = pending_arr.join(',');
            $('#pending_sts').val(pending_sts);
            var od_sts = od_arr.join(',');
            $('#od_sts').val(od_sts);
            var due_nil_sts = due_nil_arr.join(',');
            $('#due_nil_sts').val(due_nil_sts);
            var closed_sts = closed_arr.join(',');
            $('#closed_sts').val(closed_sts);
        }
    }); 
    setTimeout(()=>{
        var pending_sts = $('#pending_sts').val()
        var od_sts = $('#od_sts').val()
        var due_nil_sts = $('#due_nil_sts').val()
        var closed_sts = $('#closed_sts').val()
        $.ajax({
            //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
            url: 'collectionFile/getLoanList.php',
            data: {'req_id':req_id,'cus_id':cus_id,'pending_sts':pending_sts,'od_sts':od_sts,'due_nil_sts':due_nil_sts,'closed_sts':closed_sts},
            type:'post',
            cache: false,
            success: function(response){
                $('#loanListTableDiv').empty()
                $('#loanListTableDiv').html(response);
                

                $('.collection-window').click(function(){
                    $('.personalinfo_card').hide();
                    $('.loanlist_card').hide();
                    $('.back-button').hide();
                    $('.collection_card').show();
                    $('#close_collection_card').show();
                    $('#submit_collection').show();

                    var req_id = $(this).attr('data-value');
                    
                    //To get the loan category ID to store when collection form submitted
                    $.ajax({
                        url:'collectionFile/getDetailForCollection.php',
                        data: {"req_id":req_id},
                        dataType:'json',
                        type:'post',
                        cache: false,
                        success:function(response){
                            var loan_category_id = response['loan_category'];
                            var sub_category_id = response['sub_category'];
                            $('#loan_category_id').val(loan_category_id)
                            $('#sub_category_id').val(sub_category_id)
                        }
                    })
                    var loan_category = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().text()
                    var sub_category = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().text()
                    var status = $(this).parent().prev().prev().text()
                    var sub_status = $(this).parent().prev().text()
                    
                    $('#req_id').val(req_id)
                    $('#loan_category').val(loan_category)
                    $('#sub_category').val(sub_category)
                    $('#status').val(status)
                    $('#sub_status').val(sub_status)
                    
                    //To get Collection Code
                    $.ajax({
                        url:'collectionFile/getCollectionCode.php',
                        data:{},
                        dataType: 'json',
                        type: 'post',
                        cache: false,
                        success: function(response){
                            $('#collection_id').val(response)
                        }
                    });

                    //To get Cheque List
                    $.ajax({
                        url:'collectionFile/getChequeList.php',
                        data:{'req_id':req_id},
                        dataType: 'json',
                        type: 'post',
                        cache: false,
                        success: function(response){
                            $('#cheque_no').empty()
                            $('#cheque_no').append('<option value="">Select Cheque No</option>');
                            for(var i=0;i<response.length;i++){
                                $('#cheque_no').append('<option value="'+response[i]['cheque_no_id']+'">'+response[i]['cheque_no']+'</option>');
                            }
                            $('#cheque_no').change(function(){
                                var cheque_no = $(this).val();
                                if(cheque_no != ''){
                                    for(var i=0;i<response.length;i++){
                                        if(cheque_no == response[i]['cheque_no_id']){
                                            var holder_name = response[i]['cheque_holder_name'];
                                        }
                                    }
                                    $('.chequeSpan').text('* ' + holder_name);
                                }else{
                                    $('.chequeSpan').text("*");
                                }
                            })
                        }
                    });
                    
                    //in this file, details gonna fetch by request ID, Not by customer ID (Because we need loan details from particular request ID)
                    $.ajax({
                        url: 'collectionFile/getLoanDetails.php',
                        data: {'req_id':req_id,'cus_id':cus_id},
                        dataType:'json',
                        type:'post',
                        cache: false,
                        success: function(response){
                            //Display all value to readonly fields
                            $('#tot_amt').val(response['total_amt'])
                            $('#paid_amt').val(response['total_paid'])
                            $('#bal_amt').val(response['balance'])
                            $('#due_amt').val(response['due_amt'])
                            $('#pending_amt').val(response['pending'])
                            $('#payable_amt').val(response['payable'])
                            $('#penalty').val(response['penalty'])
                            $('#coll_charge').val(response['coll_charge'])
                            
                            //to get how many due are pending till now
                            var totspan = (response['total_amt'] / response['due_amt']).toFixed(1);
                            var paidspan =(response['total_paid'] / response['due_amt']).toFixed(1);
                            var balspan =(response['balance'] / response['due_amt']).toFixed(1);
                            var pendingspan =(response['pending'] / response['due_amt']).toFixed(1);
                            var payablespan =(response['payable'] / response['due_amt']).toFixed(1);
                            
                            //Show all in span class
                            $('.totspan').text('* (No of Due : '+totspan+')')
                            $('.paidspan').text('* (No of Due : '+paidspan+')')
                            $('.balspan').text('* (No of Due : '+balspan+')')
                            $('.pendingspan').text('* (No of Due : '+pendingspan+')')
                            $('.payablespan').text('* (No of Due : '+payablespan+')')
                            
                            //To set limitations for input fields
                            $('#due_amt_track').attr('onblur',`if( parseInt($(this).val()) > ` + response['balance'] + ` ){ alert("Enter Lesser Value"); $(this).val(""); }`)
                            $('#penalty_track').attr('onblur',`if( parseInt($(this).val()) > ` + response['penalty'] + ` ){ alert("Enter Lesser Value"); $(this).val(""); }`)
                            $('#coll_charge_track').attr('onblur',`if( parseInt($(this).val()) > ` + response['coll_charge'] + ` ){ alert("Enter Lesser Value"); $(this).val(""); }`)
                            
                            //To set Limitation that should not cross its limit with considering track values and previous readonly values
                            $('#pre_close_waiver').attr('onblur',`var due_track = $('#due_amt_track').val(); if( parseFloat($(this).val()) > '` + response['balance'] + `' -due_track){ alert("Enter Lesser Value"); $(this).val("");$('#total_waiver').val(""); }`)
                            $('#penalty_waiver').attr('onblur',`var penalty_track = $('#penalty_track').val(); if( parseFloat($(this).val()) > '` + response['penalty'] + `' -penalty_track){ alert("Enter Lesser Value"); $(this).val("");$('#total_waiver').val(""); }`)
                            $('#coll_charge_waiver').attr('onblur',`var coll_charge_track = $('#coll_charge_track').val(); if( parseFloat($(this).val()) > '` + response['coll_charge'] + `' -coll_charge_track){ alert("Enter Lesser Value"); $(this).val("");$('#total_waiver').val(""); }`)
                        }
                    })

                });
                $('#close_collection_card').click(function(){
                    $('.personalinfo_card').show();
                    $('.loanlist_card').show();
                    $('.back-button').show();
                    $('.collection_card').hide();
                    $('#close_collection_card').hide();
                    $('#submit_collection').hide();
                })
                $('.due-chart').click(function(){
                    var req_id = $(this).attr('value');
                    dueChartList(req_id,cus_id); // To show Due Chart List.
                    setTimeout(()=>{
                        $('.print_due_coll').click(function(){
                            var id = $(this).attr('value');
                            Swal.fire({
                                title: 'Print',
                                text: 'Do you want to print this collection?',
                                // icon: 'question',
                                // showConfirmButton: true,
                                // confirmButtonColor: '#009688',
                                imageUrl: 'img/printer.png',
                                imageWidth: 300,
                                imageHeight: 210,
                                imageAlt: 'Custom image',
                                showCancelButton: true,
                                confirmButtonColor: '#009688',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'No',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url:'collectionFile/print_collection.php',
                                        data:{'coll_id':id},
                                        type:'post',
                                        cache:false,
                                        success:function(html){
                                            $('#printcollection').html(html)
                                            // Get the content of the div element
                                            var content = $("#printcollection").html();
                
                                            // Create a new window
                                            var w = window.open();
                
                                            // Write the content to the new window
                                            $(w.document.body).html(content);
                
                                            // Print the new window
                                            w.print();
                
                                            // Close the new window
                                            w.close();
                                        }
                                    })
                                }
                            })
                        })
                    },1000)
                })
                $('.penalty-chart').click(function(){
                    var req_id = $(this).attr('value');
                    $.ajax({
                        //to insert penalty by on click
                        url: 'collectionFile/getLoanDetails.php',
                            data: {'req_id':req_id,'cus_id':cus_id},
                            dataType:'json',
                            type:'post',
                            cache: false,
                            success: function(response){
                                penaltyChartList(req_id,cus_id); //To show Penalty List.
                            }
                    })
                })
                $('.coll-charge-chart').click(function(){
                    var req_id = $(this).attr('value');
                    collectionChargeChartList(req_id) //To Show Collection Charges Chart List
                })
                $('.coll-charge').click(function(){
                    var req_id = $(this).attr('value');console.log(req_id)
                    resetcollCharges(req_id);  //Collection Charges
                })
                $('.move-error').click(function(){
                    if(confirm("Are you Sure To move this Loan to Error?")){
                        
                        var req_id = $(this).attr('value');
                        var cus_status = '15';
                        $.ajax({
                            url: 'collectionFile/moveStatus.php',
                            data: {'req_id':req_id,'cus_status':cus_status},
                            dataType: 'json',
                            type: 'post',
                            cache: false,
                            success:function(response){
                                Swal.fire({
                                    timerProgressBar: true,
                                    timer: 3000,
                                    title: 'Moved To Error!',
                                    icon: 'succes',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#009688'
                                });
                                setTimeout(function(){
                                    window.location= 'edit_collection';
                                },2000)
                            }
                        })
                    }else{
                        event.preventDefault();
                    }
                })
                $('.move-legal').click(function(){
                    if(confirm("Are you Sure To move this Loan to Legal?")){
                        
                        var req_id = $(this).attr('value');
                        var cus_status = '16';
                        $.ajax({
                            url: 'collectionFile/moveStatus.php',
                            data: {'req_id':req_id,'cus_status':cus_status},
                            dataType: 'json',
                            type: 'post',
                            cache: false,
                            success:function(response){
                                Swal.fire({
                                    timerProgressBar: true,
                                    timer: 3000,
                                    title: 'Moved To Legal!',
                                    icon: 'succes',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#009688'
                                });
                                setTimeout(function(){
                                    window.location= 'edit_collection';
                                },2000)
                            }
                        })
                    }else{
                        event.preventDefault();
                    }
                })
                $('.return-sub').click(function(){
                    if(confirm("Are you Sure To move this Loan to Sub Status?")){
                        
                        var req_id = $(this).attr('value');
                        var cus_status = '14';
                        $.ajax({
                            url: 'collectionFile/moveStatus.php',
                            data: {'req_id':req_id,'cus_status':cus_status},
                            dataType: 'json',
                            type: 'post',
                            cache: false,
                            success:function(response){
                                Swal.fire({
                                    timerProgressBar: true,
                                    timer: 3000,
                                    title: 'Moved To Sub Status!',
                                    icon: 'succes',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#009688'
                                });
                                setTimeout(function(){
                                    window.location= 'edit_collection';
                                },2000)
                            }
                        })
                    }else{
                        event.preventDefault();
                    }
                })
                $('.move-closed').click(function(){
                    if(confirm("Are you Sure To move this Loan to Closed?")){
                        
                        var req_id = $(this).attr('value');
                        var cus_status = '20';
                        $.ajax({
                            url: 'collectionFile/moveStatus.php',
                            data: {'req_id':req_id,'cus_status':cus_status},
                            dataType: 'json',
                            type: 'post',
                            cache: false,
                            success:function(response){
                                Swal.fire({
                                    timerProgressBar: true,
                                    timer: 3000,
                                    title: 'Moved To Closed!',
                                    icon: 'succes',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#009688'
                                });
                                setTimeout(function(){
                                    window.location= 'edit_collection';
                                },2000)
                            }
                        })
                    }else{
                        event.preventDefault();
                    }
                })
        }
    })
},2000)


    
    
    
}//Auto Load function END

//to get Cheque Numbers list based on the request id
function getChequeNoList(){

}

function validations(){
    var collection_access = $('#collection_access').val();
    var collection_mode = $('#collection_mode').val();var cheque_no = $('#cheque_no').val();var trans_id = $('#trans_id').val();var trans_date = $('#trans_date').val();
    var collection_loc = $('#collection_loc').val();var due_amt_track = $('#due_amt_track').val();var penalty_track = $('#penalty_track').val();var coll_charge_track = $('#coll_charge_track').val();
    var pre_close_waiver = $('#pre_close_waiver').val();var penalty_waiver = $('#penalty_waiver').val();var coll_charge_waiver = $('#coll_charge_waiver').val()
    var total_paid_track = $('#total_paid_track').val();var total_waiver = $('#total_waiver').val();
    

    if(collection_mode == ''){
        $('#collectionmodeCheck').show();
        event.preventDefault();
    }else{
        $('#collectionmodeCheck').hide();

        if(collection_mode == '2'){
            //if Cheque Chosen
            if(cheque_no == ''){
                $('#chequeCheck').show();
                event.preventDefault();
            }else{
                $('#chequeCheck').hide();
            }
        
            if(trans_id == ''){
                $('#transidCheck').show();
                event.preventDefault();
            }else{
                $('#transidCheck').hide();
            }
            if(trans_date == ''){
                $('#transdateCheck').show();
                event.preventDefault();
            }else{
                $('#transdateCheck').hide();
            }
        }else if(collection_mode >= '3' && collection_mode <= '5'){ 
            //If other than cash and cheque
            if(trans_id == ''){
                $('#transidCheck').show();
                event.preventDefault();
            }else{
                $('#transidCheck').hide();
            }
            if(trans_date == ''){
                $('#transdateCheck').show();
                event.preventDefault();
            }else{
                $('#transdateCheck').hide();
            }
        }
    }

    if(collection_loc == ''){
        $('#collectionlocCheck').show();
        event.preventDefault();
    }else{
        $('#collectionlocCheck').hide();
    }

    // if(collection_access == 0){
        
    // }
    if(total_paid_track == '' || total_paid_track == 0){
        if(total_waiver == '' || total_waiver == 0){
            $('.totalpaidCheck').show();
            event.preventDefault();
        }else{
            $('.totalpaidCheck').hide();
        }
    }else{
        $('.totalpaidCheck').hide();
    }
}

//Due Chart List
function dueChartList(req_id,cus_id){
    // var req_id = $('#idupd').val()
    // const cus_id = $('#cusidupd').val()
    $.ajax({
        url: 'collectionFile/getDueChartList.php',
        data: {'req_id':req_id,'cus_id':cus_id},
        type:'post',
        cache: false,
        success: function(response){
            $('#dueChartTableDiv').empty()
            $('#dueChartTableDiv').html(response)
        }
    });//Ajax End.
}
//Penalty Chart List
function penaltyChartList(req_id,cus_id){
    $.ajax({
        url: 'collectionFile/getPenaltyChartList.php',
        data: {'req_id':req_id,'cus_id':cus_id},
        type:'post',
        cache: false,
        success: function(response){
            $('#penaltyChartTableDiv').empty()
            $('#penaltyChartTableDiv').html(response)
        }
    });//Ajax End.
}
//Collection Charge Chart List
function collectionChargeChartList(req_id){
    $.ajax({
        url: 'collectionFile/getCollectionChargeList.php',
        data: {'req_id':req_id},
        type:'post',
        cache: false,
        success: function(response){
            $('#collectionChargeDiv').empty()
            $('#collectionChargeDiv').html(response)
        }
    });//Ajax End.
}
//Collection Charges
function resetcollCharges(req_id) {
    $.ajax({
        url: 'collectionFile/collection_charges_reset.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#collChargeTableDiv").empty();
            $("#collChargeTableDiv").html(html);
            $("#cc_req_id").val(req_id);
            $("#collectionCharge_date").val('');
            $("#collectionCharge_purpose").val('');
            $("#collectionCharge_Amnt").val('');
        }
    });
}


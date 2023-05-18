$(document).ready(function(){
/// noc_req_id = get particular line item request id becuase multiple request show in list against single customer.. the Customer is same but request is not so have to take particular req id to show details.
    $('#submit_closed').click(function(){ 
        validations();
    })

    ///Customer Feedback 
    $("body").on("click", "#cus_feedback_edit", function () {
        let id = $(this).attr('value');
    
        $.ajax({
            url: 'closedFile/loan_summary_edit.php',
            type: 'POST',
            data: { "id": id },
            dataType: 'json',
            cache: false,
            success: function (result) {

                $("#feedbackID").val(result['id']);
                $("#feedback_label").val(result['feedback_label']);
                $("#cus_feedback").val(result['cus_feedback']);
                $("#feedback_remark").val(result['feedback_remark']);

            }
        });

    });


    $("body").on("click", "#cus_feedback_delete", function () {
        var isok = confirm("Do you want delete this Feedback?");
        if (isok == false) {
            return false;
        } else {
            var id = $(this).attr('value');

            $.ajax({
                url: 'closedFile/loan_summary_delete.php',
                type: 'POST',
                data: { "id": id },
                cache: false,
                success: function (response) {
                    var delresult = response.includes("Deleted");
                    if (delresult) {
                        $('#feedbackDeleteOk').show();
                        setTimeout(function () {
                            $('#feedbackDeleteOk').fadeOut('fast');
                        }, 2000);
                    }
                    else {

                        $('#feedbackDeleteNotOk').show();
                        setTimeout(function () {
                            $('#feedbackDeleteNotOk').fadeOut('fast');
                        }, 2000);
                    }

                    resetfeedback();
                }
            });
        }
    });

    //closed status
    $('#closed_Sts').change(function(){
        var sts = $(this).val();

        if(sts == '1'){
            $('#considerlevel').show();
        }else{
            $('#considerlevel').hide();
        }
    })

})//Document Ready End


//On Load Event
$(function(){

    $('.noc_window').hide(); //Hide collection window at the starting
    $('#close_noc_card').hide();//Hide collection close button at the starting
    $('#submit_closed').hide();//Hide Submit button at the starting, because submit is only for collection

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
    var balAmnt = [];
    $.ajax({
        url: 'closedFile/resetCustomerStsForClosed.php',
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
                balAmnt[i] = response['balAmnt'][i]
            }
            var pending_sts = pending_arr.join(',');
            $('#pending_sts').val(pending_sts);
            var od_sts = od_arr.join(',');
            $('#od_sts').val(od_sts);
            var due_nil_sts = due_nil_arr.join(',');
            $('#due_nil_sts').val(due_nil_sts);
            var closed_sts = closed_arr.join(',');
            $('#closed_sts').val(closed_sts);
            balAmnt = balAmnt.join(',');
            // $('#balAmnt').val(balAmnt);
            
        }
    }); 
    $('<div/>', {class: 'overlay'}).appendTo('.loanlist_card').html('<div class="loader"></div><span class="overlay-text">Please Wait</span>');
    setTimeout(()=>{
        var pending_sts = $('#pending_sts').val()
        var od_sts = $('#od_sts').val()
        var due_nil_sts = $('#due_nil_sts').val()
        var closed_sts = $('#closed_sts').val()
        var bal_amt = balAmnt;
        $.ajax({
            //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
            url: 'closedFile/getLoanListForClosed.php',
            data: {'req_id':req_id,'cus_id':cus_id,'pending_sts':pending_sts,'od_sts':od_sts,'due_nil_sts':due_nil_sts,'closed_sts':closed_sts,'bal_amt':bal_amt},
            type:'post',
            cache: false,
            success: function(response){
                $('.overlay').remove();
                $('#loanListTableDiv').empty()
                $('#loanListTableDiv').html(response);
                
                $('.noc-window').click(function(){
                    $('.loanlist_card').hide();
                    $('.datachecking_card').hide();
                    $('.back-button').hide();
                    $('.noc_window').show();
                    $('#close_noc_card').show();
                    $('#submit_closed').show();

                    var reqID = $(this).attr('data-value');
                    $('#noc_req_id').val(reqID);

                    resetfeedback(); //Reset Feedback Modal Table.
                    feedbackList(); // Feedback List.
                });
                
                $('#close_noc_card').click(function(){
                    $('.loanlist_card').show();
                    $('.datachecking_card').show();
                    $('.back-button').show();
                    $('.noc_window').hide();
                    $('#close_noc_card').hide();
                    $('#submit_closed').hide();
                })

                $('.due-chart').click(function(){
                    var nocreq_id = $('#noc_req_id').val();
                    dueChartList(nocreq_id,cus_id); // To show Due Chart List.
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
                    var noc_req_id = $('#noc_req_id').val();
                    $.ajax({
                        //to insert penalty by on click
                        url: 'collectionFile/getLoanDetails.php',
                            data: {'req_id':noc_req_id,'cus_id':cus_id},
                            dataType:'json',
                            type:'post',
                            cache: false,
                            success: function(response){
                                penaltyChartList(noc_req_id,cus_id); //To show Penalty List.
                            }
                    })
                })

                $('.coll-charge-chart').click(function(){
                    var noc_req_id = $('#noc_req_id').val();
                    collectionChargeChartList(noc_req_id) //To Show Collection Charges Chart List
                })

                $('.coll-charge').click(function(){
                    var noc_req_id = $('#noc_req_id').val();
                    resetcollCharges(noc_req_id);  //Collection Charges
                })
           }
    })


    $.ajax({
        // To Check Customer Guarentor History.
        url: 'closedFile/getGuarentorData.php',
        data: {'cus_id':cus_id,'pending_sts':pending_sts,'od_sts':od_sts,'due_nil_sts':due_nil_sts,'closed_sts':closed_sts},
        type:'post',
        cache: false,
        success: function(response){
            $('#guarentor_checkDiv').empty()
            $('#guarentor_checkDiv').html(response);
            
            }
        });
    
},2000)
   
}//Auto Load function END


function validations(){
    var closed_Sts = $('#closed_Sts').val(); var closed_Sts_consider = $('#closed_Sts_consider').val(); var closed_Sts_remark = $('#closed_Sts_remark').val();

    if(closed_Sts == ''){
        $('#closedStatusCheck').show();
        event.preventDefault();
    }else{
        $('#closedStatusCheck').hide();
    }

    if(closed_Sts == '1'){
        if(closed_Sts_consider == ''){
            $('#considerLevelCheck').show();
            event.preventDefault();
        }else{
            $('#considerLevelCheck').hide();
        }
    }

    if(closed_Sts_remark == ''){
        $('#remarkCheck').show();
        event.preventDefault();
    }else{
        $('#remarkCheck').hide();
    }
}

//Due Chart List
function dueChartList(nocreq_id,cus_id){
    $.ajax({
        url: 'collectionFile/getDueChartList.php',
        data: {'req_id':nocreq_id,'cus_id':cus_id,'closed': 'true'},
        type:'post',
        cache: false,
        success: function(response){
            $('#dueChartTableDiv').empty()
            $('#dueChartTableDiv').html(response)
        }
    });//Ajax End.
}
//Penalty Chart List
function penaltyChartList(noc_req_id,cus_id){
    $.ajax({
        url: 'collectionFile/getPenaltyChartList.php',
        data: {'req_id':noc_req_id,'cus_id':cus_id},
        type:'post',
        cache: false,
        success: function(response){
            $('#penaltyChartTableDiv').empty()
            $('#penaltyChartTableDiv').html(response)
        }
    });//Ajax End.
}
//Collection Charge Chart List
function collectionChargeChartList(noc_req_id){
    $.ajax({
        url: 'collectionFile/getCollectionChargeList.php',
        data: {'req_id':noc_req_id},
        type:'post',
        cache: false,
        success: function(response){
            $('#collectionChargeDiv').empty()
            $('#collectionChargeDiv').html(response)
        }
    });//Ajax End.
}

//Loan Summary Modal 
$('#feedbacklabelCheck').hide(); $('#feedbackCheck').hide();


$(document).on("click", "#feedbackBtn", function () {

    let nocreq_id = $('#noc_req_id').val();
    let cusidupd = $('#cusidupd').val();
    let feedback_label = $("#feedback_label").val();
    let cus_feedback = $("#cus_feedback").val();
    let feedback_remark = $("#feedback_remark").val();
    let feedbackID = $("#feedbackID").val();


    if (feedback_label != "" && cus_feedback != "" && nocreq_id != "") {
        $.ajax({
            url: 'closedFile/loan_summary_submit.php',
            type: 'POST',
            data: { "feedback_label": feedback_label, "cus_feedback": cus_feedback,"feedback_remark":feedback_remark,"feedbackID": feedbackID,  "reqId": nocreq_id,"cusidupd":cusidupd },
            cache: false,
            success: function (response) {

                var insresult = response.includes("Inserted");
                var updresult = response.includes("Updated");
                if (insresult) {
                    $('#feedbackInsertOk').show();
                    setTimeout(function () {
                        $('#feedbackInsertOk').fadeOut('fast');
                    }, 2000);
                }
                else if (updresult) {
                    $('#feedbackUpdateok').show();
                    setTimeout(function () {
                        $('#feedbackUpdateok').fadeOut('fast');
                    }, 2000);
                }
                else {
                    $('#feedbackNotOk').show();
                    setTimeout(function () {
                        $('#feedbackNotOk').fadeOut('fast');
                    }, 2000);
                }

                resetfeedback();
            }
        });

        $('#feedbacklabelCheck').hide(); $('#feedbackCheck').hide();
    }
    else {

        if (feedback_label == "") {
            $('#feedbacklabelCheck').show();
        } else {
            $('#feedbacklabelCheck').hide();
        }

        if (cus_feedback == "") {
            $('#feedbackCheck').show();
        } else {
            $('#feedbackCheck').hide();
        }

    }

});

function resetfeedback() {
    let NOCReq_id = $('#noc_req_id').val();
    $.ajax({
        url: 'closedFile/loan_summary_reset.php',
        type: 'POST',
        data: { "reqId": NOCReq_id },
        cache: false,
        success: function (html) {
            $("#feedbackTable").empty();
            $("#feedbackTable").html(html);

            $("#feedback_label").val('');
            $("#cus_feedback").val('');
            $("#feedback_remark").val('');
            $("#feedbackID").val('');

        }
    });
}

function feedbackList() {
    let NOC_Req_id = $('#noc_req_id').val();
    $.ajax({
        url: 'closedFile/loan_summary_list.php',
        type: 'POST',
        data: { "reqId": NOC_Req_id },
        cache: false,
        success: function (html) {
            $("#feedbackListTable").empty();
            $("#feedbackListTable").html(html);

            $("#feedback_label").val('');
            $("#cus_feedback").val('');
            $("#feedback_remark").val('');
            $("#feedbackID").val('');
        }
    });
}
//Loan Summary Modal End


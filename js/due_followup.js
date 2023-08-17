$(document).ready(function(){

    //Collection Charge
    $('#collectionChargeDateCheck').hide();$('#purposeCheck').hide();$('#amntCheck').hide();
    
    window.onscroll = function () {
        let navbar = document.getElementById("navbar");
        let navAttr = navbar.getAttribute('class')
        let stickyHeader = navbar.offsetTop;
        if (window.pageYOffset > 200 && navAttr.includes('collection-card')) {
            // navbar.style.display = "block";
            $('#navbar').fadeIn('fast');
            navbar.classList.add("stickyHeader")
        } else {
            $('#navbar').fadeOut('fast');
            navbar.classList.remove("stickyHeader");
        }
    };

})//Document Ready End


//On Load Event
$(function(){

    $('.loan_history_card').hide(); //Hide loan history window at the starting
    $('.doc_history_card').hide(); //Hide Document history window at the starting
    $('#close_collection_card').hide();//Hide collection close button at the starting
    $('#submit_collection').hide();//Hide Submit button at the starting, because submit is only for collection

    var req_id = $('#idupd').val()
    const cus_id = $('#cusidupd').val()
    OnLoadFunctions(req_id,cus_id);

    var cus_pic = $('#cuspicupd').val();
    $('#imgshow').attr('src','uploads/request/customer/'+cus_pic);
})

function OnLoadFunctions(req_id,cus_id){
    //To get loan sub Status
    var pending_arr = [];
    var od_arr = [];
    var due_nil_arr = [];
    var closed_arr = [];
    var balAmnt = [];
    $.ajax({
        url: 'collectionFile/resetCustomerStatus.php',
        data: {'cus_id':cus_id},
        dataType:'json',
        type:'post',
        cache: false,
        success: function(response){
            if(response.length != 0){

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
            url: 'followupFiles/dueFollowup/viewLoanList.php',
            data: {'req_id':req_id,'cus_id':cus_id,'pending_sts':pending_sts,'od_sts':od_sts,'due_nil_sts':due_nil_sts,'closed_sts':closed_sts,'bal_amt':bal_amt},
            type:'post',
            cache: false,
            success: function(response){
                $('.overlay').remove();
                $('#loanListTableDiv').empty()
                $('#loanListTableDiv').html(response);

                $('.loan-history-window').click(function(e){
                    e.preventDefault();

                    $('.loanlist_card').hide();
                    $('.back-button').hide();
                    $('.loan_history_card').show();
                    $('.doc_history_card').hide();
                    let navbar = document.getElementById('navbar');
                    navbar.classList.add('collection-card')
                    $('#close_collection_card').show();

                    $.ajax({
                        //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
                        url: 'followupFiles/dueFollowup/viewLoanHistory.php',
                        data: {'cus_id':cus_id,'pending_sts':pending_sts,'od_sts':od_sts,'due_nil_sts':due_nil_sts,'closed_sts':closed_sts},
                        type:'post',
                        cache: false,
                        success: function(response){
                            $('#loanHistoryDiv').empty()
                            $('#loanHistoryDiv').html(response);
                        }
                    });

                });

                $('.doc-history-window').click(function(e){
                    e.preventDefault();

                    $('.loanlist_card').hide();
                    $('.back-button').hide();
                    $('.loan_history_card').hide();
                    $('.doc_history_card').show();
                    let navbar = document.getElementById('navbar');
                    navbar.classList.add('collection-card')
                    $('#close_collection_card').show();

                    $.ajax({
                        //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
                        url: 'followupFiles/dueFollowup/viewDocumentHistory.php',
                        data: {'cus_id':cus_id,'pending_sts':pending_sts,'od_sts':od_sts,'due_nil_sts':due_nil_sts,'closed_sts':closed_sts,'bal_amt':bal_amt},
                        type:'post',
                        cache: false,
                        success: function(response){
                            $('#docHistoryDiv').empty()
                            $('#docHistoryDiv').html(response);
                        }
                    })

                });

                $('#close_collection_card').click(function(){

                    $('.loanlist_card').show();
                    $('.back-button').show();
                    $('.loan_history_card').hide();
                    $('.doc_history_card').hide();
                    $('#close_collection_card').hide();
                    
                });

                $('.due-chart').click(function(){
                    var req_id = $(this).attr('value');
                    dueChartList(req_id,cus_id); // To show Due Chart List.
                    setTimeout(()=>{
                        $('.print_due_coll').click(function(){
                            var id = $(this).attr('value');
                            Swal.fire({
                                title: 'Print',
                                text: 'Do you want to print this collection?',
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
                    collectionChargeChartList(req_id) //To Show Fine Chart List
                })
                $('.coll-charge').click(function(){
                    var req_id = $(this).attr('value');
                    resetcollCharges(req_id);  //Fine
                })
        }
    })
},2000)

}//Auto Load function END


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
//Fine
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


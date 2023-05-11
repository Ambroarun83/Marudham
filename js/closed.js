$(document).ready(function(){

    $('#submit_noc').click(function(){ 
        validations();
    })
    
    $('#cus_garuentor_datacheck').DataTable({
        'processing': true,
        'iDisplayLength': 11,
        "lengthMenu": [
            [11, 26, 51, -1],
            [10, 25, 50, "All"]
        ],
        // "createdRow": function(row, data, dataIndex) {
        //     $(row).find('td:first').html(dataIndex + 1);
        // },
        // "drawCallback": function(settings) {
        //     this.api().column(0).nodes().each(function(cell, i) {
        //         cell.innerHTML = i + 1;
        //     });
        // },
    });

})//Document Ready End


//On Load Event
$(function(){

    $('.noc_window').hide(); //Hide collection window at the starting
    $('#close_noc_card').hide();//Hide collection close button at the starting
    $('#submit_noc').hide();//Hide Submit button at the starting, because submit is only for collection

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
                $('#loanListTableDiv').empty()
                $('#loanListTableDiv').html(response);
                
                $('.noc-window').click(function(){
                    $('.loanlist_card').hide();
                    $('.datachecking_card').hide();
                    $('.back-button').hide();
                    $('.noc_window').show();
                    $('#close_noc_card').show();
                    $('#submit_noc').show();

                    var reqID = $(this).attr('data-value');
                    $('#noc_req_id').val(reqID);
                });
                
                $('#close_noc_card').click(function(){
                    $('.loanlist_card').show();
                    $('.datachecking_card').show();
                    $('.back-button').show();
                    $('.noc_window').hide();
                    $('#close_noc_card').hide();
                    $('#submit_noc').hide();
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
                    var req_id = $('#noc_req_id').val();
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
                    var req_id = $('#noc_req_id').val();
                    collectionChargeChartList(req_id) //To Show Collection Charges Chart List
                })

                $('.coll-charge').click(function(){
                    var req_id = $('#noc_req_id').val();console.log(req_id)
                    resetcollCharges(req_id);  //Collection Charges
                })
           }
    })
    
},2000)
   
}//Auto Load function END


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
function dueChartList(nocreq_id,cus_id){
    // var req_id = $('#idupd').val()
    // const cus_id = $('#cusidupd').val()
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


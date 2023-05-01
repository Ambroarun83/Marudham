$(document).ready(function(){

    $('#collection_mode').change(function(){
        var collection_mode = $(this).val();
        if(collection_mode == '2'){
            //if Cheque Chosen
            $('.cheque').show();
            $('.transaction').show();
            $('.other').hide();//Extra div for alignment
        }else if(collection_mode >= '3' && collection_mode <= '5'){ 
            //If other than cash and cheque
            $('.cheque').hide();
            $('.transaction').show();
            $('.other').show();//Extra div for alignment
        }else{
            //If nothing chosen
            $('.cheque').hide();
            $('.transaction').hide();
            $('.other').hide();//Extra div for alignment
        }
    })


})//Document Ready End


//On Load Event
$(function(){

    $('.collection_card').hide(); //Hide collection window at the starting
    $('#close_collection_card').hide();//Hide collection close button at the starting
    $('#submit_collection').hide();//Hide Submit button at the starting, because submit is only for collection

    var req_id = $('#idupd').val()
    const cus_id = $('#cusidupd').val()
    $.ajax({
        //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
        url: 'collectionFile/getLoanList.php',
        data: {'req_id':req_id,'cus_id':cus_id},
        type:'post',
        cache: false,
        success: function(response){
            $('#loanListTableDiv').empty()
            $('#loanListTableDiv').html(response)

            $('.collection-window').click(function(){
                $('.personalinfo_card').hide();
                $('.loanlist_card').hide();
                $('.back-button').hide();
                $('.collection_card').show();
                $('#close_collection_card').show();
                $('#submit_collection').show();

                var req_id = $(this).attr('data-value'); 
                var loan_category = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().text()
                var sub_category = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().text()
                var status = $(this).parent().prev().prev().text()
                var sub_status = $(this).parent().prev().text()
                
                $('#loan_category').val(loan_category)
                $('#sub_category').val(sub_category)
                $('#status').val(status)
                $('#sub_status').val(sub_status)

                $.ajax({
                //in this file, details gonna fetch by request ID, Not by customer ID (Because we need loan details from particular request ID)
                    url: 'collectionFile/getLoanDetails.php',
                    data: {'req_id':req_id,'cus_id':cus_id},
                    dataType:'json',
                    type:'post',
                    cache: false,
                    success: function(response){

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
        }
    })
})
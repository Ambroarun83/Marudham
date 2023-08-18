$(document).ready(function(){



    const toggleButtons = $(".toggle-button");
    toggleButtons.on("click", function() {
        // Reset active class for all buttons
        toggleButtons.removeClass("active");
        // Add active class to the clicked button
        $(this).addClass("active");

        const typevalue = this.value;
        $('.existing_card, .new_card, .new_promo_card, .repromotion_card').hide();
        if(typevalue == 'New'){
            $('.new_card').toggle('show')
        }else if(typevalue == 'Existing'){
            $('.existing_card').toggle('show');
            showPromotionList();
        }else if(typevalue == 'Repromotion'){
            $('.repromotion_card').toggle('show')
        }
    })

    $('#cus_id_search, #cus_id').keyup(function() {
        var value = $(this).val();
        value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
        $(this).val(value);
    });

    $('button').click(function(e){e.preventDefault();})

    $('#search_cus').click(function(){
        if(validateCustSearch() == true){
            searchCustomer();
        }else{
            $('.new_promo_card').hide();
        }
    });

    $('#submit_new_cus').click(function(){
        if(validateNewCusAdd() == true){
            submitNewCustomer();
        }
    });

    $('#sumit_add_promo').click(function(){
        if(validatePromoAdd() == true){
            submitPromotion();
        }
    })

});


$(function(){
    
})




function searchCustomer(){
    let cus_id = $('#cus_id_search').val();let cus_name = $('#cus_name_search').val();let cus_mob = $('#cus_mob_search').val();
    var args = {'cus_id':cus_id,'cus_name':cus_name,'cus_mob':cus_mob};

    $.post('followupFiles/promotion/searchCustomer.php',args,function(response){

        if(response['status'].includes('No')){

            $('.alert-success').show();
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 2000);
            
            $('.new_promo_card').show();
            resetNewPromotionTable();
            
        }else{
            
            $('.alert-danger').show();
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 2000);
            
            $('.new_promo_card').hide();
        }

    },'json')

    

}
function validateCustSearch(){
    let response = true;
    let cus_id = $('#cus_id_search').val();let cus_name = $('#cus_name_search').val();let cus_mob = $('#cus_mob_search').val();
    
    validateField(cus_id,cus_name,cus_mob, '.searchDetailsCheck');
    
    function validateField(cus_id,cus_name,cus_mob, fieldId) {
        if (cus_id === '' && cus_name === '') {
            response = false;
            event.preventDefault();
            $(fieldId).show();

            if(cus_mob === ''){
                response = false;
                event.preventDefault();
                $(fieldId).show();
            }else{
                if(cus_mob.length < 10){
                    response = false;
                    event.preventDefault();
                    $(fieldId).show();
                }else {
                    response = true;
                    $(fieldId).hide();
                }
            }
        } else {
            $(fieldId).hide();
        }
        
    }

    return response;
}


function resetNewPromotionTable(){
    $.post('followupFiles/promotion/resetNewPromotionTable.php',{},function(html){
        $('#new_promo_div').empty();
        $('#new_promo_div').html(html);
        
        intNotintOnclick();

        
    }).then(function(){
        promoChartOnclick();
    })
}



function submitNewCustomer(){
    let cus_id = $('#cus_id').val();let cus_name = $('#cus_name').val();let cus_mob = $('#cus_mob').val();
    let area = $('#area').val();let sub_area = $('#sub_area').val();
    let args = {'cus_id':cus_id,'cus_name':cus_name,'cus_mob':cus_mob,'area':area,'sub_area':sub_area}
    $.post('followupFiles/promotion/submitNewCustomer.php',args,function(response){
        if(response.includes('Error')){
            swarlErrorAlert(response);
        }else if(response.includes('Added')){
            // if this true then it will ask for confirmation to update customer details in new promotion table
            swarlInfoAlert(response,'Do You want to Update?');
        }else{
            swarlSuccessAlert(response);
            $('#addnewcus').find('.modal-body input').val('');
        }
    });
}
function validateNewCusAdd(){
    let response = true;
    let cus_id = $('#cus_id').val();let cus_name = $('#cus_name').val();let cus_mob = $('#cus_mob').val();
    let area = $('#area').val();let sub_area = $('#sub_area').val();
    
    validateField(cus_id, '#cus_idCheck');
    validateField(cus_name, '#cus_nameCheck');
    validateField(cus_mob, '#cus_mobCheck');
    validateField(area, '#areaCheck');
    validateField(sub_area, '#sub_areaCheck');

    function validateField(value, fieldId) {
        if (value === '' ) {
            response = false;
            event.preventDefault();
            $(fieldId).show();
        } else {
            $(fieldId).hide();
        }
        
    }

    return response;
}


function submitPromotion(){
    let cus_id = $('#promo_cus_id').val();
    let status = $('#promo_status').val();let label = $('#promo_label').val();let remark = $('#promo_remark').val();let follow_date = $('#promo_fdate').val();
    let args = {'cus_id':cus_id,'status':status,'label':label,'remark':remark,'follow_date':follow_date};
    
    $.post('followupFiles/promotion/submitNewPromotion.php',args,function(response){
        if(response.includes('Error')){
            swarlErrorAlert(response);
        }else{
            swarlSuccessAlert(response);
            $('#addPromotion').find('.modal-body input').not('[readonly]').val('');
        }
    })
}
function validatePromoAdd(){
    let response = true;
    let status = $('#promo_status').val();let label = $('#promo_label').val();let remark = $('#promo_remark').val();
    let follow_date = $('#promo_fdate').val();
    
    validateField(status, '#promo_statusCheck');
    validateField(label, '#promo_labelCheck');
    validateField(remark, '#promo_remarkCheck');
    validateField(follow_date, '#promo_fdateCheck');

    function validateField(value, fieldId) {
        if (value === '' ) {
            response = false;
            event.preventDefault();
            $(fieldId).show();
        } else {
            $(fieldId).hide();
        }
        
    }

    return response;
}


function update(){//this function will update customer details of after confirmation
    let cus_id = $('#cus_id').val();let cus_name = $('#cus_name').val();let cus_mob = $('#cus_mob').val();
    let area = $('#area').val();let sub_area = $('#sub_area').val();
    let args = {'cus_id':cus_id,'cus_name':cus_name,'cus_mob':cus_mob,'area':area,'sub_area':sub_area,'update':'yes'}
    $.post('followupFiles/promotion/submitNewCustomer.php',args,function(response){
        if(response.includes('Error')){
            swarlErrorAlert(response);
        }else{
            swarlSuccessAlert(response);
            $('#addnewcus').find('.modal-body input').val('');
        }
    })   
}
function promoChartOnclick(){//function of on click event for promo chart
    $('.promo-chart').off('click').click(function(){
        let cus_id = $(this).data('id');
        $.post('followupFiles/promotion/resetPromotionChart.php',{'cus_id':cus_id},function(html){
            $('#promoChartDiv').empty();
            $('#promoChartDiv').html(html); 
        })
        
    })
}
function intNotintOnclick(){
    $('.intrest, .not-intrest').off('click').click(function(){//onclick for add promotion modal
        let value = $(this).children().text();//takes span inner html
        let cus_id = $(this).data('id');//takes customer id of new customer promotion

        $('#promo_status').val(value);//this will set status as intrested/Not intrested
        $('#promo_cus_id').val(cus_id);
    })
}


function showPromotionList(){
    $.post('followupFiles/promotion/showPromotionList.php',{},function(html){
        $('#exCusDiv').empty();
        $('#exCusDiv').html(html);
        intNotintOnclick();
        promoChartOnclick();

        promotionListOnclick();
        
    })
}

function promotionListOnclick(){
    
    //on click for customer profile showing in next page
    $('.cust-profile').off('click').click(function(){
        let req_id = $(this).data('reqid');
        window.location.href = 'due_followup_info&upd='+req_id+'&pgeView=1';
    })

    $('.loan-history, .doc-history').off('click').click(function(){
        let req_id = $(this).data('reqid');
        let cus_id = $(this).data('cusid');
        historyTableContents(req_id,cus_id)
    });
}

//Code snippet from c:\xampp\htdocs\marudham\js\due_followup.js
function historyTableContents(req_id,cus_id){
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
    })
    $('<div/>', {class: 'overlay'}).appendTo('body').html('<div class="loader"></div><span class="overlay-text">Please Wait</span>');
    setTimeout(()=>{ 

        var pending_sts = $('#pending_sts').val()
        console.log("🚀 ~ file: promotion_activity.js:327 ~ setTimeout ~ pending_sts:", pending_sts)
        var od_sts = $('#od_sts').val()
        var due_nil_sts = $('#due_nil_sts').val()
        var closed_sts = $('#closed_sts').val()
        var bal_amt = balAmnt;

        //for loan history
        $('.loan-history-card').show();
        $('#close_history_card').show();
        $('.doc-history-card').hide();
        $('.existing_card').hide();
        
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

        //for Document history
        $('.doc-history-card').show();
        $('#close_history_card').show();
        $('.loan-history-card').hide();
        $('.existing_card').hide();

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

        $('#close_history_card').click(()=>{
            $('.existing_card').show();//shows existing card
            $('.loan-history-card').hide();//hides loan history card
            $('.doc-history-card').hide();//hides document history card
            $(this).hide();// hides close button
        })

    },2000)

}


function swarlErrorAlert(response){
    Swal.fire({
        title: response,
        icon: 'error',
        confirmButtonText: 'Ok',
        confirmButtonColor: '#009688'
    })
}
function swarlInfoAlert(title,text){
    Swal.fire({
        title: title,
        text: text,
        icon: 'info',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: '#009688',
        cancelButtonColor: '#cc4444',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes'
    }).then(function(result){
        if(result.isConfirmed){
            update();
        }
    })
}
function swarlSuccessAlert(response){
    Swal.fire({
        title: response,
        icon: 'success',
        confirmButtonText: 'Ok',
        confirmButtonColor: '#009688'
    })
}






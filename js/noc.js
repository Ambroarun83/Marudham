$(document).ready(function(){

    $('#close-noc-card').click(function(){
        $('.noc-card').hide(); //Hide collection window at the starting
        $(this).hide();//hide close button also
        $('#submit_noc').hide();//Hide Submit button at the starting, because submit is only for collection
        $('#back-button').show(); //Show Back button
        $('.loanlist_card').show(); // Show loan list
    })

    $('#noc_member').change(function(){
        $('.scanBtn').removeAttr('disabled');
        $('#compare_finger').val('')
        var noc_member = parseInt($(this).val());
        var req_id = $('#req_id').val();
        //if Noc Member is Family member or Guarentor then get member names
        if(noc_member > 1){
            $.ajax({
                url:'nocFile/getMemberDetails.php',
                data:{'req_id':req_id,'noc_member':noc_member},
                dataType:'json',
                type:'post',
                cache: false,
                success:function(response){
                    if(noc_member == 2 ){
                        //if guarentor show readonly input box
                        $('.mem_name').show();
                        $('.mem_relation_name').hide();
                        $('#mem_relation_name').empty();
                        
                        $('#mem_id').val(response['guarentor_id'])
                        $('#mem_name').val(response['guarentor_name'])
                        $('#compare_finger').val(response['fingerprint'])
                    }else if(noc_member == 3){
                        //if Family member then show dropdown
                        $('.mem_relation_name').show();
                        $('.mem_name').hide();
                        $('#mem_name').val('');
                        
                        $('#mem_relation_name').empty();
                        $('#mem_relation_name').append("<option value=''>Select Member Name</option>")
                        for(var i=0;i<response['fam_id'].length;i++){
                            $('#mem_relation_name').append("<option value='"+response['fam_id'][i]+"'>"+response['fam_name'][i]+"</option>")
                        }

                    }
                }
            }).error(function(){
                if(noc_member == 2){
                    alert('Guarentor Fingerprint not Registered')
                }
            })
        }else if(noc_member == 1){
            //if member is customer then show customer name
            $('.mem_name').show();
            $('#mem_name').val('');
            $('.mem_relation_name').hide();
            $('#mem_relation_name').empty();

            var cus_name = $('#cus_name').val();
            var cus_id = $('#cus_id').val();
            $('#mem_name').val(cus_name)

            $.ajax({
                url:'nocFile/getFingerprints.php',
                data:{'id':cus_id,'family':false},
                dataType: 'json',
                type: 'post',
                cache: false,
                success:function(response){
                    $('#compare_finger').val(response['fingerprint'])
                }
            })
        }else {
            $('.mem_name').hide();
            $('#mem_name').val('');
            $('.mem_relation_name').hide();
            $('#mem_relation_name').empty();
        }
    })

    $('#mem_relation_name').change(function(){
        var id = $(this).val();
        $('.scanBtn').removeAttr('disabled');
        $.ajax({
            url:'nocFile/getFingerprints.php',
            data:{'id':id,'family':true},
            dataType: 'json',
            type: 'post',
            cache: false,
            success:function(response){
                $('#compare_finger').val(response['fingerprint'])
            }
        }).error(function(){
            alert('Guarentor Fingerprint not Registered')
        })
    })

    var mortgage_process = $('#mortgage_process').val()
    var endorsement_process = $('#endorsement_process').val()
    if(mortgage_process == '1'){
        $('.mort_proc').hide();
    }
    if(endorsement_process == '1'){
        $('.endor_proc').hide();
    }

    $('#submit_noc').click(function(){
        validations();
    })

})//Document Ready End


//On Load Event
$(function(){

    $('.noc-card').hide(); //Hide collection window at the starting
    $('#close-noc-card').hide();//Hide collection close button at the starting
    $('#submit_noc').hide();//Hide Submit button at the starting, because submit is only for collection

    $('.mem_relation_name').hide(); //Hide member name dropdown until chooses noc member
    $('.mem_name').hide(); //Hide member name input until chooses noc member

    var req_id = $('#idupd').val()
    const cus_id = $('#cusidupd').val()
    OnLoadFunctions(req_id,cus_id);

    var cus_pic = $('#cuspicupd').val();
    $('#imgshow').attr('src','uploads/request/customer/'+cus_pic);
})

function OnLoadFunctions(req_id,cus_id){

        $.ajax({
            //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
            url: 'nocFile/getLoanListWithClosed.php',
            data: {'req_id':req_id,'cus_id':cus_id},
            type:'post',
            cache: false,
            success: function(response){
                $('#loanListTableDiv').empty()
                $('#loanListTableDiv').html(response);
            }
        }).done(function(){
            $('.noc-window').click(function(){
                $('.noc-card').show(); //Show NOC window 
                $('#close-noc-card').show();// Show Cancel button
                $('#back-button').hide();// Hide Back button
                $('.loanlist_card').hide(); // hide loan list
                $('#submit_noc').show();//show submit button

                var req_id = $(this).attr('data-value');
                $('#req_id').val(req_id) //assigning to req_id input box for getching noc members
                
                //To get the Signed Document List on Checklist
                const cus_name = $('#cus_name').val();
                $.ajax({
                    url:'nocFile/getSignedDocList.php',
                    data: {'req_id':req_id,'cus_name':cus_name},
                    type: 'post',
                    cache:false,
                    success: function(response){
                        $('#signDocDiv').empty()
                        $('#signDocDiv').html(response);
                    }
                }).then(function(){
                    var sign_check =[];
                    $('.sign_check').click(function(){
                        if(this.checked){
                            sign_check.push($(this).attr('data-value'));
                        }else{
                            let indexToRemove = sign_check.indexOf($(this).attr('data-value'));
                            if (indexToRemove !== -1) {
                                sign_check.splice(indexToRemove, 1);
                            }
                        }
                        sign_check.sort(function(a, b) {
                            return a - b;
                        });
                        $('#sign_checklist').val(sign_check.join(','));
                    })
                })

                // To get the unused Cheque List on Checklist
                $.ajax({
                    url:'nocFile/getChequeDocList.php',
                    data: {'req_id':req_id,'cus_name':cus_name},
                    type: 'post',
                    cache:false,
                    success: function(response){
                        $('#chequeDiv').empty()
                        $('#chequeDiv').html(response);
                    }
                }).then(function(){
                    var cheque_check =[];
                    $('.cheque_check').click(function(){
                        if(this.checked){
                            cheque_check.push($(this).attr('data-value'));
                        }else{
                            let indexToRemove = cheque_check.indexOf($(this).attr('data-value'));
                            if (indexToRemove !== -1) {
                                cheque_check.splice(indexToRemove, 1);
                            }
                        }
                        cheque_check.sort(function(a, b) {
                            return a - b;
                        });
                        $('#cheque_checklist').val(cheque_check.join(','));
                    })
                })

                // To get the Mortgage List on Checklist
                $.ajax({
                    url:'nocFile/getMortgageList.php',
                    data: {'req_id':req_id,'cus_name':cus_name},
                    type: 'post',
                    cache:false,
                    success: function(response){
                        $('#mortgageDiv').empty()
                        $('#mortgageDiv').html(response);
                    }
                }).then(function(){
                    var mort_check =[];
                    $('.mort_check').click(function(){
                        var val = $(this).parent().prev().text();
                        if(this.checked){
                            mort_check.push(checkvalues(val));
                        }else{
                            let indexToRemove = mort_check.indexOf(checkvalues(val));
                            if (indexToRemove !== -1) {
                                mort_check.splice(indexToRemove, 1);
                            }
                        }
                        function checkvalues(val){
                            if(val == 'Mortgage Process'){
                                var noc = 'Mortgage Process noc';
                            }else if(val == 'Mortgage Document'){
                                var noc = 'Mortgage Document noc';
                            }
                            return noc;
                        }
                        $('#mort_checklist').val(mort_check.join(','));
                    })
                })

                // To get the Endorsement List on Checklist
                $.ajax({
                    url:'nocFile/getEndorsementList.php',
                    data: {'req_id':req_id,'cus_name':cus_name},
                    type: 'post',
                    cache:false,
                    success: function(response){
                        $('#endorsementDiv').empty()
                        $('#endorsementDiv').html(response);
                    }
                }).then(function(){
                    var endorse_check =[];
                    $('.endorse_check').click(function(){
                        var val = $(this).parent().prev().text();
                        if(this.checked){
                            endorse_check.push(checkvalues(val));
                        }else{
                            let indexToRemove = endorse_check.indexOf(checkvalues(val));
                            if (indexToRemove !== -1) {
                                endorse_check.splice(indexToRemove, 1);
                            }
                        }
                        function checkvalues(val){
                            if(val == 'Endorsement Process'){
                                var noc = 'Endorsement Process noc';
                            }else if(val == 'RC'){
                                var noc = 'RC noc';
                            }else if(val == 'Key'){
                                var noc = 'Key noc';
                            }
                            return noc;
                        }
                        $('#endorse_checklist').val(endorse_check.join(','));
                    })
                })
                // To get the Gold List on Checklist
                $.ajax({
                    url:'nocFile/getGoldList.php',
                    data: {'req_id':req_id,'cus_name':cus_name},
                    type: 'post',
                    cache:false,
                    success: function(response){
                        $('#goldDiv').empty()
                        $('#goldDiv').html(response);
                    }
                }).then(function(){
                    var gold_check =[];
                    $('.gold_check').click(function(){
                        if(this.checked){
                            gold_check.push($(this).attr('data-value'));
                        }else{
                            let indexToRemove = gold_check.indexOf($(this).attr('data-value'));
                            if (indexToRemove !== -1) {
                                gold_check.splice(indexToRemove, 1);
                            }
                        }
                        gold_check.sort(function(a, b) {
                            return a - b;
                        });
                        $('#gold_checklist').val(gold_check.join(','));
                    })
                })
                // To get the Document List on Checklist
                $.ajax({
                    url:'nocFile/getDocumentList.php',
                    data: {'req_id':req_id,'cus_name':cus_name},
                    type: 'post',
                    cache:false,
                    success: function(response){
                        $('#documentDiv').empty()
                        $('#documentDiv').html(response);
                    }
                }).then(function(){
                    var doc_check =[];
                    $('.doc_check').click(function(){
                        if(this.checked){
                            doc_check.push($(this).attr('data-value'));
                        }else{
                            let indexToRemove = doc_check.indexOf($(this).attr('data-value'));
                            if (indexToRemove !== -1) {
                                doc_check.splice(indexToRemove, 1);
                            }
                        }
                        doc_check.sort(function(a, b) {
                            return a - b;
                        });
                        $('#doc_checklist').val(doc_check.join(','));
                    })
                })

                $('.scanBtn').click(function(){
                    var mem_name = $('#mem_relation_name').val() != '' ? $('#mem_relation_name').val() : $('#mem_name').val();

                    if(mem_name != ''){

                        $('<div/>', {class: 'overlay'}).appendTo('body').html('<div class="loader"></div><span class="overlay-text">Scanning</span>');
                        $(this).attr('disabled',true);
    
                        setTimeout(()=>{ //Set Timeout, because loadin animation will be intrupped by this capture event
                            var quality = 60; //(1 to 100) (recommended minimum 55)
                            var timeout = 10; // seconds (minimum=10(recommended), maximum=60, unlimited=0)
                            var res = CaptureFinger(quality, timeout);
                            if (res.httpStaus) {
                                if (res.data.ErrorCode == "0") {
                                    $('#ack_fingerprint').val(res.data.AnsiTemplate); // Take ansi template that is the unique id which is passed by sensor
                                }//Error codes and alerts below
                                else if(res.data.ErrorCode == -1307){
                                    alert('Connect Your Device');
                                    $(this).removeAttr('disabled');
                                }else if(res.data.ErrorCode == -1140 || res.data.ErrorCode == 700){
                                    alert('Timeout');
                                    $(this).removeAttr('disabled');
                                }else if(res.data.ErrorCode == 720){
                                    alert('Reconnect Device');
                                    $(this).removeAttr('disabled');
                                }else if(res.data.ErrorCode == 730){
                                    alert('Capture Finger Again');
                                    $(this).removeAttr('disabled');
                                }else {
                                    alert('Error Code:' + res.data.ErrorCode);
                                    $(this).removeAttr('disabled');
                                }
                            }
                            else {
                                alert(res.err);
                            }
                            // Hide the loading animation and remove blur effect from the body
                            $('.overlay').remove();
    
                            //Verify the finger is matched with member name
                            var compare_finger = $('#compare_finger').val()
                            var ack_fingerprint = $('#ack_fingerprint').val()
                            if(ack_fingerprint != ''){

                                var res = VerifyFinger(compare_finger,ack_fingerprint)
                                if(res.httpStaus){
                                    if(res.data.Status){
                                        Swal.fire({
                                        title: 'Fingerprint Matching',
                                        icon: 'success',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#009688'
                                    });
                                    }else{
                                        if (res.data.ErrorCode != "0") {
                                            alert(res.data.ErrorDescription);
                                        }
                                        else {
                                            Swal.fire({
                                                title: 'Fingerprint Not Matching',
                                                icon: 'error',
                                                showConfirmButton: true,
                                                confirmButtonColor: '#009688'
                                            });
                                            $(this).removeAttr('disabled');
                                        }
                                    }
                                }else{
                                    alert(res.err)
                                }
                            }
    
                        },700) //Timeout End

                    }//If End

                })//Scan button Onclick end

                setTimeout(() => {
                    var sign_checkDisabled = $('.sign_check:disabled').length === $('.sign_check').length;
                    var cheque_checkDisabled = $('.cheque_check:disabled').length === $('.cheque_check').length;
                    var gold_checkDisabled = $('.gold_check:disabled').length === $('.gold_check').length;
                    var mort_checkDisabled = $('.mort_check:disabled').length === $('.mort_check').length;
                    var endorse_checkDisabled = $('.endorse_check:disabled').length === $('.endorse_check').length;
                    var doc_checkDisabled = $('.doc_check:disabled').length === $('.doc_check').length;
    
                    if (sign_checkDisabled && cheque_checkDisabled && gold_checkDisabled && mort_checkDisabled && endorse_checkDisabled && doc_checkDisabled) {
                        $('#submit_noc').hide();
                    }else{
                        $('#submit_noc').show();
                    }
                }, 1000);

            })//Window onclick end

        })//Ajax done End
    
}//Auto Load function END


function validations(){
    var noc_member = $('#noc_member').val(); var mem_relation_name = $('#mem_relation_name').val(); var fingerprint = $('.scanBtn').attr('disabled');
    var sign_checklist = $('#sign_checklist').val(); var cheque_checklist = $('#cheque_checklist').val(); var gold_checklist = $('#gold_checklist').val();
    var mort_checklist = $('#mort_checklist').val(); var endorse_checklist = $('#endorse_checklist').val(); var doc_checklist = $('#doc_checklist').val();
    
    var sign_checkDisabled = $('.sign_check:disabled').length === $('.sign_check').length;
    var cheque_checkDisabled = $('.cheque_check:disabled').length === $('.cheque_check').length;
    var gold_checkDisabled = $('.gold_check:disabled').length === $('.gold_check').length;
    var mort_checkDisabled = $('.mort_check:disabled').length === $('.mort_check').length;
    var endorse_checkDisabled = $('.endorse_check:disabled').length === $('.endorse_check').length;
    var doc_checkDisabled = $('.doc_check:disabled').length === $('.doc_check').length;



    if(noc_member == ''){
        $('.noc_memberCheck').show()
        event.preventDefault();
    }else{
        $('.noc_memberCheck').hide()
    }

    if(noc_member = '3' && mem_relation_name == ''){
        $('.mem_relation_nameCheck').show()
        event.preventDefault();
    }else{
        $('.mem_relation_nameCheck').hide()
    }
    
    if(fingerprint != 'disabled'){
        $('.scanBtnCheck').show()
        event.preventDefault();
    }else{
        $('.scanBtnCheck').hide()
    }

    if(sign_checklist =='' && cheque_checklist=='' && gold_checklist=='' && mort_checklist =='' && endorse_checklist=='' && doc_checklist==''){
        if(sign_checkDisabled != true){
            $('.sign_checklistCheck').show()
            event.preventDefault();
        }else{
            $('.sign_checklistCheck').hide()
        }
        
        if(cheque_checkDisabled != true){
            $('.cheque_checklistCheck').show()
            event.preventDefault();
        }else{
            $('.cheque_checklistCheck').hide()
        }
        
        if(gold_checkDisabled != true){
            $('.gold_checklistCheck').show()
            event.preventDefault();
        }else{
            $('.gold_checklistCheck').hide()
        }
        
        if(mort_checkDisabled != true){
            $('.mort_checklistCheck').show()
            event.preventDefault();
        }else{
            $('.mort_checklistCheck').hide()
        }
        
        if(endorse_checkDisabled != true){
            $('.endorse_checklistCheck').show()
            event.preventDefault();
        }else{
            $('.endorse_checklistCheck').hide()
        }
        
        if(doc_checkDisabled != true){
            $('.endorse_checklistCheck').show()
            event.preventDefault();
        }else{
            $('.doc_checklistCheck').hide()
        }

    }else{
        
    }

}
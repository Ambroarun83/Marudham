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
        })
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
                $('#submit_noc').hide();//show submit button

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
                })

                //To get the Signed Document List on Checklist
                // $.ajax({
                //     url:'nocFile/getChequeDocList.php',
                //     data: {'req_id':req_id,'cus_name':cus_name},
                //     type: 'post',
                //     cache:false,
                //     success: function(response){
                //         $('#chequeDiv').empty()
                //         $('#chequeDiv').html(response);
                //     }
                // })


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
    
                        },700) //Timeout End

                    }//If End

                })//Scan button Onclick end


            })//Window onclick end

        })//Ajax done End
    
}//Auto Load function END



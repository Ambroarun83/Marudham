$(document).ready(function () {

    // $('input[data-type="adhaar-number"]').keyup(function () { /// AAdhar Validation 
    //     var value = $(this).val();
    //     value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
    //     $(this).val(value);
    // });

    //Show Remark and Address when select other in Relationship.
    $('#relationship').on('change', function () {

        var relation = $('#relationship').val();

        if (relation == 'Other') {
            $("#remark").show();
            $("#address").show();
        }
        else if (relation != 'Other') {
            $("#remark").hide();
            $("#address").hide();
        }

    });

    $('#dob').change(function () {
        let dobirth = $('#dob').val();

        var dob = new Date(dobirth);
        //calculate month difference from current date in time  
        var month_diff = Date.now() - dob.getTime();

        //convert the calculated difference in date format  
        var age_dt = new Date(month_diff);

        //extract year from date      
        var year = age_dt.getUTCFullYear();

        //now calculate the age of the user  
        var age = Math.abs(year - 1970);

        $('#age').val(age); // set value to age.
    })


    $("#state").change(function () {
        var StateSelected = $(this).val();
        var optionsList =  getDistrictDropdown(StateSelected);
        districtNameList(optionsList)
    });

    $('#district').change(function () {
        var DistSelected = $(this).val();
        $('#district1').val(DistSelected);
        var talukOption = getTalukDropdown(DistSelected);
        talukNameList(talukOption);
    });

    $('#taluk').change(function () {
        var talukselected = $(this).val();
        $('#taluk1').val(talukselected);
        var area_upd = '';
        getTalukBasedArea(talukselected ,area_upd,'#area');
    })

    $('#area').change(function () {
        var areaselected = $('#area').val();
        var sub_area_upd = '';
        getAreaBasedSubArea(areaselected,sub_area_upd,'#sub_area');
    })

    //Area Confirm Card.
    $("#area_state").change(function () {
        var StateSelected = $(this).val();
        var districtOption =  getDistrictDropdown(StateSelected);
        conformDistrictNameList(districtOption)
    });

    $('#area_district').change(function () {
        var DistSelected = $(this).val();
        $('#area_district1').val(DistSelected);
        var talukOptionList = getTalukDropdown(DistSelected);
        conformtalukNameList(talukOptionList);
    });

    $('#area_taluk').change(function () {
        var talukselected = $(this).val();
        $('#area_taluk1').val(talukselected);
        var area_upd = '';
        getTalukBasedArea(talukselected ,area_upd,'#area_confirm');
    })

    $('#area').change(function () {
        var areaselected = $(this).val();
        var sub_area_upd = '';
        getAreaBasedSubArea(areaselected,sub_area_upd,'#area_sub_area');
    })

    $('#area_sub_area').change(function () {
        var sub_area_id = $(this).val();
        getGroupandLine(sub_area_id);
    })

    window.onscroll = function () {
        var navbar = document.getElementById("navbar");
        var stickyHeader = navbar.offsetTop;
        if (window.pageYOffset > 500) {
            $('#navbar').fadeIn('fast');
            navbar.classList.add("stickyHeader")
        } else {
            $('#navbar').fadeOut('fast');
            navbar.classList.remove("stickyHeader");
        }
    };


    ///Customer Feedback 
    $("body").on("click", "#cus_feedback_edit", function () {
        let id = $(this).attr('value');
    
        $.ajax({
            url: 'verificationFile/customer_feedback_edit.php',
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
                url: 'verificationFile/customer_feedback_delete.php',
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

    // Verification Tab Change Radio buttons
    $('#cus_profile,#documentation,#loan_calc').click(function () {
        var verify = $('input[name=verification_type]:checked').val();

        if (verify == 'cus_profile') {
            $('#customer_profile').show(); $('#cus_document').hide(); $('#customer_loan_calc').hide();
            // $('.documentation-card').hide();
            $('.edit-document-card').hide();// hide edit document card when not in use
            $('.dropdown').children().css('border-color','');// to set other dropdown buttons as normal
        }
        if (verify == 'documentation') {
            $('#customer_profile').hide(); $('#cus_document').show(); $('#customer_loan_calc').hide();
            // $('.documentation-card').show();
            $('.edit-document-card').hide();
        }
    })

    ///Documentation 



    
    // $('#close_edit_doc_card').click(function(){
    //     // $('.documentation-card').show();
    //     $('.edit-document-card').hide();
    //     resetDocumentDetails();// to clear all the values if not submitted
    // })

    // ////Mortgage Info 
    // $('#mortgageprocessCheck').hide(); $('#propertyholdertypeCheck').hide(); $('#docpropertytypeCheck').hide(); $('#docpropertymeasureCheck').hide(); $('#docpropertylocCheck').hide(); $('#docpropertyvalueCheck').hide();

    // //Endorsement Info
    // $('#endorsementprocessCheck').hide(); $('#ownertypeCheck').hide(); $('#vehicletypeCheck').hide(); $('#vehicleprocessCheck').hide(); $('#enCompanyCheck').hide(); $('#enModelCheck').hide(); 

    // //Gold Info
    // $('#goldCheck').hide(); $('#GoldstatusCheck').hide(); $('#GoldtypeCheck').hide(); $('#purityCheck').hide(); $('#goldCountCheck').hide(); $('#goldWeightCheck').hide(); $('#goldValueCheck').hide();

    // //Document Info
    // $('#documentnameCheck').hide(); $('#documentdetailsCheck').hide(); $('#documentTypeCheck').hide(); $('#docholderCheck').hide();

    // $('#sign_type').change(function () { // Signed Type 
    //     let type = $(this).val();

    //     if (type == '3') {
    //         $('#relation_doc').show();
    //         signTypeRelation();

    //     } else {
    //         $('#relation_doc').hide();
    //         $("#signType_relationship").empty();
    //     }
    // })


    // $("body").on("click", "#signed_doc_edit", function () {
    //     let id = $(this).attr('value');
    //     signTypeRelation();

    //     $.ajax({
    //         url: 'verificationFile/documentation/signed_doc_edit.php',
    //         type: 'POST',
    //         data: { "id": id },
    //         dataType: 'json',
    //         cache: false,
    //         success: function (result) {

    //             $("#signedID").val(result['id']);
    //             $("#doc_name").val(result['doc_name']);
    //             $("#sign_type").val(result['sign_type']);

    //             if (result['sign_type'] == '3') {
    //                 $('#relation_doc').show();
    //                 $("#signType_relationship").val(result['signType_relationship']);

    //             } else {
    //                 $('#relation_doc').hide();
    //             }

    //             $("#doc_Count").val(result['doc_Count']);

    //         }
    //     });

    // });

    // $("#signDocUploads").on('submit', function (e) {
    //     e.preventDefault();

    //     let doc_name = $("#doc_name").val();
    //     let sign_type = $("#sign_type").val();
    //     let doc_Count = $("#doc_Count").val();
    //     let signeddoc_upd = $('#signdoc_upd').val();

    //     if (doc_name != "" && sign_type != "" && doc_Count != "" && signeddoc_upd != "") {
    //         $.ajax({
    //             type: 'POST',
    //             url: 'updateFile/sign_info_doc_upload.php',
    //             data: new FormData(this),
    //             contentType: false,
    //             processData: false,
    //             success: function (response) {

    //                 var insresult = response.includes("Uploaded");
    //                 if (insresult) {
    //                     $('#signInsertOk').show();
    //                     setTimeout(function () {
    //                         $('#signInsertOk').fadeOut('fast');
    //                     }, 2000);
    //                 }
    //                 else {
    //                     $('#signNotOk').show();
    //                     setTimeout(function () {
    //                         $('#signNotOk').fadeOut('fast');
    //                     }, 2000);
    //                 }

    //                 resetsignInfo();
    //             }
    //         });
    //         $('#docNameCheck').hide(); $('#signTypeCheck').hide(); $('#docCountCheck').hide(); $('#docupdCheck').hide();
    //     } else {

    //         if (doc_name == "") {
    //             $('#docNameCheck').show();
    //         } else {
    //             $('#docNameCheck').hide();
    //         }

    //         if (sign_type == "") {
    //             $('#signTypeCheck').show();
    //         } else {
    //             $('#signTypeCheck').hide();
    //         }

    //         if (doc_Count == "") {
    //             $('#docCountCheck').show();
    //         } else {
    //             $('#docCountCheck').hide();
    //         }

    //         if (signeddoc_upd == "") {
    //             $('#docupdCheck').show();
    //         } else {
    //             $('#docupdCheck').hide();
    //         }

    //     }
    // });


    // $("body").on("click", "#signed_doc_delete", function () {
    //     var isok = confirm("Do you want delete this Signed Doc Info?");
    //     if (isok == false) {
    //         return false;
    //     } else {
    //         var signid = $(this).attr('value');

    //         $.ajax({
    //             url: 'verificationFile/documentation/signed_doc_delete.php',
    //             type: 'POST',
    //             data: { "signid": signid },
    //             cache: false,
    //             success: function (response) {
    //                 var delresult = response.includes("Deleted");
    //                 if (delresult) {
    //                     $('#signDeleteOk').show();
    //                     setTimeout(function () {
    //                         $('#signDeleteOk').fadeOut('fast');
    //                     }, 2000);
    //                 }
    //                 else {

    //                     $('#signDeleteNotOk').show();
    //                     setTimeout(function () {
    //                         $('#signDeleteNotOk').fadeOut('fast');
    //                     }, 2000);
    //                 }

    //                 resetsignInfo();
    //             }
    //         });
    //     }
    // });

    // $('#holder_type').change(function () { // Cheque info 
    //     let type = $(this).val();
    //     let req_id = $('#req_id').val();

    //     if (type == '0') {
    //         $('#holder_name').show();
    //         $('#holder_relationship_name').hide();

    //         $.ajax({
    //             type: 'POST',
    //             url: 'verificationFile/documentation/check_holder_name.php',
    //             data: { "type": type, "reqId": req_id },
    //             dataType: 'json',
    //             cache: false,
    //             success: function (result) {
    //                 $('#holder_name').val(result['name']);
    //                 $('#cheque_relation').val('NIL');
    //             }
    //         });

    //     } else if (type == '1') {
    //         $('#holder_name').show();
    //         $('#holder_relationship_name').hide();

    //         $.ajax({
    //             type: 'POST',
    //             url: 'verificationFile/documentation/check_holder_name.php',
    //             data: { "type": type, "reqId": req_id },
    //             dataType: 'json',
    //             cache: false,
    //             success: function (result) {
    //                 $('#holder_name').val(result['name']);
    //                 $('#cheque_relation').val(result['relationship']);
    //             }
    //         });

    //     } else if (type == '2') {
    //         $('#holder_name').hide();
    //         $('#holder_relationship_name').show();
    //         $('#cheque_relation').val('');

    //         chequeHolderName(); // Holder Name From Family Table.
    //     } else {
    //         $('#holder_name').show();
    //         $('#holder_relationship_name').hide();
    //         $('#holder_name').val('');
    //         $('#cheque_relation').val('');
    //     }
    // });

    // $('#holder_relationship_name').change(function () {
    //     let fam_id = $(this).val();
    //     $.ajax({
    //         url: 'verificationFile/documentation/find_cheque_relation.php',
    //         type: 'POST',
    //         data: { "fam_id": fam_id },
    //         dataType: 'json',
    //         success: function (response) {
    //             $('#cheque_relation').val(response);

    //         }
    //     });
    // })

    // $('#chequebankCheck').hide(); $('#holdertypeCheck').hide(); $('#chequeCountCheck').hide(); $('#chequeupdCheck').hide();

    // $("#chequeUploads").on('submit', function (e) {
    //     e.preventDefault();

    //     let cus_id = $('#cus_id').val();
    //     let holder_type = $("#holder_type").val();
    //     var holder_name = $("#holder_name").val();
    //     var holder_relationship_name = $("#holder_relationship_name").val();
    //     let chequebank_name = $("#chequebank_name").val();
    //     let cheque_count = $("#cheque_count").val();
    //     // let cheque_upd = $("#cheque_upd")[0];
    //     let formdata = new FormData();
    //     let files = $("#cheque_upd")[0].files;     
    //     for(var i=0; i<files.length; i++){
    //         formdata.append('cheque_upd[]', files[i])
    //     }
    //     var chequeno = $("#cheque_upd_no").val();
    //     var chequeArr = [];
    //     var i =0;
    //     $('.chequeno').each(function(){
    //     chequeArr[i] = $(this).val();
    //     i++;        
    //     })

    //     let chequeID = $("#chequeID").val();
        
    //     formdata.append('holder_type', holder_type)
    //     formdata.append('holder_name', holder_name)
    //     formdata.append('holder_relationship_name', holder_relationship_name)
        
    //     formdata.append('chequeID', chequeID)
    //     formdata.append('cheque_upd_no', chequeArr)
    //     formdata.append('cus_id', cus_id)
        
    //     if (holder_type != "" && chequebank_name != "" && cheque_count != "" ) {
    //         $.ajax({
    //             type: 'POST',
    //             url: 'updateFile/cheque_upload.php',
    //             data: formdata,
    //             contentType: false,
    //             processData: false,
    //             success: function (response) {

    //                 var insresult = response.includes("Uploaded");
    //                 if (insresult) {
    //                     $('#chequeInsertOk').show();
    //                     setTimeout(function () {
    //                         $('#chequeInsertOk').fadeOut('fast');
    //                     }, 2000);
    //                 }
    //                 else {
    //                     $('#chequeNotOk').show();
    //                     setTimeout(function () {
    //                         $('#chequeNotOk').fadeOut('fast');
    //                     }, 2000);
    //                 }

    //                 resetchequeInfo();
    //             }
    //         });
    //         $('#chequebankCheck').hide(); $('#holdertypeCheck').hide(); $('#chequeCountCheck').hide(); $('#chequeupdCheck').hide();
    //     } else {

    //         if (holder_type == "") {
    //             $('#holdertypeCheck').show();
    //         } else {
    //             $('#holdertypeCheck').hide();
    //         }

    //         if (chequebank_name == "") {
    //             $('#chequebankCheck').show();
    //         } else {
    //             $('#chequebankCheck').hide();
    //         }

    //         if (cheque_count == "") {
    //             $('#chequeCountCheck').show();
    //         } else {
    //             $('#chequeCountCheck').hide();
    //         }

    //         // if (checkupd == 0) {
    //         //     $('#chequeupdCheck').show();
    //         // } else {
    //         //     $('#chequeupdCheck').hide();
    //         // }

    //     }
    // });

    // $("body").on("click", "#cheque_info_edit", function () {
    //     let id = $(this).attr('value');
    //     chequeHolderName(); // Holder Name From Family Table.

    //     $.ajax({
    //         url: 'verificationFile/documentation/cheque_info_edit.php',
    //         type: 'POST',
    //         data: { "id": id },
    //         dataType: 'json',
    //         cache: false,
    //         success: function (result) {

    //             $("#chequeID").val(result['id']);
    //             $("#holder_type").val(result['holder_type']);


    //             if (result['holder_type'] != '2') {
    //                 $('#holder_name').show();
    //                 $('#holder_relationship_name').hide();
    //                 $("#holder_name").val(result['holder_name']);

    //             } else {
    //                 $('#holder_name').hide();
    //                 $('#holder_relationship_name').show();

    //                 $("#holder_relationship_name").val(result['holder_relationship_name']);
    //             }

    //             $("#cheque_relation").val(result['cheque_relation']);
    //             $("#chequebank_name").val(result['chequebank_name']);
    //             $("#cheque_count").val(result['cheque_count']);
                
    //             getChequeColumn(result['cheque_count']); // show input to insert Cheque No.
    //         }
    //     });

    // });


    // $("body").on("click", "#gold_info_edit", function () {
    //     let id = $(this).attr('value');
    //     chequeHolderName(); // Holder Name From Family Table.

    //     $.ajax({
    //         url: 'verificationFile/documentation/gold_info_edit.php',
    //         type: 'POST',
    //         data: { "id": id },
    //         dataType: 'json',
    //         cache: false,
    //         success: function (result) {

    //             $("#goldID").val(result['id']);
    //             $("#gold_sts").val(result['gold_sts']);
    //             $("#gold_type").val(result['gold_type']);
    //             $("#Purity").val(result['Purity']);
    //             $("#gold_Count").val(result['gold_Count']);
    //             $("#gold_Weight").val(result['gold_Weight']);
    //             $("#gold_Value").val(result['gold_Value']);

    //         }
    //     });

    // });


    // $("body").on("click", "#gold_info_delete", function () {
    //     var isok = confirm("Do you want delete this Gold Info?");
    //     if (isok == false) {
    //         return false;
    //     } else {
    //         var chequeid = $(this).attr('value');

    //         $.ajax({
    //             url: 'verificationFile/documentation/gold_info_delete.php',
    //             type: 'POST',
    //             data: { "chequeid": chequeid },
    //             cache: false,
    //             success: function (response) {
    //                 var delresult = response.includes("Deleted");
    //                 if (delresult) {
    //                     $('#goldDeleteOk').show();
    //                     setTimeout(function () {
    //                         $('#goldDeleteOk').fadeOut('fast');
    //                     }, 2000);
    //                 }
    //                 else {

    //                     $('#goldDeleteNotOk').show();
    //                     setTimeout(function () {
    //                         $('#goldDeleteNotOk').fadeOut('fast');
    //                     }, 2000);
    //                 }

    //                 resetgoldInfo();
    //             }
    //         });
    //     }
    // });

    // // Mortgage Info
    // $('#mortgageprocessCheck').hide(); $('#propertyholdertypeCheck').hide(); $('#docpropertytypeCheck').hide(); $('#docpropertymeasureCheck').hide(); $('#docpropertylocCheck').hide(); $('#docpropertyvalueCheck').hide();
    // $('#mortgagenameCheck').hide(); $('#mortgagedsgnCheck').hide(); $('#mortgagenumCheck').hide(); $('#regofficeCheck').hide(); $('#mortgagevalueCheck').hide(); $('#mortgagedocCheck').hide(); $('#mortgagedocUpdCheck').hide();
    

    $('#Propertyholder_type').change(function () {
        let type = $(this).val();
        let req_id = $('#req_id').val();

        if (type == '0') {
            $('#Propertyholder_name').show();
            $('#Propertyholder_relationship_name').val('');
            $('#Propertyholder_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#Propertyholder_name').val(result['name']);
                    $('#doc_property_relation').val('NIL');
                }
            });

        } else if (type == '1') {
            $('#Propertyholder_name').show();
            $('#Propertyholder_relationship_name').val('');
            $('#Propertyholder_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#Propertyholder_name').val(result['name']);
                    $('#doc_property_relation').val(result['relationship']);
                }
            });

        } else if (type == '2') {
            $('#Propertyholder_name').hide();
            $('#Propertyholder_relationship_name').show();
            $('#Propertyholder_name').val('');
            $('#doc_property_relation').val('');

            getFamilyList(); 

        } else {
            $('#Propertyholder_name').show();
            $('#Propertyholder_relationship_name').hide();
            $('#Propertyholder_name').val('');
            $('#doc_property_relation').val('');

        }
    });

    $('#Propertyholder_relationship_name').change(function () {
        let fam_id = $(this).val();
        $.ajax({
            url: 'verificationFile/documentation/find_cheque_relation.php',
            type: 'POST',
            data: { "fam_id": fam_id },
            dataType: 'json',
            success: function (response) {
                $('#doc_property_relation').val(response);

            }
        });
    });

    //Mortgage Document upload show/hide based on select YES/NO.
    $('#mortgage_document').change(function () {
        var docupd = $(this).val();

        if (docupd == '0') {
            $('#mort_doc_upd').show();
            $('#pendingchk').removeAttr('checked')
            
        } else {
            $('#mortgage_document_upd').val('');//remove selected file from file input box
            $('#mort_doc_upd').hide();
            $('#pendingchk').prop('checked',true);
        }
    })

    //when Mortgage Document pending is Checked then document will empty and Doc is NO////
    $('#pendingchk').click(function () {

        if (this.checked == true) {
            $('#mortgage_document_upd').val('');
            $('#mortgage_document').val('1');
            $('#mort_doc_upd').hide();
        } else {
            $('#mortgage_document').val('0');
            $('#mort_doc_upd').show();
        }
    })

    $('#mortgage_process').change(function () {

        let process = $(this).val();

        if (process == '0') {
            $('#mortgage_div').show();
        } else {
            $('#mortgage_div').hide();

            $('#Propertyholder_type').val('');
            $('#Propertyholder_name').val('');
            $('#Propertyholder_relationship_name').val('');
            $('#doc_property_relation').val('');
            $('#doc_property_pype').val('');
            $('#doc_property_measurement').val('');
            $('#doc_property_location').val('');
            $('#doc_property_value').val('');
            $('#mortgage_name').val('');
            $('#mortgage_dsgn').val('');
            $('#mortgage_nuumber').val('');
            $('#reg_office').val('');
            $('#mortgage_value').val('');
            $('#mortgage_document').val('');
            $('#mortgage_document_upd').val('');
            $('#mortgage_doc_upd').val('');//old uploaded name
        }
    })

    //Endrosement Info 
    $('#owner_type').change(function () {
        let type = $(this).val();
        let req_id = $('#req_id').val();

        if (type == '0') {
            $('#owner_name').show();
            $('#ownername_relationship_name').val('');
            $('#ownername_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#owner_name').val(result['name']);
                    $('#en_relation').val('NIL');
                }
            });

        } else if (type == '1') {
            $('#owner_name').show();
            $('#ownername_relationship_name').val('');
            $('#ownername_relationship_name').hide();

            $.ajax({
                type: 'POST',
                url: 'verificationFile/documentation/check_holder_name.php',
                data: { "type": type, "reqId": req_id },
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#owner_name').val(result['name']);
                    $('#en_relation').val(result['relationship']);
                }
            });

        } else if (type == '2') {
            $('#owner_name').hide();
            $('#ownername_relationship_name').show();
            $('#owner_name').val('');
            $('#en_relation').val('');

            getFamilyList();
        } else {
            $('#owner_name').show();
            $('#ownername_relationship_name').hide();
            $('#owner_name').val('');
            $('#en_relation').val('');
        }
    });

    $('#ownername_relationship_name').change(function () {
        let fam_id = $(this).val();
        $.ajax({
            url: 'verificationFile/documentation/find_cheque_relation.php',
            type: 'POST',
            data: { "fam_id": fam_id },
            dataType: 'json',
            success: function (response) {
                $('#en_relation').val(response);

            }
        });
    });
    
    $('#en_RC').change(function () {
        var rcupd = $(this).val();

        if (rcupd == '0') {
            $('#end_doc_upd').show();
            $('#endorsependingchk').removeAttr('checked');
        } else {
            $('#RC_document_upd').val('');
            $('#end_doc_upd').hide();
            $('#endorsependingchk').prop('checked',true);
        }
    });

    $('#endorsependingchk').click(function () {

        if (this.checked == true) {
            $('#RC_document_upd').val('');
            $('#en_RC').val('1');
            $('#end_doc_upd').hide();
        } else {
            $('#en_RC').val('0');
            $('#end_doc_upd').show();
        }
    })

    $('#endorsement_process').change(function () {

        let process = $(this).val();

        if (process == '0') {
            $('#end_process_div').show();
        } else {
            $('#end_process_div').hide();

            $('#owner_type').val('');
            $('#owner_name').val('');
            $('#ownername_relationship_name').val('');
            $('#en_relation').val('');
            $('#vehicle_type').val('');
            $('#vehicle_process').val('');
            $('#en_Company').val('');
            $('#en_Model').val('');
        }
    })

    // $('#document_holder').change(function () {
    //     let type = $(this).val();
    //     let req_id = $('#req_id').val();

    //     if (type == '0') {//Customer
    //         $('#docholder_name').show();
    //         $('#docholder_relationship_name').val('');
    //         $('#docholder_relationship_name').hide();

    //         $.ajax({
    //             type: 'POST',
    //             url: 'verificationFile/documentation/check_holder_name.php',
    //             data: { "type": type, "reqId": req_id },
    //             dataType: 'json',
    //             cache: false,
    //             success: function (result) {
    //                 $('#docholder_name').val(result['name']);
    //                 $('#doc_relation').val('NIL');
    //             }
    //         });

    //     } else if (type == '1') {//Guarentor
    //         $('#docholder_name').show();
    //         $('#docholder_relationship_name').val('');
    //         $('#docholder_relationship_name').hide();

    //         $.ajax({
    //             type: 'POST',
    //             url: 'verificationFile/documentation/check_holder_name.php',
    //             data: { "type": type, "reqId": req_id },
    //             dataType: 'json',
    //             cache: false,
    //             success: function (result) {
    //                 $('#docholder_name').val(result['name']);
    //                 $('#doc_relation').val(result['relationship']);
    //             }
    //         });

    //     } else if (type == '2') {//Family member
    //         $('#docholder_name').hide();
    //         $('#docholder_relationship_name').show();
    //         $('#docholder_name').val('');
    //         $('#doc_relation').val('');

    //         docHolderName();
    //     } else {
    //         $('#docholder_name').show();
    //         $('#docholder_relationship_name').hide();
    //         $('#docholder_name').val('');
    //         $('#doc_relation').val('');
    //     }
    // });

    // $('#docholder_relationship_name').change(function () {
    //     let fam_id = $(this).val();
    //     $.ajax({
    //         url: 'verificationFile/documentation/find_cheque_relation.php',
    //         type: 'POST',
    //         data: { "fam_id": fam_id },
    //         dataType: 'json',
    //         success: function (response) {
    //             $('#doc_relation').val(response);

    //         }
    //     });
    // });

    // //To Show Relationship value on edit page.////
    // let mortgage = $('#Propertyholder_type').val();
    // if(mortgage == '2'){
    //     $('#Propertyholder_name').hide();
    //     $('#Propertyholder_relationship_name').show();
    //     mortgageHolderName();
    //     let mortgageHolder =  $('#mortgage_relation_name').val();

    //     setTimeout(() => {
    //         $('#Propertyholder_relationship_name').val(mortgageHolder);
    //     }, 500);
    // }

    // let ot = $('#owner_type').val();
    // if(ot == '2'){
    //     $('#owner_name').hide();
    //     $('#ownername_relationship_name').show();
    //     endorseHolderName();
    //     let Endorsename =  $('#en_relation_name').val();

    //     setTimeout(() => {
    //         $('#ownername_relationship_name').val(Endorsename);
    //     }, 500);
    // }

    // let docHolder = $('#document_holder').val();    
    // if(docHolder == '2'){
    //     $('#docholder_name').hide();
    //     $('#docholder_relationship_name').show();
    //     docHolderName();
    //     let holder =  $('#docrelation_name').val();

    //     setTimeout(() => {
    //         $('#docholder_relationship_name').val(holder);
    //     }, 500);
    // }

});   ////////Document Ready End

$(function () {
    //  $('.icon-chevron-down1').parent().next('div').slideUp(); //To collapse all card on load
    
    getImage(); // To show customer image when window onload.

    resetFamInfo(); //Call Family Info Table Initially.
    resetFamDetails();
    closeFamModal();

    resetpropertyInfo() // Property Info Modal Table Reset.
    resetPropertyinfoList() //Property Info List.

    resetbankInfo(); // Bank info Modal Table Reset.
    resetbankinfoList(); //Bank Info List.

    resetkycinfoList(); //KYC Info List.

    //Documentation

    getDocumentHistory();//for document history table
    
    // resetsignInfo(); // Signed Doc info Reset.
    // resetsigninfoList(); // Signed Doc List Reset.

    // resetchequeInfo(); // Cheque Info Reset.
    // chequeinfoList(); // Cheque Info List.

    // resetgoldInfo(); // Gold Info Reset.
    // goldinfoList(); // Gold Info List.
    
    // resetdocInfo(); // Document Info Reset.
    // docinfoList(); // Document Info List.

    resetfeedback(); //Reset Feedback Modal Table.
    feedbackList(); // Feedback List.

    getCustomerLoanCounts();//to get closed customer details

    var state_upd = $('#state_upd').val();
    if(state_upd != ''){
        var optionsList = getDistrictDropdown(state_upd);
        districtNameList(optionsList)
    }

    var district_upd = $('#district_upd').val();
    if(district_upd != ''){
        var talukOption =  getTalukDropdown(district_upd);
        talukNameList(talukOption);
    }

    var taluk_upd = $('#taluk_upd').val();
    if(taluk_upd != ''){
        var area_upd = $('#area_upd').val();
        getTalukBasedArea(taluk_upd ,area_upd,'#area');
    }

    var area_upd = $('#area_upd').val();
    if(area_upd != ''){
        var sub_area_upd = $('#sub_area_upd').val();
        getAreaBasedSubArea(area_upd,sub_area_upd,'#sub_area');
    }

//Area Confirm Details.
    var area_state_upd = $('#area_state_upd').val();
    if(area_state_upd != ''){
        var districtOption = getDistrictDropdown(area_state_upd);
        conformDistrictNameList(districtOption)
    }

    var area_district_upd = $('#area_district_upd').val();
    if(area_district_upd != ''){
        var talukOptionList =  getTalukDropdown(area_district_upd);
        conformtalukNameList(talukOptionList);
    }

    var area_taluk_upd = $('#area_taluk_upd').val();
    if(area_taluk_upd != ''){
        var area_upd = $('#area_confirm_area').val();
        getTalukBasedArea(area_taluk_upd,area_upd,'#area_confirm');
    }

    var area_confirm_area = $('#area_confirm_area').val();
    if(area_confirm_area != ''){
        var sub_area_upd = $('#sub_area_confirm').val();
        getAreaBasedSubArea(area_confirm_area,sub_area_upd,'#area_sub_area');
    }

    $('.modalTable').DataTable({
        'processing': true,
        'iDisplayLength': 5,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).find('td:first').html(dataIndex + 1);
        },
        "drawCallback": function (settings) {
            this.api().column(0).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        },
    });
    

});

function getImage() { // Cus img show onload.
    let imgName = $('#cus_image').val();
    $('#imgshow').attr('src', "uploads/request/customer/" + imgName + " ");

    var  guarentorimg = $('#guarentor_image').val();
    $('#imgshows').attr('src', "uploads/verification/guarentor/" + guarentorimg + " ");
}

function getCustomerLoanCounts(){
    var cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/getCustomerLoanCounts.php',
        data: {'cus_id':cus_id},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#cus_loan_count').val(response['loan_count'])
            $('#cus_frst_loanDate').val(response['first_loan'])
            $('#cus_travel_cmpy').val(response['travel'])
            $('#cus_exist_type').val(response['existing_type'])
        },
        error:function(){
            $('#cus_exist_type').val('Renewal');
        }
    })
}
// Modal Box for Agent Group

$(document).on("click", "#submitFamInfoBtn", function () {
    let cus_id = $('#cus_id').val();
    let famname = $("#famname").val();
    let relationship = $("#relationship").val();
    let other_remark = $("#other_remark").val();
    let other_address = $("#other_address").val();
    let relation_age = $("#relation_age").val();
    let relation_aadhar = $("#relation_aadhar").val();
    let relation_Mobile = $("#relation_Mobile").val();
    let relation_Occupation = $("#relation_Occupation").val();
    let relation_Income = $("#relation_Income").val();
    let relation_Blood = $("#relation_Blood").val();
    let famTableId = $("#famID").val();

    if (famname != "" && relationship != "" && relation_age != "" && relation_aadhar != "" && relation_Mobile != "" && relation_Occupation != "" && relation_Income != "" ) {
        $.ajax({
            url: 'updateFile/update_family_submit.php',
            type: 'POST',
            data: { "famname": famname, "realtionship": relationship, "other_remark": other_remark, "other_address": other_address, "relation_age": relation_age, "relation_aadhar": relation_aadhar, "relation_Mobile": relation_Mobile, "relation_Occupation": relation_Occupation, "relation_Income": relation_Income, "relation_Blood": relation_Blood, "famTableId": famTableId, "cus_id": cus_id },
            cache: false,
            success: function (response) {

                var insresult = response.includes("Inserted");
                var updresult = response.includes("Updated");
                if (insresult) {
                    $('#FamInsertOk').show();
                    setTimeout(function () {
                        $('#FamInsertOk').fadeOut('fast');
                    }, 2000);
                }
                else if (updresult) {
                    $('#famUpdateok').show();
                    setTimeout(function () {
                        $('#famUpdateok').fadeOut('fast');
                    }, 2000);
                }
                else {
                    $('#NotOk').show();
                    setTimeout(function () {
                        $('#NotOk').fadeOut('fast');
                    }, 2000);
                }

                resetFamInfo();
                resetFamDetails();
                closeFamModal();
            }
        });
    }
    else {
        if (famname == "") {
            $('#famnameCheck').show();
        } else {
            $('#famnameCheck').hide();
        }

        if (relationship == "") {
            $('#famrelationCheck').show();
        } else {
            $('#famrelationCheck').hide();
        }

        if (relationship == "Other" && other_remark == "") {
            $('#famremarkCheck').show();
        } else {
            $('#famremarkCheck').hide();
        }

        if (relationship == "Other" && other_address == "") {
            $('#famaddressCheck').show();
        } else {
            $('#famaddressCheck').hide();
        }

        if (relation_age == "") {
            $('#famageCheck').show();
        } else {
            $('#famageCheck').hide();
        }

        if (relation_aadhar == "") {
            $('#famaadharCheck').show();
        } else {
            $('#famaadharCheck').hide();
        }

        if (relation_Mobile == "") {
            $('#fammobileCheck').show();
        } else {
            $('#fammobileCheck').hide();
        }

        if (relation_Occupation == "") {
            $('#famoccCheck').show();
        } else {
            $('#famoccCheck').hide();
        }

        if (relation_Income == "") {
            $('#famincomeCheck').show();
        } else {
            $('#famincomeCheck').hide();
        }
    }

});

function resetFamInfo() {
    let cus_id = $('#cus_id').val();

    $.ajax({
        url: 'verificationFile/verification_fam_reset.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#updatedFamTable").empty();
            $("#updatedFamTable").html(html);

            $("#famname").val('');
            $("#relationship").val('');
            $("#other_remark").val('');
            $("#other_address").val('');
            $("#relation_age").val('');
            $("#relation_aadhar").val('');
            $("#relation_Mobile").val('');
            $("#relation_Occupation").val('');
            $("#relation_Income").val('');
            $("#relation_Blood").val('');
            $("#famID").val('');
        }
    });
}

function resetFamDetails() {

    let cus_id = $('#cus_id').val();

    $.ajax({
        url: 'verificationFile/verification_fam_list.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#famList").empty();
            $("#famList").html(html);
        }
    });
}

$("body").on("click", "#verification_fam_edit", function () {
    let id = $(this).attr('value');

    $.ajax({
        url: 'verificationFile/verification_fam_edit.php',
        type: 'POST',
        data: { "id": id },
        dataType: 'json',
        cache: false,
        success: function (result) {

            $("#famID").val(result['id']);
            $("#famname").val(result['fname']);
            $("#relationship").val(result['relation']);
            $("#other_remark").val(result['remark']);
            $("#other_address").val(result['address']);
            $("#relation_age").val(result['age']);
            $("#relation_aadhar").val(result['aadhar']);
            $("#relation_Mobile").val(result['mobileno']);
            $("#relation_Occupation").val(result['occ']);
            $("#relation_Income").val(result['income']);
            $("#relation_Blood").val(result['bg']);
            if (result['relation'] == 'Other') {
                $('#remark').show();
                $('#address').show();
            }
            else {
                $('#remark').hide();
                $('#address').hide();
            }
            $('#famnameCheck').hide(); $('#famrelationCheck').hide(); $('#famremarkCheck').hide(); $('#famaddressCheck').hide(); $('#famageCheck').hide(); $('#famaadharCheck').hide(); $('#fammobileCheck').hide(); $('#famoccCheck').hide(); $('#famincomeCheck').hide();
        }
    });

});

$("body").on("click", "#verification_fam_delete", function () {
    var isok = confirm("Do you want delete this Family Info?");
    if (isok == false) {
        return false;
    } else {
        var famid = $(this).attr('value');

        $.ajax({
            url: 'verificationFile/verification_fam_delete.php',
            type: 'POST',
            data: { "famid": famid },
            cache: false,
            success: function (response) {
                var delresult = response.includes("Deleted");
                if (delresult) {
                    $('#FamDeleteOk').show();
                    setTimeout(function () {
                        $('#FamDeleteOk').fadeOut('fast');
                    }, 2000);
                    resetFamInfo();
                    resetFamDetails();
                    closeFamModal();
                }
                else {

                    $('#FamDeleteNotOk').show();
                    setTimeout(function () {
                        $('#FamDeleteNotOk').fadeOut('fast');
                    }, 2000);
                    resetFamInfo();
                    resetFamDetails();
                    closeFamModal();

                }
            }
        });
    }
});



//FamilyModal Close
function closeFamModal() {
    resetFamInfo();
    resetFamDetails();
}


///////////////////////// Property Info Starts /////////////////////////////////////

function propertyHolder() {
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/property_holder.php',
        type: 'post',
        data: { "cus_id": cus_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#property_holder").empty();
            $("#property_holder").append("<option value=''>" + 'Select Property Holder' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i];
                $("#property_holder").append("<option value='" + fam_name + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#property_holder option:first-child");
                $("#property_holder").html($("#property_holder option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#property_holder").prepend(firstOption);
            }
        }
    });
}



$(document).on("click", "#propertyInfoBtn", function () {
    let cus_id = $('#cus_id').val();
    let property_type = $("#property_typ").val();
    let property_measurement = $("#property_measurement").val();
    let property_value = $("#property_value").val();
    let property_holder = $("#property_holder").val();
    let propertyID = $("#propertyID").val();

    if (property_type != "" && property_measurement != "" && property_value != "" && property_holder != "" ) {
        $.ajax({
            url: 'updateFile/update_property_submit.php',
            type: 'POST',
            data: { "property_type": property_type, "property_measurement": property_measurement, "property_value": property_value, "property_holder": property_holder, "propertyID": propertyID, "cus_id": cus_id },
            cache: false,
            success: function (response) {

                var insresult = response.includes("Inserted");
                var updresult = response.includes("Updated");
                if (insresult) {
                    $('#prptyInsertOk').show();
                    setTimeout(function () {
                        $('#prptyInsertOk').fadeOut('fast');
                    }, 2000);
                }
                else if (updresult) {
                    $('#prptyUpdateok').show();
                    setTimeout(function () {
                        $('#prptyUpdateok').fadeOut('fast');
                    }, 2000);
                }
                else {
                    $('#prptyNotOk').show();
                    setTimeout(function () {
                        $('#NotOk').fadeOut('fast');
                    }, 2000);
                }

                resetpropertyInfo();
            }
        });
    }
    else {

        if (property_type == "") {
            $('#prtytypeCheck').show();
        } else {
            $('#prtytypeCheck').hide();
        }

        if (property_measurement == "") {
            $('#prtymeasureCheck').show();
        } else {
            $('#prtymeasureCheck').hide();
        }

        if (property_value == "") {
            $('#prtyvalCheck').show();
        } else {
            $('#prtyvalCheck').hide();
        }

        if (property_holder == "") {
            $('#prtyholdCheck').show();
        } else {
            $('#prtyholdCheck').hide();
        }

    }

});

function resetpropertyInfo() {
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/verification_property_reset.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#propertyTable").empty();
            $("#propertyTable").html(html);

            $("#property_typ").val('');
            $("#property_measurement").val('');
            $("#property_value").val('');
            $("#property_holder").val('');
            $("#propertyID").val('');

            $('#prtytypeCheck').hide(); $('#prtymeasureCheck').hide(); $('#prtyvalCheck').hide(); $('#prtyholdCheck').hide();
        }
    });
}


$("body").on("click", "#verification_property_edit", function () {
    let id = $(this).attr('value');

    $.ajax({
        url: 'verificationFile/verification_property_edit.php',
        type: 'POST',
        data: { "id": id },
        dataType: 'json',
        cache: false,
        success: function (result) {

            $("#propertyID").val(result['id']);
            $("#property_typ").val(result['type']);
            $("#property_measurement").val(result['measuree']);
            $("#property_value").val(result['pVal']);
            $("#property_holder").val(result['holder']);

        }
    });

});

$("body").on("click", "#verification_property_delete", function () {
    var isok = confirm("Do you want delete this Property Info?");
    if (isok == false) {
        return false;
    } else {
        var prptyid = $(this).attr('value');

        $.ajax({
            url: 'verificationFile/verification_property_delete.php',
            type: 'POST',
            data: { "prptyid": prptyid },
            cache: false,
            success: function (response) {
                var delresult = response.includes("Deleted");
                if (delresult) {
                    $('#prptyDeleteOk').show();
                    setTimeout(function () {
                        $('#prptyDeleteOk').fadeOut('fast');
                    }, 2000);
                }
                else {

                    $('#prptyDeleteNotOk').show();
                    setTimeout(function () {
                        $('#prptyDeleteNotOk').fadeOut('fast');
                    }, 2000);
                }

                resetpropertyInfo();
            }
        });
    }
});


function resetPropertyinfoList() {
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/verification_property_list.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#propertyList").empty();
            $("#propertyList").html(html);

            $("#property_typ").val('');
            $("#property_measurement").val('');
            $("#property_value").val('');
            $("#property_holder").val('');
            $("#propertyID").val('');

            $('#prtytypeCheck').hide(); $('#prtymeasureCheck').hide(); $('#prtyvalCheck').hide(); $('#prtyholdCheck').hide();
        }
    });
}

////////////////////////////// Bank Info ///////////////////////////////////////////////////////



$(document).on("click", "#bankInfoBtn", function () {

    let cus_id = $('#cus_id').val();
    let bank_name = $("#bank_name").val();
    let branch_name = $("#branch_name").val();
    let account_holder_name = $("#account_holder_name").val();
    let account_number = $("#account_number").val();
    let Ifsc_code = $("#Ifsc_code").val();
    let bankID = $("#bankID").val();

    if (bank_name != "" && branch_name != "" && account_holder_name != "" && account_number != "" && Ifsc_code != "" && cus_id != "") {
        $.ajax({
            url: 'updateFile/update_bank_submit.php',
            type: 'POST',
            data: { "bank_name": bank_name, "branch_name": branch_name, "account_holder_name": account_holder_name, "account_number": account_number, "Ifsc_code": Ifsc_code, "bankID": bankID, "cus_id": cus_id },
            cache: false,
            success: function (response) {

                var insresult = response.includes("Inserted");
                var updresult = response.includes("Updated");
                if (insresult) {
                    $('#bankInsertOk').show();
                    setTimeout(function () {
                        $('#bankInsertOk').fadeOut('fast');
                    }, 2000);
                }
                else if (updresult) {
                    $('#bankUpdateok').show();
                    setTimeout(function () {
                        $('#bankUpdateok').fadeOut('fast');
                    }, 2000);
                }
                else {
                    $('#bankNotOk').show();
                    setTimeout(function () {
                        $('#bankNotOk').fadeOut('fast');
                    }, 2000);
                }

                resetbankInfo();
            }
        });

        $('#bankNameCheck').hide(); $('#branchCheck').hide(); $('#accholdCheck').hide(); $('#accnoCheck').hide(); $('#ifscCheck').hide();
    }
    else {

        if (bank_name == "") {
            $('#bankNameCheck').show();
        } else {
            $('#bankNameCheck').hide();
        }

        if (branch_name == "") {
            $('#branchCheck').show();
        } else {
            $('#branchCheck').hide();
        }

        if (account_holder_name == "") {
            $('#accholdCheck').show();
        } else {
            $('#accholdCheck').hide();
        }

        if (account_number == "") {
            $('#accnoCheck').show();
        } else {
            $('#accnoCheck').hide();
        }
        if (Ifsc_code == "") {
            $('#ifscCheck').show();
        } else {
            $('#ifscCheck').hide();
        }

    }

});


function resetbankInfo() {
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/verification_bank_reset.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#bankTable").empty();
            $("#bankTable").html(html);

            $("#bank_name").val('');
            $("#branch_name").val('');
            $("#account_holder_name").val('');
            $("#account_number").val('');
            $("#Ifsc_code").val('');
            $("#bankID").val('');

        }
    });
}


$("body").on("click", "#verification_bank_edit", function () {
    let id = $(this).attr('value');

    $.ajax({
        url: 'verificationFile/verification_bank_edit.php',
        type: 'POST',
        data: { "id": id },
        dataType: 'json',
        cache: false,
        success: function (result) {

            $("#bankID").val(result['id']);
            $("#bank_name").val(result['bankName']);
            $("#branch_name").val(result['branch']);
            $("#account_holder_name").val(result['accHolderName']);
            $("#account_number").val(result['acc_no']);
            $("#Ifsc_code").val(result['ifsc']);

        }
    });

});


$("body").on("click", "#verification_bank_delete", function () {
    var isok = confirm("Do you want delete this Bank Info?");
    if (isok == false) {
        return false;
    } else {
        var bankid = $(this).attr('value');

        $.ajax({
            url: 'verificationFile/verification_bank_delete.php',
            type: 'POST',
            data: { "bankid": bankid },
            cache: false,
            success: function (response) {
                var delresult = response.includes("Deleted");
                if (delresult) {
                    $('#bankDeleteOk').show();
                    setTimeout(function () {
                        $('#bankDeleteOk').fadeOut('fast');
                    }, 2000);
                }
                else {

                    $('#bankDeleteNotOk').show();
                    setTimeout(function () {
                        $('#bankDeleteNotOk').fadeOut('fast');
                    }, 2000);
                }

                resetbankInfo();
            }
        });
    }
});

function resetbankinfoList() {
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/verification_bank_list.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#bankResetTable").empty();
            $("#bankResetTable").html(html);
        }
    });
}

////////////////////////// KYC Info ////////////////////////////////////////////////



$(document).on("click", "#kycInfoBtn", function () {

    let req_id = $('#req_id').val();
    let proofof = $("#proofof").val();
    let proof_type = $("#proof_type").val();
    let proof_number = $("#proof_number").val();
    let kyc_upload = $("#kyc_upload").val();
    let kycID = $("#kycID").val();
    let upload = $("#upload")[0];
    let file = upload.files[0];


    let formdata = new FormData();
    formdata.append('upload', file)
    formdata.append('proofof', proofof)
    formdata.append('proof_type', proof_type)
    formdata.append('proof_number', proof_number)
    formdata.append('kycID', kycID)
    formdata.append('kyc_upload', kyc_upload)
    formdata.append('reqId', req_id)

    if (proofof != "" && proof_type != "" && proof_number != "" && file != undefined && req_id != "") {
        $.ajax({
            url: 'verificationFile/verification_kyc_submit.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {

                var insresult = response.includes("Inserted");
                var updresult = response.includes("Updated");
                if (insresult) {
                    $('#kycInsertOk').show();
                    setTimeout(function () {
                        $('#kycInsertOk').fadeOut('fast');
                    }, 2000);
                }
                else if (updresult) {
                    $('#kycUpdateok').show();
                    setTimeout(function () {
                        $('#kycUpdateok').fadeOut('fast');
                    }, 2000);
                }
                else {
                    $('#kycNotOk').show();
                    setTimeout(function () {
                        $('#bankNotOk').fadeOut('fast');
                    }, 2000);
                }

                resetkycInfo();
            }
        });

        $('#proofCheck').hide(); $('#proofTypeCheck').hide(); $('#proofnoCheck').hide(); $('#proofUploadCheck').hide();

    }
    else {

        if (proofof == "") {
            $('#proofCheck').show();
        } else {
            $('#proofCheck').hide();
        }

        if (proof_type == "") {
            $('#proofTypeCheck').show();
        } else {
            $('#proofTypeCheck').hide();
        }

        if (proof_number == "") {
            $('#proofnoCheck').show();
        } else {
            $('#proofnoCheck').hide();
        }

        if (file == undefined && kycID == "") {
            $('#proofUploadCheck').show();
        } else {
            $('#proofUploadCheck').hide();
        }

    }

});

function resetkycInfo() {
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/verification_kyc_reset.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#kycTable").empty();
            $("#kycTable").html(html);

            $("#proofof").val('');
            $("#proof_type").val('');
            $("#proof_number").val('');
            $("#upload").val('');
            $("#kycID").val('');

            $('#proofCheck').hide(); $('#proofTypeCheck').hide(); $('#proofnoCheck').hide(); $('#proofUploadCheck').hide();
        }
    });
}


$("body").on("click", "#verification_kyc_edit", function () {
    let id = $(this).attr('value');

    $.ajax({
        url: 'verificationFile/verification_kyc_edit.php',
        type: 'POST',
        data: { "id": id },
        dataType: 'json',
        cache: false,
        success: function (result) {

            $("#kycID").val(result['id']);
            $("#proofof").val(result['proofOf']);
            $("#proof_type").val(result['proofType']);
            $("#proof_number").val(result['proofNo']);
            $("#kyc_upload").val(result['upload']);

            $('#proofCheck').hide(); $('#proofTypeCheck').hide(); $('#proofnoCheck').hide(); $('#proofUploadCheck').hide();
        }
    });

});


$("body").on("click", "#verification_kyc_delete", function () {
    var isok = confirm("Do you want delete this KYC Info?");
    if (isok == false) {
        return false;
    } else {
        var kycid = $(this).attr('value');

        $.ajax({
            url: 'verificationFile/verification_kyc_delete.php',
            type: 'POST',
            data: { "kycid": kycid },
            cache: false,
            success: function (response) {
                var delresult = response.includes("Deleted");
                if (delresult) {
                    $('#kycDeleteOk').show();
                    setTimeout(function () {
                        $('#kycDeleteOk').fadeOut('fast');
                    }, 2000);
                }
                else {

                    $('#kycDeleteNotOk').show();
                    setTimeout(function () {
                        $('#kycDeleteNotOk').fadeOut('fast');
                    }, 2000);
                }

                resetkycInfo();
            }
        });
    }
});

function resetkycinfoList() {
    let cus_id = $('#cus_id').val();

    $.ajax({
        url: 'verificationFile/verification_kyc_list.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#kycListTable").empty();
            $("#kycListTable").html(html);

            resetkycInfo();
        }
    });
}

$('#proofof').change(function () {
    let req_id = $('#req_id').val();
    let proof = $('#proofof').val();

    $.ajax({
        url: 'verificationFile/verification_proof_type.php',
        type: 'POST',
        data: { "reqId": req_id, "proof": proof },
        dataType: 'json',
        cache: false,
        success: function (response) {


            $('#proof_type option').prop('disabled', false);

            $.each(response, function (index, value) {
                $('#proof_type option[value="' + value + '"]').prop('disabled', true);
            });

        }
    });

})


//get district dropdown
function getDistrictDropdown(StateSelected) {

    var optionsList;
    
    {
        var TamilNadu = ["Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kancheepuram", "Kanniyakumari", "Karur", "Madurai", "Nagapattinam",
            "Namakkal", "Nilgiris", "Perambalur", "Pudukottai", "Ramanathapuram", "Salem", "Sivagangai", "Thanjavur", "Theni", "Thiruvallur", "Tiruvannamalai", "Thiruvarur",
            "Thoothukudi", "Tiruchirappalli", "Thirunelveli", "Vellore", "Viluppuram", "Virudhunagar", "Ariyalur", "Krishnagiri", "Tiruppur", "Chengalpattu", "Kallakurichi",
            "Ranipet", "Tenkasi", "Tirupathur", "Mayiladuthurai"];
        var Puducherry = ["Puducherry"];
    }//District list
    switch (StateSelected) {
        case "TamilNadu":
            optionsList = TamilNadu;
            break;
        case "Puducherry":
            optionsList = Puducherry;
            break;
        case "SelectState":
            optionsList = ["Select District"];
            break;
    }

    return optionsList;
}

function districtNameList(optionsList){ // To List the District
    var htmlString = "<option value='Select District'>Select District</option>";
    var district_upd = $('#district_upd').val();
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (district_upd != undefined && district_upd != '' && district_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#district").html(htmlString);
    $("#district1").val(district_upd);

    {//To Order Alphabetically
        var firstOption = $("#district option:first-child");
        $("#district").html($("#district option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#district").prepend(firstOption);
    }
}

function conformDistrictNameList(optionsList){ // To List the Confirm Area District
    var htmlString = "<option value='Select District'>Select District</option>";
    var district_upd = $('#area_district_upd').val();
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (district_upd != undefined && district_upd != '' && district_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#area_district").html(htmlString);
    $("#area_district1").val(district_upd);

    {//To Order Alphabetically
        var firstOption = $("#area_district option:first-child");
        $("#area_district").html($("#area_district option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#area_district").prepend(firstOption);
    }
}

//get Taluk Dropdown
function getTalukDropdown(DistSelected) {

    var optionsList;
    {
        var Chennai = ["Alandur", "Ambattur", "Aminjikarai", "Ayanavaram", "Egmore", "Guindy", "Madhavaram", "Madhuravoyal", "Mambalam", "Mylapore", "Perambur", "Purasavakkam", "Sholinganallur", "Thiruvottriyur", "Tondiarpet", "Velacherry"];
        var Coimbatore = ["Aanaimalai", "Annur", "Coimbatore(North)", "Coimbatore(South)", "Kinathukadavu", "Madukarai", "Mettupalayam", "Perur", "Pollachi", "Sulur", "Valparai"];
        var Cuddalore = ["Cuddalore", "Bhuvanagiri", "Chidambaram", "Kattumannarkoil", "Kurinjipadi", "Panruti", "Srimushnam", "Thittakudi", "Veppur", "Virudhachalam"];
        var Dharmapuri = ["Dharmapuri", "Harur", "Karimangalam", "Nallampalli", "Palacode", "Pappireddipatti", "Pennagaram"];
        var Dindigul = ["Atthur", "Dindigul (East)", "Dindigul (West)", "Guziliyamparai", "Kodaikanal", "Natham", "Nilakottai", "Oddanchatram", "Palani", "Vedasandur"];
        var Erode = ["Erode", "Anthiyur", "Bhavani", "Gobichettipalayam", "Kodumudi", "Modakurichi", "Nambiyur", "Perundurai", "Sathiyamangalam", "Thalavadi"];
        var Kancheepuram = ["Kancheepuram", "Kundrathur", "Sriperumbudur", "Uthiramerur", "Walajabad"];
        var Kanniyakumari = ["Agasteeswaram", "Kalkulam", "Killiyur", "Thiruvatar", "Thovalai", "Vilavankodu"];
        var Karur = ["Karur", "Aravakurichi", "Kadavur", "Krishnarayapuram", "Kulithalai", "Manmangalam", "Pugalur"];
        var Madurai = ["Kallikudi", "Madurai (East)", "Madurai (North)", "Madurai (South)", "Madurai (West)", "Melur", "Peraiyur", "Thirumangalam", "Thiruparankundram", "Usilampatti", "Vadipatti"];
        var Nagapattinam = ["Nagapattinam", "Kilvelur", "Thirukkuvalai", "Vedaranyam"];
        var Namakkal = ["Namakkal", "Kholli Hills", "Kumarapalayam", "Mohanoor", "Paramathi Velur", "Rasipuram", "Senthamangalam", "Tiruchengode"];
        var Nilgiris = ["Udagamandalam", "Coonoor", "Gudalur", "Kothagiri", "Kundah", "Pandalur"];
        var Perambalur = ["Perambalur", "Alathur", "Kunnam", "Veppanthattai"];
        var Pudukottai = ["Pudukottai", "Alangudi", "Aranthangi", "Avudiyarkoil", "Gandarvakottai", "Iluppur", "Karambakudi", "Kulathur", "Manamelkudi", "Ponnamaravathi", "Thirumayam", "Viralimalai"];
        var Ramanathapuram = ["Ramanathapuram", "Kadaladi", "Kamuthi", "Kezhakarai", "Mudukulathur", "Paramakudi", "Rajasingamangalam", "Rameswaram", "Tiruvadanai"];
        var Salem = ["Salem", "Attur", "Edapadi", "Gangavalli", "Kadaiyampatti", "Mettur", "Omalur", "Pethanayakanpalayam", "Salem South", "Salem West", "Sankari", "Vazhapadi", "Yercaud"];
        var Sivagangai = ["Sivagangai", "Devakottai", "Ilayankudi", "Kalaiyarkovil", "Karaikudi", "Manamadurai", "Singampunari", "Thirupuvanam", "Tirupathur"];
        var Thanjavur = ["Thanjavur", "Boothalur", "Kumbakonam", "Orathanadu", "Papanasam", "Pattukottai", "Peravurani", "Thiruvaiyaru", "Thiruvidaimaruthur"];
        var Theni = ["Theni", "Aandipatti", "Bodinayakanur", "Periyakulam", "Uthamapalayam"];
        var Thiruvallur = ["Thiruvallur", "Avadi", "Gummidipoondi", "Pallipattu", "Ponneri", "Poonamallee", "R.K. Pet", "Tiruthani", "Uthukottai"];
        var Tiruvannamalai = ["Thiruvannamalai", "Arni", "Chengam", "Chetpet", "Cheyyar", "Jamunamarathur", "Kalasapakkam", "Kilpennathur", "Polur", "Thandramet", "Vandavasi", "Vembakkam"];
        var Thiruvarur = ["Thiruvarur", "Kodavasal", "Koothanallur", "Mannargudi", "Nannilam", "Needamangalam", "Thiruthuraipoondi", "Valangaiman"];
        var Thoothukudi = ["Thoothukudi", "Eral", "Ettayapuram", "Kayathar", "Kovilpatti", "Ottapidaram", "Sattankulam", "Srivaikundam", "Tiruchendur", "Vilathikulam"];
        var Tiruchirappalli = ["Lalgudi", "Manachanallur", "Manapparai", "Marungapuri", "Musiri", "Srirangam", "Thottiam", "Thuraiyur", "Tiruchirapalli (West)", "Tiruchirappalli (East)", "Tiruverumbur"];
        var Thirunelveli = ["Tirunelveli", "Ambasamudram", "Cheranmahadevi", "Manur", "Nanguneri", "Palayamkottai", "Radhapuram", "Thisayanvilai"];
        var Vellore = ["Vellore", "Aanikattu", "Gudiyatham", "K V Kuppam", "Katpadi", "Pernambut"];
        var Viluppuram = ["Villupuram", "Gingee", "Kandachipuram", "Marakanam", "Melmalaiyanur", "Thiruvennainallur", "Tindivanam", "Vanur", "Vikravandi"];
        var Virudhunagar = ["Virudhunagar", "Aruppukottai", "Kariyapatti", "Rajapalayam", "Sathur", "Sivakasi", "Srivilliputhur", "Tiruchuli", "Vembakottai", "Watrap"];
        var Ariyalur = ["Ariyalur", "Andimadam", "Sendurai", "Udaiyarpalayam"];
        var Krishnagiri = ["Krishnagiri", "Anjetty", "Bargur", "Hosur", "Pochampalli", "Sulagiri", "Thenkanikottai", "Uthangarai"];
        var Tiruppur = ["Avinashi", "Dharapuram", "Kangeyam", "Madathukkulam", "Oothukuli", "Palladam", "Tiruppur (North)", "Tiruppur (South)", "Udumalaipettai"];
        var Chengalpattu = ["Chengalpattu", "Cheyyur", "Maduranthakam", "Pallavaram", "Tambaram", "Thirukalukundram", "Tiruporur", "Vandalur"];
        var Kallakurichi = ["Kallakurichi", "Chinnaselam", "Kalvarayan Hills", "Sankarapuram", "Tirukoilur", "Ulundurpet"];
        var Ranipet = ["Arakkonam", "Arcot", "Kalavai", "Nemili", "Sholingur", "Walajah"];
        var Tenkasi = ["Tenkasi", "Alangulam", "Kadayanallur", "Sankarankovil", "Shenkottai", "Sivagiri", "Thiruvengadam", "Veerakeralampudur"];
        var Tirupathur = ["Tirupathur", "Ambur", "Natrampalli", "Vaniyambadi"];
        var Mayiladuthurai = ["Mayiladuthurai", "Kuthalam", "Sirkali", "Tharangambadi"];
        var Puducherry = ["Puducherry", "Oulgaret", "Villianur", "Bahour", "Karaikal", "Thirunallar", "Mahe", "Yanam"];

    }//taluk list
    switch (DistSelected) {
        case "Ariyalur":
            optionsList = Ariyalur;
            break;
        case "Chengalpattu":
            optionsList = Chengalpattu;
            break;
        case "Chennai":
            optionsList = Chennai;
            break;
        case "Coimbatore":
            optionsList = Coimbatore;
            break;
        case "Dharmapuri":
            optionsList = Dharmapuri;
            break;
        case "Erode":
            optionsList = Erode;
            break;
        case "Cuddalore":
            optionsList = Cuddalore;
            break;
        case "Dindigul":
            optionsList = Dindigul;
            break;
        case "Kallakurichi":
            optionsList = Kallakurichi;
            break;
        case "Kanniyakumari":
            optionsList = Kanniyakumari;
            break;
        case "Krishnagiri":
            optionsList = Krishnagiri;
            break;
        case "Nagapattinam":
            optionsList = Nagapattinam;
            break;
        case "Perambalur":
            optionsList = Perambalur;
            break;
        case "Ramanathapuram":
            optionsList = Ramanathapuram;
            break;
        case "Salem":
            optionsList = Salem;
            break;
        case "Tenkasi":
            optionsList = Tenkasi;
            break;
        case "Theni":
            optionsList = Theni;
            break;
        case "Thirunelveli":
            optionsList = Thirunelveli;
            break;
        case "Thiruvarur":
            optionsList = Thiruvarur;
            break;
        case "Tirupathur":
            optionsList = Tirupathur;
            break;
        case "Tiruvannamalai":
            optionsList = Tiruvannamalai;
            break;
        case "Vellore":
            optionsList = Vellore;
            break;
        case "Virudhunagar":
            optionsList = Virudhunagar;
            break;
        case "Kancheepuram":
            optionsList = Kancheepuram;
            break;
        case "Karur":
            optionsList = Karur;
            break;
        case "Madurai":
            optionsList = Madurai;
            break;
        case "Namakkal":
            optionsList = Namakkal;
            break;
        case "Pudukottai":
            optionsList = Pudukottai;
            break;
        case "Ranipet":
            optionsList = Ranipet;
            break;
        case "Sivagangai":
            optionsList = Sivagangai;
            break;
        case "Thanjavur":
            optionsList = Thanjavur;
            break;
        case "Nilgiris":
            optionsList = Nilgiris;
            break;
        case "Thiruvallur":
            optionsList = Thiruvallur;
            break;
        case "Thoothukudi":
            optionsList = Thoothukudi;
            break;
        case "Tiruppur":
            optionsList = Tiruppur;
            break;
        case "Tiruchirappalli":
            optionsList = Tiruchirappalli;
            break;
        case "Viluppuram":
            optionsList = Viluppuram;
            break;
        case "Mayiladuthurai":
            optionsList = Mayiladuthurai;
            break;
        case "Puducherry":
            optionsList = Puducherry;
            break;
        case "Select District":
            optionsList = ["Select Taluk"];
            break;
    }

    return optionsList;
}

function talukNameList(optionsList){ //To show Taluk list.
    var taluk_upd = $('#taluk_upd').val();
    var htmlString = "<option value='Select Taluk'>Select Taluk</option>";
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (taluk_upd != undefined && taluk_upd != '' && taluk_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#taluk").html(htmlString);
    $("#taluk1").val(taluk_upd);

    {//To Order Alphabetically
        var firstOption = $("#taluk option:first-child");
        $("#taluk").html($("#taluk option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#taluk").prepend(firstOption);
    }
}

function conformtalukNameList(optionsList){ //To show Taluk list.
    var taluk_upd = $('#area_taluk_upd').val();
    var htmlString = "<option value='Select Taluk'>Select Taluk</option>";
    for (var i = 0; i < optionsList.length; i++) {
        var selected = '';
        if (taluk_upd != undefined && taluk_upd != '' && taluk_upd == optionsList[i]) { selected = "selected"; }
        htmlString = htmlString + "<option value='" + optionsList[i] + "' " + selected + " >" + optionsList[i] + "</option>";
    }
    $("#area_taluk").html(htmlString);
    $("#area_taluk1").val(taluk_upd);

    {//To Order Alphabetically
        var firstOption = $("#area_taluk option:first-child");
        $("#area_taluk").html($("#area_taluk option:not(:first-child)").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
        }));
        $("#area_taluk").prepend(firstOption);
    }
}

//Get Taluk Based Area
function getTalukBasedArea(talukselected,area_upd,area) {

    $.ajax({
        url: 'requestFile/ajaxGetEnabledAreaName.php',
        type: 'post',
        data: { 'talukselected': talukselected },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $(area).empty();
            $(area).append("<option value=''>" + 'Select Area' + "</option>");
            for (var i = 0; i < len; i++) {
                var area_id = response[i]['area_id'];
                var area_name = response[i]['area_name'];
                var selected = '';
                if (area_upd != undefined && area_upd != '' && area_upd == area_id) {
                    selected = 'selected';
                }
                $(area).append("<option value='" + area_id + "' " + selected + ">" + area_name + "</option>");
            }

            {//To Order Alphabetically
                var firstOption = $(area+" option:first-child");
                $(area).html($(area+" option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $(area).prepend(firstOption);
            }
        }
    });
}

//Get Area Based Sub Area
function getAreaBasedSubArea(area,sub_area_upd,sub_area) {
    
    $.ajax({
        url: 'requestFile/ajaxGetEnabledSubArea.php',
        type: 'post',
        data: { 'area': area },
        dataType: 'json',
        success: function (response) {

            $(sub_area).empty();
            $(sub_area).append("<option value='' >Select Sub Area</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (sub_area_upd != undefined && sub_area_upd != '' && sub_area_upd == response[i]['sub_area_id']) {
                    selected = 'selected';
                }
                $(sub_area).append("<option value='" + response[i]['sub_area_id'] + "' " + selected + ">" + response[i]['sub_area_name'] + " </option>");
            }
        }
    });
}

function getGroupandLine(sub_area_id){
    
    $.ajax({
        url: 'verificationFile/getGroupandLine.php',
        data: {'sub_area_id':sub_area_id},
        dataType: 'json',
        type:'post',
        cache: false,
        success: function(response){
            $('#area_group').val(response['group_name']);
            $('#area_line').val(response['line_name']);
        }
    })
}

$('#cus_loan_limit').change(function () { /// Loan Limit will Check the Loan Amount in Request Loan Category./////
    let loanLimit = parseInt($(this).val());
    let loanSubCat = $('#loan_sub_cat').val();

    $.ajax({
        type: 'POST',
        url:'verificationFile/check_loan_limit.php',
        data:{'loan_sub_id': loanSubCat},
        dataType: 'json',
        success: function(response){
            if (loanLimit > parseInt(response)) {
                alert("Kindly Enter Loan Limit Lesser Than Loan Amount " + response);
                $('#cus_loan_limit').val('');
                return false;
            }
        }
    })



})


//Customer Feedback Modal 
$('#feedbacklabelCheck').hide(); $('#feedbackCheck').hide();


$(document).on("click", "#feedbackBtn", function () {

    let cus_id = $('#cus_id').val();
    let feedback_label = $("#feedback_label").val();
    let cus_feedback = $("#cus_feedback").val();
    let feedback_remark = $("#feedback_remark").val();
    let feedbackID = $("#feedbackID").val();


    if (feedback_label != "" && cus_feedback != "" && cus_id != "") {
        $.ajax({
            url: 'updateFile/update_cus_feedback_submit.php',
            type: 'POST',
            data: { "feedback_label": feedback_label, "cus_feedback": cus_feedback,"feedback_remark":feedback_remark,"feedbackID": feedbackID,  "cus_id": cus_id },
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
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/customer_feedback_reset.php',
        type: 'POST',
        data: { "cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#feedbackTable").empty();
            $("#feedbackTable").html(html);

            $("#feedback_label").val('');
            $("#cus_feedback").val('');
            $("#feedbackID").val('');

        }
    });
}

function feedbackList() {
    let cus_id = $('#cus_id').val();
    $.ajax({
        url: 'verificationFile/customer_feedback_list.php',
        type: 'POST',
        data: { "cus_id": cus_id },
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
//Customer Feedback Modal End

////////////////////////////////////////////////Submit Verification //////////////////////////////////////////////////////////////////////////////

$('#submit_verification').click(function () {
    validation();
});

function validation() {
    var cus_id = $('#cus_id').val(); var cus_name = $('#cus_name').val(); var dob = $('#dob').val(); var gender = $('#gender').val(); var bloodGroup = $('#bloodGroup').val(); var state = $('#state').val()
    var district = $('#district1').val(); var taluk = $('#taluk1').val(); var area = $('#area').val(); var sub_area = $('#sub_area').val(); var pic = $('#pic').val(); var mobile1 = $('#mobile1').val();
    var guarentor_name = $('#guarentor_name').val();var guarentor_image = $('#guarentor_image').val(); var guarentorpic = $('#guarentorpic').val(); var area_cnfrm = $('#area_cnfrm').val(); var cus_res_type = $('#cus_res_type').val();
    var cus_res_details = $('#cus_res_details').val(); var cus_res_address = $('#cus_res_address').val(); var cus_res_native = $('#cus_res_native').val();
    var cus_occ_type = $('#cus_occ_type').val(); var cus_occ_detail = $('#cus_occ_detail').val(); var cus_occ_income = $('#cus_occ_income').val(); var cus_occ_address = $('#cus_occ_address').val(); var cus_how_know = $('#cus_how_know').val(); var cus_monthly_income = $('#cus_monthly_income').val(); var cus_other_income = $('#cus_other_income').val(); var cus_support_income = $('#cus_support_income').val(); var cus_Commitment = $('#cus_Commitment').val(); var cus_monDue_capacity = $('#cus_monDue_capacity').val(); var cus_loan_limit = $('#cus_loan_limit').val();  var about_cus = $('#about_cus').val();
    var req_id = $('#req_id').val();

    if (cus_id == '') {
        event.preventDefault();
        $('#cusidCheck').show();
    } else {
        $('#cusidCheck').hide();
    }
    if (cus_name == '') {
        event.preventDefault();
        $('#cusnameCheck').show();
    } else {
        $('#cusnameCheck').hide();
    }
    if (dob == '') {
        event.preventDefault();
        $('#dobCheck').show();
    } else {
        $('#dobCheck').hide();
    }
    if (gender == '') {
        event.preventDefault();
        $('#genderCheck').show();
    } else {
        $('#genderCheck').hide();
    }
    if (mobile1 == '') {
        event.preventDefault();
        $('#mobile1Check').show();
    } else {
        $('#mobile1Check').hide();
    }
    if (guarentor_name == '') {
        event.preventDefault();
        $('#guarentor_nameCheck').show();
    } else {
        $('#guarentor_nameCheck').hide();
    }
    if(guarentor_image == ''){
        if (guarentorpic == '') {
            event.preventDefault();
            $('#guarentorpicCheck').show();
        } else {
            $('#guarentorpicCheck').hide();
        }
    }
    if (area_cnfrm == '0') {
        $('#areacnfrmCheck').hide();
        if (cus_res_type == '' || cus_res_details == '' || cus_res_address == '' || cus_res_native == '') {
            event.preventDefault();
            $('#occ_infoCheck').hide();
            $('#res_infoCheck').show();
        } else {
            $('#occ_infoCheck').hide();
            $('#res_infoCheck').hide();
        }
    } else if (area_cnfrm == '1') {
        $('#areacnfrmCheck').hide();
        if (cus_occ_type == '' || cus_occ_detail == '' || cus_occ_income == '' || cus_occ_address == '') {
            event.preventDefault();
            $('#res_infoCheck').hide();
            $('#occ_infoCheck').show();
        } else {
            $('#res_infoCheck').hide();
            $('#occ_infoCheck').hide();
        }
    } else {
        event.preventDefault();
        $('#areacnfrmCheck').show();
    }
    if (state == 'SelectState') {
        event.preventDefault();
        $('#stateCheck').show();
    } else {
        $('#stateCheck').hide();
    }
    if (district == '') {
        event.preventDefault();
        $('#districtCheck').show();
    } else {
        $('#districtCheck').hide();
    }
    if (taluk == '') {
        event.preventDefault();
        $('#talukCheck').show();
    } else {
        $('#talukCheck').hide();
    }
    if (area == '') {
        event.preventDefault();
        $('#areaCheck').show();
    } else {
        $('#areaCheck').hide();
    }
    if (sub_area == '') {
        event.preventDefault();
        $('#subareaCheck').show();
    } else {
        $('#subareaCheck').hide();
    }
    if (cus_how_know == '') {
        event.preventDefault();
        $('#howToKnowCheck').show();
    } else {
        $('#howToKnowCheck').hide();
    }
    if (cus_monthly_income == '') {
        event.preventDefault();
        $('#monthlyIncomeCheck').show();
    } else {
        $('#monthlyIncomeCheck').hide();
    }
    if (cus_other_income == '') {
        event.preventDefault();
        $('#otherIncomeCheck').show();
    } else {
        $('#otherIncomeCheck').hide();
    }
    if (cus_support_income == '') {
        event.preventDefault();
        $('#supportIncomeCheck').show();
    } else {
        $('#supportIncomeCheck').hide();
    }
    if (cus_Commitment == '') {
        event.preventDefault();
        $('#commitmentCheck').show();
    } else {
        $('#commitmentCheck').hide();
    }
    if (cus_monDue_capacity == '') {
        event.preventDefault();
        $('#monthlyDueCapacityCheck').show();
    } else {
        $('#monthlyDueCapacityCheck').hide();
    }
    if (cus_loan_limit == '') {
        event.preventDefault();
        $('#loanLimitCheck').show();
    } else {
        $('#loanLimitCheck').hide();
    }
    if (about_cus == '') {
        event.preventDefault();
        $('#aboutcusCheck').show();
    } else {
        $('#aboutcusCheck').hide();
    }

    if (Communitcation_to_cus == '') {
        event.preventDefault();
        $('#communicationCheck').show();
    } else {
        $('#communicationCheck').hide();
    }
    if (verification_person.length == 0 ) {
        event.preventDefault();
        $('#verificationPersonCheck').show();
    } else {
        $('#verificationPersonCheck').hide();
    }
    if (verification_location == '') {
        event.preventDefault();
        $('#verificationLocCheck').show();
    } else {
        $('#verificationLocCheck').hide();
    }

    $.ajax({
        url: 'verificationFile/validateModals.php',
        data: { 'req_id': req_id, 'table': 'verification_family_info' },
        type: 'post',
        cache: false,
        success: function (response) {
            if (response == "0") {
                event.preventDefault();
                $('#family_infoCheck').show();
            } else if (response == "1") {
                $('#family_infoCheck').hide();
            }
        }
    })
    $.ajax({
        url: 'verificationFile/validateModals.php',
        data: { 'req_id': req_id, 'table': 'verification_kyc_info' },
        type: 'post',
        cache: false,
        success: function (response) {
            if (response == "0") {
                event.preventDefault();
                $('#kyc_infoCheck').show();
            } else if (response == "1") {
                $('#kyc_infoCheck').hide();
            }
        }
    })

}

$('#Communitcation_to_cus').change(function () {
    let com = $(this).val();

    if (com == '0') {
        $('#verifyaudio').show();
    } else {
        $('#verifyaudio').hide();
    }
})

//////////////////////////////////////////////////// Documentation  Start////////////////////////////////////////


function getDocumentHistory(){
    let cus_id = $('#cus_id_load').val();
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
            // if(response.DESCRIPTION != null ){//check json response is not empty

            
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
            // }
        }
    }).then(function(){
        var pending_sts = $('#pending_sts').val()
        var od_sts = $('#od_sts').val()
        var due_nil_sts = $('#due_nil_sts').val()
        var closed_sts = $('#closed_sts').val()
        var bal_amt = balAmnt;
        $.ajax({
            //in this file, details gonna fetch by customer ID, Not by req id (Because we need all loans from customer)
            url: 'verificationFile/documentation/getDocumentHistory.php',
            data: {'cus_id':cus_id,'pending_sts':pending_sts,'od_sts':od_sts,'due_nil_sts':due_nil_sts,'closed_sts':closed_sts,'bal_amt':bal_amt,screen:'update'},
            type:'post',
            cache: false,
            success: function(response){
                $('#docHistoryDiv').empty()
                $('#docHistoryDiv').html(response);
            }
        }).then(function(){
            $('.edit-doc').unbind('click');
            $('.edit-doc').click(function(){
                
                $('.dropdown').not($(this).parent()).children().css('border-color','');// to set other dropdown buttons as normal
                $(this).parent().prev().css('border-color','red');// showing selected loan's dropdown button highlighted
                
                $('.edit-document-card').show();
                // $('.documentation-card').hide();

                var req_id = $(this).data('reqid');var cus_id = $(this).data('cusid');var cus_name = $(this).data('cusname')
                getDocumentDetails(req_id,cus_id,cus_name);
                $('#req_id_doc').val(req_id);
            })
        })
    })

}

function getDocumentDetails(req_id,cus_id,cus_name){

    resetSignedDocList(req_id,cus_id);// to reset signed document list non-modal
    resetChequeList(req_id,cus_id);// to reset signed document list non-modal
    resetGoldList(req_id,cus_id);// to reset signed document list non-modal
    resetDocmentList(req_id,cus_id);// to reset signed document list non-modal
    // getFamilyList();//to get family , it may used in mort and endorse processes
    getMortgageInfo(req_id,cus_id); // to get mortgage details
    getEndorsementInfo(req_id,cus_id); // to get mortgage details

    $('#update_mortgage, #update_endorsement').off('click');
    $('#update_mortgage, #update_endorsement').click(function(){
        let id = $(this).attr('id');
        if(MEValidation(id) == true){// if validation are done and returned true

            updateMortEndorse(id,req_id);

        }
        // MEValidation(id);
    })
}

//Signed Doc List non-modal
function resetSignedDocList(req_id,cus_id) {
    
    $.ajax({
        url: 'updateFile/sign_doc_list.php',
        type: 'POST',
        data: { "req_id":req_id,"cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#signDocResetDiv").empty();
            $("#signDocResetDiv").html(html);

            $("#doc_name").val('');
            $("#sign_type").val('');
            $("#signType_relationship").val('');
            $("#doc_Count").val('');
            $("#signedID").val('');
            $("#signdoc_upd").val('');
        }
    }).then(function(){
        $('#signed_table').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        })
    })
}

//Cheque Info List non-modal
function resetChequeList(req_id,cus_id) {
    
    $.ajax({
        url: 'updateFile/cheque_info_upd_list.php',
        type: 'POST',
        data: { "req_id":req_id,"cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#chequeResetDiv").empty();
            $("#chequeResetDiv").html(html);

            $('#chequeColumnDiv').empty();
            
            $("#holder_type").val('');
            $("#holder_name").val('');
            $("#holder_relationship_name").val('');
            $("#cheque_relation").val('');
            $("#chequebank_name").val('');
            $("#cheque_count").val('');
            $("#cheque_upd").val('');
            $("#chequeID").val('');
        }
    }).then(function(){
        $('#cheque_table').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });
    })
}

//Gold Info List non-modal
function resetGoldList(req_id,cus_id) {
    
    $.ajax({
        url: 'updateFile/gold_info_list.php',
        type: 'POST',
        data: { "req_id":req_id,"cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#goldResetDiv").empty();
            $("#goldResetDiv").html(html);

            $("#gold_sts").val('');
            $("#gold_type").val('');
            $("#Purity").val('');
            $("#gold_Count").val('');
            $("#gold_Weight").val('');
            $("#gold_Value").val('');
            $("#goldID").val('');
        }
    }).then(function(){
        $('#gold_table').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
    })
}

//to get Family names
function getFamilyList(){

    let cus_id = $('#cus_id_load').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "cus_id": cus_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#ownername_relationship_name, #Propertyholder_relationship_name").empty();
            $("#ownername_relationship_name, #Propertyholder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len-1; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#ownername_relationship_name, #Propertyholder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }

        }
    });
}

//Document Info List non-modal
function resetDocmentList(req_id,cus_id) {
    
    $.ajax({
        url: 'updateFile/doc_info_upd_list.php',
        type: 'POST',
        data: {"req_id":req_id,"cus_id": cus_id },
        cache: false,
        success: function (html) {
            $("#documentResetDiv").empty();
            $("#documentResetDiv").html(html);

            $("#document_name").val('');
            $("#document_details").val('');
            $("#document_type").val('');
            $("#document_holder").val('');
            $("#docholder_name").val('');
            $("#docholder_relationship_name").val('');
            $("#doc_relation").val('');
            $("#document_info_upd").val('');
        }
    }).then(function(){
        $('#document_table').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
    })
}

//Motrgage info
function getMortgageInfo(req_id,cus_id){
    $.ajax({
        url: 'updateFile/getMortgageInfo.php',
        data: { "req_id":req_id,"cus_id": cus_id },
        type: 'POST',
        dataType: 'json',
        cache: false,
        success: function(response){
            $('#mortgage_process').val(response['mort_process']);
            // $('#mortgage_process').attr('disabled',true)
            if(response['mort_process'] == '0'){
                $('#mortgage_div').show();
                
                $('#Propertyholder_type').val(response['prop_holder_type']);

                if(response['prop_holder_type'] != '2'){
                    
                    $('#Propertyholder_name').show();
                    $('#Propertyholder_name').val(response['prop_holder_name']);
                    $('#Propertyholder_relationship_name').hide();

                }else if(response['prop_holder_type'] == '2'){
                    
                    $('#Propertyholder_relationship_name').show();
                    $('#Propertyholder_relationship_name').val(response['prop_holder_rel']);
                    $('#Propertyholder_name').hide();
                }

                $('#doc_property_relation').val(response['doc_prop_rel']);
                $('#doc_property_pype').val(response['doc_prop_type']);
                $('#doc_property_measurement').val(response['doc_prop_meas']);
                $('#doc_property_location').val(response['doc_prop_loc']);
                $('#doc_property_value').val(response['doc_prop_val']);
                
                $('#mortgage_name').val(response['mort_name']);
                $('#mortgage_dsgn').val(response['mort_des']);
                $('#mortgage_nuumber').val(response['mort_num']);
                $('#reg_office').val(response['reg_office']);
                $('#mortgage_value').val(response['mort_value']);
                $('#mortgage_document').val(response['mort_doc']);
                
                if(response['mort_doc'] == '0'){//show file input button if document already uploaded. so then user also can upload again with updated file
                    $('#mort_doc_upd').show()
                    $('#pendingchk').removeAttr('checked');
                }else{
                    $('#mort_doc_upd').hide()
                    $('#pendingchk').prop('checked',true);
                }

                $('#mortgage_doc_upd').val(response['mort_doc_upd']);//store file name inside hidden input if already uploaded

            }else{
                $('#mortgage_div').hide();
            }
        }
    })
}

//Endorsement info
function getEndorsementInfo(req_id,cus_id){
    $.ajax({
        url: 'updateFile/getEndorsementInfo.php',
        data: { "req_id":req_id,"cus_id": cus_id },
        type: 'POST',
        dataType: 'json',
        cache: false,
        success: function(response){
            $('#endorsement_process').val(response['end_process']);
            
            if(response['end_process'] == '0'){
                $('#end_process_div').show();
                
                $('#owner_type').val(response['owner_type']);//like customer, garentor
                
                if(response['owner_type'] != '2'){
                    
                    $('#owner_name').show();
                    $('#owner_name').val(response['owner_name']);
                    $('#ownername_relationship_name').hide();

                }else if(response['owner_type'] == '2'){
                    
                    $('#ownername_relationship_name').show();
                    $('#ownername_relationship_name').val(response['owner_rel_name']);//fam id
                    $('#owner_name').hide();
                }
                // $('#owner_name').val(response['owner_name']);
                // $('#ownername_relationship_name').val(response['owner_rel_name']);//fam id


                $('#en_relation').val(response['owner_relation']);//like father, brother

                $('#vehicle_type').val(response['vehicle_type']);//new or old
                $('#vehicle_process').val(response['vehicle_process']);
                $('#en_Company').val(response['vehicle_comp']);
                $('#en_Model').val(response['vehicle_mod']);
                $('#vehicle_reg_no').val(response['vehicle_reg_no']);
                
                $('#endorsement_name').val(response['end_name']);
                $('#en_RC').val(response['end_rc']);
                $('#en_Key').val(response['end_key']);

                if(response['end_rc'] == '0'){//show file input button if document already uploaded. so then user also can upload again with updated file
                    $('#end_doc_upd').show()
                    $('#endorsependingchk').removeAttr('checked');
                }else{
                    $('#end_doc_upd').hide()
                    $('#endorsependingchk').prop('checked',true);
                }

                $('#rc_doc_upd').val(response['end_rc_doc_upd']);//store file name inside hidden input if already uploaded

            }else{
                $('#end_process_div').hide();
            }
        }
    })
}

//to update in table of ack documentation
function updateMortEndorse(id,req_id){

    if(id=='update_mortgage'){
        var formdata = $('#mort_form').serializeArray();
        var file_data = $('#mortgage_document_upd').prop('files')[0];
    }else if(id=='update_endorsement'){
        var file_data = $('#RC_document_upd').prop('files')[0];    
        var formdata = $('#end_form').serializeArray();
    }
    // var mortgage_document_upd = $('#mortgage_document_upd')[0].files;
    formdata.push({name:'id',value :id},{name:'req_id', value :req_id});
    
    $.ajax({
        url: 'updateFile/updateMortEndorse.php',
        data: formdata,
        type: 'post',
        cache: false,
        success: function(response){
            if(file_data == undefined){
                if(response.includes('Successfully')){
                    Swal.fire({
                        title: response,
                        icon: 'success',
                        showConfirmButton: true,
                        confirmButtonColor: '#009688'
                    })
                    getDocumentHistory();// to reset the current status of the document history
                }else if(response.includes('Error')){
                    Swal.fire({
                        title: response,
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#009688'
                    });
                }
            }
        }
    }).then(function(){
        
        
        var filetosend = new FormData();                  

        if(id=='update_mortgage'){
            var file_data = $('#mortgage_document_upd').prop('files')[0];    
            filetosend.append('mortgage_document_upd', file_data)
        }else if(id=='update_endorsement'){
            var file_data = $('#RC_document_upd').prop('files')[0];
            filetosend.append('RC_document_upd', file_data)
        }
        filetosend.append('id', id);
        filetosend.append('req_id', req_id);
        if(file_data != undefined ){//if file has been choosen then upload it
            $.ajax({
                url: 'updateFile/updateMortEndorseDocs.php',
                data: filetosend,
                contentType: false,
                processData:false,
                type: 'post',
                cache: false,
                success: function(response){
                    if(response.includes('Successfully')){
                        Swal.fire({
                            title: response,
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688'
                        })
                        getDocumentHistory();// to reset the current status of the document history
                    }else if(response.includes('Error')){
                        Swal.fire({
                            title: response,
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#009688'
                        });
                    }
                }
            })
        }

    })
}

//to validate mortgage and endorsement
function MEValidation(id){
    var response = true;
    if(id == 'update_mortgage'){
        var mortgage_process = $('#mortgage_process').val(); var Propertyholder_type = $('#Propertyholder_type').val();var Propertyholder_name = $('#Propertyholder_name').val();
        var Propertyholder_relationship_name = $('#Propertyholder_relationship_name').val();var doc_property_relation = $('#doc_property_relation').val();
        var doc_property_pype = $('#doc_property_pype').val(); var doc_property_measurement = $('#doc_property_measurement').val(); 
        var doc_property_location = $('#doc_property_location').val(); var doc_property_value = $('#doc_property_value').val();
        var mortgage_name = $('#mortgage_name').val(); var mortgage_dsgn = $('#mortgage_dsgn').val(); var mortgage_nuumber = $('#mortgage_nuumber').val(); 
        var reg_office = $('#reg_office').val(); var mortgage_value = $('#mortgage_value').val(); var mortgage_document = $('#mortgage_document').val();var mortgage_doc_upd = $('#mortgage_document_upd').val();

        if(mortgage_process == ''){
            event.preventDefault();
            $('#mortgageprocessCheck').show();
            response = false;
        }else{

            if(mortgage_process == '0'){// only check if mortgage process yes
                
                validateField(Propertyholder_type, '#propertyholdertypeCheck');

                if(Propertyholder_type != '' && Propertyholder_type == '2'){//check holder type is family
                    validateField(Propertyholder_relationship_name, '#propertyholdernameCheck');
                }else if(Propertyholder_type != '' && Propertyholder_type != '2'){//check holder type is family
                    // validateField(Propertyholder_name, '#propertyholdernameCheck');
                }

                validateField(doc_property_pype, '#docpropertytypeCheck');
                validateField(doc_property_measurement, '#docpropertymeasureCheck');
                validateField(doc_property_location, '#docpropertylocCheck');
                validateField(doc_property_value, '#docpropertyvalueCheck');
                validateField(mortgage_name, '#mortgagenameCheck');
                validateField(mortgage_dsgn, '#mortgagedsgnCheck');
                validateField(mortgage_nuumber, '#mortgagenumCheck');
                validateField(reg_office, '#regofficeCheck');
                validateField(mortgage_value, '#mortgagevalueCheck');
                validateField(mortgage_document, '#mortgagedocCheck');
                if(mortgage_document != '' && mortgage_document == '0'){// check if document is yes
                    validateField(mortgage_doc_upd,'#mortgagedocUpdCheck');//if yes then validate file uploaded or not
                }
            }
            $('#mortgageprocessCheck').hide();
        }
    }else if(id == 'update_endorsement'){
        var endorsement_process = $('#endorsement_process').val(); var owner_type = $('#owner_type').val(); var ownername_relationship_name = $('#ownername_relationship_name').val(); 
        var vehicle_type = $('#vehicle_type').val(); var vehicle_process = $('#vehicle_process').val();var en_Company = $('#en_Company').val(); var en_Model = $('#en_Model').val();
        var endorsement_name = $('#endorsement_name').val(); var en_RC = $('#en_RC').val(); var en_Key = $('#en_Key').val();
        var vehicle_reg_no = $('#vehicle_reg_no').val();var RC_document_upd = $('#RC_document_upd').val();var RC_old_document_upd = $('#rc_doc_upd').val();

        if(endorsement_process == ''){
            event.preventDefault();
            $('#endorsementprocessCheck').show();
            response = false;
        }else{

            if(endorsement_process == '0'){// only check if Endorsement process yes
                validateField(owner_type, '#ownertypeCheck');

                if(owner_type != '' && owner_type != '2'){//check owner type is not family
                    validateField(owner_name, '#ownernameCheck');
                }else if(owner_type != '' && owner_type == '2'){//check owner type is family
                    validateField(ownername_relationship_name, '#ownernameCheck');
                }
                validateField(vehicle_type, '#vehicletypeCheck');
                validateField(vehicle_process, '#vehicleprocessCheck');
                validateField(en_Company, '#enCompanyCheck');
                validateField(en_Model, '#enModelCheck');
                validateField(vehicle_reg_no, '#vehicle_reg_noCheck');
                validateField(endorsement_name, '#endorsementnameCheck');
                validateField(en_Key, '#enKeyCheck');
                validateField(en_RC, '#enRCCheck');
                if(en_RC != '' && en_RC == '0'){// check if rc document is yes
                    validateField(RC_document_upd,'#rcdocUpdCheck');//if yes then validate file uploaded or not
                }
            }

            $('#endorsementprocessCheck').hide();

        }
    }

    function validateField(value, fieldId) {
        if (value === '') {
            response = false;
            event.preventDefault();
            $(fieldId).show();
        } else {
            $(fieldId).hide();
        }
    }
    
    
    return response;
}


// function mortgageHolderName(){
//     let cus_id = $('#cus_id').val();

//     $.ajax({
//         url: 'verificationFile/verificationFam.php',
//         type: 'post',
//         data: { "cus_id": cus_id },
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#Propertyholder_relationship_name").empty();
//             $("#Propertyholder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
//             for (var i = 0; i < len-1; i++) {
//                 var fam_name = response[i]['fam_name'];
//                 var fam_id = response[i]['fam_id'];
//                 $("#Propertyholder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
//             }
//             {//To Order ag_group Alphabetically
//                 var firstOption = $("#Propertyholder_relationship_name option:first-child");
//                 $("#Propertyholder_relationship_name").html($("#Propertyholder_relationship_name option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#Propertyholder_relationship_name").prepend(firstOption);
//             }

//         }
//     });
// }

// function endorseHolderName() {

//     let cus_id = $('#cus_id').val();

//     $.ajax({
//         url: 'verificationFile/verificationFam.php',
//         type: 'post',
//         data: { "cus_id": cus_id },
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#ownername_relationship_name").empty();
//             $("#ownername_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
//             for (var i = 0; i < len-1; i++) {
//                 var fam_name = response[i]['fam_name'];
//                 var fam_id = response[i]['fam_id'];
//                 $("#ownername_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
//             }
//             {//To Order ag_group Alphabetically
//                 var firstOption = $("#ownername_relationship_name option:first-child");
//                 $("#ownername_relationship_name").html($("#ownername_relationship_name option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#ownername_relationship_name").prepend(firstOption);
//             }

//         }
//     });
// }
// function docHolderName(){
//     let cus_id = $('#cus_id').val();

//     $.ajax({
//         url: 'verificationFile/verificationFam.php',
//         type: 'post',
//         data: { "cus_id": cus_id },
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#docholder_relationship_name").empty();
//             $("#docholder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
//             for (var i = 0; i < len; i++) {
//                 var fam_name = response[i]['fam_name'];
//                 var fam_id = response[i]['fam_id'];
//                 $("#docholder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
//             }
//             {//To Order ag_group Alphabetically
//                 var firstOption = $("#docholder_relationship_name option:first-child");
//                 $("#docholder_relationship_name").html($("#docholder_relationship_name option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#docholder_relationship_name").prepend(firstOption);
//             }

//         }
//     });
// }

// $('#docNameCheck').hide(); $('#signTypeCheck').hide(); $('#docCountCheck').hide(); //Signed Doc Validation Hide ///

// function resetsignInfo() {
//     let cus_id = $('#cus_id').val();
//     $.ajax({
//         url: 'updateFile/sign_info_upd_reset.php',
//         type: 'POST',
//         data: { "cus_id": cus_id },
//         cache: false,
//         success: function (html) {
//             $("#signTable").empty();
//             $("#signTable").html(html);

//             $("#doc_name").val('');
//             $("#sign_type").val('');
//             $("#signType_relationship").val('');
//             $("#doc_Count").val('');
//             $("#signedID").val('');
//             $("#signdoc_upd").val('');

//         }
//     });
// }

// // Signed Doc 
// function signTypeRelation() {
//     let cus_id = $('#cus_id').val();
//     $.ajax({
//         url: 'verificationFile/verificationFam.php',
//         type: 'post',
//         data: { "cus_id": cus_id },
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#signType_relationship").empty();
//             $("#signType_relationship").append("<option value=''>" + 'Select Relationship' + "</option>");
//             for (var i = 0; i < len; i++) {
//                 var fam_name = response[i]['fam_name'];
//                 var fam_id = response[i]['fam_id'];
//                 var relationship = response[i]['relationship'];
//                 $("#signType_relationship").append("<option value='" + fam_id + "'>" + fam_name + ' - ' + relationship + "</option>");
//             }
//             {//To Order ag_group Alphabetically
//                 var firstOption = $("#signType_relationship option:first-child");
//                 $("#signType_relationship").html($("#signType_relationship option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#signType_relationship").prepend(firstOption);
//             }

//         }
//     });
// }




// function filesCount() {
//     var cnt = $('#doc_Count').val();
//     var signFile = document.querySelector('#signdoc_upd');

//     if (signFile.files.length <= cnt) {
//         return true;
//     } else {
//         alert('Please select Less than ' + cnt + ' files.')
//         $("#signdoc_upd").val('');
//         return false;
//     }
// }

// ///Cheque Info 
// function resetchequeInfo() {
//     let cus_id = $('#cus_id').val();
//     $.ajax({
//         url: 'updateFile/cheque_info_upd_reset.php',
//         type: 'POST',
//         data: { "cus_id": cus_id },
//         cache: false,
//         success: function (html) {
//             $('#chequeColumnDiv').empty();
//             $("#chequeTable").empty();
//             $("#chequeTable").html(html);

//             $("#holder_type").val('');
//             $("#holder_name").val('');
//             $("#holder_relationship_name").val('');
//             $("#cheque_relation").val('');
//             $("#chequebank_name").val('');
//             $("#cheque_count").val('');
//             $("#cheque_upd").val('');
//             $("#chequeID").val('');

//         }
//     });
// }

// //Cheque Holder Name 
// function chequeHolderName() {
//     let cus_id = $('#cus_id').val();
//     $.ajax({
//         url: 'verificationFile/verificationFam.php',
//         type: 'post',
//         data: { "cus_id": cus_id },
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#holder_relationship_name").empty();
//             $("#holder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
//             for (var i = 0; i < len; i++) {
//                 var fam_name = response[i]['fam_name'];
//                 var fam_id = response[i]['fam_id'];
//                 $("#holder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
//             }
//             {//To Order ag_group Alphabetically
//                 var firstOption = $("#holder_relationship_name option:first-child");
//                 $("#holder_relationship_name").html($("#holder_relationship_name option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#holder_relationship_name").prepend(firstOption);
//             }

//         }
//     });
// }



// function chequefilesCount() {
//     var cnt = $('#cheque_count').val();
//     var chequeFile = document.querySelector('#cheque_upd');

//     if (chequeFile.files.length <= cnt) {
//         return true;
//     } else {
//         alert('Please select Less than ' + cnt + ' files.')
//         $("#cheque_upd").val('');
//         return false;
//     }
// }

// //Cheque No 
// function getChequeColumn(cnt){

//     $.ajax({
//         type: 'post',
//         data: {"count": cnt},
//         url: 'verificationFile/documentation/cheque_info_upd_column.php',
//         success:function(result){
//             $('#chequeColumnDiv').empty();
//             $('#chequeColumnDiv').html(result);

//         }
//     })

// }

// //Gold Info 
// $(document).on("click", "#goldInfoBtn", function () {

//     let cus_id = $('#cus_id').val();
//     let gold_sts = $("#gold_sts").val();
//     let gold_type = $("#gold_type").val();
//     let Purity = $("#Purity").val();
//     let gold_Count = $("#gold_Count").val();
//     let gold_Weight = $("#gold_Weight").val();
//     let gold_Value = $("#gold_Value").val();
//     let goldID = $("#goldID").val();

//     if ( gold_sts != "" && gold_type != "" && Purity != "" && gold_Count != "" && gold_Weight != "" && gold_Value != "" && cus_id != "") {
//         $.ajax({
//             url: 'updateFile/gold_info_submit.php',
//             type: 'POST',
//             data: { "gold_sts": gold_sts,"gold_type": gold_type, "Purity": Purity, "gold_Count": gold_Count, "gold_Weight": gold_Weight, "gold_Value": gold_Value, "goldID": goldID, "cus_id": cus_id },
//             cache: false,
//             success: function (response) {

//                 var insresult = response.includes("Inserted");
//                 var updresult = response.includes("Updated");
//                 if (insresult) {
//                     $('#goldInsertOk').show();
//                     setTimeout(function () {
//                         $('#goldInsertOk').fadeOut('fast');
//                     }, 2000);
//                 }
//                 else if (updresult) {
//                     $('#goldUpdateok').show();
//                     setTimeout(function () {
//                         $('#goldUpdateok').fadeOut('fast');
//                     }, 2000);
//                 }
//                 else {
//                     $('#goldNotOk').show();
//                     setTimeout(function () {
//                         $('#goldNotOk').fadeOut('fast');
//                     }, 2000);
//                 }

//                 resetgoldInfo();
//             }
//         });

        
//     $('#GoldstatusCheck').hide(); $('#GoldtypeCheck').hide(); $('#purityCheck').hide(); $('#goldCountCheck').hide(); $('#goldWeightCheck').hide(); $('#goldValueCheck').hide();
//     }
//     else {

//         if (gold_sts == '') {
//             $('#GoldstatusCheck').show();
//         } else {
//             $('#GoldstatusCheck').hide();
//         }
//         if (gold_type == '') {
//             $('#GoldtypeCheck').show();
//         } else {
//             $('#GoldtypeCheck').hide();
//         }
//         if (Purity == '') {
//             $('#purityCheck').show();
//         } else {
//             $('#purityCheck').hide();
//         }
//         if (gold_Count == '') {
//             $('#goldCountCheck').show();
//         } else {
//             $('#goldCountCheck').hide();
//         }
//         if (gold_Weight == '') {
//             $('#goldWeightCheck').show();
//         } else {
//             $('#goldWeightCheck').hide();
//         }
//         if (gold_Value == '') {
//             $('#goldValueCheck').show();
//         } else {
//             $('#goldValueCheck').hide();
//         }

//     }

// });

// function resetgoldInfo() {
//     let cus_id = $('#cus_id').val();
//     $.ajax({
//         url: 'updateFile/gold_info_reset.php',
//         type: 'POST',
//         data: { "cus_id": cus_id,'pages': 2 },
//         cache: false,
//         success: function (html) {
//             $("#goldTable").empty();
//             $("#goldTable").html(html);

//             $("#gold_sts").val('');
//             $("#gold_type").val('');
//             $("#Purity").val('');
//             $("#gold_Count").val('');
//             $("#gold_Weight").val('');
//             $("#gold_Value").val('');
//             $("#goldID").val('');

//         }
//     });
// }




// // ///////////////////////////  Document Info Modal //////////////////////////////

// $('#documentnameCheck').hide();$('#documentdetailsCheck').hide();$('#documentTypeCheck').hide();$('#docholderCheck').hide();
// //Document info submit button action
// $('#docInfoBtn').click(function(){
//     let cus_id = $("#cus_id").val();
//     let doc_id = $("#doc_info_id").val();
//     let doc_name = $("#document_name").val();
//     let doc_details = $("#document_details").val();
//     let doc_type = $("#document_type").val();
//     let doc_holder = $("#document_holder").val();
//     let holder_name = $("#docholder_name").val();
//     let relation_name = $("#docholder_relationship_name").val();
//     let relation = $("#doc_relation").val();

//     var formdata = new FormData();
//     formdata.append('doc_id',doc_id)
//     formdata.append('doc_name',doc_name)
//     formdata.append('doc_details',doc_details)
//     formdata.append('doc_type',doc_type)
//     formdata.append('doc_holder',doc_holder)
//     formdata.append('holder_name',holder_name)
//     formdata.append('relation_name',relation_name)
//     formdata.append('relation',relation)
//     formdata.append('cus_id',cus_id)

//     var files = $("#document_info_upd")[0].files;     
//     for(var i=0; i<files.length; i++){
//         formdata.append('document_info_upd[]', files[i])
//     }
    
//     if (doc_name !='' && doc_details !='' && doc_type!='' && doc_holder!='' && relation!='') {

//         $.ajax({
//             url:'updateFile/doc_info_submit.php',
//             data: formdata,
//             contentType: false,
//             processData: false,
//             type:'POST',
//             // cache: false,
//             success:function(response){
                
//                 var insresult = response.includes("Inserted");
//                 var updresult = response.includes("Updated");
//                 if (insresult) {
//                     $('#docInsertOk').show();
//                     setTimeout(function () {
//                         $('#docInsertOk').fadeOut('fast');
//                     }, 2000);
//                 }
//                 else if (updresult) {
//                     $('#docUpdateok').show();
//                     setTimeout(function () {
//                         $('#docUpdateok').fadeOut('fast');
//                     }, 2000);
//                 }
//                 else {
//                     $('#docNotOk').show();
//                     setTimeout(function () {
//                         $('#docNotOk').fadeOut('fast');
//                     }, 2000);
//                 }

//                 resetdocInfo();
//             }
//         })
//     }else{
//         $('#documentnameCheck').show();$('#documentdetailsCheck').show();$('#documentTypeCheck').show();$('#docholderCheck').show();
//     }
// })

// $("body").on("click", "#doc_info_edit", function () {console.log('asdf')
//     let id = $(this).attr('value');
//     $.ajax({
//         url: 'verificationFile/documentation/doc_info_edit.php',
//         type: 'POST',
//         data: { "id": id },
//         dataType: 'json',
//         cache: false,
//         beforeSend:function(){
//             docHolderName();
//         },
//         success: function (response) {
            
//             $("#doc_info_id").val(response['doc_id']);
//             $("#document_name").val(response['doc_name']);
//             $("#document_details").val(response['doc_details']);
//             $("#document_type").val(response['doc_type']);
//             $("#document_holder").val(response['doc_holder']);
//             if(response['doc_holder'] == '0' || response['doc_holder'] == '1' ){
//                 $("#docholder_name").show();
//                 $("#docholder_relationship_name").hide();
//                 $("#docholder_name").val(response['holder_name']);
//             }else{
//                 $("#docholder_name").hide();
//                 $("#docholder_relationship_name").show();
//                 $("#docholder_relationship_name").val(response['relation_name']);
//             }
//             $("#doc_relation").val(response['relation']);

//         }
//     });

// });


// $("body").on("click", "#doc_info_delete", function () {
//     var isok = confirm("Do you want delete this Document Info?");
//     if (isok == false) {
//         return false;
//     } else {
//         var id = $(this).attr('value');

//         $.ajax({
//             url: 'verificationFile/documentation/doc_info_delete.php',
//             type: 'POST',
//             data: { "id": id },
//             cache: false,
//             success: function (response) {
//                 var delresult = response.includes("Deleted");
//                 if (delresult) {
//                     $('#docDeleteOk').show();
//                     setTimeout(function () {
//                         $('#docDeleteOk').fadeOut('fast');
//                     }, 2000);
//                 }
//                 else {

//                     $('#docDeleteNotOk').show();
//                     setTimeout(function () {
//                         $('#docDeleteNotOk').fadeOut('fast');
//                     }, 2000);
//                 }

//                 resetdocInfo();
//             }
//         });
//     }
// });
// //Document Info List Modal Table
// function resetdocInfo() {
//     let cus_id = $('#cus_id').val();
//     $.ajax({
//         url: 'updateFile/doc_info_reset.php',
//         type: 'POST',
//         data: { "cus_id": cus_id,'pages': 2 },
//         cache: false,
//         success: function (html) {
//             $("#docModalDiv").empty();
//             $("#docModalDiv").html(html);

//             $("#document_name").val('');
//             $("#document_details").val('');
//             $("#document_type").val('');
//             $("#document_holder").val('');
//             $("#docholder_name").val('');
//             $("#relation_name").val('');
//             $("#doc_relation").val('');
//             $("#document_info_upd").val('');

//         }
//     });
// }

// ///////////////////////////  Document Info Modal END //////////////////////////////

// $('#loanCategoryTableCheck').hide();	
// let loanCategoryTableError = true;
// function validateLoanCategoryTable() {
//     var currentrow = $("#moduleTable tr").last();
//     if (currentrow.find("#cheque_no").val() == '') {
//         //   $('#loanCategoryTableCheck').show();
//         loanCategoryTableError = false;
//         return false;
//     } else {
//         // $('#loanCategoryTableCheck').hide();
//         loanCategoryTableError = true;
//         return true;
//     }
// }

// // add module 
// $(document).on("click", '.add_checqueNo', function () {

//     validateLoanCategoryTable();

//     if (loanCategoryTableError == true) {
//         var appendTxt = "<tr><td><input type='text' tabindex='13' class='chosen-select form-control cheque_no' id='cheque_no' name='cheque_no[]' /></td>" +
//             "<td><button type='button' tabindex='26' id='add_checqueNo' name='add_checqueNo' value='Submit' class='btn btn-primary add_checqueNo'>Add</button></td>" +
//             "<td><span class='deleterow icon-trash-2' tabindex='18'></span></td>" +
//             "</tr>";
//     }
//     else {
//         return false;
//     }

//     $('#moduleTable').find('tbody').append(appendTxt);
// });

// // Delete unwanted Rows
// $(document).on("click", '.deleterow', function () {
//     $(this).parent().parent().remove();
// });





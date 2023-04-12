const personMultiselect = new Choices('#verification_person', {
    removeItemButton: true,
    noChoicesText: null,
    placeholder: true,
    placeholderValue: 'Select Verification Person',
    });

$(document).ready(function () {

    $('input[data-type="adhaar-number"]').keyup(function () { /// AAdhar Validation 
        var value = $(this).val();
        value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(" ");
        $(this).val(value);
    });

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

    $('#category').on('change', function () {

        let category = $('#category').val();

        if (category == 0) {
            $('#nameCheck').show();
            $('#aadharNo').hide();
            $('#mobileNo').hide();

            famNameList(); /// To show family name for Data Check.

        } else if (category == 1) {
            $('#aadharNo').show();
            $('#nameCheck').hide();
            $('#mobileNo').hide();

            aadharList()//// To show Aadhar No for Data Checking.

        } else if (category == 2) {
            $('#mobileNo').show();
            $('#nameCheck').hide();
            $('#aadharNo').hide();

            mobileList(); //// To show Mobile No for Data Checking.

        } else {
            $('#nameCheck').hide();
            $('#aadharNo').hide();
            $('#mobileNo').hide();
        }

    })

    function famNameList() {  // To show family name for Data Check.
        let req_id = $('#req_id').val();

        $.ajax({
            url: 'verificationFile/verification_datacheck_name.php',
            type: 'POST',
            data: { "reqId": req_id },
            dataType: 'json',
            cache: false,
            success: function (response) {
                $("#check_name").empty();
                $('#check_name').append("<option value=''> Select Name </option>")
                let len = response.length;
                for (let i = 0; i < len; i++) {
                    let name = response[i]['fam_name'];
                    $('#check_name').append("<option value='" + name + "'> " + name + " </option>")
                }

            }
        });
    }

    function mobileList() { // To show Mobile No for Data Checking.
        let req_id = $('#req_id').val();

        $.ajax({
            url: 'verificationFile/verification_datacheck_name.php',
            type: 'POST',
            data: { "reqId": req_id },
            dataType: 'json',
            cache: false,
            success: function (response) {
                $("#check_mobileno").empty();
                $('#check_mobileno').append("<option value=''> Select Mobile Number </option>")
                let len = response.length;
                for (let i = 0; i < len; i++) {
                    let no = response[i]['mobile'];
                    $('#check_mobileno').append("<option value='" + no + "'> " + no + " </option>")
                }

            }
        });
    }

 
    function aadharList() {   // To show Aadhar No for Data Checking.
        let req_id = $('#req_id').val();

        $.ajax({
            url: 'verificationFile/verification_datacheck_name.php',
            type: 'POST',
            data: { "reqId": req_id },
            dataType: 'json',
            cache: false,
            success: function (response) {
                $("#check_aadhar").empty();
                $('#check_aadhar').append("<option value=''> Select Aadhar Number    </option>")
                let len = response.length;
                for (let i = 0; i < len; i++) {
                    let aadhar = response[i]['aadhar'];
                    let fam_name = response[i]['fam_name'];
                    $('#check_aadhar').append("<option value='" + aadhar + "'> " + fam_name + " </option>")
                }

            }
        });
    }


    $('#check_name, #check_aadhar, #check_mobileno').on('change', function () {

        let name = $(this).val();
        let category = $('#category').val();
        let req_id = $('#req_id').val();

        $.ajax({
            url: 'verificationFile/verification_cus_datacheck.php',
            type: 'POST',
            data: { "name": name, "category": category },
            cache: false,
            success: function (html) {
                $("#cus_check").empty();
                $("#cus_check").html(html);
            }
        });

        $.ajax({
            url: 'verificationFile/verification_fam_datacheck.php',
            type: 'POST',
            data: { "name": name, "req_id": req_id, "category": category },
            cache: false,
            success: function (html) {
                $("#fam_check").empty();
                $("#fam_check").html(html);
            }
        });

        $.ajax({
            url: 'verificationFile/verification_group_datacheck.php',
            type: 'POST',
            data: { "name": name, "req_id": req_id, "category": category },
            cache: false,
            success: function (html) {
                $("#group_check").empty();
                $("#group_check").html(html);
            }
        });
        
    })



    $('#pic').change(function () {
        var pic = $('#pic')[0];
        var img = $('#imgshow');
        img.attr('src', URL.createObjectURL(pic.files[0]));
    })

    $('#guarentorpic').change(function () {
        var pic = $('#guarentorpic')[0];
        var img = $('#imgshows');
        img.attr('src', URL.createObjectURL(pic.files[0]));
    })

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


    $("#state").change(function(){
        var StateSelected = $(this).val();
        getDistrictDropdown(StateSelected);
    });

    $('#district').change(function(){
        var DistSelected =  $(this).val();
        $('#district1').val(DistSelected);
        getTalukDropdown(DistSelected);
    });
    
    $('#taluk').change(function(){
        var talukselected = $(this).val();
        $('#taluk1').val(talukselected);
        getTalukBasedArea(talukselected);
    })

    $('#area').change(function(){

        var areaselected = $('#area').val();
        getAreaBasedSubArea(areaselected);
    })

    window.onscroll = function () {
        var navbar = document.getElementById("navbar");
        var stickyHeader = navbar.offsetTop;
        if (window.pageYOffset > 500) {
            // navbar.style.display = "block";
            $('#navbar').fadeIn('fast');
            // window.setTimeout(function () {
            //     navbar.style.opacity = 1;
            // }, 0);
            navbar.classList.add("stickyHeader")
        } else {
            // navbar.style.opacity = 0.3;
            // window.setTimeout(function () {
                // navbar.style.display = 'none';
                $('#navbar').fadeOut('fast');
            // }, 300);
            navbar.classList.remove("stickyHeader");
        }
    };

    $('#sub_area').change(function(){
        var sub_area_id = $(this).val();
        getGroupandLine(sub_area_id);
    })

// Verification Tab Change
    $('#cus_profile,#documentation,#loan_calc').click(function(){
        var verify = $('input[name=verification_type]:checked').val();

        if(verify == 'cus_profile')
        {
            $('#customer_profile').show(); $('#cus_document').hide(); $('#customer_loan_calc').hide();
         
        }
        if(verify == 'documentation')
        {
            $('#customer_profile').hide(); $('#cus_document').show(); $('#customer_loan_calc').hide();
           
        }
        if(verify == 'loan_calc')
        {
            $('#customer_profile').hide(); $('#cus_document').hide(); $('#customer_loan_calc').show();
      
        }
    })

});   ////////Document Ready End

$(function () {
    getImage(); // To show customer image when window onload.
    
    resetFamInfo(); //Call Family Info Table Initially.
    resetFamDetails();
    closeFamModal();

    resetgroupInfo(); //Group Family Modal Table Reset 
    resetGroupDetails()
   // closeGroupModal()

    resetpropertyInfo() // Property Info Modal Table Reset.
   // closePropertyModal() //Property Info List.
    resetPropertyinfoList() //Property Info List.

    resetbankInfo(); // Bank info Modal Table Reset.
   // closeBankModal(); //Bank Info List.
    resetbankinfoList(); //Bank Info List.

   // resetkycInfo(); //KYC info Modal Table Reset.
    resetkycinfoList(); //KYC Info List.


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

function getImage(){ // Cus img show onload.
    let imgName = $('#cus_image').val();
    $('#imgshow').attr('src',"uploads/request/customer/"+ imgName + " ");
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

// Modal Box for Agent Group
$('#famnameCheck').hide(); $('#famrelationCheck').hide(); $('#famremarkCheck').hide(); $('#famaddressCheck').hide(); $('#famageCheck').hide(); $('#famaadharCheck').hide(); $('#fammobileCheck').hide(); $('#famoccCheck').hide(); $('#famincomeCheck').hide();
$(document).on("click", "#submitFamInfoBtn", function () {
    let req_id = $('#req_id').val();
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

    if (famname != "" && relationship != "" && relation_age != "" && relation_aadhar != "" && relation_Mobile != "" && relation_Occupation != "" && relation_Income != "" && req_id !="") {
        $.ajax({
            url: 'verificationFile/verification_family_submit.php',
            type: 'POST',
            data: { "famname": famname, "realtionship": relationship, "other_remark": other_remark, "other_address": other_address, "relation_age": relation_age, "relation_aadhar": relation_aadhar, "relation_Mobile": relation_Mobile, "relation_Occupation": relation_Occupation, "relation_Income": relation_Income, "relation_Blood": relation_Blood, "famTableId": famTableId,"reqId": req_id  },
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
    let req_id = $('#req_id').val();
    
    $.ajax({
        url: 'verificationFile/verification_fam_reset.php',
        type: 'POST',
        data: {"reqId": req_id},
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

    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verification_fam_list.php',
        type: 'POST',
        data: {"reqId": req_id},
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
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: {"reqId": req_id},
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#guarentor_name").empty();
            $("#guarentor_name").append("<option value=''>" + 'Select Guarantor' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#guarentor_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#guarentor_name option:first-child");
                $("#guarentor_name").html($("#guarentor_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#guarentor_name").prepend(firstOption);
            }

            resetFamInfo();
            resetFamDetails();
            verificationPerson(); //To Select verification Person in Verification Info.////// 
        }
    });
}

// Verification Info Person 
function verificationPerson() {
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: {"reqId": req_id},
        dataType: 'json',
        success: function (response) {
            personMultiselect.clearStore();
            var len = response.length;
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                var items = [
                    {
                        value: fam_id,
                        label: fam_name,
                    }
                ];
                personMultiselect.setChoices(items);
                personMultiselect.init();
            }
        }
    });
}


$('#guarentor_name').change(function () { //Select Guarantor Name relationship will show in input.

    let famId = document.querySelector("#guarentor_name").value;

    $.ajax({
        url: 'verificationFile/verification_guarantor.php',
        type: 'POST',
        data: { "famid": famId },
        dataType: 'json',
        cache: false,
        success: function (result) {

            $("#guarentor_relationship").val(result['relation']);
       
        }
    });

});




//////////////////////////////////Group Start///////////////////////////////////////

$('#grpnameCheck').hide(); $('#grpageCheck').hide(); $('#grpaadharCheck').hide(); $('#grpmbleCheck').hide(); $('#grpgenCheck').hide(); $('#grpdesgnCheck').hide();

$(document).on("click", "#groupInfoBtn", function () {
    let req_id = $('#req_id').val();
    let group_name = $("#group_name").val();
    let group_age = $("#group_age").val();
    let group_aadhar = $("#group_aadhar").val();
    let group_mobile = $("#group_mobile").val();
    let group_gender = $("#group_gender").val();
    let group_designation = $("#group_designation").val();
    let grpID = $("#grpID").val();

    if (group_name != "" && group_age != "" && group_aadhar != "" && group_mobile != "" && group_gender != "" && group_designation != "" && req_id != "") {
        $.ajax({
            url: 'verificationFile/verification_group_submit.php',
            type: 'POST',
            data: { "group_name": group_name, "group_age": group_age, "group_aadhar": group_aadhar, "group_mobile": group_mobile, "group_gender": group_gender, "group_designation": group_designation, "grpTableId": grpID,"req_id": req_id },
            cache: false,
            success: function (response) {

                var insresult = response.includes("Inserted");
                var updresult = response.includes("Updated");
                if (insresult) {
                    $('#grpInsertOk').show();
                    setTimeout(function () {
                        $('#grpInsertOk').fadeOut('fast');
                    }, 2000);
                }
                else if (updresult) {
                    $('#grpUpdateok').show();
                    setTimeout(function () {
                        $('#grpUpdateok').fadeOut('fast');
                    }, 2000);
                }
                else {
                    $('#NotOk').show();
                    setTimeout(function () {
                        $('#NotOk').fadeOut('fast');
                    }, 2000);
                }

                resetgroupInfo();
                resetGroupDetails()
                // closeGroupModal()
            }
        });
    }
    else {

        if (group_name == "") {
            $('#grpnameCheck').show();
        } else {
            $('#grpnameCheck').hide();
        }

        if (group_age == "") {
            $('#grpageCheck').show();
        } else {
            $('#grpageCheck').hide();
        }

        if (group_aadhar == "") {
            $('#grpaadharCheck').show();
        } else {
            $('#grpaadharCheck').hide();
        }

        if (group_mobile == "") {
            $('#grpmbleCheck').show();
        } else {
            $('#grpmbleCheck').hide();
        }

        if (group_gender == "") {
            $('#grpgenCheck').show();
        } else {
            $('#grpgenCheck').hide();
        }

        if (group_designation == "") {
            $('#grpdesgnCheck').show();
        } else {
            $('#grpdesgnCheck').hide();
        }

    }

});

function resetgroupInfo() {
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verification_grp_reset.php',
        type: 'POST',
        data: {"reqId": req_id},
        cache: false,
        success: function (html) {
            $("#GroupTable").empty();
            $("#GroupTable").html(html);

            $("#group_name").val('');
            $("#group_age").val('');
            $("#group_aadhar").val('');
            $("#group_mobile").val('');
            $("#group_gender").val('');
            $("#group_designation").val('');
            $("#grpID").val('');
        }
    });
}

function resetGroupDetails() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_group_list.php',
        type: 'POST',
        data: {"reqId": req_id},
        cache: false,
        success: function (html) {
            $("#GroupList").empty();
            $("#GroupList").html(html);
        }
    });
}

$("body").on("click", "#verification_grp_edit", function () {
    let id = $(this).attr('value');

    $.ajax({
        url: 'verificationFile/verification_grp_edit.php',
        type: 'POST',
        data: { "id": id },
        dataType: 'json',
        cache: false,
        success: function (result) {

            $("#grpID").val(result['id']);
            $("#group_name").val(result['gname']);
            $("#group_age").val(result['age']);
            $("#group_aadhar").val(result['gaadhar']);
            $("#group_mobile").val(result['gmobile']);
            $("#group_gender").val(result['gGen']);
            $("#group_designation").val(result['dgsn']);



            // $('#famnameCheck').hide(); $('#famrelationCheck').hide(); $('#famremarkCheck').hide(); $('#famaddressCheck').hide(); $('#famageCheck').hide(); $('#famaadharCheck').hide(); $('#fammobileCheck').hide(); $('#famoccCheck').hide(); $('#famincomeCheck').hide(); $('#fambgCheck').hide();
        }
    });

});

$("body").on("click", "#verification_grp_delete", function () {
    var isok = confirm("Do you want delete this Group Info?");
    if (isok == false) {
        return false;
    } else {
        var Groupid = $(this).attr('value');

        $.ajax({
            url: 'verificationFile/verification_grp_delete.php',
            type: 'POST',
            data: { "Groupid": Groupid },
            cache: false,
            success: function (response) {
                var delresult = response.includes("Deleted");
                if (delresult) {
                    $('#GroupDeleteOk').show();
                    setTimeout(function () {
                        $('#GroupDeleteOk').fadeOut('fast');
                    }, 2000);
                }
                else {

                    $('#GroupDeleteNotOk').show();
                    setTimeout(function () {
                        $('#GroupDeleteNotOk').fadeOut('fast');
                    }, 2000);
                }

                resetgroupInfo();
                resetGroupDetails()
            }
        });
    }
});



//Group Modal Close
// function closeGroupModal() {
//     $.ajax({
//         url: 'verificationFile/verificationGroup.php',
//         type: 'post',
//         data: {},
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#group_names").empty();
//             $("#group_names").append("<option value=''>" + 'Add Group Name' + "</option>");
//             for (var i = 0; i < len; i++) {
//                 var Group_name = response[i];
//                 $("#group_names").append("<option value='" + Group_name + "'>" + Group_name + "</option>");
//             }
//             {//To Order ag_group Alphabetically
//                 var firstOption = $("#group_names option:first-child");
//                 $("#group_names").html($("#group_names option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#group_names").prepend(firstOption);
//             }

//             resetgroupInfo();
//         }
//     });
// }

///////////////////////// Property Info Starts /////////////////////////////////////

function propertyHolder() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/property_holder.php',
        type: 'post',
        data: {"reqId": req_id},
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

$('#prtytypeCheck').hide(); $('#prtymeasureCheck').hide(); $('#prtyvalCheck').hide(); $('#prtyholdCheck').hide();

$(document).on("click", "#propertyInfoBtn", function () {
    let req_id = $('#req_id').val();
    let property_type = $("#property_typ").val();
    let property_measurement = $("#property_measurement").val();
    let property_value = $("#property_value").val();
    let property_holder = $("#property_holder").val();
    let propertyID = $("#propertyID").val();

    if (property_type != "" && property_measurement != "" && property_value != "" && property_holder != "" && req_id !="") {
        $.ajax({
            url: 'verificationFile/verification_property_submit.php',
            type: 'POST',
            data: { "property_type": property_type, "property_measurement": property_measurement, "property_value": property_value, "property_holder": property_holder, "propertyID": propertyID, "reqId": req_id },
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
                // resetGroupDetails()
                // closeGroupModal()
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
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_property_reset.php',
        type: 'POST',
        data: {"reqId": req_id},
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



//Property Modal Close
// function closePropertyModal() {
//     $.ajax({
//         url: 'verificationFile/verification_property.php',
//         type: 'post',
//         data: {},
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#property_types").empty();
//             $("#property_types").append("<option value=''>" + 'Add Property Info' + "</option>");
//             for (var i = 0; i < len; i++) {
//                 var property_name = response[i];
//                 $("#property_types").append("<option value='" + property_name + "'>" + property_name + "</option>");
//             }
//             {//To Order  Alphabetically
//                 var firstOption = $("#property_types option:first-child");
//                 $("#property_types").html($("#property_types option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#property_types").prepend(firstOption);
//             }

//             resetPropertyinfoList();
//         }
//     });
// }

function resetPropertyinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_property_list.php',
        type: 'POST',
        data: {"reqId": req_id},
        cache: false,
        success: function (html) {
            $("#propertyList").empty();
            $("#propertyList").html(html);
        }
    });
}

////////////////////////////// Bank Info ///////////////////////////////////////////////////////

$('#bankNameCheck').hide(); $('#branchCheck').hide(); $('#accholdCheck').hide(); $('#accnoCheck').hide(); $('#ifscCheck').hide();

$(document).on("click", "#bankInfoBtn", function () {

    let req_id = $('#req_id').val();
    let bank_name = $("#bank_name").val();
    let branch_name = $("#branch_name").val();
    let account_holder_name = $("#account_holder_name").val();
    let account_number = $("#account_number").val();
    let Ifsc_code = $("#Ifsc_code").val();
    let bankID = $("#bankID").val();

    if (bank_name != "" && branch_name != "" && account_holder_name != "" && account_number != "" && Ifsc_code != "" && req_id !="") {
        $.ajax({
            url: 'verificationFile/verification_bank_submit.php',
            type: 'POST',
            data: { "bank_name": bank_name, "branch_name": branch_name, "account_holder_name": account_holder_name, "account_number": account_number, "Ifsc_code": Ifsc_code, "bankID": bankID, "reqId": req_id },
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
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_bank_reset.php',
        type: 'POST',
        data: {"reqId": req_id},
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


//Bank Modal Close
// function closeBankModal() {
//     $.ajax({
//         url: 'verificationFile/verification_bank.php',
//         type: 'post',
//         data: {},
//         dataType: 'json',
//         success: function (response) {

//             var len = response.length;
//             $("#bank_name_list").empty();
//             $("#bank_name_list").append("<option value=''>" + 'Add Bank Info' + "</option>");
//             for (var i = 0; i < len; i++) {
//                 var bank_name = response[i];
//                 $("#bank_name_list").append("<option value='" + bank_name + "'>" + bank_name + "</option>");
//             }
//             {//To Order  Alphabetically
//                 var firstOption = $("#bank_name_list option:first-child");
//                 $("#bank_name_list").html($("#bank_name_list option:not(:first-child)").sort(function (a, b) {
//                     return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
//                 }));
//                 $("#bank_name_list").prepend(firstOption);
//             }

//             resetbankinfoList();
//         }
//     });
// }


function resetbankinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_bank_list.php',
        type: 'POST',
        data: {"reqId": req_id},
        cache: false,
        success: function (html) {
            $("#bankResetTable").empty();
            $("#bankResetTable").html(html);
        }
    });
}

////////////////////////// KYC Info ////////////////////////////////////////////////


$('#proofCheck').hide(); $('#proofTypeCheck').hide(); $('#proofnoCheck').hide(); $('#proofUploadCheck').hide();

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

    if (proofof != "" && proof_type != "" && proof_number != "" && file != undefined && req_id !="") {
        $.ajax({
            url: 'verificationFile/verification_kyc_submit.php',
            type: 'POST',
            data:  formdata ,
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
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_kyc_reset.php',
        type: 'POST',
        data: {"reqId": req_id},
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
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verification_kyc_list.php',
        type: 'POST',
        data: {"reqId": req_id},
        cache: false,
        success: function (html) {
            $("#kycListTable").empty();
            $("#kycListTable").html(html);

            resetkycInfo();
        }
    });
}

$('#proofof').change(function(){
    let req_id = $('#req_id').val();
    let proof = $('#proofof').val();

    $.ajax({
        url: 'verificationFile/verification_proof_type.php',
        type: 'POST',
        data: {"reqId": req_id,"proof": proof},
        dataType: 'json',
        cache: false,
        success: function (response) {

            
            $('#proof_type option').prop('disabled', false);

            $.each(response, function(index, value) {
                $('#proof_type option[value="' + value + '"]').prop('disabled', true);
            });

        }
    });

})


//get district dropdown
function getDistrictDropdown(StateSelected){
        
    var optionsList;
    var htmlString = "<option value='Select District'>Select District</option>";
    {
    var TamilNadu = ["Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kancheepuram","Kanniyakumari","Karur","Madurai","Nagapattinam",
    "Namakkal","Nilgiris","Perambalur","Pudukottai","Ramanathapuram","Salem","Sivagangai","Thanjavur","Theni","Thiruvallur","Tiruvannamalai","Thiruvarur",
    "Thoothukudi","Tiruchirappalli","Thirunelveli","Vellore","Viluppuram","Virudhunagar","Ariyalur","Krishnagiri","Tiruppur","Chengalpattu","Kallakurichi",
    "Ranipet","Tenkasi","Tirupathur","Mayiladuthurai"];
    var Puducherry = ["Puducherry"];
    }//District list
    switch (StateSelected) {
        case  "TamilNadu":
            optionsList = TamilNadu;
            break;
        case  "Puducherry":
            optionsList = Puducherry;
            break;
        case "SelectState":
            optionsList = ["Select District"];
            break;
    }

    var district_upd = $('#district_upd').val();
    for(var i = 0; i < optionsList.length; i++){
        var selected ='';
        if(district_upd != undefined && district_upd != '' && district_upd == optionsList[i]){ selected = "selected";}
        htmlString = htmlString+"<option value='"+ optionsList[i] +"' "+ selected +" >"+ optionsList[i] +"</option>";
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

//get Taluk Dropdown
function getTalukDropdown(DistSelected){

    var optionsList;
    var htmlString = "<option value='Select Taluk'>Select Taluk</option>";
    {
        var Chennai = ["Alandur","Ambattur","Aminjikarai","Ayanavaram","Egmore","Guindy","Madhavaram","Madhuravoyal","Mambalam","Mylapore","Perambur","Purasavakkam","Sholinganallur","Thiruvottriyur","Tondiarpet","Velacherry"];
        var Coimbatore = ["Aanaimalai","Annur","Coimbatore(North)","Coimbatore(South)","Kinathukadavu","Madukarai","Mettupalayam","Perur","Pollachi","Sulur","Valparai"];
        var Cuddalore = ["Cuddalore","Bhuvanagiri","Chidambaram","Kattumannarkoil","Kurinjipadi","Panruti","Srimushnam","Thittakudi","Veppur","Virudhachalam"];
        var Dharmapuri = ["Dharmapuri","Harur","Karimangalam","Nallampalli","Palacode","Pappireddipatti","Pennagaram"];
        var Dindigul = ["Atthur","Dindigul (East)","Dindigul (West)","Guziliyamparai","Kodaikanal","Natham","Nilakottai","Oddanchatram","Palani","Vedasandur"];
        var Erode = ["Erode","Anthiyur","Bhavani","Gobichettipalayam","Kodumudi","Modakurichi","Nambiyur","Perundurai","Sathiyamangalam","Thalavadi"];
        var Kancheepuram =  ["Kancheepuram","Kundrathur","Sriperumbudur","Uthiramerur","Walajabad"];
        var Kanniyakumari = ["Agasteeswaram","Kalkulam","Killiyur","Thiruvatar","Thovalai","Vilavankodu"];
        var Karur = ["Karur","Aravakurichi","Kadavur","Krishnarayapuram","Kulithalai","Manmangalam","Pugalur"];
        var Madurai = ["Kallikudi","Madurai (East)","Madurai (North)","Madurai (South)","Madurai (West)","Melur","Peraiyur","Thirumangalam","Thiruparankundram","Usilampatti","Vadipatti"];
        var Nagapattinam  = ["Nagapattinam","Kilvelur","Thirukkuvalai","Vedaranyam"];
        var Namakkal = ["Namakkal","Kholli Hills","Kumarapalayam","Mohanoor","Paramathi Velur","Rasipuram","Senthamangalam","Tiruchengode"];
        var Nilgiris = ["Udagamandalam","Coonoor","Gudalur","Kothagiri","Kundah","Pandalur"];
        var Perambalur = ["Perambalur","Alathur","Kunnam","Veppanthattai"];
        var Pudukottai = ["Pudukottai","Alangudi","Aranthangi","Avudiyarkoil","Gandarvakottai","Iluppur","Karambakudi","Kulathur","Manamelkudi","Ponnamaravathi","Thirumayam","Viralimalai"];
        var Ramanathapuram = ["Ramanathapuram","Kadaladi","Kamuthi","Kezhakarai","Mudukulathur","Paramakudi","Rajasingamangalam","Rameswaram","Tiruvadanai"];
        var Salem =  ["Salem","Attur","Edapadi","Gangavalli","Kadaiyampatti","Mettur","Omalur","Pethanayakanpalayam","Salem South","Salem West","Sankari","Vazhapadi","Yercaud"];
        var Sivagangai = ["Sivagangai","Devakottai","Ilayankudi","Kalaiyarkovil","Karaikudi","Manamadurai","Singampunari","Thirupuvanam","Tirupathur"];
        var Thanjavur = ["Thanjavur","Boothalur","Kumbakonam","Orathanadu","Papanasam","Pattukottai","Peravurani","Thiruvaiyaru","Thiruvidaimaruthur"];
        var Theni =  ["Theni","Aandipatti","Bodinayakanur","Periyakulam","Uthamapalayam"];
        var Thiruvallur  = ["Thiruvallur","Avadi","Gummidipoondi","Pallipattu","Ponneri","Poonamallee","R.K. Pet","Tiruthani","Uthukottai"];
        var Tiruvannamalai =  ["Thiruvannamalai","Arni","Chengam","Chetpet","Cheyyar","Jamunamarathur","Kalasapakkam","Kilpennathur","Polur","Thandramet","Vandavasi","Vembakkam"];
        var Thiruvarur =  ["Thiruvarur","Kodavasal","Koothanallur","Mannargudi","Nannilam","Needamangalam","Thiruthuraipoondi","Valangaiman"];
        var Thoothukudi = ["Thoothukudi","Eral","Ettayapuram","Kayathar","Kovilpatti","Ottapidaram","Sattankulam","Srivaikundam","Tiruchendur","Vilathikulam"];
        var Tiruchirappalli = ["Lalgudi","Manachanallur","Manapparai","Marungapuri","Musiri","Srirangam","Thottiam","Thuraiyur","Tiruchirapalli (West)","Tiruchirappalli (East)","Tiruverumbur"];
        var Thirunelveli =  ["Tirunelveli","Ambasamudram","Cheranmahadevi","Manur","Nanguneri","Palayamkottai","Radhapuram","Thisayanvilai"];
        var Vellore =  ["Vellore","Aanikattu","Gudiyatham","K V Kuppam","Katpadi","Pernambut"];
        var Viluppuram = ["Villupuram","Gingee","Kandachipuram","Marakanam","Melmalaiyanur","Thiruvennainallur","Tindivanam","Vanur","Vikravandi"];
        var Virudhunagar =  ["Virudhunagar","Aruppukottai","Kariyapatti","Rajapalayam","Sathur","Sivakasi","Srivilliputhur","Tiruchuli","Vembakottai","Watrap"];
        var Ariyalur = ["Ariyalur","Andimadam","Sendurai","Udaiyarpalayam"];
        var Krishnagiri = ["Krishnagiri","Anjetty","Bargur","Hosur","Pochampalli","Sulagiri","Thenkanikottai","Uthangarai"];
        var Tiruppur = ["Avinashi","Dharapuram","Kangeyam","Madathukkulam","Oothukuli","Palladam","Tiruppur (North)","Tiruppur (South)","Udumalaipettai"];
        var Chengalpattu  = ["Chengalpattu","Cheyyur","Maduranthakam","Pallavaram","Tambaram","Thirukalukundram","Tiruporur","Vandalur"];
        var Kallakurichi =  ["Kallakurichi","Chinnaselam","Kalvarayan Hills","Sankarapuram","Tirukoilur","Ulundurpet"];
        var Ranipet = ["Arakkonam","Arcot","Kalavai","Nemili","Sholingur","Walajah"];
        var Tenkasi =  ["Tenkasi","Alangulam","Kadayanallur","Sankarankovil","Shenkottai","Sivagiri","Thiruvengadam","Veerakeralampudur"];
        var Tirupathur =  ["Tirupathur","Ambur","Natrampalli","Vaniyambadi"];
        var Mayiladuthurai =  ["Mayiladuthurai","Kuthalam","Sirkali","Tharangambadi"];
        var Puducherry = ["Puducherry", "Oulgaret", "Villianur", "Bahour","Karaikal","Thirunallar","Mahe","Yanam"];
        
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
        case  "Cuddalore":
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
        case  "Nagapattinam":
            optionsList = Nagapattinam;
            break;
        case "Perambalur":
            optionsList = Perambalur;
            break;
        case  "Ramanathapuram":
            optionsList = Ramanathapuram;
            break;
        case "Salem":
            optionsList = Salem;
            break;
        case  "Tenkasi":
            optionsList = Tenkasi;
            break;
        case "Theni":
            optionsList = Theni ;
            break;
        case  "Thirunelveli":
            optionsList = Thirunelveli;
            break;
        case "Thiruvarur":
            optionsList = Thiruvarur;
            break;
        case  "Tirupathur":
            optionsList = Tirupathur;
            break;
        case "Tiruvannamalai":
            optionsList = Tiruvannamalai;
            break;
        case  "Vellore":
            optionsList = Vellore;
            break;
        case "Virudhunagar":
            optionsList = Virudhunagar;
            break;
        case  "Kancheepuram":
            optionsList = Kancheepuram;
            break;
        case  "Karur":
            optionsList = Karur;
            break;
        case "Madurai":
            optionsList = Madurai ;
            break;
        case  "Namakkal":
            optionsList = Namakkal;
            break;
        case  "Pudukottai":
            optionsList = Pudukottai;
            break;
        case "Ranipet":
            optionsList = Ranipet;
            break;
        case  "Sivagangai":
            optionsList = Sivagangai;
            break;
        case "Thanjavur":
            optionsList = Thanjavur;
            break;
        case  "Nilgiris":
            optionsList = Nilgiris;
            break;
        case "Thiruvallur":
            optionsList = Thiruvallur;
            break;
        case  "Thoothukudi":
            optionsList = Thoothukudi;
            break;
        case "Tiruppur":
            optionsList = Tiruppur ;
            break;
        case  "Tiruchirappalli":
            optionsList = Tiruchirappalli;
            break;
        case  "Viluppuram":
            optionsList = Viluppuram;
            break;
        case  "Mayiladuthurai":
            optionsList = Mayiladuthurai;
            break;
        case  "Puducherry":
            optionsList = Puducherry;
            break;
        case "Select District":
            optionsList = ["Select Taluk"];
            break;
    }
    var taluk_upd = $('#taluk_upd').val();
    for(var i = 0; i < optionsList.length; i++){
        var selected ='';
        if(taluk_upd != undefined && taluk_upd != '' && taluk_upd == optionsList[i]){ selected = "selected";}
        htmlString = htmlString+"<option value='"+ optionsList[i] +"' "+ selected +" >"+ optionsList[i] +"</option>";
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

//Get Taluk Based Area
function getTalukBasedArea(talukselected){
    var area_upd = $('#area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledAreaName.php',
        type: 'post',
        data: {'talukselected':talukselected},
        dataType: 'json',
        success:function(response){

            var len = response.length;
            $("#area").empty();
            $("#area").append("<option value=''>"+'Select Area'+"</option>");
            for(var i = 0; i<len; i++){
                var area_id = response[i]['area_id'];
                var area_name = response[i]['area_name'];
                var selected = '';
                if(area_upd != undefined && area_upd != '' && area_upd == area_id ){
                    selected = 'selected';
                }
                $("#area").append("<option value='"+area_id+"' "+selected+">"+area_name+"</option>");
            }
            
            $("#area_name").val('');
            $("#area_id").val('');

            {//To Order Alphabetically
                var firstOption = $("#area option:first-child");
                $("#area").html($("#area option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#area").prepend(firstOption);
            }
        }
    });
}

//Get Area Based Sub Area
function getAreaBasedSubArea(area){
    var sub_area_upd = $('#sub_area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledSubArea.php',
        type: 'post',
        data: {'area':area},
        dataType: 'json',
        success:function(response){

            $('#sub_area').empty();
            $('#sub_area').append("<option value='' >Select Sub Area</option>");
            for(var i=0;i<response.length;i++){
                var selected='';
                if(sub_area_upd != undefined && sub_area_upd != '' && sub_area_upd == response[i]['sub_area_id']){
                    selected ='selected';
                }
                $('#sub_area').append("<option value='"+response[i]['sub_area_id']+"' "+selected+">"+response[i]['sub_area_name']+" </option>");
            }
        }
    });
}

$('#cus_loan_limit').change(function(){ /// Loan Limit will Check the Loan Amount in Request Loan Category./////
    let loanLimit = $(this).val();
    let loanamnt = $('#loan_amt').val();

    if(loanLimit > loanamnt){
     
        alert("Kindly Enter Loan Limit Lesser Than Loan Amount " + loanamnt);
        $(this).val('');
        return false;
    }

})

////////////////////////////////////////////////Submit Verification //////////////////////////////////////////////////////////////////////////////

$('#submit_verification').click(function(){
    validation();
});

function validation(){
    var cus_id = $('#cus_id').val();var cus_name = $('#cus_name').val();var dob = $('#dob').val();var gender = $('#gender').val();var bloodGroup = $('#bloodGroup').val();var state = $('#state').val()
    var district = $('#district1').val();var taluk = $('#taluk1').val();var area = $('#area').val();var sub_area = $('#sub_area').val();var pic = $('#pic').val();var mobile1 = $('#mobile1').val();
    var guarentor_name = $('#guarentor_name').val();var guarentorpic = $('#guarentorpic').val();var area_cnfrm = $('#area_cnfrm').val();var cus_res_type = $('#cus_res_type').val();
    var cus_res_details = $('#cus_res_details').val();var cus_res_address = $('#cus_res_address').val();var cus_res_native = $('#cus_res_native').val();
    var cus_occ_type = $('#cus_occ_type').val();var cus_occ_detail = $('#cus_occ_detail').val();var cus_occ_income = $('#cus_occ_income').val();var cus_occ_address = $('#cus_occ_address').val(); var cus_how_know = $('#cus_how_know').val(); var cus_monthly_income = $('#cus_monthly_income').val(); var cus_other_income = $('#cus_other_income').val(); var cus_support_income = $('#cus_support_income').val(); var cus_Commitment = $('#cus_Commitment').val(); var cus_monDue_capacity = $('#cus_monDue_capacity').val(); var cus_loan_limit = $('#cus_loan_limit').val(); var cus_Character = $('#cus_Character').val(); var cus_Approach = $('#cus_Approach').val(); var cus_Relationship = $('#cus_Relationship').val(); var cus_Attitude = $('#cus_Attitude').val(); var cus_Behavior = $('#cus_Behavior').val(); var cus_Incidents_Remarks = $('#cus_Incidents_Remarks').val(); var about_cus = $('#about_cus').val(); 
    var req_id = $('#req_id').val();
    
    if(cus_id == ''){
        event.preventDefault();
        $('#cusidCheck').show();
    }else{
        $('#cusidCheck').hide();
    }
    if(cus_name == ''){
        event.preventDefault();
        $('#cusnameCheck').show();
    }else{
        $('#cusnameCheck').hide();
    }
    if(dob == ''){
        event.preventDefault();
        $('#dobCheck').show();
    }else{
        $('#dobCheck').hide();
    }
    if(gender == ''){
        event.preventDefault();
        $('#genderCheck').show();
    }else{
        $('#genderCheck').hide();
    }
    if(bloodGroup == ''){
        event.preventDefault();
        $('#bloodGroupCheck').show();
    }else{
        $('#bloodGroupCheck').hide();
    }
    if(mobile1 == ''){
        event.preventDefault();
        $('#mobile1Check').show();
    }else{
        $('#mobile1Check').hide();
    }
    if(pic == ''){
        event.preventDefault();
        $('#picCheck').show();
    }else{
        $('#picCheck').hide();
    }
    if(guarentor_name == ''){
        event.preventDefault();
        $('#guarentor_nameCheck').show();
    }else{
        $('#guarentor_nameCheck').hide();
    }
    if(guarentorpic == ''){
        event.preventDefault();
        $('#guarentorpicCheck').show();
    }else{
        $('#guarentorpicCheck').hide();
    }
    if(area_cnfrm == '0'){
        $('#areacnfrmCheck').hide();
        if(cus_res_type == '' || cus_res_details=='' || cus_res_address == '' || cus_res_native == ''){
            event.preventDefault();
            $('#occ_infoCheck').hide();
            $('#res_infoCheck').show();
        }else{
            $('#occ_infoCheck').hide();
            $('#res_infoCheck').hide();
        }
    }else if(area_cnfrm == '1'){
        $('#areacnfrmCheck').hide();
        if(cus_occ_type == '' || cus_occ_detail=='' || cus_occ_income == '' || cus_occ_address == ''){
            event.preventDefault();
            $('#res_infoCheck').hide();
            $('#occ_infoCheck').show();
        }else{
            $('#res_infoCheck').hide();
            $('#occ_infoCheck').hide();
        }
    }else {
        event.preventDefault();
        $('#areacnfrmCheck').show();
    }
    if(state == 'SelectState'){
        event.preventDefault();
        $('#stateCheck').show();
    }else{
        $('#stateCheck').hide();
    }
    if(district == ''){
        event.preventDefault();
        $('#districtCheck').show();
    }else{
        $('#districtCheck').hide();
    }
    if(taluk == ''){
        event.preventDefault();
        $('#talukCheck').show();
    }else{
        $('#talukCheck').hide();
    }
    if(area == ''){
        event.preventDefault();
        $('#areaCheck').show();
    }else{
        $('#areaCheck').hide();
    }
    if(sub_area == ''){
        event.preventDefault();
        $('#subareaCheck').show();
    }else{
        $('#subareaCheck').hide();
    }
    if(cus_how_know == ''){
        event.preventDefault();
        $('#howToKnowCheck').show();
    }else{
        $('#howToKnowCheck').hide();
    }
    if(cus_monthly_income == ''){
        event.preventDefault();
        $('#monthlyIncomeCheck').show();
    }else{
        $('#monthlyIncomeCheck').hide();
    }
    if(cus_other_income == ''){
        event.preventDefault();
        $('#otherIncomeCheck').show();
    }else{
        $('#otherIncomeCheck').hide();
    }
    if(cus_support_income == ''){
        event.preventDefault();
        $('#supportIncomeCheck').show();
    }else{
        $('#supportIncomeCheck').hide();
    }
    if(cus_Commitment == ''){
        event.preventDefault();
        $('#commitmentCheck').show();
    }else{
        $('#commitmentCheck').hide();
    }
    if(cus_monDue_capacity == ''){
        event.preventDefault();
        $('#monthlyDueCapacityCheck').show();
    }else{
        $('#monthlyDueCapacityCheck').hide();
    }
    if(cus_loan_limit == ''){
        event.preventDefault();
        $('#loanLimitCheck').show();
    }else{
        $('#loanLimitCheck').hide();
    }
    if(cus_Character == ''){
        event.preventDefault();
        $('#CharacterCheck').show();
    }else{
        $('#CharacterCheck').hide();
    }
    if(cus_Approach == ''){
        event.preventDefault();
        $('#ApproachCheck').show();
    }else{
        $('#ApproachCheck').hide();
    }
    if(cus_Relationship == ''){
        event.preventDefault();
        $('#cusRelationshipCheck').show();
    }else{
        $('#cusRelationshipCheck').hide();
    }
    if(cus_Attitude == ''){
        event.preventDefault();
        $('#cusAttitudeCheck').show();
    }else{
        $('#cusAttitudeCheck').hide();
    }
    if(cus_Behavior == ''){
        event.preventDefault();
        $('#cusBehaviorCheck').show();
    }else{
        $('#cusBehaviorCheck').hide();
    }
    if(cus_Incidents_Remarks == ''){
        event.preventDefault();
        $('#cusIncidentsRemarksCheck').show();
    }else{
        $('#cusIncidentsRemarksCheck').hide();
    }
    if(about_cus == ''){
        event.preventDefault();
        $('#aboutcusCheck').show();
    }else{
        $('#aboutcusCheck').hide();
    }

    $.ajax({
        url:'verificationFile/validateModals.php',
        data:{'req_id':req_id, 'table':'verification_family_info'},
        type: 'post',
        cache: false,
        success: function(response){
            if(response == "0"){
                event.preventDefault();
                $('#family_infoCheck').show();
            }else if(response == "1"){
                $('#family_infoCheck').hide();
            }
        }
    })
    $.ajax({
        url:'verificationFile/validateModals.php',
        data:{'req_id':req_id, 'table':'verification_group_info'},
        type: 'post',
        cache: false,
        success: function(response){
            if(response == "0"){
                event.preventDefault();
                $('#group_infoCheck').show();
            }else if(response == "1"){
                $('#group_infoCheck').hide();
            }
        }
    })
    $.ajax({
        url:'verificationFile/validateModals.php',
        data:{'req_id':req_id, 'table':'verification_property_info'},
        type: 'post',
        cache: false,
        success: function(response){
            if(response == "0"){
                event.preventDefault();
                $('#property_infoCheck').show();
            }else if(response == "1"){
                $('#property_infoCheck').hide();
            }
        }
    })
    $.ajax({
        url:'verificationFile/validateModals.php',
        data:{'req_id':req_id, 'table':'verification_bank_info'},
        type: 'post',
        cache: false,
        success: function(response){
            if(response == "0"){
                event.preventDefault();
                $('#bank_infoCheck').show();
            }else if(response == "1"){
                $('#bank_infoCheck').hide();
            }
        }
    })
    $.ajax({
        url:'verificationFile/validateModals.php',
        data:{'req_id':req_id, 'table':'verification_kyc_info'},
        type: 'post',
        cache: false,
        success: function(response){
            if(response == "0"){
                event.preventDefault();
                $('#kyc_infoCheck').show();
            }else if(response == "1"){
                $('#kyc_infoCheck').hide();
            }
        }
    })


            //Verification Person Multi select store
            var person_list = personMultiselect.getValue();
            var person = '';
            for(var i=0;i<person_list.length;i++){
                if (i > 0) {
                    person += ',';
                }
                person += person_list[i].value;
            }
            var arr = person.split(",");
            arr.sort(function(a,b){return a-b});
            var sortedStr = arr.join(",");
            $('#verifyPerson').val(sortedStr);
    
}

$('#Communitcation_to_cus').change(function(){
    let com = $(this).val();

    if(com == '0'){
        $('#verifyaudio').show();
    }else{
        $('#verifyaudio').hide(); 
    }
})
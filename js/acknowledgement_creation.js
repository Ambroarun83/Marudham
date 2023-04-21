const personMultiselect = new Choices('#verification_person', {
    removeItemButton: true,
    noChoicesText: null,
    placeholder: true,
    placeholderValue: 'Select Verification Person',
});

$(document).ready(function () {

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

    // Verification Tab Change Radio buttons
    $('#cus_profile,#documentation,#loan_calc').click(function () {
        var verify = $('input[name=verification_type]:checked').val();

        if (verify == 'cus_profile') {
            $('#customer_profile').show(); $('#cus_document').hide(); $('#customer_loan_calc').hide();

        }
        if (verify == 'documentation') {
            $('#customer_profile').hide(); $('#cus_document').show(); $('#customer_loan_calc').hide();

        }
        if (verify == 'loan_calc') {
            $('#customer_profile').hide(); $('#cus_document').hide(); $('#customer_loan_calc').show();
            onLoadEditFunction();
            getUserBasedLoanCategory();
            setTimeout(()=>{
                getCategoryInfo();
                var sub_cat_id = $('#sub_category').val();
                getLoaninfo(sub_cat_id);
                profitCalculationInfo();
            },1000)
        }
    })

///Documentation 

    ////Mortgage Info     
    $('#mortgagenameCheck').hide(); $('#mortgagedsgnCheck').hide(); $('#mortgagenumCheck').hide(); $('#regofficeCheck').hide(); $('#mortgagevalueCheck').hide(); $('#mortgagedocCheck').hide();

    //Endorsement Info
    $('#vehicle_reg_noCheck').hide(); $('#endorsementnameCheck').hide(); $('#enRCCheck').hide(); $('#enKeyCheck').hide();


//To Show Relationship value on edit page.////
let mortgage = $('#Propertyholder_type').val();
if(mortgage == '2'){
    $('#Propertyholder_name').hide();
    $('#Propertyholder_relationship_name').show();
    mortgageHolderName();
    let mortgageHolder =  $('#mortgage_relation_name').val();

    setTimeout(() => {
        $('#Propertyholder_relationship_name').val(mortgageHolder);
    }, 500);
}

let ot = $('#owner_type').val();
if(ot == '2'){
    $('#owner_name').hide();
    $('#ownername_relationship_name').show();
    endorseHolderName();
    let Endorsename =  $('#en_relation_name').val();

    setTimeout(() => {
        $('#ownername_relationship_name').val(Endorsename);
    }, 500);
}

let docHolder = $('#document_holder').val();    
if(docHolder == '2'){
    $('#docholder_name').hide();
    $('#docholder_relationship_name').show();
    docHolderName();
    let holder =  $('#docrelation_name').val();

    setTimeout(() => {
        $('#docholder_relationship_name').val(holder);
    }, 500);
}

$('#pendingchk').click(function(){
    var pend = document.querySelector('#pendingchk');

    if(pend.checked == true){
    var pending = $(this).val();
    console.log(pending);
    }
})


});   ////////Document Ready End

$(function () {
     $('.icon-chevron-down1').parent().next('div').slideUp(); //To collapse all card on load

     $('input').attr('readonly',true);
     $('select').attr('disabled',true);
     
     $('input#mortgage_name').removeAttr('readonly');
     $('input#mortgage_dsgn').removeAttr('readonly');
     $('input#mortgage_nuumber').removeAttr('readonly');
     $('input#reg_office').removeAttr('readonly');
     $('input#mortgage_value').removeAttr('readonly');
     $('#mortgage_document').removeAttr('disabled');

     $('input#vehicle_reg_no').removeAttr('readonly');
     $('input#endorsement_name').removeAttr('readonly');
     $('#en_RC').removeAttr('disabled');
     $('#en_Key').removeAttr('disabled');
    
    getImage(); // To show customer image when window onload.

    resetFamDetails(); //Family Table List

    resetGroupDetails()    //Group Family Modal Table Reset 

    resetPropertyinfoList() //Property Info List.

    resetbankinfoList(); //Bank Info List.

    resetkycinfoList(); //KYC Info List.

    //Documentation
    getstaffCode(); // Atuo Generate Doc ID.
    resetsigninfoList(); // Signed Doc List Reset.

    chequeinfoList(); // Cheque Info List.

    feedbackList(); // Feedback List.

    verificationPerson() //Verification Person


    var state_upd = $('#state_upd').val();
    if(state_upd != ''){
        getDistrictDropdown(state_upd);
    }
    var district_upd = $('#district_upd').val();
    if(district_upd != ''){
        getTalukDropdown(district_upd);
    }
    var taluk_upd = $('#taluk_upd').val();
    if(taluk_upd != ''){
        getTalukBasedArea(taluk_upd);
    }
    var area_upd = $('#area_upd').val();
    if(area_upd != ''){
        getAreaBasedSubArea(area_upd);
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

function resetFamDetails() {

    let req_id = $('#req_id').val();
    var guarentor_name = $('#guarentor_name_upd').val();

    $.ajax({
        url: 'verificationFile/verification_fam_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#famList").empty();
            $("#famList").html(html);
        }
    });

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#guarentor_name").empty();
            $("#guarentor_name").append("<option value=''>" + 'Select Guarantor' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                var selected = '';
                if(guarentor_name != '' && guarentor_name == fam_id){
                    selected = 'selected';
                }
                $("#guarentor_name").append("<option value='" + fam_id + "' " + selected+ ">" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#guarentor_name option:first-child");
                $("#guarentor_name").html($("#guarentor_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#guarentor_name").prepend(firstOption);
            }

        }
    });
}

// Verification Info Person 
function verificationPerson() {
    let req_id = $('#req_id').val();

    var verification_person_upd = $('#verification_person_upd').val();
    var values = verification_person_upd.split(',');


    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {
            personMultiselect.clearStore();
            var len = response.length;
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                var selected = '';
                if(verification_person_upd != '' &&  values.includes(fam_id)){
                    selected = 'selected';
                }
                var items = [
                    {
                        value: fam_id,
                        label: fam_name,
                        selected: selected,  
                    }
                ];
                personMultiselect.setChoices(items);
                personMultiselect.init();
            }
        }
    });
}

function resetGroupDetails() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_group_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#GroupList").empty();
            $("#GroupList").html(html);
        }
    });
}

///////////////////////// Property Info Starts /////////////////////////////////////
function resetPropertyinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_property_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#propertyList").empty();
            $("#propertyList").html(html);
        }
    });
}

////////////////////////////// Bank Info ///////////////////////////////////////////////////////
function resetbankinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/verification_bank_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#bankResetTable").empty();
            $("#bankResetTable").html(html);
        }
    });
}

////////////////////////// KYC Info ////////////////////////////////////////////////
function resetkycinfoList() {
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verification_kyc_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#kycListTable").empty();
            $("#kycListTable").html(html);

        }
    });
}

//get district dropdown
function getDistrictDropdown(StateSelected) {

    var optionsList;
    var htmlString = "<option value='Select District'>Select District</option>";
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

//get Taluk Dropdown
function getTalukDropdown(DistSelected) {

    var optionsList;
    var htmlString = "<option value='Select Taluk'>Select Taluk</option>";
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
    var taluk_upd = $('#taluk_upd').val();
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

//Get Taluk Based Area
function getTalukBasedArea(talukselected) {
    var area_upd = $('#area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledAreaName.php',
        type: 'post',
        data: { 'talukselected': talukselected },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#area").empty();
            $("#area").append("<option value=''>" + 'Select Area' + "</option>");
            for (var i = 0; i < len; i++) {
                var area_id = response[i]['area_id'];
                var area_name = response[i]['area_name'];
                var selected = '';
                if (area_upd != undefined && area_upd != '' && area_upd == area_id) {
                    selected = 'selected';
                }
                $("#area").append("<option value='" + area_id + "' " + selected + ">" + area_name + "</option>");
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
function getAreaBasedSubArea(area) {
    var sub_area_upd = $('#sub_area_upd').val();
    $.ajax({
        url: 'requestFile/ajaxGetEnabledSubArea.php',
        type: 'post',
        data: { 'area': area },
        dataType: 'json',
        success: function (response) {

            $('#sub_area').empty();
            $('#sub_area').append("<option value='' >Select Sub Area</option>");
            for (var i = 0; i < response.length; i++) {
                var selected = '';
                if (sub_area_upd != undefined && sub_area_upd != '' && sub_area_upd == response[i]['sub_area_id']) {
                    selected = 'selected';
                }
                $('#sub_area').append("<option value='" + response[i]['sub_area_id'] + "' " + selected + ">" + response[i]['sub_area_name'] + " </option>");
            }
        }
    });
}

//Customer Feedback Modal 
function feedbackList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/customer_feedback_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#feedbackListTable").empty();
            $("#feedbackListTable").html(html);

            $("#feedback_label").val('');
            $("#cus_feedback").val('');
            $("#feedbackID").val('');
        }
    });
}
//Customer Feedback Modal End

//////////////////////////////////////////////////// Documentation  Start////////////////////////////////////////

//Get DOC id 
function getstaffCode() {
    let doc_Id = $('#doc_table_id').val();
    $.ajax({
        url: 'verificationFile/documentation/doc_id_autoGen.php',
        type: "post",
        dataType: "json",
        data: { "id": doc_Id },
        cache: false,
        success: function (response) {
            var docId = response;
            $('#doc_id').val(docId);
        }
    })
}

function endorseHolderName(){

    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#ownername_relationship_name").empty();
            $("#ownername_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#ownername_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#ownername_relationship_name option:first-child");
                $("#ownername_relationship_name").html($("#ownername_relationship_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#ownername_relationship_name").prepend(firstOption);
            }

        }
    });
}

function mortgageHolderName(){
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#Propertyholder_relationship_name").empty();
            $("#Propertyholder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#Propertyholder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#Propertyholder_relationship_name option:first-child");
                $("#Propertyholder_relationship_name").html($("#Propertyholder_relationship_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#Propertyholder_relationship_name").prepend(firstOption);
            }

        }
    });
}

function docHolderName(){
    let req_id = $('#req_id').val();

    $.ajax({
        url: 'verificationFile/verificationFam.php',
        type: 'post',
        data: { "reqId": req_id },
        dataType: 'json',
        success: function (response) {

            var len = response.length;
            $("#docholder_relationship_name").empty();
            $("#docholder_relationship_name").append("<option value=''>" + 'Select Holder Name' + "</option>");
            for (var i = 0; i < len; i++) {
                var fam_name = response[i]['fam_name'];
                var fam_id = response[i]['fam_id'];
                $("#docholder_relationship_name").append("<option value='" + fam_id + "'>" + fam_name + "</option>");
            }
            {//To Order ag_group Alphabetically
                var firstOption = $("#docholder_relationship_name option:first-child");
                $("#docholder_relationship_name").html($("#docholder_relationship_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#docholder_relationship_name").prepend(firstOption);
            }

        }
    });
}

// Signed Doc 
function resetsigninfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/documentation/signed_doc_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#signDocResetTable").empty();
            $("#signDocResetTable").html(html);
        }
    });
}

//Cheque Info List
function chequeinfoList() {
    let req_id = $('#req_id').val();
    $.ajax({
        url: 'verificationFile/documentation/cheque_info_list.php',
        type: 'POST',
        data: { "reqId": req_id },
        cache: false,
        success: function (html) {
            $("#ChequeResetTable").empty();
            $("#ChequeResetTable").html(html);
        }
    });
}

//Documentation Submit Validation
$('#submit_documentation').click(function () {
    doc_submit_validation();
});

function doc_submit_validation() {

    var mortgage_process = $('#mortgage_process').val(); var endorsement_process = $('#endorsement_process').val(); 
    var req_id = $('#req_id').val();
    var mortgage_name = $('#mortgage_name').val(); var mortgage_dsgn = $('#mortgage_dsgn').val(); var mortgage_nuumber = $('#mortgage_nuumber').val(); var reg_office = $('#reg_office').val(); var mortgage_value = $('#mortgage_value').val(); var mortgage_document = $('#mortgage_document').val();
    var vehicle_reg_no = $('#vehicle_reg_no').val();
    var endorsement_name = $('#endorsement_name').val(); var en_RC = $('#en_RC').val(); var en_Key = $('#en_Key').val();


    if (mortgage_process == '0') {
       
        if (mortgage_name == '') {
            event.preventDefault();
            $('#mortgagenameCheck').show();
        } else {
            $('#mortgagenameCheck').hide();
        }
        if (mortgage_dsgn == '') {
            event.preventDefault();
            $('#mortgagedsgnCheck').show();
        } else {
            $('#mortgagedsgnCheck').hide();
        }
        if (mortgage_nuumber == '') {
            event.preventDefault();
            $('#mortgagenumCheck').show();
        } else {
            $('#mortgagenumCheck').hide();
        }
        if (reg_office == '') {
            event.preventDefault();
            $('#regofficeCheck').show();
        } else {
            $('#regofficeCheck').hide();
        }
        if (mortgage_value == '') {
            event.preventDefault();
            $('#mortgagevalueCheck').show();
        } else {
            $('#mortgagevalueCheck').hide();
        }
        if (mortgage_document == '') {
            event.preventDefault();
            $('#mortgagedocCheck').show();
        } else {
            $('#mortgagedocCheck').hide();
        }
    }

    if (endorsement_process == '0') {

        if (vehicle_reg_no == '') {
            event.preventDefault();
            $('#vehicle_reg_noCheck').show();
        } else {
            $('#vehicle_reg_noCheck').hide();
        }
        if (endorsement_name == '') {
            event.preventDefault();
            $('#endorsementnameCheck').show();
        } else {
            $('#endorsementnameCheck').hide();
        }
        if (en_RC == '') {
            event.preventDefault();
            $('#enRCCheck').show();
        } else {
            $('#enRCCheck').hide();
        }
        if (en_Key == '') {
            event.preventDefault();
            $('#enKeyCheck').show();
        } else {
            $('#enKeyCheck').hide();
        }
    }

}
//////////////////////////////////////////////////// Documentation  END////////////////////////////////////////


//////////////////////////////////////////////////////////////////// Loan Calculation Functions Start ///////////////////////////////////////////////////////////////////////////////
function onLoadEditFunction(){//On load for Loan Calculation edit
    
}

$('#loan_category').change(function(){
    var loan_cat = $(this).val();
    getSubCategory(loan_cat);
})

$('#refresh_cal').click(function(){
    
    var profit_method = $('#profit_method').val(); // if profit method changes, due type is EMI
    if(profit_method == 'after_intrest'){
        getLoanAfterInterest();
    }else if(profit_method == 'pre_intrest'){
        getLoanPreInterest();
    }
    
    var due_type = $('#due_type').val(); //If Changes not found in profit method, calculate loan amt for monthly basis
    if(due_type == 'Interest'){
        getLoanInterest();
    }

    var due_method_scheme = $('#due_method_scheme').val();
    if(due_method_scheme == '1'){//Monthly scheme as 1
        getLoanMonthly();
    }else if(due_method_scheme == '2'){//Weekly scheme as 2
        getLoanWeekly();
    }else if(due_method_scheme == '3'){//Daily scheme as 3
        getLoanDaily();
    }
})

$('#submit_loan_calculation').click(function(){
    $('#refresh_cal').trigger('click'); //For calculate once again if user missed to refresh calculation

    loan_calc_validation(); 
})


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

//Fetch Loan category list Based on Agent
function getUserBasedLoanCategory(){
    var loan_category = $('#loan_category_load').val();
    var loan_category_upd = $('#loan_category_upd').val();
    $.ajax({
        url:'verificationFile/LoanCalculation/getUserBasedLoanCategory.php',
        data:{},
        dataType:'json',
        type:'post',
        cache:false,
        success:function(response){
            $('#loan_category').empty();
            $('#loan_category').append("<option value='' >Select Loan Category</option>");
            for(var i=0;i<response.length;i++){
                var selected = '';
                if(loan_category_upd == '' || loan_category_upd == undefined){ //if update is not available, then only use on load value of loan category
                    if(loan_category != undefined && loan_category != '' &&  loan_category == response[i]['loan_category_id']){
                        selected = 'selected';
                        getSubCategory(response[i]['loan_category_id']);
                    }
                }else{
                    if(loan_category_upd != undefined && loan_category_upd != '' &&  loan_category_upd == response[i]['loan_category_id']){
                        selected = 'selected';
                        getSubCategory(response[i]['loan_category_id']);
                    }
                }
                
                $('#loan_category').append("<option value='"+response[i]['loan_category_id']+"' "+selected+" >"+response[i]['loan_category_name']+" </option>");
            }
            ;
        }
    })
}

//Fetch Sub Category Based on loan category
function getSubCategory(loan_cat){
	var sub_category = $('#sub_category_load').val();
	var sub_categoryu_upd = $('#sub_category_upd').val();
	$.ajax({
		url: 'requestFile/getSingleSubCategory.php',
		type:'POST',
		dataType:'json',
		cache: false,
		data:{'loan_cat':loan_cat},
		success: function(response){

			$('#sub_category').empty();
            $('#sub_category').append("<option value='' >Select Sub Category</option>");
            for(var i=0;i<response.length;i++){
                var selected='';
                if(sub_categoryu_upd == '' || sub_categoryu_upd == undefined){ //if update is not available, then only use on load value of loan category
                    if(sub_category != undefined && sub_category != '' && sub_category == response[i]['sub_category_name']){
                        selected ='selected';
                    }
                }else{
                    if(sub_categoryu_upd != undefined && sub_categoryu_upd != '' && sub_categoryu_upd == response[i]['sub_category_name']){
                        selected ='selected';
                    }
                }
                $('#sub_category').append("<option value='"+response[i]['sub_category_name']+"' "+selected+">"+response[i]['sub_category_name']+" </option>");
            }
		}
	})
}

//Get Category info From Request
function getCategoryInfo(){
    var sub_category_upd = $('#sub_category_upd').val();
    var sub_cat = $('#sub_category').val();
    $.ajax({
        url:'requestFile/getCategoryInfo.php',
        data:{'sub_cat':sub_cat},
        dataType:'json',
        type:'post',
        cache:false,
        success:function(response){
            category_info=''
            $('#moduleTable').empty();
            $('#moduleTable').append('<tbody><tr>');
            if(response.length != 0){
                var tb = 35;
                for(var i=0;i<response.length;i++){
                    $('#moduleTable tbody tr').append( `<td><label for="disabledInput">`+response[i]['loan_category_ref_name']+`</label><span class="required">&nbsp;*</span><input type="text" class="form-control" id="category_info" name="category_info[]" 
                    value='`+category_info+`' tabindex='`+tb+`' required placeholder='Enter `+response[i]['loan_category_ref_name']+`'></td>`);
                    tb++;
                }
                $('#moduleTable tbody tr').append(`<td><button type="button" tabindex='`+tb+`' id="add_category_info[]" name="add_category_info" 
                class="btn btn-primary add_category_info">Add</button> </td><td><span class='icon-trash-2 deleterow' id='deleterow' tabindex='`+tb+`'></span></td>
                </tr></tbody></table>`);

                var category_content = $('#moduleTable tbody tr').html(); //To get the appended category list
                
                var category_count = $('#moduleTable tbody tr').find('td').length - 2;//To find input fields count
                getCategoryInputs(category_count,category_content,sub_category_upd);

                $(document).on('click','.add_category_info', function(){
                    $('#moduleTable tbody').append('<tr>'+category_content+'</tr>');
                    // $('#moduleTable tbody tr:last input').filter(':last').val('');
                });

                // remove delete option for last child
                $('#deleterow:last').filter(':last').removeClass('deleterow');

                $(document).on('click','.deleterow',function(){
                    $(this).parent().parent().remove();
                });

            }
        }
    });
    
    
    function getCategoryInputs(category_count,category_content,sub_category_upd){
        
        var req_id = $('#req_id').val();
        $.ajax({
            url:'verificationFile/LoanCalculation/getCategoryInfo.php',
            data:{'req_id':req_id,'sub_category_upd':sub_category_upd},
            dataType: 'json',
            type: 'post',
            cachec: false,
            success: function(response){
                var trCount = Math.ceil(response.length / category_count); // number of rows needed
                
                for(var j =0;j<trCount-1;j++){
                    $('#moduleTable tbody').append('<tr>'+category_content+'</tr>');
                    // $('#moduleTable tbody tr:last input').filter(':last').val('');
                }
                for(var i=0;i<response.length;i++){
                    $('#moduleTable tbody input').each(function(index){
                        $(this).val(response[index]);
                    });
                }
            }
        })
    }

}

//Get New Category Info
$('#sub_category').change(function(){
    var sub_cat = $(this).val();
    $.ajax({
        url:'requestFile/getCategoryInfo.php',
        data:{'sub_cat':sub_cat},
        dataType:'json',
        type:'post',
        cache:false,
        success:function(response){
            $('#moduleTable').empty();
            $('#moduleTable').prepend('<tbody><tr>');
            if(response.length != 0){
                var tb = 35;
                for(var i=0;i<response.length;i++){
                    $('#moduleTable tbody tr').append( `<td><label for="disabledInput">`+response[i]['loan_category_ref_name']+`</label><span class="required">&nbsp;*</span><input type="text" class="form-control" id="category_info" name="category_info[]" 
                    value='' tabindex='`+tb+`' required placeholder='Enter `+response[i]['loan_category_ref_name']+`'></td>`);
                    $('.category_info').show();
                    tb++;
                    
                    
                }
                $('#moduleTable tbody tr').append(`<td><button type="button" tabindex='`+tb+`' id="add_category_info[]" name="add_category_info" 
                class="btn btn-primary add_category_info">Add</button> </td><td><span class='icon-trash-2 deleterow' id='deleterow' tabindex='`+tb+`'></span></td>
                </tr></tbody>`);
                
                category_content = $('#moduleTable tbody').html(); //To get the appended category list
                
                // unbind the event handler
                $(document).off('click', '.add_category_info');
                $(document).on('click','.add_category_info', function(){
                        console.log(category_content)
                        $('#moduleTable tbody').append(category_content);
                });

                // remove delete option for last child
                $('#deleterow:last').filter(':last').removeClass('deleterow');

                // unbind the event handler
                $(document).off('click', '.deleterow');
                $(document).on('click','.deleterow',function(){
                        $(this).parent().parent().remove();
                });
            }else{
                $('.category_info').hide();
            }
        }
    })
    $('#tot_value').val('');$('#ad_amt').val('');$('#loan_amt').val('');
    getLoaninfo(sub_cat);
})

//Fetch loan Details based on category select
function getLoaninfo(sub_cat_id){
	
    $.ajax({
        url:'requestFile/getLoanInfo.php',
        data: {'sub_cat_id':sub_cat_id},
        dataType:'json',
        type:'post',
        cache:false,
        success:function(response){
            if(response['advance'] == 'Yes'){
                $('.advance_yes').show();
                $('#loan_amt').attr('readonly', true);

                $('#tot_value').unbind('blur').blur(function(){// to calculate loan amount ant advance percentage
                    var amt = $('#tot_value').val();
                    var advance = $('#ad_amt').val();
                    var loan_amt = parseInt(amt) - parseInt(advance);
            
                    if(amt <=  parseInt(response['loan_limit'])){
                        if(loan_amt != NaN){
                            $('#loan_amt').val(loan_amt.toFixed(0));
                        }
                    }else{
                        alert('Please Enter Lesser amount!');
                        $('#tot_value').val('');
                        $('#loan_amt').val('');
                    }
                })
            
                $('#ad_amt').unbind('blur').blur(function(){//To calculate loan amount and advance percentage
                    var amt = $('#tot_value').val();
                    var advance = $('#ad_amt').val();
                    var loan_amt = amt - advance;
                    $('#loan_amt').val(loan_amt.toFixed(0));
                });

            }else{
                $('.advance_yes').hide();
                $('#loan_amt').removeAttr('readonly');
                $('#loan_amt').unbind('blur').blur(function(){// to calculate loan amount ant advance percentage
                    var loan_amt = $(this).val();
            
                    if(loan_amt <=  parseInt(response['loan_limit'])){
                        $('#loan_amt').val(loan_amt.toFixed(0));
                    }else{
                        alert('Please Enter Lesser amount!');
                        $('#loan_amt').val('');
                    }
                })
            }
        }
    })
}

//to fetch Calculation based inputs
function profitCalculationInfo(){
    var sub_cat = $('#sub_category').val();
    var profit_type = $('#profit_type').val();
    var due_method = $('#due_method_scheme').val(); 
    if(profit_type!=''){ //Call only if profit type autamatically set
        profitCalAjax(profit_type,sub_cat); //Call for edit
    }
    if(due_method !=''){//Call only if due method autamatically set
        schemeAjax(due_method,sub_cat); //Call for edit
    }
    setTimeout(function(){
    var scheme_name = $('#scheme_name').val(); 
        if(scheme_name !=''){//Call only if scheme name autamatically set
            schemeCalAjax(scheme_name); //Call for edit
        }
    },1000)

    $('#profit_type').change(function(){//On change evemt
            
            $('.calculation').hide(); // to hide calculation inputs
            $('.scheme').hide();// to hide Scheme inputs
            $('.emi-calculation').hide(); // to hide calculation inputs
            $('.interest-calculation').hide(); // to hide calculation inputs
            $('#profit_method').empty(); // to empty calculation inputs
            $('#calc_method').val(''); // to empty calculation inputs
            
            $('#due_method_scheme').val(''); // to clear due method selection 
            $('.day_scheme').hide(); // to Hide day shceme
            $('#day_scheme').val(''); // to clear day scheme selection 
            $('#scheme_name').val(''); // to clear scheme name selection 
            
            $('#int_rate').val('');$('#int_rate').attr('readonly',false);
            $('#due_period').val('');$('#due_period').attr('readonly',false);
            $('.min-max-int').text('*');
            $('.min-max-due').text('*');
            $('.min-max-doc').text('*');
            $('.min-max-proc').text('*');
            
        var profit_type = $(this).val();
        var sub_cat = $('#sub_category').val();
        profitCalAjax(profit_type,sub_cat)
        
    });//Profit Type change event end

    $('#due_method_scheme').change(function(){
        var due_method = $(this).val(); 
        
        if(due_method == '2'){ // show weekdays only if weekly due method selected
            $('.day_scheme').show();
        }else{
            $('.day_scheme').hide();
        }

        var sub_cat = $('#sub_category').val();
        schemeAjax(due_method,sub_cat);

        $('#int_rate').val('');$('#int_rate').attr('readonly',false);
        $('#due_period').val('');$('#due_period').attr('readonly',false);
        $('.min-max-int').text('*');
        $('.min-max-due').text('*');
        $('.min-max-doc').text('*');
        $('.min-max-proc').text('*');
    });

    $('#scheme_name').change(function(){ //Scheme Name change event
        var scheme_id = $(this).val();
        schemeCalAjax(scheme_id);
    })
}

//
function profitCalAjax(profit_type,sub_cat){
    var profit_method_upd = $('#profit_method_upd').val()
    if($('#int_rate_upd').val()){var int_rate_upd = $('#int_rate_upd').val();}else{var int_rate_upd = '';}
    if($('#due_period_upd').val()){var due_period_upd = $('#due_period_upd').val();}else{var due_period_upd = '';}
    if($('#doc_charge_upd').val()){var doc_charge_upd = $('#doc_charge_upd').val();}else{var doc_charge_upd = '';}
    if($('#proc_fee_upd').val()){var proc_fee_upd = $('#proc_fee_upd').val();}else{var proc_fee_upd = '';}
    if(profit_type == '1'){//if Calculation selected
        $('.calculation').show();
        $('.scheme').hide();
        $.ajax({ // To show profit calculation infos based on sub category
            url: 'verificationFile/LoanCalculation/getProfitCalculationInfo.php',
            data: {'sub_cat':sub_cat},
            dataType: 'json',
            type: 'post',
            cache: false,
            success: function(response){
                if(response['due_type'] == 'emi'){
                    $('.emi-calculation').show();
                    $('.interest-calculation').hide();
                    $('#due_type').val('EMI');
                    
                    var profit_method = response['profit_method'].split(','); //Splitting into array by exploding comma (',')
                    $('#profit_method').empty();
                    $('#profit_method').append(`<option value=''>Select Profit Method</option>`);
                    for(var i =0 ; i<profit_method.length;i++){
                        if(profit_method[i] == 'pre_intrest'){valuee = 'Pre Interest';}else if(profit_method[i] == 'after_intrest'){valuee = 'After Interest';}
                        var selected= '';
                        if(profit_method_upd != '' && profit_method_upd != undefined && profit_method_upd == profit_method[i]){
                            selected = 'selected';
                        }
                        $('#profit_method').append(`<option value='`+profit_method[i]+`' `+selected+`>`+valuee+`</option>`);
                    }
                    $('#calc_method').val('');

                    //To set min and maximum 
                    $('.min-max-int').text('* ('+response['intrest_rate_min']+'% - '+response['intrest_rate_max']+'%) ');
                    $('#int_rate').attr('onBlur',`if( parseFloat($(this).val()) > '`+response['intrest_rate_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+response['intrest_rate_min']+`' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#int_rate').val(int_rate_upd);
                    $('.min-max-due').text('* ('+response['due_period_min']+' - '+response['due_period_max']+') ');
                    $('#due_period').attr('onBlur',`if( parseInt($(this).val()) > '`+response['due_period_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseInt($(this).val()) < '`+response['due_period_min']+`' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#due_period').val(due_period_upd);
                    
                    $('.min-max-doc').text('* ('+response['document_charge_min']+'% - '+response['document_charge_max']+'%) ');
                    $('#doc_charge').attr('onBlur',`if( parseFloat($(this).val()) > '`+response['document_charge_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+response['document_charge_min']+`' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#doc_charge').val(doc_charge_upd);

                    $('.min-max-proc').text('* ('+response['processing_fee_min']+'% - '+response['processing_fee_max']+'%) ');
                    $('#proc_fee').attr('onBlur',`if( parseFloat($(this).val()) > '`+response['processing_fee_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+response['processing_fee_min']+`' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#proc_fee').val(proc_fee_upd);

                }else if(response['due_type'] == 'intrest'){
                    
                    $('.emi-calculation').hide();
                    $('.interest-calculation').show();
                    $('#due_type').val('Interest');
                    $('#profit_method').empty();
                    $('#calc_method').val(response['calculate_method']);

                    //To set min and maximum 
                    $('.min-max-int').text('* ('+response['intrest_rate_min']+'% - '+response['intrest_rate_max']+'%) ');
                    $('#int_rate').attr('onBlur',`if( parseFloat($(this).val()) > '`+response['intrest_rate_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+response['intrest_rate_min']+`' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#int_rate').val(int_rate_upd);
                    
                    $('.min-max-due').text('* ('+response['due_period_min']+' - '+response['due_period_max']+') ');
                    $('#due_period').attr('onBlur',`if( parseInt($(this).val()) > '`+response['due_period_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseInt($(this).val()) < '`+response['due_period_min']+`' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#due_period').val(due_period_upd);
                    
                    $('.min-max-doc').text('* ('+response['document_charge_min']+'% - '+response['document_charge_max']+'%) ');
                    $('#doc_charge').attr('onBlur',`if( parseFloat($(this).val()) > '`+response['document_charge_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+response['document_charge_min']+`' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#doc_charge').val(doc_charge_upd);

                    $('.min-max-proc').text('* ('+response['processing_fee_min']+'% - '+response['processing_fee_max']+'%) ');
                    $('#proc_fee').attr('onBlur',`if( parseFloat($(this).val()) > '`+response['processing_fee_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseFloat($(this).val()) < '`+response['processing_fee_min']+`' && parseFloat($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                    $('#proc_fee').val(proc_fee_upd);
                }
            }
        })
    }else if(profit_type == '2'){ //if Scheme selected
        $('.calculation').hide(); // to hide calculation inputs
        $('.scheme').show(); // to show scheme inputs
    }else{
        $('.calculation').hide(); // to hide calculation inputs
        $('.scheme').hide(); // to hide scheme inputs
    }
}

//
function schemeAjax(due_method,sub_cat){
    var scheme_upd = $('#scheme_upd').val();
    $.ajax({ //To show scheme names based on sub category
        url: 'verificationFile/LoanCalculation/getSchemeNames.php',
        data: {'sub_cat':sub_cat,'due_method':due_method},
        dataType: 'json',
        type: 'post',
        cache: false,
        success: function(response){
            $('#scheme_name').empty();
            $('#scheme_name').append(`<option value=''>Select Scheme Name</option>`);
            for(var i =0 ; i<response.length;i++){
                var selected='';
                if(scheme_upd != '' && scheme_upd != undefined && scheme_upd == response[i]['scheme_id']){
                    selected = 'selected';
                }
                $('#scheme_name').append(`<option value='`+response[i]['scheme_id']+`' `+selected+`>`+response[i]['scheme_name']+`</option>`);
            }
        }
    });
}

//
function schemeCalAjax(scheme_id){
    if(scheme_id != ''){
        if($('#int_rate_upd').val()){var int_rate_upd = $('#int_rate_upd').val();}else{var int_rate_upd = '';}
        if($('#due_period_upd').val()){var due_period_upd = $('#due_period_upd').val();}else{var due_period_upd = '';}
        if($('#doc_charge_upd').val()){var doc_charge_upd = $('#doc_charge_upd').val();}else{var doc_charge_upd = '';}
        if($('#proc_fee_upd').val()){var proc_fee_upd = $('#proc_fee_upd').val();}else{var proc_fee_upd = '';}

        $.ajax({ //show scheme based loan info using scheme id
            url: 'verificationFile/LoanCalculation/getSchemeDetails.php',
            dataType: 'json',
            type: 'post',
            data: {'scheme_id':scheme_id},
            cache: false,
            success: function(response){
                //To set min and maximum 
                
                $('#int_rate').val(response['intrest_rate']);$('#int_rate').attr('readonly',true); // setting readonly due to fixed interest
                
                $('#due_period').val(response['due_period']);$('#due_period').attr('readonly',true); // setting readonly due to fixed due period
                
                if(response['doc_charge_type'] == 'amt') {type = '₹'}else if(response['doc_charge_type'] == 'percentage'){type='%';} //Setting symbols
                $('.min-max-doc').text('* ('+response['doc_charge_min'] +' '+type+' - '+response['doc_charge_max']+' '+type+') '); //setting min max values in span
                $('#doc_charge').attr('onBlur',`if( parseInt($(this).val()) > '`+response['doc_charge_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                        if( parseInt($(this).val()) < '`+response['doc_charge_min']+`' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                $('#doc_charge').val(doc_charge_upd);
                
                if(response['proc_fee_type'] == 'amt') {type = '₹'}else if(response['proc_fee_type'] == 'percentage'){type='%';}//Setting symbols
                $('.min-max-proc').text('* ('+response['proc_fee_min']+' '+type+' - '+response['proc_fee_max']+' '+type+') ');//setting min max values in span
                $('#proc_fee').attr('onBlur',`if( parseInt($(this).val()) > '`+response['proc_fee_max']+`' ){ alert("Enter Lesser Value"); $(this).val(""); }else
                                    if( parseInt($(this).val()) < '`+response['proc_fee_min']+`' && parseInt($(this).val()) != '' ){ alert("Enter Higher Value"); $(this).val(""); } `); //To check value between rage
                $('#proc_fee').val(doc_charge_upd);
            }
        })
    }else{
        $('#int_rate').val('');$('#int_rate').attr('readonly',false);
        $('#due_period').val('');$('#due_period').attr('readonly',false);
        $('.min-max-int').text('*');
        $('.min-max-due').text('*');
        $('.min-max-doc').text('*');
        $('.min-max-proc').text('*');
    }
}

//To Get Loan Calculation for After Interest
function getLoanAfterInterest(){
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();
    $('#loan_amt_cal').val(loan_amt); //get loan amt from loan info card
    $('#principal_amt_cal').val(loan_amt); // principal amt as same as loan amt for after interest

    var interest_rate = parseInt(loan_amt) * (parseFloat(int_rate)/100) * parseInt(due_period); //Calculate interest rate 
    $('#int_amt_cal').val(interest_rate);

    var tot_amt = parseInt(loan_amt) + parseFloat(interest_rate); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(tot_amt);

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(due_amt);

    var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    $('#doc_charge_cal').val(doc_charge);

    var proc_fee = parseInt(loan_amt) * (parseFloat(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    $('#proc_fee_cal').val(proc_fee);

    var net_cash = parseInt(loan_amt) - parseFloat(doc_charge) - parseFloat(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(net_cash);
}

//To Get Loan Calculation for Pre Interest
function getLoanPreInterest(){
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();
    $('#loan_amt_cal').val(loan_amt); //get loan amt from loan info card
    
    
    var int_amt = parseInt(loan_amt) * (parseFloat(int_rate)/100) * parseInt(due_period); //Calculate interest rate 
    $('#int_amt_cal').val(int_amt);
    
    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(princ_amt); 

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(tot_amt);

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(due_amt);

    var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    $('#doc_charge_cal').val(doc_charge);

    var proc_fee = parseInt(loan_amt) * (parseFloat(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    $('#proc_fee_cal').val(proc_fee);

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(net_cash);
}

//To Get Loan Calculation for Interest due type
function getLoanInterest(){
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(loan_amt); //get loan amt from loan info card
    $('#principal_amt_cal').val(loan_amt); 
    
    $('#tot_amt_cal').val('');
    $('#due_amt_cal').val('');//Due period will be monthly by default so no need of due amt
    
    var int_amt = parseInt(loan_amt) * (parseFloat(int_rate)/100) ; //Calculate interest rate 
    $('#int_amt_cal').val(int_amt);
    
    var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    $('#doc_charge_cal').val(doc_charge);

    var proc_fee = parseInt(loan_amt) * (parseFloat(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    $('#proc_fee_cal').val(proc_fee);

    var net_cash = parseInt(loan_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(net_cash);
}

//To Get Loan Calculation for Monthly Scheme method
function getLoanMonthly(){ 
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(loan_amt); //get loan amt from loan info card
    
    var int_amt = parseInt(loan_amt) * (parseFloat(int_rate)/100) ; //Calculate interest rate 
    $('#int_amt_cal').val(int_amt);

    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(princ_amt); 

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(tot_amt);

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(due_amt);
    
    var doc_type = $('.min-max-doc').text(); //Scheme may have document charge in rupees or percentage . so getting symbol from span
    if(doc_type.includes('₹')){
        var doc_charge = parseInt(doc_charge) ; //Get document charge from loan info and directly show the document charge provided because of it is in rupees
    }else if(doc_type.includes('%')){
        var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    }
    $('#doc_charge_cal').val(doc_charge);

    var proc_type = $('.min-max-proc').text(); //Scheme may have Processing fee in rupees or percentage . so getting symbol from span
    if(proc_type.includes('₹')){
        var proc_fee =parseInt(proc_fee);//Get processing fee from loan info and directly show the Processing Fee provided because of it is in rupees
    }else if(proc_type.includes('%')){
        var proc_fee = parseInt(loan_amt) * (parseInt(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    }
    $('#proc_fee_cal').val(proc_fee);

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(net_cash);
}

//To Get Loan Calculation for Weekly Scheme method
function getLoanWeekly(){ 
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(loan_amt); //get loan amt from loan info card
    
    var int_amt = parseInt(loan_amt) * (parseFloat(int_rate)/100) ; //Calculate interest rate 
    $('#int_amt_cal').val(int_amt);

    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(princ_amt); 

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(tot_amt);

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(due_amt);
    
    var doc_type = $('.min-max-doc').text(); //Scheme may have document charge in rupees or percentage . so getting symbol from span
    if(doc_type.includes('₹')){ 
        var doc_charge = parseInt(doc_charge) ; //Get document charge from loan info and directly show the document charge provided because of it is in rupees
    }else if(doc_type.includes('%')){
        var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    }
    $('#doc_charge_cal').val(doc_charge);

    var proc_type = $('.min-max-proc').text();//Scheme may have Processing fee in rupees or percentage . so getting symbol from span
    if(proc_type.includes('₹')){
        var proc_fee =parseInt(proc_fee);//Get processing fee from loan info and directly show the Processing Fee provided because of it is in rupees
    }else if(proc_type.includes('%')){
        var proc_fee = parseInt(loan_amt) * (parseInt(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    }
    $('#proc_fee_cal').val(proc_fee);

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(net_cash);
}

//To Get Loan Calculation for Daily Scheme method
function getLoanDaily(){ 
    var loan_amt = $('#loan_amt').val();
    var int_rate = $('#int_rate').val();
    var due_period = $('#due_period').val();
    var doc_charge = $('#doc_charge').val();
    var proc_fee = $('#proc_fee').val();

    $('#loan_amt_cal').val(loan_amt); //get loan amt from loan info card
    
    var int_amt = parseInt(loan_amt) * (parseFloat(int_rate)/100) ; //Calculate interest rate 
    $('#int_amt_cal').val(int_amt);

    var princ_amt = parseInt(loan_amt) - parseInt(int_amt); // Calculate principal amt by subracting interest amt from loan amt
    $('#principal_amt_cal').val(princ_amt); 

    var tot_amt = parseInt(princ_amt) + parseFloat(int_amt); //Calculate total amount from principal/loan amt and interest rate
    $('#tot_amt_cal').val(tot_amt);

    var due_amt = parseInt(tot_amt) / parseInt(due_period);//To calculate due amt by dividing total amount and due period given on loan info
    $('#due_amt_cal').val(due_amt);
    
    var doc_type = $('.min-max-doc').text(); //Scheme may have document charge in rupees or percentage . so getting symbol from span
    if(doc_type.includes('₹')){ 
        var doc_charge = parseInt(doc_charge) ; //Get document charge from loan info and directly show the document charge provided because of it is in rupees
    }else if(doc_type.includes('%')){
        var doc_charge = parseInt(loan_amt) * (parseFloat(doc_charge)/100) ; //Get document charge from loan info and multiply with loan amt to get actual doc charge
    }
    $('#doc_charge_cal').val(doc_charge);

    var proc_type = $('.min-max-proc').text();//Scheme may have Processing fee in rupees or percentage . so getting symbol from span
    if(proc_type.includes('₹')){
        var proc_fee =parseInt(proc_fee);//Get processing fee from loan info and directly show the Processing Fee provided because of it is in rupees
    }else if(proc_type.includes('%')){
        var proc_fee = parseInt(loan_amt) * (parseInt(proc_fee)/100);//Get processing fee from loan info and multiply with loan amt to get actual proc fee
    }
    $('#proc_fee_cal').val(proc_fee);

    var net_cash = parseInt(princ_amt) - parseInt(doc_charge) - parseInt(proc_fee) ; //Net cash will be calculated by subracting other charges
    $('#net_cash_cal').val(net_cash);
}

//Validation for Loan calculation
function loan_calc_validation(){
    var cus_id_loan = $('#cus_id_loan').val(); //if this is empty means , customer profile is not submitted yet
    var loan_category = $('#loan_category').val(); var sub_category = $('#sub_category').val();var tot_value = $('#tot_value').val();var ad_amt = $('#ad_amt').val();
    var loan_amt = $('#loan_amt').val();var due_type = $('#due_type').val();
    var profit_type = $('#profit_type').val();var due_method_scheme = $('#due_method_scheme').val();var day_scheme = $('#day_scheme').val(); var scheme_name = $('#scheme_name').val();
    var profit_method= $('#profit_method').val();var int_rate= $('#int_rate').val(); var due_period =$('#due_period').val(); var doc_charge = $('#doc_charge').val(); 
    var proc_fee = $('#proc_fee').val();var loan_amt_cal = $('#loan_amt_cal').val(); var principal_amt_cal = $('#principal_amt_cal').val(); var int_amt_cal = $('#int_amt_cal').val();
    var tot_amt_cal = $('#tot_amt_cal').val(); var due_amt_cal = $('#due_amt_cal').val(); var doc_charge_cal = $('#doc_charge_cal').val();var proc_fee_cal =$('#proc_fee_cal').val();
    var net_cash_cal =$('#net_cash_cal').val();var due_start_from = $('#due_start_from').val(); var maturity_month =$('#maturity_month').val();var collection_method = $('#collection_method').val();

    if(cus_id_loan == ''){
        Swal.fire({
            timerProgressBar: true,
            timer: 2000,
            title: 'Please Complete Customer Profile!',
            icon: 'error',
            showConfirmButton: true,
            confirmButtonColor: '#009688'
        });
        event.preventDefault();
    }

    if(loan_category == ''){
        $('#loancategoryCheck').show();
        event.preventDefault();
    }else{
        $('#loancategoryCheck').hide();
    }

    if(sub_category == ''){
        $('#subcategoryCheck').show();
        event.preventDefault();
    }else{
        $('#subcategoryCheck').hide();
    }

    if(tot_value == '' && $('.advance_yes').css('display') != "none"){
        $('#total_valueCheck').show();
        event.preventDefault();
    }else{
        $('#total_valueCheck').hide();
    }

    if(ad_amt == '' && $('.advance_yes').css('display') != "none"){
        $('#ad_amtCheck').show();
        event.preventDefault();
    }else{
        $('#ad_amtCheck').hide();
    }
    
    if(loan_amt == '' ){
        $('#loan_amtCheck').show();
        event.preventDefault();
    }else{
        $('#loan_amtCheck').hide();
    }
    
    if(profit_type == '' ){
        $('#profit_typeCheck').show();
        event.preventDefault();
    }else{
        $('#profit_typeCheck').hide();
    }
    
    if(profit_method == '' && due_type == 'EMI'){
        $('#profit_methodCheck').show();
        event.preventDefault();
    }else{
        $('#profit_methodCheck').hide();
    }
    
    if(due_method_scheme == '' && $('.scheme').css('display') != 'none'){
        $('#due_method_schemeCheck').show();
        event.preventDefault();
    }else{
        $('#due_method_schemeCheck').hide();
    }
    
    if(day_scheme == '' && $('.day_scheme').css('display') != 'none'){
        $('#day_schemeCheck').show();
        event.preventDefault();
    }else{
        $('#day_schemeCheck').hide();
    }
    
    if(scheme_name == '' && $('.scheme').css('display') != 'none'){
        $('#scheme_nameCheck').show();
        event.preventDefault();
    }else{
        $('#scheme_nameCheck').hide();
    }
    
    if(int_rate == '' ){
        $('#int_rateCheck').show();
        event.preventDefault();
    }else{
        $('#int_rateCheck').hide();
    }
    
    if(due_period == '' ){
        $('#due_periodCheck').show();
        event.preventDefault();
    }else{
        $('#due_periodCheck').hide();
    }
    
    if(doc_charge == '' ){
        $('#doc_chargeCheck').show();
        event.preventDefault();
    }else{
        $('#doc_chargeCheck').hide();
    }
    
    if(proc_fee == '' ){
        $('#proc_feeCheck').show();
        event.preventDefault();
    }else{
        $('#proc_feeCheck').hide();
    }
    
    if(due_start_from == '' ){
        $('#due_start_fromCheck').show();
        event.preventDefault();
    }else{
        $('#due_start_fromCheck').hide();
    }
    
    if(maturity_month == '' ){
        $('#maturity_monthCheck').show();
        event.preventDefault();
    }else{
        $('#maturity_monthCheck').hide();
    }
    
    if(collection_method == '' ){
        $('#collection_methodCheck').show();
        event.preventDefault();
    }else{
        $('#collection_methodCheck').hide();
    }
    
    
    
}

//////////////////////////////////////////////////////////////////// Loan Calculation Functions End ///////////////////////////////////////////////////////////////////////////////
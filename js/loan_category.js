// Document is ready
$(document).ready(function () {

// remove delete option for last child
$('#delete_row:last').filter(':last').removeClass("deleterow");

{//To Order Alphabetically
    var firstOption = $("#loan_category_name option:first-child");
    $("#loan_category_name").html($("#loan_category_name option:not(:first-child)").sort(function (a, b) {
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
    }));
    $("#loan_category_name").prepend(firstOption);
}

 // Modal Box for Category Name
 $("#loancategorynameCheck").hide();
 $(document).on("click", "#submitLoanCategoryModal", function () {
     var loan_category_creation_id=$("#loan_category_creation_id").val();
     var loan_category_creation_name=$("#loan_category_creation_name").val();
     if(loan_category_creation_name!=""){
         $.ajax({
             url: 'loancategoryFile/ajaxInsertLoanCategory.php',
             type: 'POST',
             data: {"loan_category_creation_name":loan_category_creation_name,"loan_category_creation_id":loan_category_creation_id},
             cache: false,
             success:function(response){
                 var insresult = response.includes("Exists");
                 var updresult = response.includes("Updated");
                 if(insresult){
                     $('#categoryInsertNotOk').show(); 
                     setTimeout(function() {
                         $('#categoryInsertNotOk').fadeOut('fast');
                     }, 2000);
                 }else if(updresult){
                     $('#categoryUpdateOk').show();  
                     setTimeout(function() {
                         $('#categoryUpdateOk').fadeOut('fast');
                     }, 2000);
                     $("#coursecategoryTable").remove();
                     resetloancategoryTable();
                     $("#loan_category_creation_name").val('');
                     $("#loan_category_creation_id").val('');
                 }
                 else{
                     $('#categoryInsertOk').show();  
                     setTimeout(function() {
                         $('#categoryInsertOk').fadeOut('fast');
                     }, 2000);
                     $("#coursecategoryTable").remove();
                     resetloancategoryTable();
                     $("#loan_category_creation_name").val('');
                     $("#loan_category_creation_id").val('');
                 }
             }
         });
     }
     else{
     $("#loancategorynameCheck").show();
     }
 });


 function resetloancategoryTable(){
 $.ajax({
     url: 'loancategoryFile/ajaxResetLoanCategoryTable.php',
     type: 'POST',
     data: {},
     cache: false,
     success:function(html){
         $("#updatedloancategoryTable").empty();
         $("#updatedloancategoryTable").html(html);
     }
 });
 }

  $("#loan_category_creation_name").keyup(function(){
      var CTval = $("#loan_category_creation_name").val();
      if(CTval.length == ''){
      $("#loancategorynameCheck").show();
      return false;
      }else{
      $("#loancategorynameCheck").hide();
      }
  });

  $("body").on("click","#edit_category",function(){
      var loan_category_creation_id=$(this).attr('value');
      $("#loan_category_creation_id").val(loan_category_creation_id);
      $.ajax({
              url: 'loancategoryFile/ajaxEditLoanCategory.php',
              type: 'POST',
              data: {"loan_category_creation_id":loan_category_creation_id},
              cache: false,
              success:function(response){
              $("#loan_category_creation_name").val(response);
          }
      });
  });

$("body").on("click","#delete_category", function(){
  var isok=confirm("Do you want delete course category?");
  if(isok==false){
    return false;
  }else{
      var loan_category_creation_id=$(this).attr('value');
      var c_obj = $(this).parents("tr");
      $.ajax({
          url: 'loancategoryFile/ajaxDeleteLoanCategory.php',
          type: 'POST',
          data: {"loan_category_creation_id":loan_category_creation_id},
          cache: false,
          success:function(response){
              var delresult = response.includes("Rights");
              if(delresult){
              $('#categoryDeleteNotOk').show(); 
              setTimeout(function() {
              $('#categoryDeleteNotOk').fadeOut('fast');
              }, 2000);
              }
              else{
              c_obj.remove();
              $('#categoryDeleteOk').show();  
              setTimeout(function() {
              $('#categoryDeleteOk').fadeOut('fast');
              }, 2000);
              }
          }
      });
  }
});

$(function(){
    $('#coursecategoryTable').DataTable({
        'processing': true,
        'iDisplayLength': 5,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "createdRow": function(row, data, dataIndex) {
            $(row).find('td:first').html(dataIndex + 1);
        },
        "drawCallback": function(settings) {
            this.api().column(0).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        },
    });
});


 // add module 
$(document).on("click", '.add_category_ref', function () { 

    validateLoanCategoryTable();

    if(loanCategoryTableError == true){    
        var appendTxt = "<tr><td><input type='text' tabindex='13' class='chosen-select form-control loan_category_ref_name' id='loan_category_ref_name' name='loan_category_ref_name[]' /></td>" +
        "<td><button type='button' tabindex='26' id='add_category_ref' name='add_category_ref' value='Submit' class='btn btn-primary add_category_ref'>Add</button></td>" +
        "<td><span class='deleterow icon-trash-2' tabindex='18'></span></td>"+
        "</tr>";
    } 
    else 
    {
        return false;
    }

    $('#moduleTable').find('tbody').append(appendTxt);
});

// Delete unwanted Rows
$(document).on("click", '.deleterow', function () {
    $(this).parent().parent().remove();
});

 // Validate loan category
 $('#loanCategoryCheck').hide();	
 let loancategoryError = true;
 $('#loan_category_name').change(function () {	
     validateLoanCategory();
 });
 function validateLoanCategory() {
     let loancategoryValue = $('#loan_category_name').val();	
     if (loancategoryValue.length == '') {
         $('#loanCategoryCheck').show();
         loancategoryError = false;
         return false;
     }
     else {
         $('#loanCategoryCheck').hide();
         loancategoryError = true;	
     }
 }

 // Validate loan category
 $('#subCategoryCheck').hide();	
 let subcategoryError = true;
 $('#sub_category_name').change(function () {	
     ValidateSubCategory();
 });
 function ValidateSubCategory() {
     let sub_category_name = $('#sub_category_name').val();	
     if (sub_category_name.length == '') {
         $('#subCategoryCheck').show();
         subcategoryError = false;
         return false;
     }
     else {
         $('#subCategoryCheck').hide();
         subcategoryError = true;	
     }
 }
 
$('#loanCategoryTableCheck').hide();	
let loanCategoryTableError = true;
function validateLoanCategoryTable(){ 
  var currentrow = $("#moduleTable tr").last();
  if (currentrow.find("#loan_category_ref_name").val() == '') {
      $('#loanCategoryTableCheck').show();
        loanCategoryTableError = false;
        return false;
  }else{
    $('#loanCategoryTableCheck').hide();
    loanCategoryTableError = true;	
    return true;
  }
}

 // Submit Button 
 $('#submitLoanCategory').click(function () {	

     validateLoanCategory();
     ValidateSubCategory();

     if(loancategoryError == true && subcategoryError == true){    
         return true;
     } 
     else 
     {
         return false;
     }
 });
 
});

function DropDownCourse(){
    $.ajax({
        url: 'loancategoryFile/ajaxGetLoanCategory.php',
        type: 'post',
        data: {},
        dataType: 'json',
        success:function(response){

            var len = response.length;
            $("#loan_category_name").empty();
            $("#loan_category_name").append("<option value=''>"+'Select Loan Category'+"</option>");
            for(var i = 0; i<len; i++){
                var loan_category_creation_id = response[i]['loan_category_creation_id'];
                var loan_category_creation_name = response[i]['loan_category_creation_name'];
                $("#loan_category_name").append("<option value='"+loan_category_creation_id+"'>"+loan_category_creation_name+"</option>");
                
            }
            {//To Order Alphabetically
                var firstOption = $("#loan_category_name option:first-child");
                $("#loan_category_name").html($("#loan_category_name option:not(:first-child)").sort(function (a, b) {
                    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1;
                }));
                $("#loan_category_name").prepend(firstOption);
            }

        }
    });
}

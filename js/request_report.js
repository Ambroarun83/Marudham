$(document).ready(function() {

    getRequestReport();

});



function getRequestReport(){
    $.post('reportFile/request/getRequestReport.php',{},function(data){
        $('#request_table_div').empty().html(data);
        
    });
}
$(document).ready(function() {

    getClosedReport();

});



function getClosedReport(){
    $.post('reportFile/closed/getClosedReport.php',{},function(data){
        $('#closed_table_div').empty().html(data);
        
    });
}
$(document).ready(function() {

    getBalanceReport();

});



function getBalanceReport(){
    $.post('reportFile/balance/getBalanceReport.php',{},function(data){
        $('#balance_table_div').empty().html(data);
        
    });
}
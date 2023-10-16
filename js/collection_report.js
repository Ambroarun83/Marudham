$(document).ready(function() {

    getCollectionReport();

});



function getCollectionReport(){
    $.post('reportFile/collection/getCollectionReport.php',{},function(data){
        $('#collection_table_div').empty().html(data);
        
    });
}
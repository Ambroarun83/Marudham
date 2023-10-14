$(document).ready(function() {

    getLoanIssueReport();

});



function getLoanIssueReport(){
    $.post('reportFile/loan_issue/getLoanIssueReport.php',{},function(data){
        $('#loan_issue_table_div').empty().html(data);
        
    });
}
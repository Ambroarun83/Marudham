$(document).ready(function() {

    $(".toggle-button").on("click", function() {
        // Reset active class for all buttons
        $(".toggle-button").removeClass("active");
        // Add active class to the clicked button
        $(this).addClass("active");

        let typevalue = this.value;//this will contain the selected value

        $("#daily_card").toggle(typevalue === 'Daily');//this condition will throw true to toggle function which will show cards
        $("#weekly_card").toggle(typevalue === 'Weekly');
        $("#monthly_card").toggle(typevalue === 'Monthly');

        if (typevalue === 'Daily') {getDailyTable();}
        else if (typevalue === 'Weekly') {getWeeklyTable();}
        else if (typevalue === 'Monthly') {getMonthlyTable();}
    });

});




function getDailyTable(){
    $.post('reportFile/ledger/getDailyTable.php',{},function(data){
        $('#daily_table_div').empty().html(data);
    });
}
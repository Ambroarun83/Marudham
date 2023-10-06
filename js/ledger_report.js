$(document).ready(function() {
    const toggleButtons = $(".toggle-button");
    toggleButtons.on("click", function() {
        // Reset active class for all buttons
        toggleButtons.removeClass("active");
        // Add active class to the clicked button
        $(this).addClass("active");

        let typevalue = this.value;//this will contain the selected value
    });
})
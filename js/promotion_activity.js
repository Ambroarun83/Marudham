$(document).ready(function(){



    const toggleButtons = $(".toggle-button");
    toggleButtons.removeClass('active'); //initially make all buttons unchecked
    toggleButtons.on("click", function() {
        // Reset active class for all buttons
        toggleButtons.removeClass("active");
        // Add active class to the clicked button
        $(this).addClass("active");

        const typevalue = this.value;
        $('.existing_card, .new_card, .repromotion_card').hide();
        if(typevalue == 'New'){
            $('.new_card').toggle('show')
        }else if(typevalue == 'Existing'){
            $('.existing_card').toggle('show')
        }else if(typevalue == 'Repromotion'){
            $('.repromotion_card').toggle('show')
        }
    })

    $('button').click(function(e){e.preventDefault();})

    $('#search_cus').click(function(){
        $('.alert-danger').show();
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 2000);
    })
});


$(function(){
    
})
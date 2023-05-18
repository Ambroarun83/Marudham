$(document).ready(function(){

    $('#raising_for').change(function(){
        var raising_for = $('#raising_for').val();

        if(raising_for == '1'){ //Myself
            $('#myself').show();
            $('#staff').hide();
            $('#agent').hide();
            $('#customer').hide();
        }else if(raising_for == '2'){ //Staff
            $('#myself').hide();
            $('#staff').show();
            $('#agent').hide();
            $('#customer').hide();
        }else if(raising_for == '3'){ //Agent
            $('#myself').hide();
            $('#staff').hide();
            $('#agent').show();
            $('#customer').hide();
        }else if(raising_for == '4'){ //Customer
            $('#myself').hide();
            $('#staff').hide();
            $('#agent').hide();
            $('#customer').show();
        }else{
            $('#myself').hide();
            $('#staff').hide();
            $('#agent').hide();
            $('#customer').hide();
        }
    })

}); //Document END.
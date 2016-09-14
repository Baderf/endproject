$(function(){

    if($(".choose_username")[0]){
        input = $(".choose_username");

        $("#register_start").on("click", function(e){

            if($(input).val() == ""){
                e.preventDefault();
                input.focus();
            }

        });
    }

});
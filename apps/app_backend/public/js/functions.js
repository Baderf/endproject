// SEND - Checking System:


function fade_in_next_step(prev_step, next_step){
    $(".step.step"+prev_step).fadeOut("fast", function(){
        $(".step.step"+prev_step).removeClass("active");
        $(".step.step"+next_step).fadeIn().addClass("active");
    })
}

function sayHello(){
    setTimeout(function(){

        $(".mailpig_speak").fadeIn();

        $time = 4000;


        $(".mailpig_speak p.speak").each(function(index, element){
            setTimeout(function(){
                if(index == 0){
                    $(element).fadeIn();
                }else{
                    $("p.speak" + index).fadeOut("fast", function(){
                        $(element).fadeIn();
                    });
                }

            }, 3000*index);

        });

    }, 5000);

    setTimeout(function(){
        $(".mailpig_speak").fadeOut();

    }, 15000);
}

function show_help(){
    $(".mailpig_helper").toggleClass("active");
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function send_button(){
    select = $("#user_mails");
    button = $('#send_button_user_mail');
    if(select.val() == "default"){
        button.attr("disabled","true");
    }else{
        button.removeAttr("disabled");
    }
}

function switch_statistic_to(id){


    $(".dashboard_statistics").find(".statistic_event_active").hide("slow", function(){
        $(this).removeClass("statistic_event_active").addClass("statistic_event_hide");

        $(".statistic_event_hide[data-id=" + id + "]").show("slow").addClass("statistic_event_active").removeClass("statistic_event_hide");
    });
}



function ajax_filter(action, target, insert, baseURL, item, button){
    $(".area_loading_spinner").fadeIn("slow");
    button.attr("disabled", "true");

    $.ajax({
        method: "POST",
        url: baseURL + 'backend/' + target,
        data: {
            action: action
        },

        success: function (data) {

            if(data) {

                if($(data).find("."+insert + " ." +item).length == 0){
                    $("."+insert + " ." +item).each(function(){

                        $("."+insert + " .alert-info").fadeOut("fast");


                        $(this).fadeOut("slow", function(){
                            $(this).remove();
                        });

                    });
                    $(data).find("." +insert +" .alert-info").hide().appendTo("." +insert).fadeIn("slow", function(){
                        $(".area_loading_spinner").fadeOut("slow");
                    });

                    button.removeAttr("disabled");

                }else{
                    $("."+insert + " ." +item).each(function(){

                        removed = false;
                        $("."+insert + " .alert-info").fadeOut("fast");

                        $(this).fadeOut("slow", function(){
                            $(this).remove();
                        });

                    });
                    $(data).find("."+insert + " ." +item).each(function(){
                        $("."+insert + " .alert-info").fadeOut("fast");
                        $(this).hide().appendTo("." +insert);
                        $(this).slideDown("slow");
                        $(".fa-spinner").hide();
                    });

                    $(".area_loading_spinner").fadeOut("slow");
                    button.removeAttr("disabled");
                }



            }

        },
        error: function(xhr, textStatus, errorThrown){
            $(".area_loading_spinner").fadeOut("slow");
        }

    }).always(function(jqXHR, textStatus){

    });

}

function check_countusers(baseURL, event_id, mail_type){
    $.ajax({
        method: "POST",
        url: baseURL + 'backend/myevents/countuser',
        data: {
            event_id: event_id,
            mail_type: mail_type
        },

        success: function (data) {

            if(data == "Error" || data == "0") {
                $checkbox = $(".check_count_users").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>There are no users to send this mail!");
                $checkbox.removeClass("alert-info").addClass("alert-danger");
                $checkbox.attr("data-error", "true");
            }else{
                $checkbox = $(".check_count_users").html("This mail goes to <strong>" + data + "</strong> receiver! <span class='glyphicon glyphicon-ok-circle fa-spinner-show'></span>");
                $checkbox.removeClass("alert-info").addClass("alert-success");
            }

        },
        error: function(xhr, textStatus, errorThrown){
            $checkbox = $(".check_count_users").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>An error occured. Please try again later.");
            $checkbox.removeClass("alert-info").addClass("alert-warning");
            $checkbox.attr("data-error", "true");
        }

    }).always(function(jqXHR, textStatus){

    });
}

function checkuseremails(baseURL,event_id){
    $.ajax({
        method: "POST",
        url: baseURL + 'backend/myevents/checkuseremails',
        data: {
            event_id: event_id,
            mail_type: mail_type
        },

        success: function (data) {

            if($.type(data) == 'array') {
                $checkbox = $(".check_mails_users").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>Some mails are not ok: <ul class='error_mails'></ul>");
                $checkbox.removeClass("alert-info").addClass("alert-danger");

                $.each( data, function( key, value ) {
                    $("<li>").text(( ++key + ": " + value )).appendTo(".error_mails");
                });

                $("<br><p>").text("You can still send the mail").appendTo(".check_mails_users");

            }else{
                $checkbox = $(".check_mails_users").html("All emails are <strong>ok!</strong> <span class='glyphicon glyphicon-ok-circle fa-spinner-show'></span>");
                $checkbox.removeClass("alert-info").addClass("alert-success");
            }

        },
        error: function(xhr, textStatus, errorThrown){
            $checkbox = $(".check_mails_users").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>An error occured. Please try again later.");
            $checkbox.removeClass("alert-info").addClass("alert-warning");
            $checkbox.attr("data-error", "true");
        }

    }).always(function(jqXHR, textStatus){

    });
}

function checkmailsettings(baseURL,event_id, mail_id, user_id){
    $.ajax({
        method: "POST",
        url: baseURL + 'backend/myevents/checkmailsettings',
        data: {
            event_id: event_id,
            mail_id: mail_id,
            user_id: user_id
        },

        success: function (data) {

            if(data != 'true') {
                $checkbox = $(".check_mail_settings").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>Some mailsettings are not ok: <ul class='error_settings'></ul>");
                $checkbox.removeClass("alert-info").addClass("alert-danger");
                $checkbox.attr("data-error", "true");

                obj = jQuery.parseJSON(data);

                $.each( obj, function( key, value ) {
                    $("<li>").text(( value )).appendTo(".error_settings");
                });

                $('.check_mail_settings').append("<button class='btn btn-sm spec spec_event' id='checkmailsettings_again'>check again <i class='fa fa-spinner fa-spin'></i></button>");


            }else{
                $checkbox = $(".check_mail_settings").html("Your settings are <strong>ok!</strong> <span class='glyphicon glyphicon-ok-circle fa-spinner-show'></span>");
                $checkbox.removeClass("alert-info").addClass("alert-success");
                $checkbox.removeClass("alert-danger");
                $checkbox.removeAttr("data-error");
                setTimeout(function(){
                    checkforerrors();
                },500);

            }

        },
        error: function(xhr, textStatus, errorThrown){
            $checkbox = $(".check_mail_settings").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>An error occured. Please try again later.");
            $checkbox.removeClass("alert-info").addClass("alert-warning");
            $checkbox.attr("data-error", "true");
        }

    }).always(function(jqXHR, textStatus){

    });
}

function updatemailsettings_manual(baseURL, event_id, mail_id, user_id, mail_sender, mail_sender_adress, subject, preheader, button){
    $.ajax({
        method: "POST",
        url: baseURL + 'backend/myevents/updatemailsettings_manual',
        data: {
            event_id: event_id,
            mail_id: mail_id,
            user_id: user_id,
            mail_sender: mail_sender,
            mail_sender_adress: mail_sender_adress,
            subject: subject,
            preheader: preheader
        },

        success: function (data) {
            element = $(".mail_saving");

            if(data != 'success') {
                text = "A problem occured. Please reload the page or try it later.";
                show_info_message(element, button, text);
                return false;
            }else{
                text = "Settings updated!";
                show_success_message(element, button, text);
                return true;
            }


        },
        error: function(xhr, textStatus, errorThrown){

        }

    }).always(function(jqXHR, textStatus){

    });
}

function checkduplicates(baseURL,event_id){
    $.ajax({
        method: "POST",
        url: baseURL + 'backend/myevents/checkforduplicates',
        data: {
            event_id: event_id,
            mail_type: mail_type
        },

        success: function (data) {

            if(data != 'true') {
                $checkbox = $(".check_user_duplicates").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>There are some email duplicates: <ul class='error_mails_duplicates'></ul>");
                $checkbox.removeClass("alert-info").addClass("alert-warning");

                obj = jQuery.parseJSON(data);

                $.each( obj, function( key, value ) {
                    $("<li>").text(( value )).appendTo(".error_mails_duplicates");
                });

                $("<br><p>").text("They will get the mail too often, but you can still continue!").appendTo(".check_user_duplicates");


            }else{
                $checkbox = $(".check_user_duplicates").html("No duplicates were found! <span class='glyphicon glyphicon-ok-circle fa-spinner-show'></span>");
                $checkbox.removeClass("alert-info").addClass("alert-success");
            }

        },
        error: function(xhr, textStatus, errorThrown){
            $checkbox = $(".check_user_duplicates").html("<span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Warning! </strong>An error occured. Please try again later.");
            $checkbox.removeClass("alert-info").addClass("alert-warning");
            $checkbox.attr("data-error", "true");
        }

    }).always(function(jqXHR, textStatus){

    });
}

function checksettings(){
    $("#check_system input").each(function(){
        if($(this).val() == ""){
            $(this).addClass("error");
        }else{
            $(this).removeClass("error");
        }
    });
}

function checkforerrors(){
    error = false;

    $("#check_operator .alert").each(function(){
       if($(this).attr("data-error")){
           console.log("ERROR");
           error = true;
       }
    });

    if(error){
        $('#update_settings').removeAttr("disabled");
    }else{
        $('#send_mail_btn').removeAttr("disabled");
        $('#update_settings').removeAttr("disabled");
    }

}


// NEW EVENT - DATEPICKER:

function show_success_message(element, button, text){
    message = element.find(".alert-success");

    if (text){
        message.html("<strong>Success!</strong>" + " " + text);
    }



    message.slideDown("slow", function(){
        setTimeout(function(){
            message.slideUp("fast", function(){
                if(button){
                    button.prop("disabled", false);
                    stop_loading(button);
                }
            });
        }, 2000);
    })
}

function show_slide_message(element, text, button = false){
    element.html(text);
    element.slideDown("slow", function(){
        setTimeout(function(){
            element.slideUp("slow");
            if(button != false){
                button.removeAttr("disabled");
                stop_loading(button);
            }
        },3000)
    })
}

function show_info_message(element, button, text){
    message = element.find(".alert-info");
    message.html("<strong>Info!</strong>" + " " + text);
    message.slideDown("slow", function(){
        setTimeout(function(){
            message.slideUp("fast", function(){
                button.prop("disabled", false);
            });
        }, 2000);
    })
}

function start_loading(button){

    spinner = button.find(".fa-spinner").fadeIn("slow");

}

function stop_loading(button){
    spinner = button.find(".fa-spinner").fadeOut("slow");
}

function count_settings(){

    inputs = $("#overlay_wrapper_settings input");
    counter = 0;
    inputs.each(function() {
        if($(this).val() == ""){
            $(this).addClass("info_settings");
            counter++;
        }else{
            $(this).removeClass("info_settings");
        }
    });

    warner = $(".settings_warner");
    info_text = $(".full-info");

    if (counter == 0){
        warner.html("<i class='glyphicon glyphicon-ok'></i>");
        warner.addClass("success");
        info_text.fadeOut("slow");
    }else{
        info_text.fadeIn("slow");
        warner.html(counter);
        warner.removeClass("success");
    }


}

$(function(){

    if($(".mailpig_speak")[0]){
        sayHello();

        // HIER
    }

    if($(".chart_area")[0]){
        $(".chart_area").each(function(){

            var ctx = $(this).find("canvas");
            var accepted = ctx.data("accepted");
            var canceled = ctx.data("canceled");
            var noaction = ctx.data("noaction");

            var data = {
                labels: [
                    "Particpate",
                    "Cancel",
                    "No Action"
                ],
                datasets: [
                    {
                        data: [accepted, canceled, noaction],
                        backgroundColor: [
                            "#009688",
                            "#f34848",
                            "#FFCE56"
                        ],
                        hoverBackgroundColor: [
                            "#009688",
                            "#f34848",
                            "#FFCE56"
                        ]
                    }]
            };
            var myPieChart = new Chart(ctx,{
                type: 'pie',
                data: data,
                options: {},
                animation:{
                    animateScale:true
                }
            });
        });
    }


    if($("#send_button_user_mail")[0]){
        select = $("#user_mails");
        select.on("change", function(){
            send_button();
        });
    }

    $(".fa-spinner").hide();

    if($(".btn_settings_mail")[0]){
        inputs = $("#overlay_wrapper_settings input");

            $("#mail_title, #mail_sender, #mail_sender_adress, #subject, #preheader").on("blur", function(){
                count_settings();
            });

        count_settings();
    }

    if($("#check_system")[0]){
        user_id = $('#user_id').val();
        event_id = $('#event_id').val();
        mail_id = $('#mail_id').val();
        mail_type = $('#mail_type').val();

        var baseURL = $('body').data('baseurl');

        setTimeout(function() {
            // AJAX CALL: CHECK HOW MUCH USER
            check_countusers(baseURL, event_id, mail_type);
        }, 2000);


        setTimeout(function() {
            // AJAX CALL: CHECK MAILS
            checkuseremails(baseURL, event_id);
        }, 4000);

        setTimeout(function() {
            // AJAX CALL: CHECK SETTINGS
            checkmailsettings(baseURL, event_id, mail_id, user_id);
        }, 6000);

        setTimeout(function() {
            // AJAX CALL: CHECK DUPLICATES
            checkduplicates(baseURL, event_id);
            $('.wait-info').slideUp("slow");
        }, 8000);

        $("#check_system input").on("blur", function(){
            checksettings();

        });

        checksettings();
        setTimeout(function(){
           check = checkforerrors();




        }, 8500);
    }






    // Overlay click event
    $(".overlay").on("click", function(event){
        if($(event.target).data("action") == "close"){

            $(".overlay_wrapper").slideUp("fast", function(){
                $(".overlay").slideUp("fast");
            });
        }
    });

    $(".overlay .btn-danger").on("click", function(){
        $(".overlay_wrapper").slideUp("fast", function(){
            $(".overlay").slideUp("fast");
        });
    });

    var click_from = $(".hover_date_from");
    var click_to = $(".hover_date_to");
    var area_from = $(".date_area_from");
    var area_to = $(".date_area_to");

    // AREA FROM:


    // AREA TO:



    // CLICK EVENTS FÜR DAS PICKER-WECHSELN

        $(click_from).on("click", function(){
           if(!$(".date_area_from").hasClass("active")){
                $picker_from.slideUp("slow");
                $picker_from.show("slow");
                $picker_to.slideDown("slow");
                $picker_to.hide();
                area_to.removeClass("active");
                area_from.addClass("active");
            }
        });

        $(click_to).on("click", function(){
            if(!$(".date_area_to").hasClass("active")){
                $picker_to.slideUp("slow");
                $picker_to.show("slow");
                $picker_from.slideDown("slow");
                $picker_from.hide();
                area_from.removeClass("active");
                area_to.addClass("active");
            }
        });

    // PICKER FROM

        var $picker_from = $('#datetimepicker_from').datetimepicker({
            inline: true,
            sideBySide: true
        });

        $('#datetimepicker_from').on('dp.change', function(event) {

            $('#selected-date').text(event.date);
            var formatted_date = event.date.format('MM/DD/YYYY h:mm a');

            year_from = $(".date_area_from .year").text(event.date.format('YYYY'));
            day_from = $(".date_area_from .day").text(event.date.format('ddd') + ",");
            daynum_from = $(".date_area_from .monthandday .day_num").text(event.date.format(' DD'));
            month_from = $(".date_area_from .monthandday .month").text(event.date.format(' MMM'));
            time_from = $(".date_area_from .monthandday .time").text("(" + event.date.format('hh:mm a') + ")");


            $('#date_from').val(formatted_date);
            //$('#hidden-val').text($('#my_hidden_input').val());
        });

    // PICKER TO

        var $picker_to = $('#datetimepicker_to').datetimepicker({
            inline: true,
            sideBySide: true
        });

        $('#datetimepicker_to').on('dp.change', function(event) {

            $('#selected-date').text(event.date);
            var formatted_date = event.date.format('MM/DD/YYYY h:mm a');

            year_to = $(".date_area_to .year").text(event.date.format('YYYY'));
            day_to = $(".date_area_to .day").text(event.date.format('ddd') + ",");
            daynum_to = $(".date_area_to .monthandday .day_num").text(event.date.format(' DD'));
            month_to = $(".date_area_to .monthandday .month").text(event.date.format(' MMM'));
            time_to = $(".date_area_to .monthandday .time").text("(" + event.date.format('hh:mm a') + ")");

            $('#date_to').val(formatted_date);
            $('#hidden-val').text($('#my_hidden_input').val());
        }).hide();





});

// EDIT - EVENT:

$(function () {
    $('#datetimepicker_edit_to').datetimepicker({
        viewMode: 'days',
        format: 'MM/DD/YYYY'
    });

    $('.datepicker_userspec').datetimepicker({
        viewMode: 'days',
        format: 'MM/DD/YYYY'
    });

    $('.datepicker_userspec').on('dp.change', function(event){
        $('#selected-date').text(event.date);
        $(this).val(event.date.format('MM/DD/YYYY'));
    });

    $('.timepicker_userspec').datetimepicker({
        format: 'LT'
    });

    $('.timepicker_userspec').on('dp.change', function(event){
        $('#selected-date').text(event.date);
        $(this).val(event.date.format('LT'));
    });


    $('#datetimepicker_edit_from').datetimepicker({
        viewMode: 'days',
        format: 'MM/DD/YYYY'
    });

    $(function () {
        $('#timepicker_from').datetimepicker({
            format: 'LT'
        });
    });

    $(function () {
        $('#timepicker_to').datetimepicker({
            format: 'LT'
        });
    });
});


// EDIT FORMULARS:


$(function () {
    var $formaction_field = $("#formaction");

    var $choose_field_url = $(".choose_url");
    var $choose_field_mail = $(".choose_mail");
    var $choose_field_feedback = $(".choose_feedback");

    $formaction_field.on("change", function(){
       if($("#formaction").val() == "url"){
           $choose_field_url.removeClass("not_active");
           $choose_field_mail.addClass("not_active");
           $choose_field_feedback.addClass("not_active");
       }else if($("#formaction").val() == "confirmation_mail"){
           $choose_field_url.addClass("not_active");
           $choose_field_mail.removeClass("not_active");
           $choose_field_feedback.addClass("not_active");
       }else if($("#formaction").val() == "feedback"){
           $choose_field_url.addClass("not_active");
           $choose_field_mail.addClass("not_active");
           $choose_field_feedback.removeClass("not_active");
       }else{
           $choose_field_url.addClass("not_active");
           $choose_field_mail.addClass("not_active");
           $choose_field_feedback.addClass("not_active");
       }
    });


});

// EDIT FORMULAR STANDARD FIELDS:

$(function () {


    $("body").click(function(event) {

    });


    // Verschiebe TR zu Deaktivierten und Retour
    $("a.remove_tr").click(function(event) {
        event.preventDefault();
        var row = $(this).parents("tr:first");
        if ($(this).is(".standard_field_active .remove_tr")) {
            row.hide("slow", function(){
                row.insertAfter($(".deactivated_standard_fields tr:last-child"));

                row.removeClass("active_tr").addClass("deactive_tr");
                row.find(".td_btn_area a").removeClass("btn-danger").addClass("btn-success");
                row.find(".td_btn_area span").remove();
                row.find(".td_btn_area a").html('activate ' + "<span class='glyphicon glyphicon-ok'></span>");

                row.show("slow");
                $(this).children().last().hide();
                insert_ids();
            })
        }else if($(this).is(".deactivated_standard_fields .remove_tr")) {
            row.hide("slow", function(){
                row.insertAfter($(".activated_standard_fields tr:last-child"));

                row.removeClass("deactive_tr").addClass("active_tr");
                row.find(".td_btn_area a").removeClass("btn-success").addClass("btn-danger");
                row.find(".td_btn_area span").remove();
                row.find(".td_btn_area a").html('deactivate ' + "<span class='glyphicon glyphicon-remove'></span>");

                row.show("slow");
                $(this).children().last().show();
                insert_ids();
            })
        }

    });




});

function insert_ids(){
    var input_active = $(".active_standard_fields_row").val("");
    var input_ids_active = "";

    var input_deactivate = $(".deactive_standard_fields_row").val("");
    var input_ids_deactive = "";

    $(".standard_field_active tr.active_tr").each(function() {
        var id = $(this).data("row-id");
        input_ids_active = input_ids_active + (":"+id+":");
    });


    $(".deactivated_standard_fields tr.deactive_tr").each(function() {
        var id_de = $(this).data("row-id");
        input_ids_deactive = input_ids_deactive + (":"+id_de+":");
    });

    input_active.val(input_ids_active);
    input_deactivate.val(input_ids_deactive);

}

// FORMBUILDER EDIT

$(function () {
    $("body .btn-field-creator").on("click", function(e){
        e.preventDefault();

        var select = $(".form_choose_type");
        var title = $("#formtitle_user_spec");


        if ($(title).val().length === 0){
            console.log("Titel ist leer, bitte Titel füllen!"); // FEEDBACK

        }else if(select.val() == "default"){
            // Meldung, dass er was aussuchen soll..
            console.log("ist default");
        }else{
            var type =  select.val();
            var field_to_input_area = $("body").find("#userspec_field_area");
            var last_id = $(field_to_input_area).find("#last_id");
            var id = parseInt($(last_id).val());



            switch (type) {
                case "select":
                    var clone = $("body").find(".input_templates").find("div.user_input_select").clone();

                    var new_element = $(clone).hide().appendTo(field_to_input_area);
                    $(new_element).slideDown("slow");



                    // Anpassung DIV ID's
                    $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id);
                    $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                    // Anpassung Label ID
                    var label = $(new_element).find("#field_title_");
                    $(label).attr("id", "field_title_"+id);
                    // Anpassung select id:
                    var select_input = $(new_element).find("select[name=form_selection_]");
                    $(select_input).attr("name", "form_selection_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (select field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());

                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);
                    // ID von ADD BTN
                    $(new_element).find("a.btn-selection-field-adder").attr("data-table-id", id);

                    $(new_element).find("table.form_field_options").attr("data-table-id", id);
                    $(new_element).find("tbody.tbody_id_").attr("class", "tbody_id_"+id);


                    break;
                case "checkbox":
                var clone = $("body").find(".input_templates").find("div.user_input_checkbox").clone();
                var new_element = $(clone).hide().appendTo(field_to_input_area);
                $(new_element).slideDown("slow");

                // Anpassung DIV ID's
                $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id);
                $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                // Anpassung Label ID
                var label = $(new_element).find("#field_title_");
                $(label).attr("id", "field_title_"+id);
                // Anpassung select id:
                var select_input = $(new_element).find("select[name=form_selection_]");
                $(select_input).attr("name", "form_selection_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (checkbox field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());

                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);
                    // ID von ADD BTN
                $(new_element).find("a.btn-selection-field-adder").attr("data-table-id", id);

                $(new_element).find("table.form_field_options").attr("data-table-id", id);
                $(new_element).find("tbody.tbody_id_").attr("class", "tbody_id_"+id);


                break;

                case "radio":
                    var clone = $("body").find(".input_templates").find("div.user_input_radio").clone();
                    var new_element = $(clone).hide().appendTo(field_to_input_area);
                    $(new_element).slideDown("slow");

                    // Anpassung DIV ID's
                    $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id);
                    $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                    // Anpassung Label ID
                    var label = $(new_element).find("#field_title_");
                    $(label).attr("id", "field_title_"+id);
                    // Anpassung select id:
                    var select_input = $(new_element).find("select[name=form_selection_]");
                    $(select_input).attr("name", "form_selection_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (radio field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());

                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);
                    // ID von ADD BTN
                    $(new_element).find("a.btn-selection-field-adder").attr("data-table-id", id);

                    $(new_element).find("table.form_field_options").attr("data-table-id", id);
                    $(new_element).find("tbody.tbody_id_").attr("class", "tbody_id_"+id);


                    break;


                case "number":
                    var clone = $("body").find(".input_templates").find("div.number_field").clone();
                    var new_element = $(clone).hide().appendTo(field_to_input_area);
                    $(new_element).slideDown("slow");

                    // Anpassung DIV ID's
                    $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id).attr("data-table-input-field", id);
                    $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                    // Anpassung Label ID
                    var label = $(new_element).find("#field_title_");
                    $(label).attr("id", "field_title_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (number field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());

                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);
                    break;

                case "text":
                    var clone = $("body").find(".input_templates").find("div.text_input").clone();
                    var new_element = $(clone).hide().appendTo(field_to_input_area);
                    $(new_element).slideDown("slow");

                    // Anpassung DIV ID's
                    $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id);
                    $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                    // Anpassung Label ID
                    var label = $(new_element).find("#field_title_");
                    $(label).attr("id", "field_title_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (text field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());


                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);

                    break;

                case "date":
                    var clone = $("body").find(".input_templates").find("div.date_input").clone();
                    var new_element = $(clone).hide().appendTo(field_to_input_area);
                    $(new_element).slideDown("slow");

                    // Anpassung DIV ID's
                    $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id);
                    $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                    // Anpassung Label ID
                    var label = $(new_element).find("#field_title_");
                    $(label).attr("id", "field_title_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (date field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());

                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    var default_input = $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);
                    var new_datepicker = $(new_element).find('.datepicker_userspec').datetimepicker({
                        viewMode: 'days',
                        format: 'MM/DD/YYYY'
                    });

                    break;

                case "time":
                    var clone = $("body").find(".input_templates").find("div.time_input").clone();
                    var new_element = $(clone).hide().appendTo(field_to_input_area);
                    $(new_element).slideDown("slow");

                    // Anpassung DIV ID's
                    $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id);
                    $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                    // Anpassung Label ID
                    var label = $(new_element).find("#field_title_");
                    $(label).attr("id", "field_title_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (time field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());

                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);

                    $(new_element).find('.timepicker_userspec').datetimepicker({
                        format: 'LT'
                    });


                    break;

                case "textarea":
                    var clone = $("body").find(".input_templates").find("div.textarea_input").clone();
                    var new_element = $(clone).hide().appendTo(field_to_input_area);
                    $(new_element).slideDown("slow");

                    // Anpassung DIV ID's
                    $(new_element).attr("data-table-id", id).attr("data-table-input-id", id).attr("data-user-field-id", id);
                    $(new_element).removeClass("select_field_area_").addClass("select_field_area_"+id);
                    // Anpassung Label ID
                    var label = $(new_element).find("#field_title_");
                    $(label).attr("id", "field_title_"+id);

                    $(clone).find("dt > span").html($(title).val() + " (textarea field)");
                    title_input = $(clone).find("#field_title_"+id);
                    $(title_input).val((title).val());

                    // Hidden Fields:
                    var hidden_field_area = $(new_element).find("div.hidden_fields");
                    var hidden_id_field = $(hidden_field_area).find(".hidden_user_field_id_").removeClass("hidden_user_field_id_").addClass("hidden_user_field_id_"+id).attr("name", "user_field_id_"+id);
                    $(hidden_id_field).val(id);
                    $(hidden_field_area).find(".hidden_user_field_type_").removeClass("hidden_user_field_type_").addClass("hidden_user_field_type_"+id).attr("name", "user_field_type_"+id);
                    $(hidden_field_area).find(".hidden_user_field_default_").removeClass("hidden_user_field_default_").addClass("hidden_user_field_default_"+id).attr("name", "user_field_default_"+id);
                    $(hidden_field_area).find(".hidden_user_field_values_").removeClass("hidden_user_field_values_").addClass("hidden_user_field_values_"+id).attr("name", "user_field_values_"+id);
                    $(hidden_field_area).find(".hidden_user_field_placeholder_").removeClass("hidden_user_field_placeholder_").addClass("hidden_user_field_placeholder_"+id).attr("name", "user_field_placeholder_"+id);
                    var hidden_title = $(hidden_field_area).find(".hidden_user_field_title_").removeClass("hidden_user_field_title_").addClass("hidden_user_field_title_"+id).attr("name", "user_field_title_"+id);
                    $(hidden_title).val((title).val());
                    $(hidden_field_area).find(".hidden_user_field_required_").removeClass("hidden_user_field_required_").addClass("hidden_user_field_required_"+id).attr("name", "user_field_required_"+id);
                    $("<input>").attr("type", "hidden").attr("name", "user_field_new_"+id).val("true").appendTo(hidden_field_area);

                    break;
            }

            $(title).val("");
            $(last_id).val(id + 1);

            render_post_ids();
            render_post_ids();

             // die Id's von dem neuen in ein INput speichern

        }
    });


    $("body").on("click : focus", function(event) {

        var target = $(event.target);

        tr = $(target).closest("tr");

        element = $(this).closest(".user_input_field");
        table_id = $(element).attr("data-table-id");
        table_type = $(element).attr("data-table-type");

        if (target.is(".editable_text")) {
            event.preventDefault();

            var input = target.parent().find(".editable_input");
            var text = target.parent().find(".editable_text");
            text.hide(0);
            input.attr("type", "text").focus();
            input.on("blur", function () {

                text.text(input.val());
                input.attr("type", "hidden");
                text.show(0);

                element = $(target).closest(".user_input_field");
                table_id = $(element).attr("data-table-input-id");
                table_type = $(element).attr("data-table-type");


                render_table(table_id, table_type);
                render_post_ids();
            });
        } else if (target.is(".option_delete")) {
            event.preventDefault();
            window_alert_show("Are you sure that you want to delete the selection?");
            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });
                element = $(target).closest(".user_input_field");
                table_id = $(element).attr("data-table-input-id");
                table_type = $(element).attr("data-table-type");
                tr = $(target).closest("tr");
                tr.remove();

                render_table(table_id, table_type);
                render_post_ids();


            });
        } else if (target.is(".user_reaction")) {
            event.preventDefault();
            button = $(event.target);

            button.attr("disabled", "true");
            var baseURL = $('body').data('baseurl');

            reaction = button.data("action");
            user_id = $('#user_id').val();
            event_id = $('#event_id').val();
            start_loading(button);

            $.ajax({
                method: "POST",
                url: baseURL + 'backend/users/setReaction',
                data: {
                    user_id: user_id,
                    event_id: event_id,
                    reaction: reaction
                },


                success: function (data) {
                    stop_loading(button);

                    if(data != "false"){
                        element = $(".user_saving");
                        text="Action set!";
                        current = $(".user_reactions").slideUp("fast");
                        show_success_message(element, button, text);

                        setTimeout(function(){
                                current.html(data).slideDown("slow");
                                current.find(".fa-spinner").hide();
                        }, 3000);




                        
                        

                    }

                },
                error: function(xhr, textStatus, errorThrown){
                    stop_loading(button);
                }

            }).always(function(jqXHR, textStatus){
                start_loading(button);
            });



        } else if (target.is("#send_mail_user")) {
            event.preventDefault();
            show_settings();

        } else if (target.is("#show_info")) {
            event.preventDefault();
            show_info();

        } else if (target.is(".user_delete")) {
            event.preventDefault();
            window_alert_show("Are you sure you want to delete this user?");


            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });

                // Ajax Call:
                var baseURL = $('body').data('baseurl');
                button = $(event.target);
                button.prop("disabled", true);
                start_loading(button);

                user_id = button.attr("data-id");
                event_id = button.attr("data-event-id");



                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/users/edit/' + event_id + '/delete_user/' + user_id,

                    success: function (data) {
                        if(data){
                            old_content = $('.my_events_list');
                            old_content_html = old_content.html("");

                            new_content = $(data).find(".my_events_list").html();

                            old_content.html(new_content).show("slow");
                        }

                    },
                    error: function(xhr, textStatus, errorThrown){
                        stop_loading(button);
                    }

                }).always(function(jqXHR, textStatus){
                    start_loading(button);
                });

            });

        } else if (target.is(".delete_event")) {
            event.preventDefault();
            window_alert_show("Are you sure you want to delete this event? All users and the statistics will be lost!");


            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });

                // Ajax Call:
                var baseURL = $('body').data('baseurl');
                button = $(event.target);
                button.prop("disabled", true);
                start_loading(button);

                user_id = button.attr("data-user-id");
                event_id = button.attr("data-event-id");



                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/myevents/delete/' + event_id,

                    success: function (data) {
                        if(data == "deleted"){
                            $(button).closest(".my_events_event").slideUp("fast");
                            stop_loading(button);
                        }

                    },
                    error: function(xhr, textStatus, errorThrown){
                        stop_loading(button);
                    }

                }).always(function(jqXHR, textStatus){
                    start_loading(button);
                });

            });

        } else if (target.is("#checkmailsettings_again")) {
            event.preventDefault();
            user_id = $('#user_id').val();
            event_id = $('#event_id').val();
            mail_id = $('#mail_id').val();
            mail_type = $('#mail_type').val();

            baseURL = $('body').data('baseurl');
            button = $(event.target);
            start_loading(button);



            setTimeout(function(){
                checkmailsettings(baseURL,event_id, mail_id, user_id);
            }, 2000);






        } else if (target.is("#update_settings")) {
            event.preventDefault();
            user_id = $('#user_id').val();
            event_id = $('#event_id').val();
            mail_id = $('#mail_id').val();
            mail_type = $('#mail_type').val();

            baseURL = $('body').data('baseurl');
            button = $(event.target);
            start_loading(button);



            mail_sender = $('#mail_sender').val();
            mail_sender_adress = $('#mail_sender_adress').val();
            subject = $('#subject').val();
            preheader = $('#preheader').val();

            if(mail_sender == "" || mail_sender_adress == "" || subject == "" || preheader == ""){
                stop_loading(button);
                element = $(".slide-info");
                text = "<strong>Information!</strong> Please fill out all fields!";
                show_slide_message(element, text);
            }else{
                setTimeout(function(){
                    update = updatemailsettings_manual(baseURL, event_id, mail_id, user_id, mail_sender, mail_sender_adress, subject, preheader, button);

                }, 2000);

                stop_loading(button);

            }



        } else if (target.is(".btn_settings_mail")) {
            event.preventDefault();
            show_settings();

        } else if (target.is(".list_filter")) {

            event.preventDefault();

            button = $(event.target);

            eaction = button.data("action");
            etarget = button.data("type");
            einsert = button.data("insert");
            eitem = button.data("item");
            baseURL = $('body').data('baseurl');

            $(".list_filter").each(function(){
                $(this).removeClass("active");
            });

            button.addClass("active");

            ajax_filter(eaction, etarget, einsert, baseURL, eitem, button);

        } else if (target.is(".btn_test_mail")) {
            event.preventDefault();
            show_testmailer();

        }  else if (target.is(".mail_pig_helper_img")) {
            event.preventDefault();
            show_help();

        }   else if (target.is(".mailpig_steps .close")) {
            event.preventDefault();
            show_help();

        }   else if (target.is(".mailpig_next")) {
            event.preventDefault();

            actual_step = $(".step.active").data("step");
            steps = 0;

            $(".mailpig_steps .step").each(function(){
                steps = steps + 1;
            });

            next_step = actual_step + 1;

            if(next_step > steps){
                next_step = 1;
            }

            fade_in_next_step(actual_step, next_step);

        }    else if (target.is(".mailpig_prev")) {
            event.preventDefault();

            actual_step = $(".step.active").data("step");
            steps = 0;

            $(".mailpig_steps .step").each(function(){
                steps = steps + 1;
            });

            next_step = actual_step - 1;

            if(next_step < 1){
                next_step = steps;
            }

            fade_in_next_step(actual_step, next_step);

        }    else if (target.is(".dont_show_again")) {
            event.preventDefault();

            button = $(event.target);
            button.prop("disabled", true);
            user_id = $(".helper_user_id").val();
            var baseURL = $('body').data('baseurl');

            start_loading(button);


            $.ajax({
                method: "POST",
                url: baseURL + 'backend/dashboard/dontshowagain',
                data: {
                    user_id: user_id
                },


                success: function (data) {
                    if (data == "set") {
                        element = $(".send_success");
                        text = "Helper disabled!";
                        show_success_message(element, button, text);
                        stop_loading(button);


                        $(".mailpig_helper").fadeOut("slow", function(){
                            $(".mail_pig_helper_img").fadeOut();
                        });
                    }

                },
                error: function (xhr, textStatus, errorThrown) {

                }

            }).always(function (jqXHR, textStatus) {

            });

        } else if (target.is(".event_link_stat")) {
            event.preventDefault();
            id = $(event.target).data("id");
            $(".event_link.event_active").removeClass("event_active");

            switch_statistic_to(id);
            $(".event_link[data-id=" + id +"]").addClass("event_active");

        } else if (target.is("#send_button_user_testmail")) {
            event.preventDefault();


            button = $(event.target);
            button.prop("disabled", true);
            input = $("#test_mail_to");

            if(!input.val() == ""){

                if(!isEmail(input.val())){
                    element = $(".send_error");
                    text = "This email is not valid!";
                    show_slide_message(element, text, button);
                    return;
                }else {
                    // ajax call:
                    var baseURL = $('body').data('baseurl');
                    button.prop("disabled", true);

                    email = input.val();
                    user_id = $('#user_id').val();
                    mail_id = $('#this_id').val();


                    $.ajax({
                        method: "POST",
                        url: baseURL + 'backend/designs/testmail',
                        data: {
                            email: email,
                            user_id: user_id,
                            mail_id: mail_id
                        },


                        success: function (data) {
                            if (data == "sent") {
                                element = $(".send_success");
                                text = "Testmail has been sent!";
                                show_slide_message(element, text, button);
                            }else{
                                element = $(".send_error");
                                text = data;
                                show_slide_message(element, text, button);
                            }

                        },
                        error: function (xhr, textStatus, errorThrown) {

                        }

                    }).always(function (jqXHR, textStatus) {

                    });

                }

            }else{
                element = $(".send_error");
                text = "You didn't fill out the email-field!";
                show_slide_message(element, text, button);
                return;
            }

        } else if (target.is(".make_preview")) {
            event.preventDefault();
            id = $(target).data("id");
            var baseURL = $('body').data('baseurl');


            window.open(baseURL+"backend/formulars/preview/" +id, baseURL+"backend/formulars/preview/" +id, "width=650,height=700");


        } else if (target.is(".close_window")) {
            event.preventDefault();
            window.close();
        } else if (target.is(".field_delete")) {
            event.preventDefault();
            window_alert_show("Are you sure that you want to delete the hole input field?");
            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });
                element = $(target).closest(".user_input_field");
                table_id = $(element).attr("data-table-input-id");
                table_type = $(element).attr("data-table-type");

                element.remove();

                render_table(table_id, table_type);
                render_post_ids();


            });
        } else if (target.is(".static_delete")) {
            event.preventDefault();
            window_alert_show("Are you sure that you want to delete the statics?");


            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });

                // Ajax Call:
                var baseURL = $('body').data('baseurl');
                button = $(event.target);
                button.prop("disabled", true);
                start_loading(button);

                user_id = $('#user_id').val();
                event_id = $('#event_id').val();
                reset_type = $(event.target).attr("id");

                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/users/resetStats',
                    data: {
                        user_id: user_id,
                        event_id: event_id,
                        type: reset_type
                    },


                    success: function (data) {
                        if(data == "resetted"){
                            button.slideUp("slow", function(){
                                button.remove();
                                buttons = $(".static_delete").length;
                                allbutton = $(".static_delete#all");
                                if (buttons == 1){
                                    allbutton.slideUp("slow", function(){
                                        $("<div class='alert alert-warning'><strong>Warning!</strong> This user didn't get any email from you yet!</div>").insertAfter(allbutton);
                                        allbutton.remove();
                                    });
                                }
                            });

                        }else if(data == "resettedAll"){
                            $(".static_delete").slideUp("fast");
                            allbutton = $(".static_delete#all");

                            allbutton.slideUp("slow", function(){
                                $("<div class='alert alert-warning'><strong>Warning!</strong> This user didn't get any email from you yet!</div>").insertAfter(allbutton);
                                allbutton.remove();
                            });
                        }else{
                            element = $(".user_saving");
                            text = "There has been an error setting the rections."

                            show_info_message(element, button, text);
                        }

                    },
                    error: function(xhr, textStatus, errorThrown){
                        stop_loading(button);
                    }

                }).always(function(jqXHR, textStatus){
                    start_loading(button);
                });



            });
        } else if (target.is("#send_button_user_mail")) {
            event.preventDefault();

                // Ajax Call:
                var baseURL = $('body').data('baseurl');
                button = $(event.target);
                button.prop("disabled", true);
                start_loading(button);

                user_id = $('#user_id').val();
                event_id = $('#event_id').val();
                mail_id = $("#user_mails").val();

                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/users/sendMail',
                    data: {
                        user_id: user_id,
                        event_id: event_id,
                        mail_id: mail_id
                    },


                    success: function (data) {
                        if(data == "sent"){
                            element = $(".send_success");
                            text = "Success - Mail sent!";
                            show_slide_message(element, text, button);
                        }else{
                            element = $(".send_error");
                            text = "Error - Mail not sent!";
                            show_slide_message(element, text, button);
                        }

                    },
                    error: function(xhr, textStatus, errorThrown){
                        stop_loading(button);
                    }

                }).always(function(jqXHR, textStatus){
                    start_loading(button);
                });


        } else if (target.is(".unlink_formular")) {
            event.preventDefault();
            window_alert_show("Are you sure that you want to unlink the formular? This will delete the whole data table of your formular!");

            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });

                // Ajax Call:
                var baseURL = $('body').data('baseurl');
                button = $(event.target);
                button.prop("disabled", true);
                start_loading(button);

                form_id = $("#event_link_formular").val();
                user_id = $('#user_id').val();
                event_id = $('#event_id').val();

                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/myevents/unlinkFormular',
                    data: {
                        user_id: user_id,
                        event_id: event_id
                    },


                    success: function (data) {
                        if(data == "unlinked"){
                            element = $(".myevents_saving");
                            text="Formular unlinked!";
                            show_success_message(element, button, text);

                            $(".linked_events_table").html("<tr><td colspan='2'>There are no formulars linked.</td></tr>");

                            console.log(".linked_events_table");
                        }

                    },
                    error: function(xhr, textStatus, errorThrown){
                        stop_loading(button);
                    }

                }).always(function(jqXHR, textStatus){
                    start_loading(button);
                });



            });

        } else if (target.is("#add_formular_link")) {
            event.preventDefault();


            if($("#linked_event td.linked_event")[0]){
                td = $("#linked_event td.linked_event").data("linked");

                if(td == "1"){
                    window_alert_show("Are you sure that you want link a new formular to the event? This will delete the old formular data table and will create a new one!");
                    $(".overlay_wrapper .btn-success").on("click", function () {
                        $(".overlay .btn-success").data('clicked', "1");
                        $(".overlay_wrapper").slideUp("fast", function () {
                            $(".overlay").slideUp("fast");
                        });

                        // Ajax Call:
                        var baseURL = $('body').data('baseurl');
                        button = $(event.target);
                        button.prop("disabled", true);
                        start_loading(button);

                        form_id = $("#event_link_formular").val();
                        user_id = $('#user_id').val();
                        event_id = $('#event_id').val();

                        $.ajax({
                            method: "POST",
                            url: baseURL + 'backend/myevents/linkFormularToEvent',
                            data: {
                                user_id: user_id,
                                event_id: event_id,
                                formular_id: form_id
                            },


                            success: function (data) {
                                if(data == "linked"){

                                    element = $(".myevents_saving");
                                    text="Formular linked and saved!";
                                    show_success_message(element, button, text);


                                    title = $('.form_link option[value="'+form_id+'"]').text();


                                    $(".linked_events_table").html("<tr><td><a href='formulars/edit/"+form_id+"'>"+title+"</a></td><td width='100'><button class='btn btn-sm btn-warning unlink_formular'><span class='glyphicon glyphicon-remove'></span></button></td></tr>");
                                }

                            },
                            error: function(xhr, textStatus, errorThrown){
                                stop_loading(button);
                            }

                        }).always(function(jqXHR, textStatus){
                            start_loading(button);
                        });



                    });
                }
            }else{

                // Ajax Call:
                var baseURL = $('body').data('baseurl');
                button = $(event.target);
                button.prop("disabled", true);
                start_loading(button);

                form_id = $("#event_link_formular").val();
                user_id = $('#user_id').val();
                event_id = $('#event_id').val();

                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/myevents/linkFormularToEvent',
                    data: {
                        user_id: user_id,
                        event_id: event_id,
                        formular_id: form_id
                    },


                    success: function (data) {
                        if(data == "linked"){
                            element = $(".myevents_saving");
                            text="Formular linked and saved!";
                            show_success_message(element, button, text);
                            title = $('.form_link option[value="'+form_id+'"]').text();


                            $(".linked_events_table").html("<tr><td><a href='formulars/edit/"+form_id+"'>"+title+"</a></td><td width='100'><button class='btn btn-sm btn-warning unlink_formular'><span class='glyphicon glyphicon-remove'></span></button></td></tr>");
                        }

                    },
                    error: function(xhr, textStatus, errorThrown){
                        stop_loading(button);
                    }

                }).always(function(jqXHR, textStatus){
                    start_loading(button);
                });
            }

        } else if (target.is("#saveMailSettings")) {
            var baseURL = $('body').data('baseurl');
            button = $(event.target);
            button.prop("disabled", true);
            start_loading(button);

            name = $("#mail_title").val();
            sender = $("#mail_sender").val();
            sender_adress = $("#mail_sender_adress").val();
            subject = $("#subject").val();
            preview_text = $("#preheader").val();
            user_id = $("#user_id").val();
            mail_id = $("#this_id").val();

            $.ajax({
                method: "POST",
                url: baseURL + 'backend/designs/saveMailSettings/' + mail_id,
                data: {
                    user_id: user_id,
                    title: name,
                    sender: sender,
                    sender_adress: sender_adress,
                    subject: subject,
                    preview_text: preview_text
                },


                success: function (data) {
                    if(data == "saved"){
                        element = $("#overlay_wrapper_settings");
                        text="Email settings saved!";
                        show_success_message(element, button, text);

                    }

                },
                always: function () {
                    console.log("hallo");
                    start_loading(button);
                },
                error: function(xhr, textStatus, errorThrown){
                    stop_loading(button);
                }

            }).always(function(jqXHR, textStatus){
                start_loading(button);
            });


        } else if (target.is(".email_item_options .item_delete")) {
            event.preventDefault();
            window_alert_show("Are you sure that you want to delete this element?");
            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });
                element = $(target).closest(".email-item");
                element.remove();

            });
        } else if (target.is("#save_email")) {
            event.preventDefault();
            button = $(event.target);
            button.prop("disabled", true);

            fill_email_inputs();

            var baseURL = $('body').data('baseurl');

            // AJAX - CALL - SAVE EMAIL
            fulltext = $("#emailhtmlall").val();
            emailtext = $("#emailhtmltext").val();
            mail_id = $("#this_id").val();
            user_id = $("#user_id").val();

            $.ajax({
                method: "POST",
                url: baseURL + 'backend/designs/saveMail/' + mail_id,
                data: {
                    user_id: user_id,
                    mail_id: mail_id,
                    emailtext: emailtext,
                    fulltext: fulltext
                },
                success: function (data) {
                    if(data == "saved"){
                        element = $(".mail_saving");
                        text = "Email saved!";
                        show_success_message(element, button, text);
                        count_settings();
                    }


                },
                error: function(xhr, textStatus, errorThrown){
                   

                }

            }).always(function(jqXHR, textStatus){
                start_loading(button);
            });




        } else if (target.is(".accordion_opener")) {

            $(target).next("dd").slideToggle("slow");
            //$(this).children("a").toggleClass("closed open");

        }else if (target.is(".btn-field-remover")) {
            this_user_field = $(target).closest(".user_input_field");
            event.preventDefault();
            window_alert_show("Are you sure that you want to delete this field input?");
            $(".overlay_wrapper .btn-success").on("click", function () {
                $(".overlay .btn-success").data('clicked', "1");
                $(".overlay_wrapper").slideUp("fast", function () {
                    $(".overlay").slideUp("fast");
                });

                this_user_field.slideUp("slow", function(){
                    this_user_field.remove();
                    render_post_ids();
                });
                element = $(target).closest(".user_input_field");
                table_id = $(element).attr("data-table-input-id");
                table_type = $(element).attr("data-table-type");

                render_table(table_id, table_type);
                render_post_ids();


            });
        }else if (target.is(".label_option_is_required > .option_is_required")) {

            element = $(target).closest(".user_input_field");
            table_id = $(element).attr("data-table-input-id");
            table_type = $(element).attr("data-table-type");

            element_required_field = $(element).find(".hidden_user_field_required_" + table_id);

            val = element_required_field.val();

            element_required_field.val(val === "true" ? "false" : "true");

        }else if (target.is("table .arrow_up") || target.is("table .arrow_down")) {
            event.preventDefault();
            element = $(target).closest(".user_input_field");
            table_id = $(element).attr("data-table-input-id");
            table_type = $(element).attr("data-table-type");
            
            var row = target.parents("tr:first");
            if (target.is(".arrow_up")) {
                row.hide("slow", function () {
                    row.insertBefore(row.prev()).show("slow");
                    insert_ids();
                    if (row.hasClass("is_selection")) {

                        
                        render_table(table_id, table_type);
                        render_post_ids();
                    }
                })
            } else if (target.is(".arrow_down")) {

                event.preventDefault();
                row.hide("slow", function () {
                    row.insertAfter(row.next()).show("slow");
                    insert_ids();
                    if (row.hasClass("is_selection")) {

                        render_table(table_id, table_type);
                        render_post_ids();
                    }
                })
            }


        }else if (target.is(".dt_options .arrow_up") || target.is(".dt_options .arrow_down")) {
            event.preventDefault();
            element = $(target).closest(".user_input_field");
            table_id = $(element).attr("data-table-input-id");
            table_type = $(element).attr("data-table-type");

            var row = target.parents(".user_input_field:first");
            if (target.is(".arrow_up")) {
                row.hide("slow", function () {
                    row.insertBefore(row.prev()).show("slow", function(){
                        insert_ids();
                        render_post_ids();
                    });


                })
            } else if (target.is(".arrow_down")) {

                event.preventDefault();
                row.hide("slow", function () {
                    row.insertAfter(row.next()).show("slow", function(){
                        insert_ids();
                        render_post_ids();
                    });

                })
            }




        }else if (target.is(".email_item_options .arrow_up") || target.is(".email_item_options .arrow_down")) {
            event.preventDefault();
            element = $(target).closest(".email-item");

            var row = target.parents(".email-item:first");
            if (target.is(".arrow_up")) {
                row.hide("slow", function () {
                    row.insertBefore(row.prev()).show("slow", function(){

                    });


                })
            } else if (target.is(".arrow_down")) {

                event.preventDefault();
                row.hide("slow", function () {
                    row.insertAfter(row.next()).show("slow", function(){

                    });

                })
            }




        }else if (target.is(".design_switch")) {


            if(target.is(".switch_designs")){
                if(!$(target).hasClass("switch_active")){
                    $(".switch_content").removeClass("switch_active");
                    $(".switch_designs").addClass("switch_active");

                    $(".content_tool_elements").slideUp("slow", function(){
                        $(".design_tool_elements").slideDown("slow");
                    });
                }
            }else if(target.is(".switch_content")){
                if(!$(target).hasClass("switch_active")){
                    $(".switch_designs").removeClass("switch_active");
                    $(".switch_content").addClass("switch_active");

                    $(".design_tool_elements").slideUp("slow", function(){
                        $(".content_tool_elements").slideDown("slow");
                    });
                }
            }









        }else if (target.is(".datepicker_userspec") || target.is(".timepicker_userspec")) {
            event.preventDefault();
            element = $(target).closest(".user_input_field");
            table_id = $(element).attr("data-table-input-id");
            table_type = $(element).attr("data-table-type");

            render_table(table_id, table_type);
            render_post_ids();


        }else if (target.is("#setmetaboxes")) {
            event.preventDefault();
            select_metabox = $("#email_template .metabox");
            message_element = $(".mail_saving");

            if(!select_metabox[0]){
                metabox = $("#metaboxes");
                item = $(metabox).find(".email-item").clone();

                $("#email_template").append(item);

                new_id = 999999;
                new_item = $(item).find(".cke_editable");

                $(new_item).attr("id", "editor" + new_id)
                    .attr("aria-label", "Rich Text Editor, editor" + new_id)
                    .attr("title", "Rich Text Editor, editor" + new_id)
                    .attr("contenteditable", "true");
                CKEDITOR.inline("editor" + new_id);

                button = $(event.target);
                text = "Meta-boxes inserted!";
                show_success_message(element, button, text);

            }else{
                button = $(event.target);
                button.prop("disabled", true);
                text = "Meta-boxes are already inserted!";
                show_info_message(message_element, button, text);
            }
            





        } else if (target.is(".btn-selection-field-adder")) {
            event.preventDefault();
            input_field = target.closest(".select_field_area").find("input[name=selection_user_add]");
            title_field = $("#formtitle").val();
            input = input_field.val();

            id = target.data("table-id");
            // Titel field_title = $("#field_title_1").text(title_field);

            if (input != "" && title_field != "") {


                // New Option in the Selectfield
                new_option = $("<option>");
                new_option.appendTo(target.closest(".select_field_area").find("select"));

                new_option.text(input);
                new_option.val(input);

                // New Selection in the Table
                tr = $(".tr_template").clone();
                tr.attr("data-table-id", id);
                tr.attr("data-table-input-id", id);
                tr.attr("data-table-type", "selection");
                tr.removeClass("tr_template");
                tr.addClass("is_selection");
                tr.find(".editable_input").val(input);
                tr.find(".editable_text").text(input);

                table = $("body").find(".tbody_id_" + id);
                tr.appendTo(table);
                input_field.val("");


                table = $(target).closest(".select_field_area");
                table_id = tr.data("table-id");
                // table_type = tr.data("table-type");

                table_type = table.data("type");



                $(".select_field_area input").on("blur", function (event) {
                    target = $(event.target);

                    table = $(target).parents(".select_field_area");
                    table_id = $(table).attr("data-table-id");
                    table_type = $(table).attr("data-type");

                    render_table(table_id, table_type);
                    render_post_ids();
                });
                $(".select_field_area select").on("blur", function (e) {
                    target = $(event.target);

                    table = $(target).parents(".select_field_area");
                    table_id = $(table).attr("data-table-id");
                    table_type = $(table).attr("data-type");

                    render_table(table_id, table_type);
                    render_post_ids();
                });

                
                render_table(table_id, table_type);
                render_post_ids();


            }
        } else if (target.is(".input_field_title") || target.is(".input_field_placeholder")) {
            event.preventDefault();
            if (target.is(".input_field_title")) {
                table = $(target).closest(".user_input_field");
                table_id = $(table).data("table-input-id");
                table_type = $(table).attr("data-type");
                dd_element = $(table).find("dd");
                dt_element = $(table).find("dt > span");


                title_input_field = $(dd_element).find(".input_field_title");
                hidden_title_input_field = $(dd_element).find(".hidden_user_field_title_"+table_id);

                $(title_input_field).on("blur", function (e) {
                    new_title = $(this).val();

                    $(dt_element).text(new_title + " (" + table_type + " field)");
                    $(hidden_title_input_field).val(new_title);
                });


                // Bei einem Input feld:
                $(".input_field input").on("blur", function (e) {


                    table = target.closest('.input_field');
                    table_id = table.attr("data-table-id");
                    table_type = table.attr("data-table-type");


                    render_table(table_id, table_type);
                    render_post_ids();

                });

            }
        }

        // SELECT: ADD Field


        function window_alert_show(text) {

            $(".overlay_wrapper p").text(text);
            $(".overlay#delete_overlay").slideDown("fast", function () {
                $(".overlay_wrapper#overlay_wrapper").slideDown("slow");
            });
        }
        function show_settings() {
            $(".overlay.is_hidden_settings").slideDown("fast", function () {
                $("#overlay_wrapper_settings").slideDown("slow");
            });
        }
        function show_testmailer() {
            $(".overlay.is_hidden_testmail").slideDown("fast", function () {
                $("#overlay_wrapper_testmail").slideDown("slow");
            });
        }
        function show_info() {
            $(".overlay.is_hidden_showinfo").slideDown("fast", function () {
                $("#overlay_wrapper_show_info").slideDown("slow");
            });
        }




        function render_table(id, type) {
            var table = $('*[data-table-id=' + id + ']');

            var input = $('*[data-table-input-id=' + id + ']');
            var title = $("#field_title_"+id);




            // Hidden Fields
            var user_field_id = $(input).find("input.hidden_user_field_id_" + id);
            var user_field_title = $(input).find("input.hidden_user_field_title_" + id);

            var user_field_placeholder = $(input).find("input.hidden_user_field_placeholder_" + id);

            user_field_id.val(id);
            user_field_title.val(title.val());


            var user_field_type = $(input).find(".hidden_user_field_type_" + id);
            user_field_type.val(type);

            var user_field_default = $(input).find(".hidden_user_field_default_" + id);
            var user_field_values = $(input).find(".hidden_user_field_values_" + id);
            user_field_values.val("");

            switch (type) {
                case "select":
                    var select = input.find(".selection_user").html("");


                    $(table).find("tbody tr").each(function () {
                        var value = $(this).find(".editable_text").text();
                        var option = $("<option>");
                        option.val(value);
                        option.text(value);
                        option.appendTo(select);

                        // In das Hidden-Feld eintragen:
                        options = user_field_values.val() + ":" + value + ":";



                        user_field_values.val(options);


                        user_field_default.val(select.val());

                    });
                    break;

                case "checkbox":
                    var select = input.find(".selection_user").html("");


                    $(table).find("tbody tr").each(function () {
                        var value = $(this).find(".editable_text").text();
                        var option = $("<option>");
                        option.val(value);
                        option.text(value);
                        option.appendTo(select);

                        // In das Hidden-Feld eintragen:
                        options = user_field_values.val() + ":" + value + ":";



                        user_field_values.val(options);


                        user_field_default.val(select.val());
                    });


                    break;
                case "text":
                    title = $(table).find(".input_field_title").val();
                    placeholder = $(table).find(".input_field_placeholder").val();

                    user_field_default.val(placeholder);
                    user_field_title.val(title);

                    
                    break;

                case "number":
                    title = $(table).find(".input_field_title").val();
                    placeholder = $(table).find(".input_field_placeholder").val();
                    min_value = $(table).find(".min_value_field").val();
                    max_value = $(table).find(".max_value_field").val();

                    user_field_default.val(placeholder);
                    user_field_title.val(title);
                    user_field_values.val(min_value + "," + max_value);
                    
                    
                    break;

                case "date":
                    title = $(table).find(".input_field_title").val();
                    placeholder = $(table).find(".input_field_placeholder").val();
                    default_value = $(table).find(".datepicker_userspec").val();

                    user_field_placeholder.val(placeholder);
                    user_field_default.val(default_value);
                    user_field_title.val(title);

                    break;

                case "time":
                    title = $(table).find(".input_field_title").val();
                    placeholder = $(table).find(".input_field_placeholder").val();
                    default_value = $(table).find(".timepicker_userspec").val();

                    user_field_placeholder.val(placeholder);
                    user_field_default.val(default_value);
                    user_field_title.val(title);

                    break;

                case "radio":
                    var select = input.find(".selection_user").html("");


                    $(table).find("tbody tr").each(function () {
                        var value = $(this).find(".editable_text").text();
                        var option = $("<option>");
                        option.val(value);
                        option.text(value);
                        option.appendTo(select);

                        // In das Hidden-Feld eintragen:
                        options = user_field_values.val() + ":" + value + ":";



                        user_field_values.val(options);


                        user_field_default.val(select.val());

                    });
                    break;
                case "textarea":
                    title = $(table).find(".input_field_title").val();
                    placeholder = $(table).find(".input_field_placeholder").val();

                    user_field_placeholder.val(placeholder);
                    user_field_title.val(title);

                    break;
            }

            render_post_ids();

        }

    });
    function render_post_ids(){
        hidden_post_ids = $("#userfieldids");
        $(hidden_post_ids).val("");

        $("#userspec_field_area .hidden_id_input").each(function () {

            var id = $(this).val();
            var new_id = ":" + id + ":";
            $(hidden_post_ids).val(hidden_post_ids.val() + new_id);
        });
    }
    // IST FÜR DESIGN-TEMPLATE:

    dragula([document.querySelector('#left_1'), document.querySelector('#email_template')], {
        copy: function (el, source) {
            return source === document.querySelector('#left_1')
        },
        accepts: function (el, target) {
            return target !== document.querySelector('#left_1')
        }
    });
    dragula([document.querySelector('#left_2'), document.querySelector('#email_template')], {
        copy: function (el, source) {
            return source === document.querySelector('#left_2')
        },
        accepts: function (el, target) {
            return target !== document.querySelector('#left_2')
        }


    }).on('drop', function (el) {
        email_part = $(el).find(".email-item").clone();
        $(email_part).insertAfter($(el));
        $(el).hide("fast", function(){
            $(this).remove();
        });
        new_id =  Math.floor((Math.random() * 100) + 1);
        $(email_part.find("div").first()).attr("id", "editor" + new_id)
            .attr("aria-label", "Rich Text Editor, editor" + new_id)
            .attr("title", "Rich Text Editor, editor" + new_id)
            .attr("contenteditable", "true");
        CKEDITOR.inline("editor" + new_id);

        massage_element = $('.mail_saving');
        text = "Box added!";
        show_success_message(massage_element, false, text);

    });

    dragula([document.querySelector('#left_3'), document.querySelector('#email_template')], {
        copy: function (el, source) {

            return source === document.querySelector('#left_3')
        },
        accepts: function (el, target) {
            return target !== document.querySelector('#left_3')
        }
    });
    dragula([document.querySelector('#left_4'), document.querySelector('#email_template')], {
        copy: function (el, source) {
            return source === document.querySelector('#left_4')
        },
        accepts: function (el, target) {
            return target !== document.querySelector('#left_4')
        }
    });


    // Autosave abfrage

    setTimeout(function(){

        // select the target node
        var target = document.querySelector('#email_template');

        // create an observer instance
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                fill_email_inputs();

            });
        });

        // later, you can stop observing
        //observer.disconnect();
    }, 3000);

    function fill_email_inputs(){
        emailinput_all = $("#emailhtmlall");
        emailinput_email = $("#emailhtmltext");

        // Kompletter HTML-Anteil ins Input:
        emailinput_all = emailinput_all.val($('#email_template').html());

        // Innerer HTML-Anteil ins Input:
        $("#email_template .email-item").each(function(element){



            clone = $(this).clone();

            clone.find(".email_item_options").remove();
            innerhtml = $(clone).html();


            emailinput_email.val(emailinput_email.val() + innerhtml);



        });


    }

});

// CREATE NEW DESIGN

$(function(){

    $('.btn_template').on('click', function() {
        var $this = $(this);
        var baseURL = $('body').data('baseurl');
        var mail_id = $("#this_id").val();
        var user_id = $("#user_id").val();
        var title = $("#mail_title").val();

        if(mail_id != "" || mail_id != 0){

            $this.button('loading');

            if($this.data("action")== "save"){
                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/designs/saveAsTemplate',
                    data: {
                        user_id: user_id,
                        mail_id: mail_id,
                        title: title
                    },
                    success: function (data) {
                        $this.removeClass("btn-self").addClass("btn-success");
                        $this.button('success');
                        $this.prop("disabled", true);
                        setTimeout(function(){
                            $this.removeClass("btn-success").addClass("btn-danger");
                            $this.text("Delete as Template");
                            $this.data("action", "delete");
                            $this.prop("disabled", false);
                        }, 2000);

                    },
                    error: function(xhr, textStatus, errorThrown){


                    }



                });
            }else if($this.data("action")=="delete"){
                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/designs/deleteTemplate',
                    data: {
                        user_id: user_id,
                        mail_id: mail_id,
                        title: title
                    },
                    success: function (data) {
                        $this.removeClass("btn-danger").addClass("btn-success");
                        $this.button('success');
                        $this.prop("disabled", true);
                        setTimeout(function(){
                            $this.removeClass("btn-success").addClass("btn-self");
                            $this.text("Save as Template");
                            $this.data("action", "save");
                            $this.prop("disabled", false);
                        }, 2000);

                    },
                    error: function(xhr, textStatus, errorThrown){


                    }



                });
            }




    };

});
});

$(function(){
    select = $("#select_event");
    types = $(".mailtype_choose");
    types_input = $("#select_type");
    var baseURL = $('body').data('baseurl');

    if(select[0]){

        $(select).on("focus", function(event){
            $(types).slideUp("slow", function(){
                $(this).hide();
            });
        });
        $(select).on("change", function(event){
            if($("#select_event option:selected").val() != "default"){
                // Wenn nicht default dann mach ajax:

                var user_id = $("#user").val();
                var event_id = $("#select_event option:selected").val();
                available_mails = {invitation: 'Invitation', savethedate: 'Save the date', reminder: 'Reminder', information: 'Information', thankyou: 'Thank You', confirmation: 'Confirmation'};

                $.ajax({
                    method: "POST",
                    url: baseURL + 'backend/designs/checkMailTypes',
                    data: {
                        userid: user_id,
                        eventid: event_id
                    },
                    success: function (data) {



                        select_type = $("#select_type");
                        $(select_type).html("");



                        $.each(data, function(index) {

                            if(available_mails.hasOwnProperty(data[index]['mail_type'])){
                                delete available_mails[data[index]['mail_type']];
                            }
                        });

                        if($.inArray(data, available_mails)){

                            optionsset = false;

                            $.each( available_mails, function( key, value ) {
                                option = $("<option></option>");
                                option.val(key);
                                option.text(value);
                                option.appendTo(select_type);
                                optionsset = true;
                            });

                            if(optionsset == false){
                                option = $("<option value='nomails'>No mails available!</option>");
                                option.appendTo(select_type);
                            }

                        }else{

                            option = $("<option value='nomails'>No mails available!</option>");
                            option.appendTo(select_type);
                        }



                        $(types).slideDown("slow", function(){
                            $(types_input).focus();
                        });



                    },
                    error: function(xhr, textStatus, errorThrown){
                        select_type = $("#select_type");
                        $(select_type).html("");



                        $.each( available_mails, function( key, value ) {
                            option = $("<option></option>");
                            option.val(key);
                            option.text(value);
                            option.appendTo(select_type);

                        });

                        $(types).slideDown("slow",function(){
                            $(types_input).focus();
                        });

                    }

                });
            }
        });
    }

});







// NEW EVENT - DATEPICKER:

$(function(){

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


    $("a.arrow_up,a.arrow_down").click(function(event) {
        event.preventDefault();
        var row = $(this).parents("tr:first");
        if ($(this).is("a.arrow_up")) {
            row.hide("slow", function () {
                row.insertBefore(row.prev()).show("slow");
                insert_ids();
            })
        } else {
            row.hide("slow", function () {
                row.insertAfter(row.next()).show("slow");
                insert_ids();
            })
        }
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


});
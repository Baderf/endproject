$(document).ready(function(){

    var baseURL = $('.site-wrapper').data('baseurl');

    // INPLACE EDITOR - Message Edit
    if( $('.list-chat').length >0){
        $('.item.own-msg p.message').on('dblclick', function(){

            var $el = $(this);

            var val = $el.text();
            var msgID = $el.closest('.item').data('msgid');
            $el.after('<input type="text" value="' + val + '" autofocus class="form-control inplace" />').hide();
            // geht auch mit autofocus $('input.inplace').focus();

            // AJAX ON BLUR
            $('input.inplace').on('blur', function(){
                var inputVal = $(this).val();

                $.ajax({
                    method: 'POST',
                    url: baseURL + 'messages/updatemessage',
                    data : {
                        msgid : msgID, msg : inputVal
                    },
                    success : function(){
                        $('input.inplace').remove();
                        $el.text(inputVal).fadeIn();
                    }
                })
            });

        });
    }







    // AJAX MESSAGES REPLY

    if( $('#form-reply').length > 0 ) {
        $('#form-reply').on("submit", function (e) {
            e.preventDefault();

            var message = $('#f-message').val();
            var groupid = $('#f-chatid').val();

            if ( message != "" ) {

                $.ajax({
                    method: "POST",
                    url: baseURL + 'messages/insertmessage',
                    data: {
                        message: message,
                        groupid: groupid
                    },
                    success: function (data) {

                        data = $.parseJSON(data);

                            $("<div class='item own-msg'><p><strong>" + data.uname + "</strong></p><p class='message'>" + message + "</p><p class='text-info'>geschrieben am "  + data.time + "</p></div>").appendTo(".list-chat").hide().slideDown(700);



                    }

                });
            };
        });
    }

    // Autocomplete
    if( $('#form-messages').length > 0 ){

        $('#f-user').before('<div class="user-list"></div>');
        $('#f-user').after('<div class="user-suggestions"></div>');

        $('#f-user').on('keyup', function(e){

            var val = $(this).val();

            $.ajax({
                'url'  : baseURL + 'users/getusersbyname/' + val,
                success : function( data ){

                   if( data.length > 0){

                       var $el = $('.user-suggestions');
                       $el.html('<ul></ul>');

                        $.each(data, function(key, value){

                            $el.find('ul').append('<li data-id="' + value.id + '">' + value.uname + '</li>');
                        });

                       $('.user-suggestions ul li').on('click', function(){

                           var id = $(this).data('id');
                           var uname = $(this).text();

                           $('.user-list').append('<span>' + uname + '</span>');
                           $('#f-userids').val( $('#f-userids').val() + ':' + id + ':');

                           $('#f-user').val('');
                           $el.html('');
                       });
                   }
                }
            });
        });
    }



    $('.md-mobile-btn').click(function(){
        $(this).toggleClass('open');
    });

});

$(window).on("scroll touchmove", function () {
    $('.md-top').toggleClass('shrink', $(document).scrollTop() > 0);
});
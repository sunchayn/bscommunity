(function($){
    //-###- AJAX -###-
    var isProcessing = false;
    $(document).ajaxStart(function() {
        if (isProcessing === true)
            xhr.abort();
        isProcessing = true;
    });
    $(document).ajaxComplete(function(e) {  isProcessing = false; });
    //form submitters
    $('.formSubmit').on("click",function(e){
        e.preventDefault();
        $(this).closest('form').submit();
    });
    //setup ajax
    $(document).ajaxError(function(e, x) {
        if (x.status == 500)
            $('.result-modal').removeClass('succ').addClass('fail').html('<p> sorry there\'s an Internel Server Error 500 </p>').fadeIn(400).delay(3000).fadeOut(400);
    });
    $('form.ajax').ajaxSubmit();
    $('form.ajaxModal').ajaxSubmitWithModal();
    $('.ajaxQuickSubmit').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).ajaxQSubmit();
    });
    //normal ajax request
    $('.normalAJAX').on('click',function(e){
        e.preventDefault();
        var target = $(this),
            content = target.data('content'),
            url = target.data('url');
        target.ajaxRequest({url : url, data : content}, function(response){
            if (response['done'])
                $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            else
                $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
        });
    });
    //ajax request with reload if succeed
    $('.reloadAJAX').on('click',function(e){
        e.preventDefault();
        var target = $(this),
            content = target.data('content'),
            url = target.data('url');
        target.ajaxRequest({url : url, data : content}, function(response){
            if (response['done'])
            {
                $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                setTimeout(function(){ location.reload(true); }, 3000);
            }
            else
                $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
        });
    });
    //-delete skill
    $('.ajaxQuickDeleteSkill').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('skill', function(){
            var data = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteSkill', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.delete-wrapper').fadeOut(400, function(){
                            $(this).remove();
                        });
                    }, 3000);
                }
                else
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            });
        });
    });
    //-delete education title
    $('.ajaxQuickDeleteEdTitle').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('EdTitle', function(){
            var data = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteEdTitle', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.delete-wrapper').fadeOut(400, function(){
                            $(this).remove();
                        });
                    }, 3000);
                }
                else
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            });
        });
    });
    //-delete reply
    $('.delete-reply').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('reply', function(){
            var data = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteReply', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.delete-wrapper').fadeOut(400, function(){
                            $(this).remove();
                        });
                    }, 3000);
                }
                else
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            });
        });
    });
    //-delete thread
    $('.deleteThread').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteThread', function(){
            var data = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteThread', data : data}, function(response){
                if (response['done'])
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                else
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            });
        });
    });
    //-delete thread
    $('.deleteThreadFF').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteThread', function(){
            var data = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteThreadFromForums', data : data}, function(response){
                if (response['done'])
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                else
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            });
        });
    });
    //delete message(s)
    $('.deleteMsg').on('submit',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteMessages', function(){
            var url = target.attr('action'),
                data = target.serialize();
            target.ajaxRequest({url : url, data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        $('.ticket.checked').fadeOut(400, function(){
                            $(this).remove();
                        });
                    }, 3000);
                }
                else
                {
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){ location.reload(true); }, 3000);
                }
            });
        });
    });
    //delete SIngle Message
    $('.deleteSingleMsg').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteMessages', function(){
                var data = target.attr('data-get');
            target.ajaxRequest({url : 'ajax/deleteMessage', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                }
                else
                {
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                }
            });
        });
    });
    //delete Draft
    $('.deleteDraft').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteDraft', function(){
                var data = target.attr('data-content');
            target.ajaxRequest({url : 'ajax/deleteDraft', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    target.closest('.draft-modal').delay(3000).fadeOut(400, function(){$(this).remove();});
                }
                else
                {
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                }
            });
        });
    });
    //get the receiver by id
    $('#getReceiver').on('blur', function(e){
        var $this = $(this),
            text = $this.val();
        if (text.length > 0)
        {
            $this.ajaxRequest({url : 'ajax/getUser', data : 'id='+text}, function(response){
                if (response['done'])
                {
                    $this.next().hide();
                    $('<a href="profile/'+ text +'" class="receiverHolder">'+ response['done'] +'</a>&nbsp;<a class="icon-cancel" id="cancel-rec"></a>').insertAfter('#getReceiver');
                    $this.hide();
                    $('#cancel-rec').on('click', function(){
                        $('.receiverHolder').remove();
                        $(this).remove();
                        $this.show();
                    });
                }
                else
                {
                    $('.not-found').text(response['error']).show();
                }
            });
        }
    });
    //store js
    $('.buy-item').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('buyItem', function(){
            var data = target.data('content');
            target.ajaxRequest({url : 'ajax/buyItem', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){ location.reload(true); }, 3000);
                }
                else
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            });
        });
    });
    //inventory js
    $('.consume-item').on('click', function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('consumeItem', function(){
            var data = target.data('content');
            target.ajaxRequest({url : 'ajax/consumeItem', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){ location.reload(true); }, 3000);
                }
                else
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
            });
        });
    });
    //deactivate account
    $('#desactivate-acc').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deactivateAccount', function(){
            var data = 'token='+target.attr('data-token');
            target.ajaxRequest({url : 'ajax/deactivateUser', data : data}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        $('.ticket.checked').fadeOut(400, function(){
                            $(this).remove();
                        });
                    }, 3000);
                }
                else
                {
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeOut(function(){ location.reload(true); }, 3000);
                }
            });
        });
    });
    //profile js
    $('.followUnfollow').on('click', function(e){
        e.preventDefault();
        var target = $(this),
            data = target.data('content'),
            action = target.attr('id');
        target.ajaxRequest({url : 'ajax/'+action, data : data}, function(response){
            if (response['done'])
            {
                $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                if (action == 'followUser')
                {
                    var text = target.text(),
                        trigger = $('.followUnfollow').attr('data-trigger');
                    target.text(trigger).attr('id', 'unfollowUser').attr('data-trigger', text);
                }
                else
                {
                    var text = target.text(),
                        trigger = $('.followUnfollow').attr('data-trigger');
                    target.text(trigger).attr('id', 'followUser').attr('data-trigger', text);
                }
            }
            else
                $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
        });
    });
    //pagination
    $('.page-swapper').on('change', function(){
        window.location.href = $(this).val();
    });
    //disable
    $('a.disabled').on('click', function(e){ e.preventDefault(); });
    //see notification
    $('.notifications').one('click', function(){ $(this).ajaxRequest({url : 'ajax/seeNotifications'}); });
    //report trigger
    $('.reportTrigger').on('click', function(){
        var trigger = $(this),
            target = $('#report-panel');
        $('#reported').attr('value', trigger.data('reported'));
        $('#type').attr('value', trigger.data('type'));
        target.find('.ajax-loader').empty()
        target.find('textarea').removeClass('error').val('');
    });
    //load more followers or followings
    $('.load-more').on('click',function(e){
        e.preventDefault();
        if ($(this).hasClass('disabled'))
            return false;
        var trigger = $(this),
            form = trigger.parents('form.more'),
            url = form.attr('action'),
            content = form.serialize(),
            holder = form.find('.holder');
        form.find('.container').append('<div class="temp"><img src="img/loader.gif" /></div>');
        trigger.ajaxRequest({url : url, data : content, dataType : 'html'}, function(response){
            form.find('.temp').remove();
            var data = $(response);
            form.find('.container').append(data).find('.temp').fadeIn().children().unwrap();
            holder.val(Number(holder.val()) + 1);
            if (form.find('.no-more').length)
                form.find('.load-more').addClass('disabled');
        });
    });
    //-###-
    //check tickets
    var len = $(".checkboxTickets").size();
    $(".checkboxTickets").on('change', function(){
        $this = $(this);
        if ($this.is(':checked')) {
            $this.parents('.ticket').addClass('checked');
            var count = 0;
            $(".checkboxTickets").each(function(index){
                if (!$(this).prop("checked"))
                    return false;
                count++;
                if (count == len)
                    $(".selectAll").prop("checked", true);
            });
        } else {
            $this.parents('.ticket').removeClass('checked');
            $(".selectAll").prop("checked", false);
        }
    });
    //check all tickets
    $(".selectAll").on("change", function(){
        $this = $(this);
        if ($this.is(':checked')) {
            $(".selectAll").prop("checked", true);
            $(".checkboxTickets").each(function(){
                $(this).prop("checked", true);
                $('.ticket').addClass('checked');
            });
        } else {
            $(".selectAll").prop("checked", false);
            $(".checkboxTickets").each(function(){
                $(this).prop("checked", false);
                $('.ticket').removeClass('checked');
            });
        }
    });
    //-###-
    //external link warning bind
    $('.external').each(function(){
        var comp = new RegExp(location.host),
            $this = $(this);
        $this.find('a').each(function(){
            if(!comp.test($(this).attr('href'))){
                $(this).addClass('externalLink');
            }
        });
    });
    //show the warning
    $('.externalLink').on('click', function(e){
        e.preventDefault();
        var panel = $('#externalLink'),
            link = $(this).attr('href');
        centerPanel(panel);
        $(".overlay").show();
        panel.hide().fadeIn(400);
        $(window).resize(function() { centerPanel(panel); });
        //when press ESC button
        $(document).keyup(function(e) {
            var code = e.keyCode || e.which;
            if(code == '27') {
                $('.overlay').hide();
                panel.hide();
            }
        });
        //when click cancel
        $('.overlay, .cancel').on('click',function(e){
            e.preventDefault();
            $('.overlay').hide();
            panel.hide();
        });
        panel.find('.linkHolder').html(link);
        panel.find('.theLink').attr('href', link);
    });
    //attachment uploader
    $('.attch-holder').on('submit', function(e){
        e.preventDefault();
        var holder = $(this);
        var url = holder.attr('action');
        var data = new FormData(holder[0]);
        var loader = holder.find('.upload-loader');
        data.append('bsc_atc_current', $('.attachmentsBus').val());
        loader.fadeIn(400);
        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            async: true,
            processData: false,
            contentType: false,
            success : function (response){
                $('.att-rslt').html('');
                //fetch succeeded files
                if (response.succeed.length > 0)
                    $('.succ-attch').show();
                $.each(response['succeed'], function(k, v) {
                    $('.succ-attch').append('<div class="attach-item">' + v['name'] + ' <small>' + v['size'] + '</small></div>');
                });
                //fetch faild files
                if (response.failed.length > 0)
                    $('.fail-attch').show();
                $.each(response['failed'], function(k, v) {
                    $('.fail-attch').append('<div class="attach-item">' + v['name'] + ' <small>' + v['size'] + '</small> - <span><bdo dir="auto">'+ v['error'] +'</bdo></span></div>');
                });
                $('.attachmentsBus').val(response.data);
            },
            error: function(error){
                alert("something went wrong !");
            },
            complete: function() {
                loader.hide();
            }
        });
    });
})(jQuery);

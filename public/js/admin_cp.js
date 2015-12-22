(function($){
//sub menu
$(".sub-menu>a").on("click", function(e){
    e.preventDefault();
    $(this).toggleClass('focused');
    $(this).next('nav').slideToggle(400);
    $(this).children(".toggle").toggleTwoClass("icon-angle-down", "icon-angle-up");
});
$(".sub-menu>a.checked").next('nav').show();
$(".sub-menu>a.checked").children(".toggle").toggleTwoClass("icon-angle-down", "icon-angle-up");
//end - sub menu
//#####
// ajax
    //form submitter
    $('.formSubmit').on("click",function(e){
        e.preventDefault();
        $(this).closest('form').submit();
    });
    //submit an ajax request via form
    $('form.ajax').ajaxSubmit();
    //submit an ajax request and show the result in a pop up
    $('form.ajaxModal').ajaxSubmitWithModal();
    //pagination
    $('.page-swapper').on('change', function(){
        window.location.href = $(this).val();
    });
    //disable
    $('a.disabled').on('click', function(e){
        e.preventDefault();
    });
    //see notification
    $('.notifications').one('click', function(){
        $(this).ajaxRequest({url : 'ajax/seeNotifications'});
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
    //edit category
    $('.edit-category').on('click',function(e){
        e.preventDefault();
        var target = $(this),
            content = target.data('content');
            target.ajaxRequest({url : 'ajax/getCategory', data : content}, function(response){
                console.log(response);
                $panel = $('#edit-category');
                if (response['done'])
                {
                    var cat = response['done'];
                    $panel.find('#title').val(cat.title);
                    $panel.find('#order').val(cat.order);
                    $panel.find('#desc').val(cat.desc);
                    $panel.find('#cat_id').val(cat.id);
                    switch (Number(cat.visibility))
                    {
                        case 2 :
                            $panel.find('#membersU').attr('checked', 'checked');
                            break;
                        case 3 :
                            $panel.find('#administrationU').attr('checked', 'checked');
                            break;
                        default :
                            $panel.find('#allU').attr('checked', 'checked');
                    }
                }
                else
                    $panel.find('.cat-fields').html(response['error']);
            });
    });
    //delete category
    $('.delete-category').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteCategory', function(){
            var content = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteCategory', data : content}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.cat-modal').fadeOut(400, function(){
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
    //edit forum
    $('.edit-forum').on('click',function(e){
        e.preventDefault();
        var target = $(this),
            content = target.data('content');
        target.ajaxRequest({url : 'ajax/getForum', data : content}, function(response){
            $panel = $('#edit-forum');
            if (response['done'])
            {
                var forum = response['done'];
                $panel.find('#title').val(forum.title);
                $panel.find('#logo').val(forum.logo);
                $panel.find('#desc').val(forum.desc);
                $panel.find('#cat_id').val(forum.cat_id);
                $panel.find('#id').val(forum.id);
            }
            else
                $panel.find('.cat-fields').html(response['error']);
        });
    });
    //delete category
    $('.delete-forum').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteForum', function(){
            var content = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteForum', data : content}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.cat-modal').fadeOut(400, function(){
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
    //delete user
    $('.delete-user').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteUser', function(){
            var content = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteUser', data : content}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.one-row').fadeOut(400, function(){
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
    //delete rule
    $('.delete-rule').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteRule', function(){
            var content = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteRule', data : content}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.one-rule').fadeOut(400, function(){
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
    //delete role
    $('.delete-role').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteRole', function(){
            var content = target.data('content');
            target.ajaxRequest({url : 'ajax/deleteRole', data : content}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){
                        target.parents('.one-row').fadeOut(400, function(){
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
    //edit role
    $('.edit-role').on('click',function(e){
        e.preventDefault();
        var target = $(this),
            content = target.data('content');
        target.ajaxRequest({url : 'ajax/getRole', data : content}, function(response){
            var $panel = $('#edit-role');
            if (response['done'])
            {
                var role = response['done'],
                    acc = $.parseJSON(role.access_json);
                $panel.find('#id').val(role.id);
                $panel.find('#name_ar').val(role.name_ar);
                $panel.find('#name_en').val(role.name_en);
                $(acc).each(function(){
                    $panel.find('#'+this).attr('checked', 'checked');
                });
            }
            else
                $panel.find('.fields').html(response['error']);
        });
    });
    //edit rule
    $('.edit-rule').on('click',function(e){
        e.preventDefault();
        var target = $(this),
            content = target.data('content');
        target.ajaxRequest({url : 'ajax/getRule', data : content}, function(response){
            var $panel = $('#edit-rule');
            if (response['done'])
            {
                var rule = response['done'];
                $panel.find('#id').val(rule.id);
                $panel.find('#title_ar').val(rule.title_ar);
                $panel.find('#title_en').val(rule.title_en);
                $panel.find('#description_en').val(rule.description_en);
                $panel.find('#description_ar').val(rule.description_ar);
            }
            else
                $panel.find('.fields').html(response['error']);
        });
    });
    //delete ticket(s)
    $('.delete-tickets').on('submit',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('deleteTickets', function(){
            var url = target.attr('action'),
                data = target.serialize();
            target.ajaxRequest({url : url, data : data}, function(response){
                if (response['nothing'])
                    return false;
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
    //approve or decline
    $('.usernameRequest').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxConfirm('approveDecline', function(){
            var content = target.data('content');
            target.ajaxRequest({url : 'ajax/approveDecline', data : content}, function(response){
                if (response['done'])
                {
                    $('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                }
                else
                {
                    $('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
                    setTimeout(function(){ location.reload(true); }, 3000);
                }
            });
        });
    });
    //edit category
    $('.change-role').on('click',function(e){
        e.preventDefault();
        var target = $(this);
        target.ajaxRequest({url : 'ajax/getUserRole', data : target.data('content')}, function(response){
            $panel = $('#change-role');
            if (response['done'])
            {
                var role = response['done'];
                $panel.find('.fields').show().next('.no-data').hide().html();
                $panel.find('#id').val(response['id']);
                console.log($panel.find('#role'+role['role']));
                $panel.find('#role'+response['role']).attr("selected", "selected");
            }
            else
                $panel.find('.fields').hide().next('.no-data').html( response['error']).show();
        });
    });
//help center
    //check tickets
    var len = $(".checkboxTickets").size();
    $(".checkboxTickets").on('change', function(){
        $this = $(this);
        if ($this.is(':checked')) {
           $this.parents('.ticket').addClass('checked');
           var count = 0;
           $(".checkboxTickets").each(function(index){
                if (!$(this).prop("checked")) {
                    return false;
                }
                count++;
                if (count == len){
                    $(".selectAll").prop("checked", true);
                }
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
//end - help center
//#####
})(jQuery);
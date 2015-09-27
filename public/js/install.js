(function($){
    //form submitter
    $('.formSubmit').on("click",function(e){
        e.preventDefault();
        $(this).closest('form').submit();
    });
    //ajax
    var isProcessing = false;
    $(document).ajaxStart(function() {
        if (isProcessing === true)
            xhr.abort();
        isProcessing = true;
    });
    $(document).ajaxComplete(function() { isProcessing = false; });
    $('form.ajax').ajaxSubmit();
    //install tables
    $('.install-tables').on('click', function(e){
        e.preventDefault();
        $('.ajax-result').css({'display': 'inline-block'});
        $('.step1').ajaxRequest({url : 'install/tables'}, function(response){
            for (key in response) {
                $('#'+key).children('.ajax-result').replaceWith(response[key]);
            }
            $('.next').show();
        });
    });
    //create settings
    $('.save-data').on('click', function(e){
        e.preventDefault();
        target = $('.ajax-loader'),
        form = $('#form');
        target.show().html('<img src="img/loader.gif" />');
        form.submit(function(e)
        {
            e.preventDefault();
        });
        var dataV = form.serialize(),
            urlV = form.attr('action');
        form.ajaxRequest({url : urlV, data : dataV}, function(response){
            if (response['done'])
            {
                $('.next').show();
                form.find("input, textarea").removeClass('error');
                target.html('<span>' + response['done'] + '</span>');
            }else{
                if (response['already'])
                {
                    $('.next').show();
                    target.html('<strong class="color-5">'+response['already']+'</strong>');
                }else if (response['displayError'])
                {
                    target.html('<strong class="color-5">'+response['displayError']+'</strong>');
                }else{
                    var val = "<ul class='have-arrow'>";
                    $.each(response, function() {
                        $.each(this, function(k, v) {
                            val += "<li>"+v+"</li>";
                        });
                    });
                    val += "</ul>";
                    target.html(val);
                    form.find("input, textarea").removeClass('error').each(function(){
                        if (response[$(this).attr('name')])
                            $(this).addClass('error');
                    });
                }
            }
            $('html,body').animate({
                scrollTop: target.offset().top
            }, 'fast');
        });
    });
})(jQuery);
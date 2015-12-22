(function(){
	//scroll top
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			if ($(window).outerWidth() > 450){
				$('.scroll-up').fadeIn();
			}else{
				$('.scroll-up-res').fadeIn();
			}
		} else {
			if ($(window).outerWidth() > 450){
				$('.scroll-up').fadeOut();
			}else{
				$('.scroll-up-res').fadeOut();
			}
		}
	});
	// click event to scroll to top
	$('.scroll-up, .scroll-up-res').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	//end - scroll top
	// #######
	// fields styles on events
	$('.inner-field').on("focus",function(){
		$(this).closest('.inner-button-field').addClass('focused');
		$(this).on("blur",function(){
			$(this).closest('.inner-button-field').removeClass('focused');
		});
	});
	// end - fields styles on events
	// #######
	//trigger forums show
	//::home page
	$('.trigger-fs').on("click",function(e){
		e.preventDefault();
		$(this).parents(".category").children(".forums").slideToggle(400);
		$(this).toggleTwoClass("icon-angle-down", "icon-angle-up");
	});
	//end - trigger forums show
	//#######
	//end - trigger small login panel
	//#######	
	// attach plugins
	$('.dropdown-trigger').bsDropdown();
	$('.select-trigger').bsSelect();
	$('.tool-tip').tooltip();
	$('.open-modal').modal();
	//end - attach plugins
	//-----
	//toggle inputs
	$(".toggle-input").on('click', function(e){
		e.preventDefault();
		$(this).parents(".input-to-toggle-wrapper").find(".input-to-toggle").fadeIn(400).children("input").focus().parents(".input-to-toggle-wrapper").next('.additional-input').fadeIn(400);
	});
	$(".toggle-back").on('click', function(e){
		e.preventDefault();
		$(this).parents('.input-to-toggle').fadeOut(400).parents(".input-to-toggle-wrapper").next('.additional-input').fadeOut(400);
	});
	//end - toggle inputs
	//######
	//trigger small login panel
	//::general pages
    //# login panel
	$('.trigger-sm-login').on("click",function(e){
		e.preventDefault();
		$(".resp-login").slideToggle(400);
	});
    //# users panel
	$('.trigger-sm-userpanel').on("click",function(e){
		e.preventDefault();
		$(".sm-userpanel").slideToggle(400);
	});
	$('.res-menu a').css({width: 100 / $('.res-menu a').size() + '%'});
	//panel toggle
	$(".triggerPanel").on("click", function(e){
		e.preventDefault();
		var id = $(this).data('panel'),
			panel = $("#"+id);
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
	});
	//box-page
	function fitToScreenHeight(element){
		element.css({height:$(window).outerHeight()});
	}
	//box pages
	fitToScreenHeight($('.box-page'));
	//some responsive styling
	function responsiveStyle()
	{
		var resNavHeight = $('.res-menu').outerHeight();
		$('style').text("@media screen and (max-width:480px) { .wrapper { padding-bottom: "+ resNavHeight +"px; } }");
	}
	//------
	$(window).load($(this), function() {
		//center to screen panels
		centerPanel($('.central-box'));
		responsiveStyle();
    });
	// on window resize
	$(window).on('resize', function(){
		$('.scroll-up, .scroll-up-res').hide();
		centerPanel($('.central-box'));
		fitToScreenHeight($('.box-page'));
		responsiveStyle();
		if ($(this).outerWidth() > 480)
		{ $(".resp-login").hide(); }
	});
})(jQuery);
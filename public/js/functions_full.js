// All plugins here made by Mazen Touati ! - bloodstone community V1
//Toggle class plugin
(function($){
	$.fn.toggleTwoClass = function(firstClass, secondClass){
	    if($(this).hasClass(firstClass)){
	     $(this).removeClass(firstClass).addClass(secondClass);
	    }else{
	      $(this).removeClass(secondClass).addClass(firstClass);
	    }
		return($(this));
	}
})(jQuery);
//#########
//dropdown plugin
(function($){
	$.fn.bsDropdown = function(options){
		// Global Variables Area
		var defaults = {
		},
		options = $.extend(defaults, options);
		function setDdPos(trigger){
			var p = trigger.position(),
				height = trigger.outerHeight(),
				width = trigger.outerWidth(),
				menu = $("#" + trigger.data('id')),
				top = p.top + height + 8;
			menu.css({
				'left': p.left  - ( menu.outerWidth() - width  ) / 2 + 'px',
				'top' : top + 'px'
			});
		}
		$(this).each(function() {
			// variables
			var trigger = $(this),
				dropDown = $("#" + trigger.data('id'));
			setDdPos(trigger);
			$(window).resize(function() {
				setDdPos(trigger);
			});
			//event listener
			trigger.bind('click', function(e){
				e.preventDefault();
				e.stopPropagation();
				//close other opened dropdowns
				$('.dropdown-trigger').not(this).removeClass('active-dd');
				$('.dropdown-menu').not("#" + trigger.data('id')).hide();
				//styling
				$(this).toggleClass('active-dd');
				//open/close dropdown onClick
				dropDown.toggle();
				//close dropdown when click outside of it
				$('.wrapper').bind('click', function(e){
					if(!$(e.target).is('.dropdown-menu') && !$(e.target).parents().is('.dropdown-menu')){
						dropDown.hide();
						$('.dropdown-trigger').removeClass('active-dd');
			        }
				});
			});
		});
	}
})(jQuery);
//end dropdown Plugin
//#########
//select plugin
(function($){
	$.fn.bsSelect = function(options){
		// Global Variables Area
		var defaults = {},
		options = $.extend(defaults, options);
		function setSelPos(trigger){
			var p = trigger.position(),
			height = trigger.outerHeight(true),
			top = p.top + height + 7,
			selectMenu = $("#" + trigger.data('id')).css({
				'left': p.left + 'px',
				'top' : top + 'px'
			});
		}
		$(this).each(function() {
			// variables
			var trigger = $(this),
				select = $("#" + trigger.data('id')),
				menuID = trigger.data('id');
				thisID = $(this).attr("id");
				setSelPos(trigger);
				$(window).resize(function() {
					setSelPos(trigger);
				});
			//event listener
			trigger.bind('click', function(e){
				e.preventDefault();
				e.stopPropagation();
				select.children('div').scrollTop(0);
				//close other opened selects
				$('.select-menu').not("#" + menuID ).hide();
				$('.select-trigger').not(trigger).removeClass('disableTooltip');
				//open/close selects onClick
				select.toggle();
				trigger.toggleClass('disableTooltip');
				//close select when click outside of it
				$("html").bind('click', function(e){
					//does the clicked element a select or it children ?
					//leave it open
					if($(e.target).is('.select-menu') || $(e.target).parents().is('.select-menu')){
			            return false;
			        }else{
			        //else hide it
			  			select.children('div').scrollTop(0);
						select.hide();
						trigger.removeClass('disableTooltip')
					}
				});
				//change value
				$(".select-menu#"+menuID+" a").on("click", function(e){
					e.preventDefault();
					e.stopPropagation();
					trigger.text($(this).text());
					trigger.attr('data-value', $(this).parents('li').attr('data-value'));
					$('.select-menu').hide();
					trigger.removeClass('disableTooltip')
				});
				setSelPos(trigger);
			});
		});
	}
})(jQuery);
//end select Plugin
//#########
//tooltip plugin
(function($){
	$.fn.tooltip = function(options){
		// Global Variables Area
		var defaults = {
			trans: 15
		},
		options = $.extend(defaults, options);
		$(this).each(function(index) {
			// variables
			var tooltip = $(this),
				content = tooltip.data('tooltip');
				//set id to index to avoid conflict in case +1 tooltips in the same nodeParent
				tooltip.parent().append("<div id='"+ index +"' class='tooltip-style rad'>"+ content + "</div>");
				tooltip.mousemove(function(e) {
					if (!tooltip.hasClass('disableTooltip')){
						tooltip.siblings('.tooltip-style#'+index)
								.css({
									display : 'inline-block',
							       	left:  e.pageX + options.trans,
							      	top:   e.pageY + options.trans
							    });
					}
				})
				.mouseleave(function(event) {
					tooltip.siblings('.tooltip-style#'+index).hide();
				});
		});
	}
})(jQuery);
//end tooltip Plugin
//#########
//modal plugin
(function($){
	$.fn.modal = function(options){
		// Global Variables Area
		var defaults = {},
		options = $.extend(defaults, options);
		function setModalSizes(modal){
			var height = modal.outerHeight(),
				header = modal.children('.modal-head').outerHeight() || 0,
				footer = modal.children('.modal-footer').outerHeight() || 0;
				modal.children('.modal-body').css('height', height - (header + footer));
		}
		$(this).each(function(index) {
			// variables
			var modalTrigger = $(this),
				id = modalTrigger.data('id');
			modalTrigger.on('click',function(e){
				e.preventDefault();
				e.stopPropagation();
				$('.overlay').show();
				$('.modal#'+id).fadeIn(400);
				setModalSizes($('.modal#'+id));
				$(window).resize(function(event) {
					setModalSizes($('.modal#'+id));
				});
			});
			$('.overlay, .cancel').on('click',function(e){
				e.preventDefault();
				$('.overlay').hide();
				$('.modal').hide();
			});
		});
		//when press ESC button
		$(document).keyup(function(e) {
			 var code = e.keyCode || e.which;
			 if(code == '27') {
				$('.overlay').hide();
				$('.modal').hide();
			 }
		});
	}
})(jQuery);
//ajax submit
(function($){
	$.fn.ajaxSubmit = function(){
		$(this).each(function(){
			$(this).submit(function(e){
				e.preventDefault();
				var form = $(this),
					url = form.attr('action'),
					type = form.attr('method'),
					data = form.serialize(),
					target = $(this).find('.ajax-loader')
				target.fadeIn(400).html('<img src="img/loader.gif" />');
				$.ajax({
					url : url,
					type : type ,
					data : data,
					dataType : 'json',
					async: true,
					success : function (response){
						if (response['done'])
						{
							form.find("input, textarea").removeClass('error');
							target.html('<span>' + response.done + '</span>');
							setInterval(function(){
								if (response['reload'])
									location.reload(true);
								else if (response['redirect'])
									window.location.href=response['redirect'];
							}, 3000);
						}else{
							if (response['displayError'])
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
								form.find("input, .jqte, textarea").removeClass('error').each(function(){
									if (response[$(this).attr('name')])
										$(this).addClass('error');
								});
							}
						}
					},
					error: function(error){
						target.html(error.responseText);
					},
					complete: function() {
						if (!form.hasClass('noScroll'))
						{
							$('html,body').animate({
								scrollTop: target.offset().top
							}, 'fast');
						}
					}
				});
			});
		});
	}
})(jQuery);
//ajax submit with modal
(function($){
	$.fn.ajaxSubmitWithModal = function(){
		$(this).each(function(){
			$(this).submit(function(e){
				e.preventDefault();
				var form = $(this),
					url = form.attr('action'),
					type = form.attr('method'),
					data = form.serialize();
				$.ajax({
					url : url,
					type : type,
					data : data,
					dataType : 'json',
					async: true,
					success : function (response){
						if (response['done'])
						{
							$('.result-modal').removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
							if (response['reload'])
							{
								setTimeout(function(){ location.reload(true); }, 3000);
							}
						}else{
							$('.result-modal').removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
						}
					},
					error: function(error){
						$('.result-modal').addClass('fail').html('<p>' + error.responseText  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
					}
				});
			});
		});
	}
})(jQuery);
//ajax quick submit
(function($){
	$.fn.ajaxQSubmit = function(){
		var target = $(this),
			getData = target.data('content'),
			url = target.data('url');
		$.ajax({
			url : url,
			type : 'POST' ,
			data : getData,
			dataType : 'json',
			async: true,
			success : function (response){
				if (response['done'])
					$('.result-modal').finish().hide().removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
				else
					$('.result-modal').finish().stop(true, true).hide().removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
	        },
			error: function(error){
				$('.result-modal').finish().stop(true, true).hide().addClass('fail').html('<p>' + error.responseText  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
			}
		});
	}
})(jQuery);
//ajax quick delete
(function($){
	$.fn.ajaxQuickDelete = function(string){
		//get the confirm modal message
		var element = $(this);
		if (string == 'no-confirm')
		{
			element.each(function(){
				var target = $(this);
				target.on('click', function(e){
					e.preventDefault();
					target.ajaxQSubmit();
				});
			});
		}else{
			$.ajax({
				url : "ajax/getConfirmMsg",
				type : 'POST' ,
				data : {type : string},
				dataType : 'html',
				async: true,
				success : function (response){
					var string = response;
					element.each(function(){
						var target = $(this);
						target.on('click', function(e){
							e.preventDefault();
							$('.overlay').show();
							$('.confirm-modal').children('.cf-modal-content').html(string).parent().fadeIn(400)
								.css({marginTop:'-'+($('.confirm-modal').outerHeight() / 2)+'px'});

							$('.c-confirm').one('click', function(e){
								e.preventDefault();
								e.stopPropagation();
								$('.overlay').hide();
								$('.confirm-modal').hide();
								target.ajaxQSubmit();
								target.parents('.delete-wrapper').delay(1000).fadeOut(400, function(){
									$(this).remove();
								});
							});

							$('.c-cancel, .overlay').one('click', function(e){
								e.preventDefault();
								$('.overlay').hide();
								$('.confirm-modal').hide();
							});
						});
					});
				},
				error: function(error){
					element.each(function(){
						$(this).on('click', function(e){
							e.preventDefault();
							$('.result-modal').addClass('fail').html('<p>error</p>').fadeIn(400).delay(3000).fadeOut(400);
						});
					});
				}
			});
		}
	}
})(jQuery);
//ajax confirm
(function($){
	$.fn.ajaxConfirm = function(string, callbackFunc){
		//get the confirm modal message
		var element = $(this);
		$.ajax({
            url : "ajax/getConfirmMsg",
            type : 'POST' ,
            data : {type : string},
            dataType : 'html',
            async: true,
            success : function (response){
				if (response[0] == '{')
				{
					var parse = $.parseJSON(response);
					$('.result-modal').addClass('fail').html('<p>'+ parse.error +'</p>').fadeIn(400).delay(3000).fadeOut(400);
				}else{
					var string = response;
					//show confirm box
					$('.overlay').show();
					$('.confirm-modal').children('.cf-modal-content').html(string).parent().fadeIn(400)
						.css({marginTop:'-'+($('.confirm-modal').outerHeight() / 2)+'px'});
					//if confirm the task
					$('.c-confirm').one('click', function(e){
						e.preventDefault();
						e.stopPropagation();
						$('.overlay').hide();
						$('.confirm-modal').hide();
						if( typeof callbackFunc == 'function' ) callbackFunc.call();
					});
					//if cancel the task
					$('.c-cancel, .overlay').one('click', function(e){
						e.preventDefault();
						$('.overlay').hide();
						$('.confirm-modal').hide();
					});
				}
            },
            error: function(){
                $('.result-modal').addClass('fail').html('<p>error 0x0001</p>').fadeIn(400).delay(3000).fadeOut(400);
            }
        });
	}
})(jQuery);
//ajax request
(function($){
    $.fn.ajaxRequest = function(options, callBackFunc){
        var defaults = {
                dataType : 'json',
				data : '',
            },
            options = $.extend(defaults, options);
        $.ajax({
            url : options['url'],
            type : 'POST' ,
            data : options['data'],
            dataType : defaults.dataType,
            async: true,
            success : function(response){
				if (typeof callBackFunc == 'function') callBackFunc(response);
            },
            error: function(){
                $('.result-modal').addClass('fail').html('<p> something went wrong </p>').fadeIn(400).delay(3000).fadeOut(400);
            }
        });
    }
})(jQuery);
//#########
// FUNCTIONS
// 1 - charts functions
// 2 - DOM functions
//
//
//
//#########
//--------
// CHART functions
function respChart(selector, data, type, options){
	if (!$(selector).length ) {
		return false;
	}
	var ctx = selector.get(0).getContext("2d");
	// pointing parent container to make chart js inherit its width
	var x;
	// this function produce the responsive Chart JS
	function generateChart(){
		// Initiate new chart or Redraw
		switch(type){
			case 1 :    x = new Chart(ctx).Line(data, options);
				break;
			case 2 :    x = new Chart(ctx).Pie(data, options);
				break;
			case 3 :    x = new Chart(ctx).Bar(data, options);
				break;
			default : return false;
		}

	};
	// run function - render chart at first load
	generateChart();
	// enable resizing matter
	$(window).resize( function(){
		x.destroy();
		generateChart();
	} );
}
//end - CHART functions
function centerPanel(panel){
	var height = panel.outerHeight(),
		top = ($(window).height() - height ) / 2,
		left = ($(window).outerWidth() - panel.outerWidth() )/ 2;
	panel.css({top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
}
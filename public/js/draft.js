//handle inbox draft system
(function($){
	//message
	var wrapper = $('.inboxDraft');
		//get reciever
		if ($('#uniqueReciever').length > 0)
			var reciever = $('#uniqueReciever').val();
		else
			var reciever = $('#getReceiver').val();
		var counter = 4000; //20 seconds
		var changed = false;
		var resultHolder = $('.draftResult');
		var holderInitContent = resultHolder.html();
		if (typeof isThread === "undefined")
		{
			url = "ajax/saveInboxDraft";
		}else{
			CKEDITOR.instances['bseContentHolder'].on('change', function() { changed = true; $("#bseContentHolder").html(CKEDITOR.instances.bseContentHolder.getData()); });
			var url = "ajax/saveThreadsDraft";
		}
		//detect changes
		wrapper.find('.draftTrigger').on('change', function(e){ changed = true; });
		//if changes happened within the interval update the draft
		setInterval(function(){
			if (changed) {
				var data = wrapper.serialize();
				resultHolder.hide().removeClass('fail succ').html(holderInitContent).fadeIn(400);
				wrapper.ajaxRequest({url : url, data : data}, function(response){
					if (response['done'])
						resultHolder.hide().removeClass('fail').addClass('succ').html('<p>' + response.done  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
		       		else if (response['error'])
		       			resultHolder.hide().removeClass('succ').addClass('fail').html('<p>' + response.error  + '</p>').fadeIn(400).delay(3000).fadeOut(400);
		       	});
		       	//reset the detecter
				changed = false;
			}
		}, counter);


})(jQuery);
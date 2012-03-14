$(function() {
	var initVideo = function() {
		$('.video_item_hidden').delegate('.video_title', 'click', function(event){
			$('.video', event.delegateTarget).toggle();
		});
	}
	
	
	var init = function() {
		initVideo();
	}
	
	init();
})


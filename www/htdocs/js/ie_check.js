$(function(){
	
	function getCookie(c_name) {
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++){
			
			x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
			y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			x=x.replace(/^\s+|\s+$/g,"");
			if (x==c_name){
				return unescape(y);
			}
		}
	}

	function setCookie(c_name,value, exdays) {
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	}
	
	function hideMessageAndRemember() {
		setCookie('ieIsOld', true, 7);
		$('.ie_is_old').hide('slow');
	}
	
	function userKnowsAboutThisFail() {
		return !!getCookie('ieIsOld');
	}
	
	if ($.browser.msie && parseInt($.browser.version) < 9) {
		
		if (userKnowsAboutThisFail())
			return;
		
		$('.ie_is_old .hide_and_remember').click(hideMessageAndRemember);
		$('.ie_is_old').show('slow');
	}
	
	
});

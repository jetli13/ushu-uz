$(function(){
	
	function insertImageIntoText(event) {
		if ($.type($('#publication_text')[0].selectionStart) == 'undefined'){
			alert('Воспользуйтесь браузером FireFox')
			return;
		}
		var wisywigImperavi = window.wisywigImperavi;
		
		wisywigImperavi.syncCodeToTextarea();
		
		var img = event.currentTarget,
				scrollTop = $(wisywigImperavi.$frame[0].contentWindow).scrollTop();
		
		img = img.parentNode.innerHTML.replace('128/thumb_', ''); // todo треш
		img = img.replace(/style\=\"[^\"]*"/, '');
		
		wisywigImperavi.imageUploadCallback(img);
		wisywigImperavi.syncCodeToEditor();
		setTimeout(function(){
			$(wisywigImperavi.$frame[0].contentWindow).scrollTop(scrollTop)
		}, 400); //todo syncCodeToEditor не успевает отработать
	};
	
	function setPreview() {
		var textArea = $('#publication_text'),
				text = textArea.val();
		var previewName = text.match(/[a-fA-F\d]{32}/);		
		$('#publication_prevew').val(previewName);
		return true;
	}
	
	$('#photoContainer').delegate('img', 'click', insertImageIntoText);
	//$('#publication-form').submit(setPreview); todo нет привязки к публикации
})
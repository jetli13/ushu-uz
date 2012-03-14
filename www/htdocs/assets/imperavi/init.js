$(function(){
	if ($('#publication_text').length) {
		window.wisywigImperavi = $('#publication_text').redactor({
			 toolbar: 'default',
			 imageUpload: '/publication/uploadPhoto.html',
			 resize: true,
			 autoformat: false			 
		});
	}
})
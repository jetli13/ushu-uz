var swfu;
	
	$(function () {
		var config = eval('(' + $('#page_config').text() + ')');
		var photosFolder = config.photosFolder;
		
		var loadStart = function(file) {
			
		};
		
		var fileQueued = function(file) {
			
		};
		
		var uploadSuccess = function(file, data, response) {
			console.dir(file);
			console.log(response);
			console.log(data);
			var image = getPhotoNode(data);
			$('#photoContainer').prepend(image);
			
		};
		
		var getPhotoNode = function(data) {
			data = data.split('_');//todo отправлять с сервера json
			var folder = $.trim(data[0]) != '' ? data[0] + '/' : '';
			return $('<div style="padding: 5px; float:left;"><img src="' + photosFolder + folder + '128/thumb_' + data[1] + '.jpg" alt="ушу" style="border:1px; border-color:gray;" /></div>')
		}
		
		var uploadComplite = function(file) {
			if (this.getStats().files_queued === 0) {
				alert('Загрузка завершена');
			} else {	
				this.startUpload();
			}	
		};
		
		var fileDialogComplete = function() {
			this.startUpload();
		};
		
		var uploadError = function(file, code, message) {
			console.dir(file);
			console.log(code);
			console.log(message);
		};
		
		swfu = new SWFUpload({
			upload_url : config.uploadUrl,
			flash_url : "/js/upload/swfupload.swf",
			file_size_limit : "20 MB",
			file_upload_limit: 0,
			
			button_placeholder_id: 'upload_button',
			button_width : 100,
			button_height : 50,
			button_text : '<strong><span class="redText">Загрузить.</span></strong>',
			button_text_style : ".redText { color: #FF0000; font-size: 17px;}",
			button_text_left_padding : 3,
			button_text_top_padding : 2,
			button_action : SWFUpload.BUTTON_ACTION.SELECT_FILES,
			button_disabled : false,
			button_cursor : SWFUpload.CURSOR.HAND,
			button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
			
			//swfupload_loaded_handler : swfLoaded, 
			file_dialog_start_handler : loadStart, 
			file_queued_handler : fileQueued, 
			//file_queue_error_handler : file_queue_error_function, 
			file_dialog_complete_handler : fileDialogComplete,
			upload_success_handler : uploadSuccess, 
			upload_complete_handler : uploadComplite,
			upload_error_handler: uploadError,
			file_types: '*.jpg' 
		});
		

		
	});
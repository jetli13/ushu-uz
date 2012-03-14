$(function(){
	$('.fancy_photo').fancybox({
		
			fitToView: true,
			aspectRatio: false,
			topRatio: 0.5,

			loop: false,
			

			// HTML templates
			tpl: { // todo localize
				error: '<p class="fancybox-error">Запрашиваемое изображение недоступно.<br/>Попробуйте позже.</p>',
				closeBtn: '<div title="Закрыть" class="fancybox-item fancybox-close"></div>',
				next: '<a title="Вперед" class="fancybox-item fancybox-next"><span></span></a>',
				prev: '<a title="Назад" class="fancybox-item fancybox-prev"><span></span></a>'
			},
			
			nextSpeed: 'slow',
			prevSpeed: 'slow'
			

	});
})
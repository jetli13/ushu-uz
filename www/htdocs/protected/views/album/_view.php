<div class="photoAlbumItem">
	
		<?php
			$imgLink = '';
			$imagesQuantity = count($data->photos);
			if($imagesQuantity > 0) {
				//todo убрать в модель формирование путей, а из модели в pathManager
				$imgLink = '<img src="/upload/photo/album/' . $data->id . '/128/thumb_' . $data->photos[0]->name . '.jpg" alt="' . CHtml::encode($data->ru_title) . '" class="albumCover"></img>';
				$imgLink = CHtml::link($imgLink, array('view', 'id'=>$data->id));
			}
			$albumTitleLink = '<h4 class="albumTitle">' . CHtml::link(CHtml::encode(CHtml::encode($data->ru_title)), array('view', 'id'=>$data->id)) . '</h4>';
			
			$albumItem = $imgLink . $albumTitleLink; 
			if($imagesQuantity > 0) {
				$albumItem .= $imagesQuantity . ' фото';
			}
			
			print $albumItem;
		?>
	<div class="clear"></div>
</div>
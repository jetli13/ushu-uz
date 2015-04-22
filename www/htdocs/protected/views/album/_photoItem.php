<div class="photoItemWrapper">
	<div class="photoItem">
		<?
			$thumbSrc = '/upload/photo/album/' . $data->albums[0]->id . '/128/thumb_' . $data->name . '.jpg';
			$src = '/upload/photo/album/' . $data->albums[0]->id . '/' . $data->name . '.jpg';
			//todo убрать этот треш
		?>
		<a href="<?=$src?>" class="fancy_photo" rel="photoAlbum_<?=$data->albums[0]->id?>"><img src="<?=$thumbSrc?>" alt="ушу"/></a>
	</div>
</div>

<?if ($index  == count($widget->dataProvider->getData())-1){?>
	<div style="clear:both;"></div>
<?}?>
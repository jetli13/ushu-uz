<?php
$this->breadcrumbs=array(
//	'Фото'=>array('index'),
	'Добавление фотографий',
);

//$this->menu=array(
//	array('label'=>'List Photo', 'url'=>array('index')),
//	array('label'=>'Manage Photo', 'url'=>array('admin')),
//);
?>

<h1>Загрузка фотографий в альбом - <?= CHtml::link($album->ru_title, array('album/view', 'id' => $album->id))?></h1>
	<div id="page_config">
	{
		"uploadUrl": '<?=$uploadUrl?>',
		"photosFolder": '<?=$photosFolder?>'
	}
	</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
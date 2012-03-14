<?php
$this->breadcrumbs=array(
	'Фото'=>array('index'),
	'Добавление фото альбома', // todo localize
);

/*$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);*/
?>

<h1>Добавление фото альбома</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
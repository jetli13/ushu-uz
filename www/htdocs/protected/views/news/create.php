<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>Создание Новости</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
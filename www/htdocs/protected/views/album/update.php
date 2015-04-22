<?php
$this->breadcrumbs=array(
	'Фото'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

//$this->menu=array(
//	array('label'=>'Все альбомы', 'url'=>array('index')),
//	array('label'=>'Добавить альбом', 'url'=>array('create')),
//	array('label'=>'Посмотреть альбом', 'url'=>array('view', 'id'=>$model->id))
//);
?>

<h1>Изменить альбом "<?php echo $model->getTitle(); ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
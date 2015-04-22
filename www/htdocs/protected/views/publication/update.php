<?php
$this->breadcrumbs=array(
	'Publications'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'List Publication', 'url'=>array('index')),
	array('label'=>'Create Publication', 'url'=>array('create')),
	array('label'=>'View Publication', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
);
?>

<h1>Изменить статью <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	<div id="page_config">
	{
		"uploadUrl": '<?=$uploadUrl?>',
		"photosFolder": '<?=$photosFolder?>'
	}
	</div>
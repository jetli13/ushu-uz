<?php
$this->breadcrumbs=array(
	'Стили и оружие ушу'=>array('index'),
	$model->ru_title,
);

$this->menu=array(
	array('label'=>'List Publication', 'url'=>array('index')),
	array('label'=>'Create Publication', 'url'=>array('create')),
	array('label'=>'Update Publication', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Publication', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
);
?>

<div class="post">
	<h1 class="title"><?php echo $model->ru_title; ?></h1>
	<!--<div class="publication-date">
		<?$model->creationDate;?>
	</div>-->
	<div class="entry">
		<?=$model->ru_text;?>
	</div>
</div>

<?php 
	/*$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'ru_title',
			'author',
			'ru_text',
			'creationDate',
			'image',
		),
	));*/ 
?>

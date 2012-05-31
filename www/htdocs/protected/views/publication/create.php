<?php
$this->breadcrumbs=array( //todo убрать в контроллер
	$typeCaption =>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'List Publication', 'url'=>array('index')),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
);
?>

<h1>Создать новую статью</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	<div id="page_config">
	{
		"uploadUrl": '<?=$uploadUrl?>',
		"photosFolder": '<?=$photosFolder?>'
	}
	</div>
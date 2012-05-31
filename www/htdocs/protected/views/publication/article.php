<?php
$this->breadcrumbs=array(
	'Статьи',
);

$this->menu=array(
	array('label'=>'Добавить статью', 'url'=>array('createArticle')), 
	array('label'=>'Управлять', 'url'=>array('admin')),
);
?>

<h1>Статьи</h1>

<?php 
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'summaryText' => '',
	)); 
?>

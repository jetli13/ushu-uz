<?php
$this->breadcrumbs=array(
	'Новости',
);

$this->menu=array(
	array('label'=>'Добавить новость', 'url'=>array('createNews')), 
	array('label'=>'Управлять', 'url'=>array('admin')),
);
?>

<h1>Новости</h1>

<?php 
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'summaryText' => '',
	)); 
?>

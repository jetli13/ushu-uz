<?php
$this->breadcrumbs=array(
	'Стили и оружие ушу',
);

$this->menu=array(
	array('label'=>'Create Publication', 'url'=>array('create')),
	array('label'=>'Manage Publication', 'url'=>array('admin')),
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

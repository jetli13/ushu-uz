<?php
$this->breadcrumbs=array(
	'Фото',
);

$this->menu=array(
	array('label'=>'Добавить фото альбом', 'url'=>array('create')),
	array('label'=>'Управление альбомами', 'url'=>array('admin')),
);
?>

<h1>Альбомы</h1>
<div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText' => '',	
)); ?>
</div>

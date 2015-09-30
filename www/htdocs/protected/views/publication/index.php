<?php
$this->breadcrumbs=array(
	$this->typeCaption,
);

$this->menu=array(
	array('label'=>'Добавить публикацию', 'url'=>array('create')),
	array('label'=>'Управлять', 'url'=>array('admin')),
);
?>

<h1>Стили и оружие ушу</h1>

<?php 
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'summaryText' => '',
		'pager' => array(
			'header' => '',
			'nextPageLabel' => 'Вперед  >>', // todo localize
			'prevPageLabel' => '<<  Назад',
			'firstPageLabel' => 'В начало',
			//'cssFile'=>Yii::app()->request->baseUrl.'/css/theme/pager.css'	
		)	
	)); 
?>

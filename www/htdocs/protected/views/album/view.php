<?php
$this->breadcrumbs = array(
	'Фото'=>array('index'),
	$model->getTitle(),
);

$this->menu=array(
	array('label'=>'Все альбомы', 'url'=>array('index')),
	array('label'=>'Добавить альбом', 'url'=>array('create')),
	array('label'=>'Изменить альбом', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить альбом', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить альбом?')),
	array('label'=>'Управление альбомами', 'url'=>array('admin')),
	array('label'=>'Добавить фотографии', 'url'=>array('photo/create', 'id' => $model->id)),
);
?>

<h1><?php echo $model->getTitle(); ?></h1>

<?php 

$pageSize = 30;
$dataProvider=new CArrayDataProvider($model->photos, array(
  'pagination'=>array(
		'pageSize'=>$pageSize,
  ),
));



$this->widget('zii.widgets.CListView', array(
  'dataProvider' => $dataProvider,
  'itemView' => '_photoItem',
	'template' => '{summary}{items}{pager}',
	'ajaxUpdate' => false,
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

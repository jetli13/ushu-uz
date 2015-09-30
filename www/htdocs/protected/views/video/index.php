<?php
$this->breadcrumbs=array(
	'Видео', // todo localize
);

$this->menu=array(
	array('label'=>'Create Video', 'url'=>array('create')),
	array('label'=>'Manage Video', 'url'=>array('admin')),
);
?>

<h1>Видео</h1>
<!--todo localize-->

<?php
	//'type' =>'raw',
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
        'summaryText' => '',
        'pager' => array(
            'header' => '',
            'nextPageLabel' => 'Вперед  >>', // todo localize
            'prevPageLabel' => '<<  Назад',
            'firstPageLabel' => 'В начало',
        )
    ));
?>

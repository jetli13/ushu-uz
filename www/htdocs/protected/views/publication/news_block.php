<?
	if ($dataProvider->itemCount > 0) {
?>
	<div class="leftSide">
		<div id="sidebar">
			<h1>Новости</h1>
			
				<?php 					
					$this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_news_block_item',
						//'itemsTagName' => false,
						'tagName' => 'ul'	
					)); 
				?>
			
		</div>

		<?php 
			if (!Yii::app()->user->isGuest) {
				echo '<a href="/publication/createNews/">Добавить новость</a>';
			}
		?>
	</div>
<?}?>
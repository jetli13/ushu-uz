<?php $this->beginContent('//layouts/main'); ?>
<div class="container admin">
	<div class="leftSide">
		<div id="sidebar" >
			<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Администрирование',
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
				));
				$this->endWidget();
			?>
		</div><!-- sidebar -->
	</div>
	<div class="rightSide">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
		
	</div>
	<div class="clear"></div>
</div>
<?php $this->endContent(); ?>
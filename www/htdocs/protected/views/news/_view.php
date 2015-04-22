<!--<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />


</div>-->

<div class="post">
	<h2 class="title">
		<?php echo CHtml::encode($data->id)?>
	</h2>
	<p class="meta">
			<span class="date"><?php echo CHtml::encode($data->date); ?></span>
	</p>
	<div style="clear: both;">&nbsp;</div>
	<div class="entry">
		<?php 
			echo CHtml::encode($data->text); 
		?>
	</div>
</div>
<div class="post">
	<h2 class="title">
		<?php echo CHtml::link(CHtml::encode($data->ru_title), array('view', 'id'=>$data->id)); ?>
	</h2>
	<p class="meta">
			<span class="date"><?php echo CHtml::encode($data->creationDate); ?></span>
			<div style="clear: both;"></div>
	</p>
	
	<div class="entry">
		<div>
			<?php
				$TEXT_LIMIT = 800;
				print Publication::getPreview($data->ru_text, $TEXT_LIMIT);
			?>
			<div class="clear"></div>
		</div>
		<? if (mb_strlen($data->ru_text) > $TEXT_LIMIT) { ?>
			<p class="links">
				<?php echo CHtml::link(CHtml::encode('Читать полностью'), array('view', 'id'=>$data->id)); ?>
			</p>
		<?}?>	
	</div>
</div>
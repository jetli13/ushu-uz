<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publication-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченные <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ru_title'); ?>
		<?php echo $form->textField($model,'ru_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ru_title'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'en_title'); ?>
		<?php echo $form->textField($model,'en_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'en_title'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>-->

	<div class="row">
		<div style="margin-top: 20px;">
			добавление фотографий
		</div>
		<div id="upload_button"></div>
		<div id="photoContainer" class="uploaded-publication-images">
			<div class="clear"></div>
		</div>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'ru_text'); ?>
		<?php echo $form->textArea($model,'ru_text',array('rows'=>25, 'cols'=>80, 'id' => 'publication_text')); ?>
		<?php echo $form->error($model,'ru_text'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'en_text');//todo localize all ?>
		<?php echo $form->textArea($model,'en_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'en_text'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($model,'outerLink'); ?>
		<?php echo $form->textField($model,'outerLink',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'outerLink'); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'creationDate'); ?>
		<?php echo $form->textField($model,'creationDate'); ?>
		<?php echo $form->error($model,'creationDate'); ?>
	</div>-->

<!--	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>-->

	<?php echo $form->hiddenField($model, 'image', array('id' => 'publication_prevew')); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
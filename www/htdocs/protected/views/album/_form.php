<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'album-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля помеченные <span class="required">*</span>обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ru_title'); ?>
		<?php echo $form->textField($model,'ru_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ru_title'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'en_title'); ?>
		<?php echo $form->textField($model,'en_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'en_title'); ?>
	</div> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Изменить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
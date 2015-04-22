<?php
$this->pageTitle=Yii::app()->name . ' - Контакты';

$this->breadcrumbs=array(
	'Контакты',
);
?>
<!--
<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>--><!-- form -->

<?php endif; ?>
<div id="content">
<h1>Контакты</h1>
	<div class="items contacts">
		<h3>Администрация</h3>
		<ul class="administration">
			<li>
				<span class="person">Борзов Владимир Георгиевич - предсетатель АТУУ.</span>
				Тел: <span class="phone">+99890 805-73-93</span></li>
			<li>
				<span class="person">Минаков Артем Сергеевич - заместитель председателя АТУУ.</span>
				Тел: <span class="phone">+99891 164-66-78</span></li>
			<li>
				<span class="person">Султанов Азиз Бахтиярович - старший тренер АТУУ.</span>
				Тел: <span class="phone">+99890 935-98-44</span></li>
			<li>
				<span class="person">Сулейманова Анна Александровна - ответственный секретарь АТУУ.</span>
				Тел: <span class="phone">+99890 900-17-19</span></li>
		</ul>		
		<h3>Наш адрес</h3>
		<p class="address">
			г.Ташкент 
			ул.Мирза-Голиб 7А 
			Индекс: 100174
		</p>
	</div>
</div>


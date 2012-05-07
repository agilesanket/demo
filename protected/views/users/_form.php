<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'emailaddress'); ?>
		<?php echo $form->textField($model,'emailaddress',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'emailaddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cpassword'); ?>
		<?php echo $form->passwordField($model,'cpassword',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'cpassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warriorforumusername'); ?>
		<?php echo $form->textField($model,'warriorforumusername',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'warriorforumusername'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paypalemailaddress'); ?>
		<?php echo $form->textField($model,'paypalemailaddress',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'paypalemailaddress'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
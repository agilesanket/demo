<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'userid'); ?>
		<?php echo $form->textField($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emailaddress'); ?>
		<?php echo $form->textField($model,'emailaddress',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'warriorforumusername'); ?>
		<?php echo $form->textField($model,'warriorforumusername',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paypalemailaddress'); ?>
		<?php echo $form->textField($model,'paypalemailaddress',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
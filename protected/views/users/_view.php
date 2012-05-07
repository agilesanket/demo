<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userid), array('view', 'id'=>$data->userid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emailaddress')); ?>:</b>
	<?php echo CHtml::encode($data->emailaddress); ?>
	<br />

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('warriorforumusername')); ?>:</b>
	<?php echo CHtml::encode($data->warriorforumusername); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paypalemailaddress')); ?>:</b>
	<?php echo CHtml::encode($data->paypalemailaddress); ?>
	<br />


</div>
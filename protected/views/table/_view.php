<?php
/* @var $this TableController */
/* @var $data Table */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view','id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo $data->title; ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo $data->description; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('footer')); ?>:</b>
	<?php echo $data->footer; ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo Lookup::item("ReportTableStatus",$data->status); ?>
	<br />

</div>
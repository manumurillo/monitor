<?php
/* @var $this ReportController */
/* @var $data Report */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status'));?>:</b>
	<?php echo Lookup::item("ReportStatus",$data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo date ('d/m/Y',$data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_update')); ?>:</b>
	<?php echo date ('d/m/Y',$data->date_update); ?>
	<br />


</div>
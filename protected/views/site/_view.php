<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo "<a href='".$data->url."' target='_blank'>".$data->name."</a>"; ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('date_export')); ?>:</b>
	<?php echo date ('d/m/Y',$data->date_export); ?>
	<br />
</div>
	<div class="row">
		<p class="note">Agregar texto:</p>
		<?php echo $form->labelEx($item,'type'); ?>
		<?php echo $form->dropDownList($item,'type', CHtml::listData(Table::model()->findAll(), 'id', 'title'), array('empty'=>'Seleccione tabla')); ?>
	</div>
	<div class="row" id="tableLayout">
		<p class="note">Layout de la tabla seleccionada</p>
	</div>
	
	
	<div class="row">
		<p class="note">Agregar texto:</p>
		<?php echo $form->labelEx($text,'text'); ?>
		<?php echo $form->textArea($text,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($text,'text'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($item,'position'); ?>
		<?php echo $form->textField($item,'position'); ?>
		<?php echo $form->error($item,'position'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($item,'type'); ?>
		<?php echo $form->dropDownList($item,'type',Lookup::items('ReportItemType')); ?>
	</div>
<?php
Yii::app()->clientScript->registerScript('addItem', "
$('.add-button1').click(function(){
	$('.addText').toggle();
	return false;
});
$('.addText form').submit(function(){
	$('#report-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

$('.add-button2').click(function(){
	$('.addTable').toggle();
	return false;
});
$('.addText form').submit(function(){
	$('#report-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
 ?>
<div class="addLinksCont">
	<?php 
		echo CHtml::link('Agregar texto','#',array('class'=>'add-button1')); ?>
		<div class="addText" style="display:none">
		<?php $this->renderPartial('_addText',array(
			'report'=>$report, 
			'item'=>$item, 
			'text'=>$text,
			'form'=>$form
		));
	?>
	</div>
	 <?php 
		echo CHtml::link('Agregar tabla','#',array('class'=>'add-button2')); ?>
		<div class="addTable" style="display:none">
		<?php $this->renderPartial('_addTable',array(
			'report'=>$report, 
			'item'=>$item, 
			'text'=>$text,
			'form'=>$form
		));
	?>
	</div>
</div>
<?php
/* @var $this TableColumnController */
/* @var $column TableColumn */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'table-column-_columnForm-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($column); ?>

	<div class="row">
		<?php echo $form->labelEx($column,'table_id'); ?>
		<?php echo $form->textField($column,'table_id'); ?>
		<?php echo $form->error($column,'table_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($column,'title'); ?>
		<?php echo $form->textField($column,'title'); ?>
		<?php echo $form->error($column,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($column,'width'); ?>
		<?php echo $form->textField($column,'width'); ?>
		<?php echo $form->error($column,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($column,'position'); ?>
		<?php echo $form->textField($column,'position'); ?>
		<?php echo $form->error($column,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($column,'autocomplete'); ?>
		<?php echo $form->textField($column,'autocomplete'); ?>
		<?php echo $form->error($column,'autocomplete'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($column,'color'); ?>
		<?php echo $form->textField($column,'color'); ?>
		<?php echo $form->error($column,'color'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
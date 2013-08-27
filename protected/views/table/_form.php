<?php
/* @var $this TableController */
/* @var $table Table */
/* @var $form CActiveForm */
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-1.8.2.min.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/tablas.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/wColorPicker.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/tinymce.min.js'); 
	
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/wColorPicker.css'); 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'table-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
)); 
	$counter=0;

?>
	<p class="note">Campos marcados con <span class="required">*</span> son obligatorios.</p>

	<div class="row">
		<?php echo $form->labelEx($table,'name'); ?>
		<?php echo $form->textField($table,'name',array('size'=>60,'maxlength'=>128,'class'=>'isRequiredName')); ?><br>
		<span id='errorNameTable'></span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($table,'description'); ?>
		<?php echo $form->textArea($table,'description',array('rows'=>6, 'cols'=>50, 'class'=>'tinyMCEditor')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($table,'footer'); ?>
		<?php echo $form->textArea($table,'footer',array('rows'=>6, 'cols'=>50,'class'=>'tinyMCEditor')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($table,'title'); ?>
		<?php echo $form->textField($table,'title',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($table,'status'); ?>
		<?php echo $form->dropDownList($table,'status',Lookup::items('ReportTableStatus')); ?>
	</div>
	
	<div class="row">
	<p>Puede agregar columnas a la tabla para indicar los encabezados de las filas.
	<br>
	<input type="button" value="Agregar columna" class="btnAgregarColumna" id="<?php echo $counter; ?>"><br>
	<span id="count"></span> </p>
		<table id="tblTabla" class="clsTabla">
			<thead>
				<tr>
				<?php
					if($table->isNewRecord==false){
						foreach($columns as $i=>$column): 
				?>
					<th><a class="clsEliminar" href=""> Eliminar</a>
					</th>
				<?php 
						endforeach; 
					}
				?>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php
					if($table->isNewRecord==false){
						foreach($columns as $i=>$column): 
							$counter++;
				?>
					<th>
						<div id="columnForm_<?php echo $counter; ?>">
							<?php echo $form->labelEx($column,"[$i]title"); ?><br/>
							<?php echo $form->textField($column,"[$i]title",array('class'=>'isRequiredTitle')); ?><br/>
							<?php echo  "<span id='errorTitleColumn'></span>"; ?><br/><br/>
							
							<?php echo $form->labelEx($column,"[$i]width"); ?><br/>
							<?php echo $form->textField($column,"[$i]width",array('class'=>'isRequiredWidth')); ?><br/>
							<?php echo  "<span id='errorWidthColumn'></span>"; ?><br/><br/>

							<?php echo $form->labelEx($column,"[$i]position"); ?><br/>
							<?php echo $form->textField($column,"[$i]position"); ?><br/><br/>

							<?php echo $form->labelEx($column,"[$i]autocomplete"); ?><br/>
							<?php echo $form->dropDownList($column,"[$i]autocomplete",Lookup::items('ReportTableColumnAutocomplete')); ?><br/><br/>
							
							<?php echo $form->labelEx($column,"[$i]color"); ?><br/>
							<div id="wColorPicker<?php echo $i; ?>"></div>
							<div id=""></div>
							
							<script type="text/javascript">
								 $('#wColorPicker<?php echo $i; ?>').wColorPicker({
									initColor: '<?php echo CHtml::encode($column->color); ?>',
									mode: 'click',
									effect: 'slide', 
									theme: 'red',
									onSelect: function(color){
										$('#TableColumn_<?php echo $i; ?>_color').css('color', color).val(color);
									},
									onMouseover: function(color){
										$('#TableColumn_<?php echo $i; ?>_color').css('color', color).val(color);
									},
									onMouseout: function(color){
										$('#TableColumn_<?php echo $i; ?>_color').css('color', color).val(color);
									}
								});
							</script>
							<?php echo $form->textField($column,"[$i]color"); ?>
							<?php echo $form->hiddenField($column,"[$i]id",array('type'=>"hidden")); ?>
							
						</div>
					</th>
				<?php 
						endforeach; 
					}
				?>	
				</tr>
			</tbody>
		</table>
	</div>
<div class="row buttons">
		<?php echo CHtml::submitButton($table->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

	<div id="columnForm" style="display:none">
		<?php echo $form->labelEx($column,"[$counter]title"); ?><br/>
		<?php echo $form->textField($column,"[$counter]title",array('value'=>'')); ?><br/>
		<?php echo  "<span id='errorTitleColumn'></span>"; ?><br/><br/>
		
		<?php echo $form->labelEx($column,"[$counter]width"); ?><br/>
		<?php echo $form->textField($column,"[$counter]width",array('value'=>'')); ?><br/>
		<?php echo  "<span id='errorWidthColumn'></span>"; ?><br/><br/>

		<?php echo $form->labelEx($column,"[$counter]position"); ?><br/>
		<?php echo $form->textField($column,"[$counter]position",array('value'=>'')); ?><br/><br/>

		<?php echo $form->labelEx($column,"[$counter]autocomplete"); ?><br/>
		<?php echo $form->dropDownList($column,"[$counter]autocomplete",Lookup::items('ReportTableColumnAutocomplete')); ?><br/><br/>
		
		<?php echo $form->labelEx($column,"[$counter]color"); ?><br/>
		<div id="wColorPicker<?php echo $counter; ?>"></div>
		<div id=""></div>
		<?php echo $form->textField($column,"[$counter]color",array('value'=>'')); ?>
		<?php echo $form->hiddenField($column,"[$counter]id",array('type'=>"hidden", 'value'=>0)); ?>
	</div>
		<script type="text/javascript">
			 $('#wColorPicker<?php echo $counter; ?>').wColorPicker({
				initColor: '#000000',
				mode: 'click',
				effect: 'slide', 
				theme: 'red',
				onSelect: function(color){
					$('#TableColumn_<?php echo $counter; ?>_color').css('color', color).val(color);
				},
				onMouseover: function(color){
					$('#TableColumn_<?php echo $counter; ?>_color').css('color', color).val(color);
				},
				onMouseout: function(color){
					$('#TableColumn_<?php echo $counter; ?>_color').css('color', color).val(color);
				}
			});

		 tinymce.init({
			selector: '.tinyMCEditor',
			plugins: [
				'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
				'table contextmenu directionality emoticons template textcolor paste textcolor'
			],
			toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect | preview code',
			toolbar2: 'forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink',
			toolbar3: 'bullist numlist | table | hr removeformat | subscript superscript charmap',

			menubar: false,
			toolbar_items_size: 'small',
			language: 'es',
		 });
		</script>
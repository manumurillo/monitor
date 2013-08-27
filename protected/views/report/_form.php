<?php
/* @var $this ReportController */
/* @var $model Report */
/* @var $form CActiveForm */
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-1.10.2.min.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/report.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/wColorPicker.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/tinymce.min.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-ui-1.10.3.js');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/jquery-ui-1.10.3.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/myStyles.css'); 
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/wColorPicker.css');  
?>

<div class="form">
	<?php 
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'report-form',
			'enableAjaxValidation'=>false,
			'clientOptions'=>array('validateOnSubmit'=>true),
		)); 
	
		$itemCounter = $textCounter = $tableCounter = $cellCounter = $rowCounter = $colorCounter = 0;
		$tinymceArr;
	?>
	<table id="report" border="1">
		<thead>
			<tr>
				<th align="left" valign="middle">
					<p class="note">Campos marcados con <span class="required">*</span> son obligatorios.</p>
					<p class="error"><?php echo $form->errorSummary($report); ?></p>
				</th>
				<th align="right" valign="middle">
					<?php 
					if($report->isNewRecord)
					{
						echo CHtml::submitButton('', array('id'=> 'saveReport', 'class'=>'saveDraft'));
						echo ' '.CHtml::submitButton('', array('id'=> 'publishReport' , 'class'=>'publishAndSave'));
					}
					else
					{ 
						echo CHtml::submitButton('', array('id'=> 'saveReportUpdate', 'class'=>'saveDraft'));
						echo ' '.CHtml::submitButton('', array('id'=> 'publishReportUpdate', 'class'=>'publishAndSave'));
					}
					echo ' '.CHtml::submitButton('', array('id'=>'previewReport', 'class'=>'preview')); 
				?>
				</th>
			</tr>
			<tr>
				<th colspan="2" align="left" valign="middle">
					<?php 
						echo $form->labelEx($report,'title');
						echo  "<span id='errorTitle'></span>";
						echo $form->textField($report,'title',array('size'=>60,'maxlength'=>255));
						echo $form->hiddenField($report,'status'); 
						echo $form->hiddenField($report,'id'); 
					?><br>
					<span id="countItems"></span> / <span id="countRows"></span> / <span id="countCells"></span> / <span id="countTexts"></span>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr id="addOptions">
				<th colspan="2" align="center" valign="middle">
					<input type="button" class="addTextButton" id="btnAgregarTexto">
					<input type="button" class="addTableButton" id="btnAgregarTabla">
				</th>
			</tr>
			<?php
			if($report->isNewRecord==false)
			{
				if($items)
				{
					foreach($items as $i=>$item)
					{
						if($item->type==1)
						{	
			?>
			<tr id="itemText_<?php echo $textCounter; ?>" class="item">
				<th colspan="2" align="left" valign="middle">
					<div alt="Eliminar" style="width:100%; clear:both; text-align:right"><input type="button" id="deleteItem" class="deleteItem"> </div>
					<?php
						echo $form->hiddenField($item,"[$i]id");
						echo $form->hiddenField($item,"[$i]report_id");
						echo $form->hiddenField($item,"[$i]position"); 
						echo $form->hiddenField($item,"[$i]type");
						
						echo $form->hiddenField($texts[$textCounter],"[$textCounter]id",array('type'=>'hidden'));
						echo $form->hiddenField($texts[$textCounter],"[$textCounter]item_id",array('type'=>'hidden')); 
						echo "Texto<span class='required'>*</span><br><span id='errorTitle'></span><br>";
						echo "<div id='ReportText_".$textCounter."_text' class='text isRequired tinyMCEditor'>".$texts[$textCounter]->text."</div>";
					?>
					<hr>
					<input type="button" class="addTextButton" id="btnAgregarTexto"> 
					<input type="button" class="addTableButton" id="btnAgregarTabla">
				</th>
			</tr>
			<?php
							$textCounter++;
						}
						else
						{
							$_table = Table::model()->findByPk($rTables[$tableCounter]->table_id);
							$_columns = $_table->columns;
			?>
			<tr id="itemTable_<?php echo $tableCounter; ?>" class="item">
				<th colspan="2" align="left" valign="middle">
					<div alt="Eliminar" style="width:100%; clear:both; text-align:right"><input type="button" id="deleteItem" class="deleteItem"> </div>
					<h3><?php echo $_table->title; ?> </h3>
					<?php
						echo $form->hiddenField($item,"[$i]id");
						echo $form->hiddenField($item,"[$i]report_id");
						echo $form->hiddenField($item,"[$i]position"); 
						echo $form->hiddenField($item,"[$i]type"); 
						
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]id"); 
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]item_id");
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]table_id");
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]status"); 
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]rowCounter",array('value'=>$rTables[$tableCounter]->rowsCount, 'class'=>'rowCount'));
					?><br>
					<div id="layoutTable<?php echo CHtml::encode($tableCounter); ?>">
						<table border="1">
							<tr>
								<th colspan="<?php echo CHtml::encode($_table->columnsCount)+1; ?>" align="left" valign="middle">
									<?php 
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]id");
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]rtable_id"); 
										echo "<b>Descripci&oacute;n: </b>";
										if($texts[$textCounter]->text!='')
											echo "<div id='ReportText_".$textCounter."_text' class='text tinyMCEditor'>".$texts[$textCounter]->text."</div>";
										else
											echo "<div id='ReportText_".$textCounter."_text' class='text tinyMCEditor'>".$texts[$textCounter]->text."Sin descripción disponible.</div>";
									$textCounter++;
									?>
								</th>
							</tr>
							<tr>
							<?php
							$autoCompleteArr;
							$aC = 1;
								foreach($_columns as $column)
								{	
									if($column->autocomplete == TableColumn::AUTOCOMPLETE)
										$autoCompleteArr[$aC] = true;
									else 
										$autoCompleteArr[$aC] = false;
							?>
								<th width="<?php echo CHtml::encode($column->width); ?>px">
									<font color="<?php echo CHtml::encode($column->color); ?>"><b><?php echo CHtml::encode($column->title); ?></b></font>
								</th>
							<?php 
									$aC++;
								}
							?>
							<th>
								c/+/- filas	
							</th>
							</tr>
							
							<?php
								for($r=1; $r<=$rTables[$tableCounter]->rowsCount; $r++)
								{
							?>
							<tr class="row">
							<?php
									for($c=1; $c<=$_table->columnsCount; $c++)
									{
							?>
								<th id="cells">
									<?php 
										if($autoCompleteArr[$c])
											echo "<div id='ReportTableCell_".$cellCounter."_content' class='autoComplete content tinyMCEditor'>".$cells[$cellCounter]->content."</div>";
										else
											echo "<div id='ReportTableCell_".$cellCounter."_content' class='content tinyMCEditor'>".$cells[$cellCounter]->content."</div>";
										echo $form->hiddenField($cells[$cellCounter],"[$cellCounter]column_id",array("class"=>"column"));
										echo $form->hiddenField($cells[$cellCounter],"[$cellCounter]row_id"); 
									?>
								</th>
							<?php 
										$tinymceArr[$c]=$cellCounter;
										$cellCounter++;
									}							
							?>
							<th id="cellControls" align="left" valign="middle">
								<div id="wColorPicker<?php echo $rowCounter; ?>"></div>
								<?php echo $form->textField($rows[$rowCounter],"[$rowCounter]color", array('size'=>'8','maxlength'=>'7'))."<br>";
									echo $form->hiddenField($rows[$rowCounter],"[$rowCounter]id");
								?>
								<input type='button' value='+' id='addTableRow'>
								<input type='button' value='-' id='delTableRow'>
							</th>
							</tr>
							<?php
									$rowCounter++;
								}
							?>
							<tr>
								<th colspan="<?php echo CHtml::encode($_table->columnsCount)+1; ?>">						
									<?php 
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]id");
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]rtable_id"); 
										echo "<b>Pie de tabla: </b><br>";
										if($texts[$textCounter]->text!='')
											echo "<div id='ReportText_".$textCounter."_text' class='text tinyMCEditor'>".$texts[$textCounter]->text."</div>";
										else
											echo "<div id='ReportText_".$textCounter."_text' class='text tinyMCEditor'>".$texts[$textCounter]->text."Sin descripción disponible.</div>";
										$textCounter++;
									?>
								</th>
							</tr>									
						</table>
					</div>
					<hr>
					<input type="button" class="addTextButton" id="btnAgregarTexto"> 
					<input type="button" class="addTableButton" id="btnAgregarTabla">
				</th>
			</tr>
			<?php
							$tableCounter++;
						}
						$itemCounter++;
					}
				}
			}	
			?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2" align="center" valign="middle">
					<?php 
					if($report->isNewRecord)
					{
						echo CHtml::submitButton('', array('id'=> 'saveReport1', 'class'=>'saveDraft'));
						echo ' '.CHtml::submitButton('', array('id'=> 'publishReport1' , 'class'=>'publishAndSave'));
					}
					else
					{ 
						echo CHtml::submitButton('', array('id'=> 'saveReportUpdate1', 'class'=>'saveDraft'));
						echo ' '.CHtml::submitButton('', array('id'=> 'publishReportUpdate1', 'class'=>'publishAndSave'));
					}
					echo ' '.CHtml::submitButton('', array('id'=>'previewReport1', 'class'=>'preview')); 
				?>
				</th>
			</tr>
		</tfoot>
	</table>
	<?php $this->endWidget(); ?>
	
	<?php
	if($report->isNewRecord==false)
	{
	?>
	
	<script type="text/javascript">
	 tinymce.init({
		selector: '.tinyMCEditor',
		inline: true,
		plugins: [
			'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
			'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
			'table contextmenu directionality emoticons template textcolor paste fullpage textcolor'
		],
		toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect | preview code',
		toolbar2: 'forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink',
		toolbar3: 'bullist numlist | table | hr removeformat | subscript superscript charmap',

		menubar: false,
		toolbar_items_size: 'small',
		language: 'es',
	 });
</script>
	<?php
		foreach($rows as $row)
		{
	?>
		<script type="text/javascript">
			$('#wColorPicker<?php echo $colorCounter; ?>').wColorPicker({
				initColor: '<?php echo CHtml::encode($row->color); ?>',
				effect: 'slide', 
				theme: 'red',
				mode: 'click',
				onSelect: function(color){
					$('#ReportTableRow_<?php echo $colorCounter; ?>_color').css('color', color).val(color);
				},
				onMouseover: function(color){
					$('#ReportTableRow_<?php echo $colorCounter; ?>_color').css('color', color).val(color);
				},
				onMouseout: function(color){
					$('#ReportTableRow_<?php echo $colorCounter; ?>_color').css('color', color).val(color);
				}
			});
		</script>
	<?php
			$colorCounter++;
		}
		foreach($tinymceArr as $i=>$num)
		{
	?>
		<script type="text/javascript">
			tinymce.init({
				selector: '#ReportTableCell_<?php echo $i;?>_content',
				inline: true,
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
<?php
		}
	}
	?>		
	<table id="auxTable">
		<tr id="itemText" style="display:none;">
			<th colspan="2" align="left" valign="middle">
				<div alt="Eliminar" style="width:100%; clear:both; text-align:right"><input type="button" id="deleteItem" class="deleteItem"> </div>
				<?php 
					echo $form->hiddenField($item,"[$itemCounter]type",array('value'=>1));
					echo $form->hiddenField($item,"[$itemCounter]id",array('value'=>0)); 
					
					echo $form->hiddenField($text,"[$textCounter]id",array('value'=>0));				
					echo $form->hiddenField($text,"[$textCounter]item_id",array('value'=>0));	
					echo  "<span id='errorText'></span><br>";
					echo "Texto<span class='required'>*</span><br>";
					echo "<div></div>";
				?>
				<hr>
				<input type="button" class="addTextButton" id="btnAgregarTexto"> 
				<input type="button" class="addTableButton" id="btnAgregarTabla">
			</th>
		</tr>		
		<tr id="itemTable" style="display:none;">
			<th colspan="2" align="left" valign="middle">
				<div alt="Eliminar" style="width:100%; clear:both; text-align:right"><input type="button" id="deleteItem" class="deleteItem"> </div>
				<?php
					echo $form->hiddenField($item,"[$itemCounter]type",array('value'=>0));
					echo $form->hiddenField($item,"[$itemCounter]id",array('value'=>0));
					
					echo $form->hiddenField($rTable,"[$tableCounter]id",array('value'=>0)); 
					echo $form->hiddenField($rTable,"[$tableCounter]item_id",array('value'=>0));
					echo $form->hiddenField($rTable,"[$tableCounter]status",array('value'=>1)); 
					echo $form->labelEx($rTable,"[$textCounter]table_id");
					echo  "<span id='errorTable'></span>";
					echo $form->dropdownlist($rTable, "[$tableCounter]table_id", CHtml::listData(Table::model()->findAll(), 'id', 'name'),
					  array('empty'=>'Seleccione una tabla', 'selected'=>'',
						'ajax'=>array(
							'type'=>'POST',
							'url'=>CController::createUrl('table/listTableLayout'),
							'update'=>'#layoutTable',
							'data'=>array('id'=>'js:this.value'),
						 ),
					  )); 
					echo $form->hiddenField($rTable,"[$tableCounter]rowCounter",array('value'=>0, 'class'=>'rowCount')); 
				?>
				<br>
				<div id="layoutTable"><i>Una vez seleccionada la tabla, la estructura será mostrada aquí.</i></div>
				<hr>
				<input type="button" class="addTextButton" id="btnAgregarTexto"> 
				<input type="button" class="addTableButton" id="btnAgregarTabla">
			</th>
		</tr>
	</table>
</div>
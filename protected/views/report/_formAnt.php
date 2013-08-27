<?php
/* @var $this ReportController */
/* @var $model Report */
/* @var $form CActiveForm */
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-1.8.2.min.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/report.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-te-1.4.0.min.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/wColorPicker.js'); 
	
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/wColorPicker.css');  
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/jquery-te-1.4.0.css');  
?>

<div class="form">
	
	<?php 
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'report-form',
			'enableAjaxValidation'=>false,
			'clientOptions'=>array('validateOnSubmit'=>true),
		)); 
	
		$itemCounter = $textCounter = $tableCounter = $cellCounter = $rowCounter = $colorCounter = 0;
	?>
	<table id="report" border="1">
		<thead>
			<!--ReportForm begin-->
			<tr>
				<th colspan="2">
					<p class="note">Campos marcados con <span class="required">*</span> son obligatorios.</p>
					<p class="error"><?php echo $form->errorSummary($report); ?></p>
				</th>
			</tr>
	
			<tr>
				<th colspan="2">
					<?php 
						echo $form->labelEx($report,'title');
						echo  "<span id='errorTitle'></span>";
						echo $form->textField($report,'title',array('size'=>60,'maxlength'=>255));
						echo $form->hiddenField($report,'status'); 
						echo $form->hiddenField($report,'id'); 
					?>
				</th>
			</tr>
			<!--Report Form end-->
		</thead>
		<tbody>

			<tr id="addOptions">
				<th colspan="2">
					<input type="button" value="Agregar texto" class="btnAgregarTexto">
					<input type="button" value="Agregar tabla" class="btnAgregarTabla">
					<span id="countItems"></span> / <span id="countRows"></span> / <span id="countCells"></span> / <span id="countTexts"></span>
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
				<th width="20%" valign="top">
					<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
					<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
					<input type="button" value="Eliminar" class="btnEliminarItem"><br>
					<?php 
						echo $form->hiddenField($item,"[$i]id");
						echo $form->hiddenField($item,"[$i]report_id");
						echo $form->hiddenField($item,"[$i]position"); 
						echo $form->hiddenField($item,"[$i]type"); 
					?>
				</th>
				<th width="80%">
					<p class="note"></p>
					<?php
						echo $form->hiddenField($texts[$textCounter],"[$textCounter]id",array('type'=>'hidden'));
						echo $form->hiddenField($texts[$textCounter],"[$textCounter]item_id",array('type'=>'hidden')); 
						echo "Texto<span class='required'>*</span><br>";
						echo  "<span class='required'>*</span><span id='errorTitle'></span><br>";
						echo $form->textArea($texts[$textCounter],"[$textCounter]text",array('style'=>'width:100%;', 'class'=>'text isRequired jqte-test')); 
					?>
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
				<th width="20%" valign="top">
					<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
					<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
					<input type="button" value="Eliminar" class="btnEliminarItem"><br>
					<?php 
						echo $form->hiddenField($item,"[$i]id");
						echo $form->hiddenField($item,"[$i]report_id");
						echo $form->hiddenField($item,"[$i]position"); 
						echo $form->hiddenField($item,"[$i]type"); 
					?>
				</th>
				<th width="80%">
					<p class="note">Tabla: <?php echo $_table->title; ?> </p>
					<?php
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]id"); 
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]item_id");
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]table_id");
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]status"); 
						echo $form->hiddenField($rTables[$tableCounter],"[$tableCounter]rowCounter",array('value'=>$rTables[$tableCounter]->rowsCount, 'class'=>'rowCount'));
					?><br>
					<div id="layoutTable<?php echo CHtml::encode($tableCounter); ?>">
						<table border="1">
							<tr>
								<th colspan="<?php echo CHtml::encode($_table->columnsCount)+1; ?>">
									<p class="note">Encabezado:</p>
									<?php 
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]id");
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]rtable_id"); 
										echo $form->labelEx($texts[$textCounter],"[$textCounter]text");
										echo $form->textArea($texts[$textCounter],"[$textCounter]text",  array('style'=>'width:100%', 'class'=>'text jqte-test')); 
									$textCounter++;
									?><br>
								</th>
							</tr>
							<tr>
							<?php
								foreach($_columns as $column)
								{
							?>
								<th width="<?php echo CHtml::encode($column->width); ?>px">
									<font color="<?php echo CHtml::encode($column->color); ?>"><?php echo CHtml::encode($column->title); ?></font>
								</th>
							<?php 
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
										echo $form->textArea($cells[$cellCounter],"[$cellCounter]content",array('style'=>'width:100%','class'=>'content jqte-test-celda'));
										echo $form->hiddenField($cells[$cellCounter],"[$cellCounter]column_id");
										echo $form->hiddenField($cells[$cellCounter],"[$cellCounter]row_id"); 
									?>
								</th>
							<?php 
										$cellCounter++;
									}							
							?>
							<th id="cellControls">
								<div id="wColorPicker<?php echo $rowCounter; ?>"></div>
								<?php echo $form->textField($rows[$rowCounter],"[$rowCounter]color");
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
									<p class="note">Pie:</p>							
									<?php 
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]id");
										echo $form->hiddenField($texts[$textCounter],"[$textCounter]rtable_id"); 
										echo $form->labelEx($texts[$textCounter],"[$textCounter]text");
										echo $form->textArea($texts[$textCounter],"[$textCounter]text",  array('style'=>'width:100%', 'class'=>'text jqte-test')); 
										$textCounter++;
									?><br>
								</th>
							</tr>									
						</table>
					<div>
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
				<th colspan="2" align="center">
					<span id="countItems"></span>
					<?php 
					if($report->isNewRecord)
					{
						echo CHtml::submitButton('Guardar borrador', array('id'=> 'saveReport' ));
						echo CHtml::submitButton('Publicar', array('id'=> 'publishReport' ));
					}
					else
					{ 
						echo CHtml::submitButton('Guardar borrador', array('id'=> 'saveReportUpdate' ));
						echo CHtml::submitButton('Publicar', array('id'=> 'publishReportUpdate' ));
					}
					echo CHtml::submitButton('Vista previa', array('id'=>'previewReport' )); 
				?>
				</th>
			</tr>
		</tfoot>
	</table>
	<?php $this->endWidget(); ?>
	
	<?php
	if($report->isNewRecord==false)
	{
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
	}
	?>
			
	<table id="auxTable">
		<tr id="itemText" style="display:none;">
			<th name="primeraColumna" width="20%" valign="top">
				<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
				<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
				<input type="button" value="Eliminar" class="btnEliminarItem"><br>
				<?php
					echo $form->hiddenField($item,"[$itemCounter]type",array('value'=>1));
					echo $form->hiddenField($item,"[$itemCounter]id",array('value'=>0)); 
				?>
			</th>
			<th name="segundaColumna" width="80%">
				<?php 
					echo $form->hiddenField($text,"[$textCounter]id",array('value'=>0));				
					echo $form->hiddenField($text,"[$textCounter]item_id",array('value'=>0));	
					echo "Texto<span class='required'>*</span><br>";
					echo  "<span id='errorText'></span>";
					echo $form->textArea($text,"[$textCounter]text",array('style'=>'width:100%')); 
				?>
			</th>
		</tr>
		
		<tr id="itemTable" style="display:none;">
			<th name="primeraColumna" width="20%" valign="top">
				<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
				<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
				<input type="button" value="Eliminar" class="btnEliminarItem"><br>
				<?php 
					echo $form->hiddenField($item,"[$itemCounter]type",array('value'=>0));
					echo $form->hiddenField($item,"[$itemCounter]id",array('value'=>0));
				?>
			</th>
			<th name="segundaColumna" width="80%">			
				<?php 
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
					?><br>
				<div id="layoutTable"><i>Una vez seleccionada la tabla, la estructura será mostrada aquí.</i></div>

			</th>
		</tr>
		
	</table>
	
	<?php
	if($report->isNewRecord==false)
	{
	?>
	<script>
		$('.jqte-test').jqte({
			titletext:[
				{title:"Formato de texto"},
				{title:"Tamaño de letra"},
				{title:"Seleccionar color"},
				{title:"Negrita",hotkey:"B"},
				{title:"Cursiva",hotkey:"I"},
				{title:"Subrayado",hotkey:"U"},
				{title:"Lista ordenada",hotkey:"."},
				{title:"Lista",hotkey:","},
				{title:"Subíndice",hotkey:"down arrow"},
				{title:"Superíndice",hotkey:"up arrow"},
				{title:"Reducir sangría",hotkey:"left arrow"},
				{title:"Aumentar sangría",hotkey:"right arrow"},
				{title:"Alinear a la izquierda"},
				{title:"Centrar"},
				{title:"Alinear a la derecha"},
				{title:"Tachado",hotkey:"K"},
				{title:"Agregar enlace",hotkey:"L"},
				{title:"Eliminar enlace",hotkey:""},
				{title:"Remover estilo",hotkey:"Delete"},
				{title:"Línea horizontal",hotkey:"H"},
				{title:"Código HTML",hotkey:""}
			]
		});	
		
		$('.jqte-test-celda').jqte({
			center: false,
			left: false,
			right: false,
			rule: false,		
			color: false,
			fsize: false,
			format: false,
			indent: false,
			outdent: false,
			ul: false,
			ol: false,
			remove: false,
			sup: false,
			sub: false,
			strike: false
		});	
	</script>
<?php
	}
	?>
</div>

<?php

class TableController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','listTableLayout'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->pageTitle = 'Ver tabla';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{	
		$this->pageTitle = 'Crear nueva tabla';
		$table=new Table;
		$column=new TableColumn;
		
		if(isset($_POST['Table']))
		{
			$table->attributes=$_POST['Table'];
			
			if($table->save())
			{
				if(isset($_POST['TableColumn']))
				{
					$valid=true;
					foreach($_POST['TableColumn'] as $_data)
					{
						$column=new TableColumn();
						$column->setAttributes($_data);
						$column->table_id = $table->id;
						if($column->validate())
						{
							$column->save();
							$valid=true;
						}
						else
						{
							echo "algo está mal";
							$valid=false;
						}
					}
					if($valid==true)
							$this->redirect(array('view','id'=>$table->id));
				}
				$this->redirect(array('view','id'=>$table->id));
			}
		}

		$this->render('create',array('table'=>$table, 'column'=>$column,));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->pageTitle = 'Actualizar tabla';
		$column=new TableColumn;	
		$table=$this->loadModel($id);
		$columnas=$table->columns;
		$delCols = array();
		
		if(isset($_POST['Table']))
		{
			$table->attributes=$_POST['Table'];
			
			if($table->update())
			{
				$valid=true;
				if(isset($_POST['TableColumn']))
				{
					foreach($columnas as $i=>$columna)
					{
						if(isset($_POST['TableColumn'][$i]))
						{
							$columna->setAttributes($_POST['TableColumn'][$i]);
							if($columna->update())
							{
								$valid=true;
							}
						}
						else
							$delCols[$i]=$columna->id;
					}
					
					foreach($_POST['TableColumn'] as $i=>$_data)
					{
						if($_POST['TableColumn'][$i]['id']==0)
						{
							$column=new TableColumn();
							$column->setAttributes($_data);
							$column->table_id=$table->id;
							$column->save();
							$valid=true;
						}
					}
					foreach($delCols as $x=>$x_value)
					{
						$delCol=new TableColumn();
						$delCol->loadModel($x_value)->delete();
					}

					if($valid==true)
							$this->redirect(array('view','id'=>$table->id));
				}
				else
				{
					foreach($columnas as $columna)
					{
						$delCol=new TableColumn();
						$delCol->loadModel($columna->id)->delete();
					}				
					$this->redirect(array('view','id'=>$table->id));
				}
			}
		}

		$this->render('update',array(
							'table'=>$table,
							'column'=>$column,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->pageTitle = 'Eliminar tabla';
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->pageTitle = 'Tablas';
		$dataProvider=new CActiveDataProvider('Table');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->pageTitle = 'Administrar tablas';
		$model=new Table('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Table']))
			$model->attributes=$_GET['Table'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Table the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Table::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/* Show all columns and attributes from a specific Table selected by user.
	 * via Ajax POST.
	 */
	public function actionListTableLayout()
	{
		if(isset($_POST['id']) && $_POST['id']!='')
		{
			$id=$_POST['id']; //id de la tabla que ha seleccionado de la lista.
			$cellCounter=$_POST['cellCounter']; //Contador de los campos de celdas.
			$textCounter=$_POST['textCounter'];
			$rowCounter=$_POST['rowCounter'];
			$insertedCells = 0;
			$insertedTexts = 0;
			$table=Table::model()->findByPk($id);
			$layout="";
			if ($table===null)
			{
				$layout="La tabla no existe";
			}
			else
			{
				$columns = $table->columns;
				$textCounter++;
				$layout.="<table border='1'>
					<tr>
						<th colspan='".CHtml::encode($table->columnsCount+1)."' align='left' valign='center'>
							<span><input class='showHide' id='showHide".$textCounter."' type='button' value='' onClick='showHide(\"ReportText_".$textCounter."_text\", \"showHide".$textCounter."\")'/></span>Descripción:<br><br>
							<input id='ReportText_".$textCounter."_id' type='hidden' value='0' name='ReportText[".$textCounter."][id]'>
							<input id='ReportText_".$textCounter."_rtable_id' type='hidden' value='0' name='ReportText[".$textCounter."][rtable_id]'>
							<div style='display:none' id='ReportText_".$textCounter."_text' class='text'>".$table->description."</div>
						</th>
						<script type='text/javascript'>	
						tinymce.init({
							selector: '#ReportText_".$textCounter."_text',
							inline: true,
							plugins: [
								'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
								'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
								'table directionality emoticons template textcolor paste textcolor'
							],
							toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect',
							toolbar2: 'forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink',
							toolbar3: 'bullist numlist | table | hr removeformat | subscript superscript charmap | preview code',
							menubar: false,
							toolbar_items_size: 'small',
							language: 'es'
						});
						</script>
					</tr>
					<tr>";
					$insertedTexts++;
				foreach($columns as $column)
				{
					$layout.="<th width='".CHtml::encode($column->width)."' align='center' valign='middle'>
							<font color='".CHtml::encode($column->color)."'><b>".CHtml::encode($column->title)."</b></font>
						</th>";
				}
				$layout.="<th>
						c/+/- filas	
					</th>
					</tr>
					<tr class='row'>";
				foreach($columns as $column)
				{
					$cellCounter++;
					$insertedCells++;
				$layout.="<th id='cells' align='left' valign='middle'>
						<div style='width:100%; height:100%' id='ReportTableCell_".$cellCounter."_content' class='content'></div>
						<input type='hidden' id='ReportTableCell_".$cellCounter."_column_id' class='column' name='ReportTableCell[".$cellCounter."][column_id]' value='".$column->id."'>
						<input type='hidden' id='ReportTableCell_".$cellCounter."_row_id' name='ReportTableCell[".$cellCounter."][row_id]' value='0'>
					</th>
					<script type='text/javascript'>	
						tinymce.init({
							selector: '#ReportTableCell_".$cellCounter."_content',
							inline: true,
							plugins: [
								'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
								'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
								'table directionality emoticons template textcolor paste textcolor'
							],
							toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect',
							toolbar2: 'forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink',
							toolbar3: 'bullist numlist | table | hr removeformat | subscript superscript charmap | preview code',

							menubar: false,
							toolbar_items_size: 'small',
							language: 'es'
						});";
						if($column->autocomplete == TableColumn::AUTOCOMPLETE){
							$layout.="	jQuery('#ReportTableCell_".$cellCounter."_content').attr('class','autoComplete content');";
						}
					$layout.="console.log('Se agregó el editor a: #ReportTableCell_".$cellCounter."_content');</script>";
				}
				$textCounter++;
				$layout.="<th width='200px' id='cellControls' align='left' valign='center'>
						<div id='nvoColorPicker".$rowCounter."'></div>
						<input type='text' id='ReportTableRow_".$rowCounter."_color' name='ReportTableRow[".$rowCounter."][color]' size='8' maxlength='7'><br>
						<input type='hidden' id='ReportTableRow_".$rowCounter."_id' name='ReportTableRow[".$rowCounter."][id]' value='0'>
						<input type='button' value='+' id='addTableRow'>
						<input type='button' value='-' id='delTableRow'>
					</th>
					<script type='text/javascript'>
					jQuery('#nvoColorPicker".$rowCounter."').wColorPicker({
						initColor: '#000000',
						mode: 'click',
						effect: 'slide', 
						theme: 'red',
						onSelect: function(color){
							jQuery('#ReportTableRow_".$rowCounter."_color').css('color', color).val(color);
						},
						onMouseover: function(color){
							jQuery('#ReportTableRow_".$rowCounter."_color').css('color', color).val(color);
						},
						onMouseout: function(color){
							jQuery('#ReportTableRow_".$rowCounter."_color').css('color', color).val(color);
						}
					});
					</script>
					</tr>
					<tr>
						<th colspan='".CHtml::encode($table->columnsCount+1)."' align='left' valign='center'>
							<span><input class='showHide' id='showHide".$textCounter."' type='button' value='' onClick='showHide(\"ReportText_".$textCounter."_text\", \"showHide".$textCounter."\")'/></span>Pie de tabla: <br><br>
							<input id='ReportText_".$textCounter."_id' type='hidden' value='0' name='ReportText[".$textCounter."][id]'>
							<input id='ReportText_".$textCounter."_rtable_id' type='hidden' value='0' name='ReportText[".$textCounter."][rtable_id]'>
							<div style='display:none' id='ReportText_".$textCounter."_text' class='text'>".$table->footer."</div>
						</th>
						<script type='text/javascript'>		
						tinymce.init({
							selector: '#ReportText_".$textCounter."_text',
							inline: true,
							plugins: [
								'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
								'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
								'table directionality emoticons template textcolor paste textcolor'
							],
							toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect',
							toolbar2: 'forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink',
							toolbar3: 'bullist numlist | table | hr removeformat | subscript superscript charmap | preview code',

							menubar: false,
							toolbar_items_size: 'small',
							language: 'es'
						});
						</script>
					</tr>
					</table>";
				$insertedTexts++;
			}
			$array = [
				"layout" => $layout,
				"cellCounter" => $insertedCells,
				"textCounter" => $insertedTexts,
			];
			echo json_encode($array);
		}
		Yii::app()->end();
	}

	/**
	 * Performs the AJAX validation.
	 * @param Table $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='table-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

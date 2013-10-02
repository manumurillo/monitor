<?php

class ReportController extends Controller
{
	public $report;
	public $items;
	public $texts;
	public $rTables;
	public $rows;
	public $cells;
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
			array('allow',  // allow all users to perform 'list' and 'show' actions
				'actions'=>array('index', 'view', 'HtmlReports/'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to perform any action
				'users'=>array('@'),
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
		$this->pageTitle = 'Ver reporte';
		$report = new Report;
		$items[] = new ReportItem;
		$texts[] = new ReportText;
		$rTables[] = new ReportTable;
		$rows[] = new ReportTableRow;
		$cells[] = new ReportTableCell;
		
		$itemCounter = $textCounter = $rTablesCounter = $rowsCounter = $cellsCounter = 0;
		if(isset($_GET['id']))
		{
			$report = $this->loadModel($_GET['id']);
			$items = $report->items;
			if(isset($items))
			{
				foreach($items as $item)
				{
					if($item->type==ReportItem::TYPE_TEXT)
					{
						$texts[$textCounter] = ReportText::model()->findByAttributes(array('item_id'=>$item->id));	
						$textCounter++;
					}
					else
					{	
						$rTable = ReportTable::model()->findByAttributes(array('item_id'=>$item->id));
						$_rTexts = $rTable->texts;
						$_rows = $rTable->rows;
						
						foreach($_rTexts as $_rText)
						{
							$texts[$textCounter] = $_rText;
							$textCounter++;
						}
						if(isset($_rows))
						{
							foreach($_rows as $_row)
							{
								$rows[$rowsCounter] = $_row;
								$_cells = ReportTableCell::model()->findAllByAttributes(array('row_id'=>$_row->id));
							
								foreach($_cells as $_cell)
								{
									$cells[$cellsCounter] = $_cell;
									$cellsCounter++;
								}
								$rowsCounter++;
							}
							$rTables[$rTablesCounter] = $rTable;
							$rTablesCounter++;
						}
					}
				}
			}
		}		
		$this->render('view',array('report'=>$report, 
										'items'=>$items, 
										'texts'=>$texts, 
										'rTables'=>$rTables, 
										'rows'=>$rows, 
										'cells'=>$cells,
			));
	}

	/**
	 * Preview allows model.
	 * 
	 */
	public function actionPreview()
	{
		$this->pageTitle = 'Vista previa';
		$this->layout='preview';	
		$_report;
		$_postItem = array();
		$_postText = array();
		$_postrTable = array();
		$_postRow = array();
		$_postCell = array();
			
		if(isset($_POST))
		{
			$iItm = $iTxt = $iTbl = $iRow = $iCel = 0;
			
			if(isset($_POST['Report']))
			{
				$_report = new Report;
				$_report->setAttributes($_POST['Report']);
			}
			//Obtenemos todos los datos de los modelos obtenidos mediante _POST en arreglos.
			if(isset($_POST['ReportItem']))
			{
				foreach($_POST['ReportItem'] as $rI)
				{
					$_postItem[$iItm]=$rI;
					$iItm++;
				}
			}
			
			if(isset($_POST['ReportText']))
			{
				foreach($_POST['ReportText'] as $rrr=>$rT)
				{
					$_postText[$iTxt]=$rT;
					$cadena ="ReportText_".$rrr."_text";
					$_postText[$iTxt]['text']= $_POST[$cadena];
					$iTxt++;
				}
			}
			if(isset($_POST['ReportTable']))
			{
				foreach($_POST['ReportTable'] as $rTb)
				{
					$_postrTable[$iTbl]=$rTb;
					$iTbl++;
				}
			}
			if(isset($_POST['ReportTableCell']))
			{
				foreach($_POST['ReportTableCell'] as $rrr=>$rTc)
				{
					$_postCell[$iCel]=$rTc;
					$cadena ="ReportTableCell_".$rrr."_content";
					$_postCell[$iCel]['content']=$_POST[$cadena];
					$iCel++;
				}
			}
			if(isset($_POST['ReportTableRow']))
			{
				foreach($_POST['ReportTableRow'] as $rTr)
				{
					$_postRow[$iRow]=$rTr;
					$iRow++;
				}
			}
		}
		$this->render('preview',
							array(
								'report'=>$_report, 
								'items'=>$_postItem, 
								'texts'=>$_postText, 
								'rTables'=>$_postrTable, 
								'rows'=>$_postRow, 
								'cells'=>$_postCell,
							)
			);
	}
	
	/**
	 * Creates a new Report model.
	 * 
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->pageTitle = 'Crear un nuevo reporte';
		$report = new Report;
		$item = new ReportItem;
		$text = new ReportText;
		$rtable = new ReportTable;
		$row = new ReportTableRow;
		$cell = new ReportTableCell;
		
		$this->createReport();
		
		$this->render('create',array(
				'report'=>$report, 
				'item'=>$item, 
				'text'=>$text, 
				'rTable'=>$rtable, 
				'row'=>$row, 
				'cell'=>$cell,
			)
		);	
	}
	
	private function createReport()
	{
		$valid = true;
		if(isset($_POST['Report']))
		{	
			$report = new Report;
			$report->setAttributes($_POST['Report']);
			if($report->save())
			{
				$iItm = $iTxt = $iTbl = $iRow = $iCel = 1;
				$textCounter = $tableCounter = $rowCounter = $cellCounter = 1;
				$_postItem = array();
				$_postText = array();
				$_postTable = array();
				$_postRow = array();
				$_postCell = array();
				
				//Obtenemos todos los datos de los modelos obtenidos mediante _POST en arreglos.
				if(isset($_POST['ReportItem']))
				{
					foreach($_POST['ReportItem'] as $rI)
					{
						$_postItem[$iItm]=$rI;
						$iItm++;
					}
				}
				
				if(isset($_POST['ReportText']))
				{
					foreach($_POST['ReportText'] as $rrr=>$rT)
					{
						$_postText[$iTxt]=$rT;
						$cadena ="ReportText_".$rrr."_text";
						$_postText[$iTxt]['text']= $_POST[$cadena];
						$iTxt++;
					}
					
					//print_r($_postText);
					//Yii::app()->end();
				}
				if(isset($_POST['ReportTable']))
				{
					foreach($_POST['ReportTable'] as $rTb)
					{
						$_postTable[$iTbl]=$rTb;
						$iTbl++;
					}
				}
				if(isset($_POST['ReportTableCell']))
				{
					foreach($_POST['ReportTableCell'] as $rrr=>$rTc)
					{
						$_postCell[$iCel]=$rTc;
						$cadena ="ReportTableCell_".$rrr."_content";
						$_postCell[$iCel]['content']=$_POST[$cadena];
						$iCel++;
					}
				}
				if(isset($_POST['ReportTableRow']))
				{
					foreach($_POST['ReportTableRow'] as $rTr)
					{
						$_postRow[$iRow]=$rTr;
						$iRow++;
					}
				}
				
				if(isset($_postItem))
				{			
					//Recorremos cada item para almacenarlos una vez guardado el nuevo reporte.
					foreach($_postItem as $numItem=>$item)
					{
						$_item = new ReportItem;
						$_item->setAttributes($item);	
						$reportItem = $_item->createItem($report->id,$numItem,$_item->type );
						if($reportItem) 
						{
							if($reportItem->type==ReportItem::TYPE_TEXT)
							{
								if(isset($_postText))
								{
									$_text = new ReportText;
									$_text->text = $_postText[$textCounter]['text'];
									
									$reportText = $_text->createItemText($reportItem->id, $_text->text);
									$textCounter++;
									if($reportText)
										$valid = true;
									else
										$valid = false;									
								}
							}
							elseif($reportItem->type==ReportItem::TYPE_TABLE)
							{
								if(isset($_postTable))
								{
									//Se obtienen los atributos de ReportTable
									$_rTable = new ReportTable;
									$_rTable->setAttributes($_postTable[$tableCounter]);
									
									//Se obtiene la información de la tabla base y las columnas de la misma.
									$_table = Table::model()->findByPk($_rTable->table_id);
									$numCols = $_table->columnsCount;
									$_cols = $_table->columns;
									
									//Se obtiene la información sobre el numero de filas de la tabla.
									$numRows = $_postTable[$tableCounter]['rowCounter'];
									
									$tableCounter++;
									
									$reportTable = $_rTable->createReportTable($reportItem->id, $_rTable->table_id, ReportTable::STATUS_ACTIVE);
									
									if($reportTable)
									{
										//Se obtiene la descripcion de la tabla.
										$_description = new ReportText;
										$_description->text = $_postText[$textCounter]['text'];
										$textCounter++;
										
										$reportTableText = $_description->createTableText($reportTable->id, $_description->text);
										if($reportTableText==false)
											$valid = false;
										
										//Se obtiene el pie descriptivo de la tabla.
										$_footer = new ReportText;
										$_footer->text = $_postText[$textCounter]['text'];
										$textCounter++;
										
										$reportTableText2 = $_footer->createTableText($reportTable->id, $_footer->text);
										if($reportTableText2==false)
											$valid = false;
										
										//Se obtienen las filas de la tabla (si las hay.)
										if($numRows >= 1)
										{
											//Se obtienen las filas de la tabla, según el número de filas enviadas desde el formulario
											for($i=1; $i<=$numRows; $i++)
											{
												$_rTableRow = new ReportTableRow;
												$_rTableRow->setAttributes($_postRow[$rowCounter]);
												$reportTableRow = $_rTableRow->createTableRow($reportTable->id, $i, $_rTableRow->color);
												$rowCounter++;
												if($reportTableRow)
												{
													for($j=1; $j<=$numCols; $j++)
													{
														$_cell = new ReportTableCell;
														$_cell->setAttributes($_postCell[$cellCounter]);
														$reportTableCell = $_cell->createTableCell($reportTableRow->id, $_cell->column_id, $_cell->content, $reportTableRow->color);
														$cellCounter++;
														if($reportTableCell==false)
															$valid = false;
													}
												}
												else
													$valid = false;
											}
										}
									}	
								}							
							}
						}
					}
				}
				if($valid==true)
					$this->redirect(array('view','id'=>$report->id));
			}
		}
	}

	/**
	 * Updates a particular Report model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->pageTitle = 'Actualizar reporte';
		$this->loadReport($_GET['id']);
		$this->updateReport();
		
		$item = new ReportItem;
		$text = new ReportText;
		$rTable = new ReportTable;
		
		$this->render('update',array(
				'report'=>$this->report, 
				'items'=>$this->items, 
				'texts'=>$this->texts, 
				'rTables'=>$this->rTables, 
				'rows'=>$this->rows, 
				'cells'=>$this->cells,
				'item'=>$item,
				'text'=>$text,
				'rTable'=>$rTable,
			)
		);		
	}
	
	/*
	* Update a particular report 
	*/
	private function updateReport()
	{		
		$iItm = $iTxt = $iTbl = $iRow = $iCel = 1;
		$textCounter = $tableCounter = $rowCounter = $cellCounter = 1;
		$_postItem = array();
		$_postText = array();
		$_postTable = array();
		$_postRow = array();
		$_postCell = array();
		$valid = true;
		$arrItems = array();
		$arrRows = array();
		
		//Obtenemos todos los datos de los modelos enviados mediante _POST y los almacenamos temporalmente en arreglos.
		if(isset($_POST['ReportItem']))
		{
			foreach($_POST['ReportItem'] as $rI)
			{
				$arrItems[$iItm] = $rI['id'];
				$_postItem[$iItm] = $rI;
				$iItm++;
			}
		}
		
		if(isset($_POST['ReportText']))
		{
			foreach($_POST['ReportText'] as $rrr=>$rT)
			{
				$_postText[$iTxt]=$rT;
				$cadena ="ReportText_".$rrr."_text";
				$_postText[$iTxt]['text']= $_POST[$cadena];
				$iTxt++;
			}
		}
		if(isset($_POST['ReportTable']))
		{
			foreach($_POST['ReportTable'] as $rTb)
			{
				$_postTable[$iTbl]=$rTb;
				$iTbl++;
			}
		}
		if(isset($_POST['ReportTableCell']))
		{
			foreach($_POST['ReportTableCell'] as $rrr=>$rTc)
			{
				$_postCell[$iCel]=$rTc;
				$cadena ="ReportTableCell_".$rrr."_content";
				$_postCell[$iCel]['content']=$_POST[$cadena];
				$iCel++;
			}
		}
		if(isset($_POST['ReportTableRow']))
		{
			foreach($_POST['ReportTableRow'] as $rTr)
			{
				$arrRows[$iRow] = $rTr['id'];
				$_postRow[$iRow] = $rTr;
				$iRow++;
			}
		}
				
		if(isset($_POST['Report']))
		{
			$this->report->setAttributes($_POST['Report']);
			if($this->report->update())
			{
				//Comenzamos a realizar el recorrido por los items del reporte.
				if(isset($_postItem))
				{
					foreach($_postItem as $numItem=>$item)
					{
						//Realizamos la búsqueda del item en la base de datos, si existe, lo actualizamos, de lo contrario, lo creamos.
						$iTemp = $this->searchElement($item['id'], 'ReportItem');
						
						//Si existe el item, se actualiza.
						if($iTemp)
						{
							$iTemp->setAttributes($item);
							$reportItem = $iTemp->updateItem($iTemp->id, $iTemp->report_id, $numItem, $iTemp->type);
							//Si se actualizó, entonces guardamos/actualizamos el texto o tabla.
							if($reportItem)
							{
								if ($reportItem->type==ReportItem::TYPE_TEXT)
								{
									if(isset($_postText))
									{
										$tTemp = $this->searchElement($_postText[$textCounter]['id'], 'ReportText');
										if($tTemp)
										{
											$tTemp->setAttributes($_postText[$textCounter]);
											$tTemp->text = $_postText[$textCounter]['text'];
											if($tTemp->update())
												$valid = true;
											else
												$valid = false;
										}
										else{
											$_text = new ReportText;
											$_text->setAttributes($_postText[$textCounter]);
											$reportText = $_text->createItemText($reportItem->id, $_text->text);
											if($reportText)
												$valid = true;
											else
												$valid = false;									
										}
										$textCounter++;
									}
								}
								elseif($reportItem->type==ReportItem::TYPE_TABLE)
								{
									if(isset($_postTable))
									{
										$tabTemp = $this->searchElement($_postTable[$tableCounter]['id'], 'ReportTable');
										//Si existe la tabla, se actualiza.
										if($tabTemp)
										{
											$tabTemp->setAttributes($_postTable[$tableCounter]);
											if($tabTemp->update())
											{
												// Utilizamos el método deleteRows y enviamos como parámetro un arreglo con las columnas
												// de la tabla específica.
												$this->deleteRows($tabTemp->rows);
												//Se obtiene la información de la tabla base y las columnas de la misma.
												$_table = Table::model()->findByPk($tabTemp->table_id);
												$numCols = $_table->columnsCount;
												$_cols = $_table->columns;
												//Se obtiene la información sobre el numero de filas de la tabla.
												$numRows = $_postTable[$tableCounter]['rowCounter'];
												
												//Se obtiene la descripcion de la tabla.
												$_description = $this->searchElement($_postText[$textCounter]['id'], 'ReportText');
												$_description->text = $_postText[$textCounter]['text'];
												$textCounter++;
												if($_description->update())
													$valid = true;
												else
													$valid = false;
												
												//Se obtiene el footer de la tabla.
												$_footer = $this->searchElement($_postText[$textCounter]['id'], 'ReportText');
												$_footer->text = $_postText[$textCounter]['text'];
												$textCounter++;
												if($_footer->update())
													$valid = true;
												else
													$valid = false;
												
												//Si el número de filas es mayor o igual a 1, entonces recorremos las filas.
												if($numRows >= 1)
												{
													//Se obtienen las filas de la tabla, según el número de filas enviadas desde el formulario
													for($i=1; $i<=$numRows; $i++)
													{
														//Se busca la fila en la bd
														$_rTableRow = $this->searchElement($_postRow[$rowCounter]['id'], 'ReportTableRow');
														
														//Si la fila existe, se modifica.
														if($_rTableRow)
														{
															$_rTableRow->setAttributes($_postRow[$rowCounter]);
															$_rTableRow->position = $i;
															if($_rTableRow->update())
															{
																$rowCounter++;
																for($j=1; $j<=$numCols; $j++)
																{
																	$_cell = ReportTableCell::model()->findByPk(array('row_id'=>$_postCell[$cellCounter]['row_id'], 'column_id'=>$_postCell[$cellCounter]['column_id']));
																	$_cell->content = $_postCell[$cellCounter]['content'];
																	$_cell->color = $_rTableRow->color;
																	if($_cell->update())
																		$valid = true;
																	else
																		$valid = false;
																	$cellCounter++;
																}
															}
														}
														//Sino, se crea una nueva.
														else
														{
															$_rTableRow = new ReportTableRow;
															$_rTableRow->setAttributes($_postRow[$rowCounter]);
															$reportTableRow = $_rTableRow->createTableRow($tabTemp->id, $i, $_rTableRow->color);
															$rowCounter++;
															if($reportTableRow)
															{
																for($j=1; $j<=$numCols; $j++)
																{
																	$_cell = new ReportTableCell;
																	$_cell->setAttributes($_postCell[$cellCounter]);
																	$reportTableCell = $_cell->createTableCell($reportTableRow->id, $_cell->column_id, $_cell->content, $reportTableRow->color);
																	$cellCounter++;
																	if($reportTableCell==false)
																		$valid = false;
																}
															}
															else
																$valid = false;
														}
													}
												}
												$tableCounter++;
											}
											else
												$valid = false;
										}
										//Si no existe, se crea una nueva.
										else
										{
											//Se obtienen los atributos de ReportTable
											$_rTable = new ReportTable;
											$_rTable->setAttributes($_postTable[$tableCounter]);
											
											//Se obtiene la información de la tabla base y las columnas de la misma.
											$_table = Table::model()->findByPk($_rTable->table_id);
											$numCols = $_table->columnsCount;
											$_cols = $_table->columns;
											
											//Se obtiene la información sobre el numero de filas de la tabla.
											$numRows = $_postTable[$tableCounter]['rowCounter'];
											
											$tableCounter++;
											
											$reportTable = $_rTable->createReportTable($reportItem->id, $_rTable->table_id, ReportTable::STATUS_ACTIVE);
											
											if($reportTable)
											{
												//Se obtiene la descripcion de la tabla.
												$_description = new ReportText;
												$_description->text = $_postText[$textCounter]['text'];
												$textCounter++;
												
												$reportTableText = $_description->createTableText($reportTable->id, $_description->text);
												if($reportTableText==false)
													$valid = false;
												
												//Se obtiene el pie descriptivo de la tabla.
												$_footer = new ReportText;
												$_footer->text = $_postText[$textCounter]['text'];
												$textCounter++;
												
												$reportTableText2 = $_footer->createTableText($reportTable->id, $_footer->text);
												if($reportTableText2==false)
													$valid = false;
												
												//Se obtienen las filas de la tabla (si las hay.)
												if($numRows >= 1)
												{
													//Se obtienen las filas de la tabla, según el número de filas enviadas desde el formulario
													for($i=1; $i<=$numRows; $i++)
													{
														$_rTableRow = new ReportTableRow;
														$_rTableRow->setAttributes($_postRow[$rowCounter]);
														$reportTableRow = $_rTableRow->createTableRow($reportTable->id, $i, $_rTableRow->color);
														$rowCounter++;
														if($reportTableRow)
														{
															for($j=1; $j<=$numCols; $j++)
															{
																$_cell = new ReportTableCell;
																$_cell->setAttributes($_postCell[$cellCounter]);
																$reportTableCell = $_cell->createTableCell($reportTableRow->id, $_cell->column_id, $_cell->content, $reportTableRow->color);
																$cellCounter++;
																if($reportTableCell==false)
																	$valid = false;
															}
														}
														else
															$valid = false;
													}
												}
											}	
										}
									}
								}
							}
						}
						//Si no está en la base de datos, creamos un nuevo item.
						else
						{
							$_item = new ReportItem;
							$_item->setAttributes($item);	
							$reportItem = $_item->createItem($this->report->id,$numItem,$_item->type );
							if($reportItem) 
							{
								if($reportItem->type==ReportItem::TYPE_TEXT)
								{
									if(isset($_postText))
									{
										$_text = new ReportText;
										$_text->text = $_postText[$textCounter]['text'];
										
										$reportText = $_text->createItemText($reportItem->id, $_text->text);
										$textCounter++;
										if($reportText)
											$valid = true;
										else
											$valid = false;									
									}
								}
								elseif($reportItem->type==ReportItem::TYPE_TABLE)
								{
									if(isset($_postTable))
									{
										//Se obtienen los atributos de ReportTable
										$_rTable = new ReportTable;
										$_rTable->setAttributes($_postTable[$tableCounter]);
										
										//Se obtiene la información de la tabla base y las columnas de la misma.
										$_table = Table::model()->findByPk($_rTable->table_id);
										$numCols = $_table->columnsCount;
										$_cols = $_table->columns;
										
										//Se obtiene la información sobre el numero de filas de la tabla.
										$numRows = $_postTable[$tableCounter]['rowCounter'];
										
										$tableCounter++;
										
										$reportTable = $_rTable->createReportTable($reportItem->id, $_rTable->table_id, ReportTable::STATUS_ACTIVE);
										
										if($reportTable)
										{
											//Se obtiene la descripcion de la tabla.
											$_description = new ReportText;
											$_description->text = $_postText[$textCounter]['text'];
											$textCounter++;
											
											$reportTableText = $_description->createTableText($reportTable->id, $_description->text);
											if($reportTableText==false)
												$valid = false;
											
											//Se obtiene el pie descriptivo de la tabla.
											$_footer = new ReportText;
											$_footer->text = $_postText[$textCounter]['text'];
											$textCounter++;
											
											$reportTableText2 = $_footer->createTableText($reportTable->id, $_footer->text);
											if($reportTableText2==false)
												$valid = false;
											
											//Se obtienen las filas de la tabla (si las hay.)
											if($numRows >= 1)
											{
												//Se obtienen las filas de la tabla, según el número de filas enviadas desde el formulario
												for($i=1; $i<=$numRows; $i++)
												{
													$_rTableRow = new ReportTableRow;
													$_rTableRow->setAttributes($_postRow[$rowCounter]);
													$reportTableRow = $_rTableRow->createTableRow($reportTable->id, $i, $_rTableRow->color);
													$rowCounter++;
													if($reportTableRow)
													{
														for($j=1; $j<=$numCols; $j++)
														{
															$_cell = new ReportTableCell;
															$_cell->setAttributes($_postCell[$cellCounter]);
															$reportTableCell = $_cell->createTableCell($reportTableRow->id, $_cell->column_id, $_cell->content, $reportTableRow->color);
															$cellCounter++;
															if($reportTableCell==false)
																$valid = false;
														}
													}
													else
														$valid = false;
												}
											}
										}	
									}							
								}
							}
						}
					}
				}				
			}
			$this->deleteItems();
			if($valid==true)
				$this->redirect(array('view','id'=>$this->report->id));
		}
	}
	
	/*
	* Load a particular Report model with its items 
	* if any.
	* @param integer $id the id of the model to be loaded.
	*/
	private function loadReport($id)
	{
		if($id==null or $id==0)
		{
			throw new CHttpException(404,'No se encontró el objeto.');
		}
		else
		{
			$this->report = new Report;
			$this->items[] = new ReportItem;
			$this->texts[] = new ReportText;
			$this->rTables[] = new ReportTable;
			$this->rows[] = new ReportTableRow;
			$this->cells[] = new ReportTableCell;
	
			$itemCounter = $textCounter = $rTablesCounter = $rowsCounter = $cellsCounter = 0;
			//Precargamos el reporte y todos los items que pertenecen a ese reporte.
			$this->report = $this->loadModel($id);
			$this->items = $this->report->items;
			
			if(isset($this->items))
			{
				foreach($this->items as $item)
				{
					if($item->type==ReportItem::TYPE_TEXT)
					{
						$this->texts[$textCounter] = ReportText::model()->findByAttributes(array('item_id'=>$item->id));	
						$textCounter++;
					}
					else
					{	
						$rTable = ReportTable::model()->findByAttributes(array('item_id'=>$item->id));
						$_rTexts = $rTable->texts;
						$_numRows = $rTable->rowsCount;
						
						foreach($_rTexts as $_rText)
						{
							$this->texts[$textCounter] = $_rText;
							$textCounter++;
						}
						if($_numRows > 0)
						{
							$_rows = $rTable->rows;
							foreach($_rows as $_row)
							{
								$this->rows[$rowsCounter] = $_row;
								$_cells = ReportTableCell::model()->findAllByAttributes(array('row_id'=>$_row->id));
							
								foreach($_cells as $_cell)
								{
									$this->cells[$cellsCounter] = $_cell;
									$cellsCounter++;
								}
								$rowsCounter++;
							}
							$this->rTables[$rTablesCounter] = $rTable;
							$rTablesCounter++;
						}
					}
				}
			}
		}
	}
	
	private function searchElement($id, $model)
	{
		if($id==null || $id==0)
			return false;
		if($model=='ReportItem')
		{
			$item = ReportItem::model()->findByPk($id);
			if($item)
				return $item;
		}

		if($model=='ReportText')
		{
			$text = ReportText::model()->findByPk($id);
			if($text)
				return $text;
		}
		
		if($model=='ReportTable')
		{
			$rTable = ReportTable::model()->findByPk($id);
			if($rTable)
				return $rTable;
		}
		
		if($model=='ReportTableRow')
		{
			$row = ReportTableRow::model()->findByPk($id);
			if($row)
				return $row;
		}
		return false;
	}
	
	/*
	* Delete items from a especific Report
	*/
	private function deleteItems()
	{
		$i=0;
		$arrDeleteItems;
		if(isset($_POST['ReportItem']))
		{
			foreach ($this->items as $ite)
			{
				$elimina = false;
				foreach ($_POST['ReportItem'] as $it)
				{
					if($ite->id == $it['id'])
					{
						$elimina = false;
						break;
					}
					else{
						$elimina = true;
					}
				}
				if($elimina==true)
				{
					$arrDeleteItems[$i] = $ite->id;
					$i++;
				}
			}
		}
		else
		{
			foreach ($this->items as $ite)
			{
				$arrDeleteItems[$i] = $ite->id;
				$i++;
			}
		}
		if(isset($arrDeleteItems))
		{
			$ids = implode(', ', $arrDeleteItems);
			$sql="DELETE FROM monitor_report_item WHERE id IN ($ids)";
			$d = Yii::app()->db->createCommand($sql)->execute();
		}
	}
	
	/*
	* Delete TableRows from a especific ReportTable
	*/
	private function deleteRows($rows)
	{
		$i=0;
		$arrDeleteRows;
		
		if(isset($_POST['ReportTableRow']) && isset($rows))
		{
			foreach ($rows as $row)
			{
				$elimina = false;
				foreach ($_POST['ReportTableRow'] as $rtr)
				{
					if($row->id == $rtr['id'])
					{
						$elimina = false;
						break;
					}
					else
					{
						$elimina = true;
					}
				}
				if($elimina==true)
				{
					$arrDeleteRows[$i] = $row->id;
					$i++;
				}
			}
			if(isset($arrDeleteRows))
			{
				$ids = implode(', ', $arrDeleteRows);
				$sql="DELETE FROM monitor_report_table_row WHERE id IN ($ids)";
				$d = Yii::app()->db->createCommand($sql)->execute();
			}
		}
		elseif(!isset($_POST['ReportTableRow']) && isset($rows))
		{
			foreach ($rows as $row)
			{
				$arrDeleteRows[$i] = $row->id;
				$i++;
			}
			
			if(isset($arrDeleteRows))
			{
				$ids = implode(', ', $arrDeleteRows);
				$sql="DELETE FROM monitor_report_table_row WHERE id IN ($ids)";
				$d = Yii::app()->db->createCommand($sql)->execute();
			}
		}
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
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
		$this->pageTitle = 'Reportes';
		$criteria=new CDbCriteria(array(
			'condition'=>'status='.Report::STATUS_PUBLISHED,
			'order'=>'date_update DESC',
		));
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);
	 
		$dataProvider=new CActiveDataProvider('Report', array(
			'pagination'=>array(
				'pageSize'=>5,
			),
			'criteria'=>$criteria,
		));
	 
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->pageTitle = 'Administración de reportes';
		$model=new Report('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Report']))
			$model->attributes=$_GET['Report'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Export a particular Report to HTML
	 */
	public function actionExport()
	{
		$this->pageTitle = 'Exportar a HTML';
		
		if(isset($_POST["content"]) && isset($_POST["id"]) && isset($_POST["theme"]))
		{
			$report = Report::model()->findByPk(array($_POST["id"]));
			$theme = $_POST["theme"];
			if($theme == 'defaultTheme')
				$titulo = date("Ymd",$report->date_created)."_".$report->generarCodigo(2).".html";
			else
				$titulo = date("Ymd",$report->date_created)."_".$theme."_".$report->generarCodigo(2).".html";
			$url = Yii::app()->basePath."/../HtmlReports/$titulo";
			//echo $url;
			//Yii::app()->end();
			$content = 	$_POST["content"];
			$docMeta = "<!DOCTYPE HTML>".
						"<HTML>".
						"<HEAD>".
							"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>".
						"</HEAD>".
						"<BODY>".
							"<div style='width: 900px; text-align: center; margin-left:auto; margin-right:auto;'>".
								"<span style='font-family:arial; color:#000000; font-size:12px;'>Si no puede ver este mensaje correctamente por favor, haga clic <a href='http://www.monitor.tuars.com/HtmlReports/$titulo'>aquí</a>.</span>".
							"<div style='width: 900px; text-align: center; '>".$content.
							"</div></div>".
						"</BODY>".
						"<HTML>";
						
			$html = fopen ( $url, 'w+' );//abro o genero archivo *ruta relativa
			fwrite ($html, $docMeta);//escribo el contenido
			fclose($html);//cierro el archivo
			$ReportExport = new ReportExport();
			
			$ReportExport->name = $titulo;
			$ReportExport->url = "http://www.monitor.tuars.com/HtmlReports/$titulo";
			$ReportExport->date_export = time();
			if($ReportExport->save())
			{
				echo "Se ha creado el archivo correctamente, lo puede descargar <a href='/HtmlReports/download.php?file=$titulo' target='_blank'>aquí</a>.<br>";
			}
			else
				echo "Hay problemas en la exportación, inténtelo de nuevo.";			
		}
		
		if(isset($_GET['id']))
		{
			$this->loadReport($_GET['id']);
			$this->render('export',array(
					'report'=>$this->report, 
					'items'=>$this->items, 
					'texts'=>$this->texts, 
					'rTables'=>$this->rTables, 
					'rows'=>$this->rows, 
					'cells'=>$this->cells,
				)
			);
		}
	}
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Report the loaded model
	 * @throws CHttpException
	 */
	private $_model;
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				if(Yii::app()->user->isGuest)
					$condition='status='.Report::STATUS_PUBLISHED;
				else
					$condition='';
				$this->_model=Report::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'La p&aacute;gina no existe.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Report $model the model to be validated
	 */ 
	 protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='report-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/*
	*	Autocomplete Title Report
	*/
	public function actionAutocompleteCell() {
		$criteria = new CDbCriteria;
		$criteria->condition = "LOWER(content) like LOWER(:term) AND column_id = :term2";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%', ':term2'=>$_GET['columnID']);
		$criteria->limit = 10;
		$criteria->order = "frequency ASC";
		$models = FrequencyContent::model()->findAll($criteria);
		$arr = array();
		foreach($models as $i=>$model)
		{
			$arr[$i] = $model->content;
		}
		echo CJSON::encode($arr);
	}
}

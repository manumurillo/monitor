<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery-1.10.2.min.js'); 
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/themeReport.js'); 
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/myStyles.css'); 
	
	$itemCounter = $textCounter = $tableCounter = $cellCounter = $rowCounter = $colorCounter = 0;
	function toLink($text)
	{
		$patron = '/<a.*<\/a>/';
		$url= preg_replace_callback($patron, 'toLinkAgain', $text, -1);
		return $url;
	}

	function toLinkAgain($n)
	{
		if (is_array($n))
			$n = $n[0];
		$patron1 = '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i';
		preg_match($patron1,$n,$coincidencias);
		$contenido = strip_tags($n);
		$contenido2 = chunk_split($contenido, 39, "<br/>\t");
		$enlace= $coincidencias[0];
		$return = "<a href='$enlace' target='_blank'>$contenido2</a>";
		return $return;
	}
?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Monitoreo</title>
</HEAD>
<BODY>
<div id="themeConfig">
	<div id="prev"></div>
	<div id="themeGallery">
		<div id="themeMove">
			<div class="theme">
				<input type="button" id="defaultTheme" value="Default" class="defaultTheme"/>
			</div>
			<div class="theme">
				<input type="button" id="lightTheme" value="Claro" class="lightTheme"/>
			</div>
			<div class="theme">
				<input type="button" id="darkTheme" value="Oscuro" class="darkTheme"/> 
			</div>
			<div class="theme">
				<input type="button" id="blackTheme" value="Negro" class="blackTheme"/> 
			</div>
			<div class="theme">
				<input type="button" id="grayScaleTheme" value="Grises" class="grayScaleTheme"/> 
			</div>
			<div class="theme">
				<input type="button" id="whiteTheme" value="Blanco" class="whiteTheme"/> 
			</div>
		</div>	
	</div>
	<div id="next"></div>
	<div id="options">
		<input type="button" id="exportToHtml" value="" class="exportToHtml"/><img id="load" src='/images/ajax-loader.gif' style="display:none"/>	
		<input type="hidden" value="<?php echo CHtml::encode($report->id); ?>" id="Report_id">
		<input type="hidden" value="default" id="Report_theme">
		<div id="result"><p>Seleccione un tema para aplicarlo al reporte:<br> <b><i><?php echo CHtml::encode($report->title); ?></i></b></div>
	</div>
</div>
<div id="Report">
	<table id="table-background" style="border: solid 0px #B3002D; border-collapse: collapse; width: 900px; background-color: #071947; text-align: center; border-spacing: 0;">
		<tr id="space-top-background" style="height: 30px;">
			<td colspan="3">
			</td>
		</tr>
		<tr id="content" style="height:30px;">
			<td id="space-left-background" style="width: 50px">
				&nbsp;
			</td>
			<td id="body" style="width: 800px">
			
				<!--Cuerpo del Reporte-->
				
				<table id="reportContent" style="border: solid 0px #FFFF00; border-collapse: collapse; width: 800px; background-color: transparent; text-align: center; border-spacing:0;">
					
					<!--cabecera-->
					<tr id="header" style="width: 800px; background-color: #FFFFFF;">
						<td style="text-align: center">
							<img src="http://monitoreoredes.havasworldwide.com.mx/reportes/img/header.jpg" alt="Monitoreo AXA - Havas Worldwide MX" style="width: 800px;"/>
						</td>
					</tr>
					
					<tr class="division-report" style="height:10px; background-color: #071947;">
						<td style="width: 100%;">
						</td>
					</tr>
					
					<!--titulo-->
					<tr id="reportTitleSection">
						<td style="width: 800px; background-color: #FFFFFF;">
							<table style="border-collapse: collapse; text-align: center; border-spacing:0;">
								<tr style="height: 10px;">
									<td colspan="3" >
									</td>
								</tr>
								<tr>
									<td style="width: 15px;">
									</td>
									<td id="titleBack" style="width: 750px; text-align: left; vertical-align: middle; background-color: #3da9d7;">
										<span id="reportTitle" style="margin-left: 15px; font-family:arial; color:#ffffff; font-size: 21px;"><b><?php echo CHtml::encode($report->title); ?></b></span>
									</td>
									<td style="width: 10px;">
									</td>
								</tr>
								<tr style="height: 10px;">
									<td colspan="3" >
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					<!--contenido-->
					<?php
					if($items)
					{
					
					?>
					<tr id="reportContentSection">
						<td style="width: 800px; background-color: #FFFFFF;">
							<table id="reportContentTable" style="border: solid 0px #FFFFFF; border-collapse: collapse; width: 800px; text-align: center; border-spacing:0;">
							<?php
								foreach($items as $item)
								{
									if($item->type==ReportItem::TYPE_TEXT)
									{
										$texts[$textCounter] = ReportText::model()->findByAttributes(array('item_id'=>$item->id));	
							?>
								<!--Texto-->
								<tr>
									<td style="width: 40px;">
									</td>
									<td style="width: 720px; text-align: left; vertical-align: middle;">
										<span style='font-family:arial; color:#000000; font-size:12px;'><?php 
											echo $texts[$textCounter]->text; 
											$textCounter++;
										?>
										</span>
									</td>
									<td style="width: 40px;">
									</td>
								</tr>
								
								<!--hr-->
								<tr class="space-report" style="height:10px;">
									<td style="width: 40px;">
									</td>
									<td style="width: 720px; text-align: center; vertical-align: middle;">
										<hr class="hr" style="height: 1px; width: 710px; border: 0; background-color: #A8A8B7;"/>
									</td>
									<td style="width: 40px;">
									</td>
								</tr>
								<!--hr-->
								<?php
								
									}
									else
									{
										$_table = Table::model()->findByPk($rTables[$tableCounter]->table_id);
										$_columns = $_table->columns;
										$tblWidth = 0;
										foreach($_columns as $column)
										{
											$tblWidth += $column->width;
										}
										//echo $tblWidth;
										
								?>
								<!--Tabla-->
								<tr>
									<td style="width: 40px;">
									</td>
									<td style="width: 720px; text-align: left; vertical-align: middle; background-color: #FFFFFF;">
										
										<!--contenido Tabla-->
										<table class="itemTable" style="border: solid 0px #FFFF00; border-collapse: collapse; width: 720px; text-align: center; border-spacing:0;">
											<!--titulo-->
											<tr>
												<td style="text-align: left; vertical-align: middle;">
													<span class="tableTitleText" style="font-family:arial; color:#2d80a4;font-size:14px;"><b><?php echo CHtml::encode($_table->title) ?></b></span>
												</td>
												
											</tr>
											
											<!--descripcion-->	
											<?php
											if(!empty($texts[$textCounter]->text))
											{
											?>
											<tr>
												<td class="descriptionTable" style="text-align: left; vertical-align: middle;">
													<span style='font-family:arial; color:#000000; font-size:12px;'>
													<?php 
														echo $texts[$textCounter]->text; 
														$textCounter++;	
													?>
													</span>
												</td>
											</tr>
											<?php
											}
											else
											{
												$textCounter++;	
											}
											?>
											<tr class="space-table" style="height: 5px">
												<td>
												</td>
											</tr>
											<!--celdas-->	
											<tr>
												<td class="bodyTable" style="text-align: center; vertical-align: middle;">
													<table class="contentTable" style="width: 100%; border: solid 0px #2693FF; border-collapse: collapse; text-align: center; border-spacing:0;">
														<tr>
														<?php
															foreach($_columns as $column)
															{
																$width=round(($column->width*100)/728);
														?>
															<td class="tableHead" style="text-align: center; vertical-align: middle; border: solid 1px #2693FF; width: <?php echo $width; ?>%" >
																<span class="tableHeadTitle" style="font-family:arial; color:<?php echo CHtml::encode($column->color); ?>; font-size:14px;">
																	<b><?php echo CHtml::encode($column->title); ?></b>
																</span>
															</td>
														<?php 
															}
														?>
														</tr>
														<?php
															for($r=1; $r<=$rTables[$tableCounter]->rowsCount; $r++)
															{
														?>	
														<tr>
															<?php
																for($c=1; $c<=$_table->columnsCount; $c++)
																{
															?>
															<td class="cells" style="text-align: left; vertical-align: middle; border: solid 1px #2693FF;" >
																<span style="font-family:arial; color:<?php echo CHtml::encode($cells[$cellCounter]->color);?>; font-size:11px;">
																	<?php echo toLink($cells[$cellCounter]->content);?>
																</span>
															</td>
														<?php 
																	$cellCounter++;
																}							
															$rowCounter++;
															?>	
														</tr>
														
														<?php
															}
														?>
													</table>
												</td>
											</tr>
											<!--pie-->
											<?php
											if(!empty($texts[$textCounter]->text))
											{
											?>
											<tr>
												<td class="footerTable" style="text-align: left; vertical-align: middle;">
													<span style='font-family:arial; color:#000000; font-size:12px;'>
													<?php 
														echo $texts[$textCounter]->text; 
														$textCounter++;	
													?>
													</span>
												</td>
											</tr>
											<?php
											}
											else
											{
												$textCounter++;	
											}
											?>
										</table>
									</td>
									<td style="width: 40px;">
									</td>
								</tr>
								<!--hr-->
								<tr class="space-report" style="height:10px;">
									<td style="width: 40px;">
									</td>
									<td style="width: 720px; text-align: center; vertical-align: middle;">
										<hr class="hr" style="height: 1px; width: 710px; border: 0; background-color: #A8A8B7;"/>
									</td>
									<td style="width: 40px;">
									</td>
								</tr>
								<!--hr-->
								<?php
										$tableCounter++;
									}
								}
								?>
								
							</table>
						</td>
					</tr>
					<!--fin de contenido-->
					<?php
					}
					else
					{
					?>						
					<tr id="nothingToShow">
						<td style="width: 800px; background-color: #FFFFFF;">
							<table id="reportTitle" style="border-collapse: collapse; text-align: center; border-spacing:0;">
								<tr style="height: 15px;">
									<td colspan="3" >
									</td>
								</tr>
								<tr>
									<td style="width: 25px;">
									</td>
									<td style="width: 750px; text-align: left; vertical-align: middle; background-color: #3da9d7;">
										<b>No hay contenido en el reporte.</b>
									</td>
									<td style="width: 25px;">
									</td>
								</tr>
								<tr style="height: 25px;">
									<td colspan="3">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php
					}
					?>
					<tr class="division-report" style="height:10px; background-color: #071947;">
						<td style="width: 100%;">
						</td>
					</tr>
					<!--info&Copyrigth-->
					<tr id="info">
						<td style="width: 800px; background-color: #FFFFFF;">
							<table style="border: solid 0px #FFFF00; border-collapse: collapse; background-color: #FFFFFF; text-align: center; border-spacing:0;">
								<tr>
									<td style="line-height: 10px; padding-left: 7px;padding-top: 7px; vertical-align: top;text-align: left">
										<span style="font-family:arial; color:#333333; font-size:11px;">Elaborado por HAVAS WORLDWIDE M&Eacute;XICO &copy; 2013 <br /> Leibnitz 117 piso 2<br />Colonia Anzures<br />11590, M&eacute;xico, D.F.<br /><a href="http://www.havasworldwide.com.mx" style="font-family:arial; color:#2d80a4; font-size:8px;">www.havasworldwide.com.mx</a></span>
									</td>
									<td style="text-align: right">
										<img src="http://monitoreoredes.havasworldwide.com.mx/reportes/img/ladoDerecho.jpg" alt="footer"/>
									</td>
								</tr>
								<tr id="copyRight">
									<td colspan="2" style="text-align: center; width: 800px; vertical-align:bottom;">
										<img src="http://monitoreoredes.havasworldwide.com.mx/reportes/img/copyRight.jpg" alt="copyRight"/>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				<!--Fin del cuerpo del Reporte-->
			</td>
			<td id="space-right-background" style="width: 50px">
			</td>
		</tr>
		<tr id="space-bottom-background" style="height:30px;">
			<td colspan="3">
			</td>
		</tr>
	</table>
</div>
</BODY>
</HTML>
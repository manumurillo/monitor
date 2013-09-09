<?php
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
</HEAD>
<BODY> 
	<center>
	<div height="40" align="center">
		<span style="font-family:arial; color:#000000; font-size:14px;">Si no puede ver este mensaje correctamente por favor, haga clic <a href="http://monitoreoredes.havasworldwide.com.mx/reportes/20130730.html">aqu&iacute;</a>.</span>
	</div>
	<table width="900" cellspacing="0" cellpadding="0" border="0" bgcolor="#071947" valign="top"><!--background-->
		<tr height="30">
			<td colspan="3">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td width="50">
				&nbsp;
			</td>
			<td>
				<table width="800" cellspacing="0" cellpadding="0" border="1" bgcolor="" valign="top"><!--contenido-->
					<tbody>
					<!--header-->
						<tr>
							<th >
								<div style="padding-bottom:15px; background: #ffffff;">
									<img src="http://monitoreoredes.havasworldwide.com.mx/reportes/img/header.jpg" alt="encabezado"/>
								</div>
							</th>
						</tr>
					<!--end header--> 
					<!--cuerpo del reporte--> 
						<!--Report Title-->
						<tr id="reportTitle">
							<td>
								<table width="800" cellspacing="0" cellpadding="0" border="0" bgcolor="white" valign="top"><!--titulo del reporte-->
									<tr height="22">
										<td width="22">
											&nbsp;
										</td>
										<td width="756">
											&nbsp;
										</td>
										<td width="22">
											&nbsp;
										</td>
									</tr>
									<tr>
										<td width="22">
											&nbsp;
										</td>
										<td width="756" valign="top" align="left" bgcolor="#3da9d7">
											<span style="margin-left: 15px; font-family:arial;color:#ffffff; font-size: 21px;"><b><?php echo CHtml::encode($report->title); ?></b></span>
										</td>
										<td width="22">
											&nbsp;
										</td>
									</tr>
									<tr height="20">
										<td width="22">
											&nbsp;
										</td>
										<td width="756">
											&nbsp;
										</td>
										<td width="22">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
					<!--End Report Title-->
					<!--Report Content-->
						<tr id="items">
							<td>
								<table width="800" cellspacing="0" cellpadding="0" border="1" bgcolor="white" valign="top">						
						<?php
						if($items)
						{
							foreach($items as $item)
							{
								if($item->type==ReportItem::TYPE_TEXT)
								{
									$texts[$textCounter] = ReportText::model()->findByAttributes(array('item_id'=>$item->id));	
						?>
									<!-- Item Text-->
									<tr>
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
										<td width="728" align="left" style="text-align:left;">
											<?php 
												echo $texts[$textCounter]->text; 
												$textCounter++;
											?>
										</td>
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
									</tr>
									<tr height="5"  id="whiteSpaces" ><!--espacios en blanco-->
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
										<td width="728" align="left" style="text-align:left;">
											<hr/>
										</td>
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
									</tr>
									<!--end Item Text-->
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
									echo $tblWidth;
									
							?>
									<!-- Item Table-->
									<tr id="titleTable">
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
										<td width="728" VALIGN="top" align="left">
											<span style="font-family:arial; color:#2d80a4; font-size:14px;"><b><?php echo CHtml::encode($_table->title) ?></b></span>
										</td>
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
									</tr>
									<tr id="descriptionTable"><!--descripción de la tabla-->
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
										<td width="728" VALIGN="top" align="left" style="text-align:left;">
										<?php 
											echo $texts[$textCounter]->text; 
											$textCounter++;	
										?>
										</td>
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
									</tr>
									<tr><!--Cuerpo de la filas y celdas de la tabla-->
										<td width="36" height="">
											&nbsp;
										</td>
										<td width="728">
											<table width="728" cellspacing="0" cellpadding="0" bgcolor="white" valign="top" border="0" style="border-top: 1px; border-top-style: solid; border-top-color:#82c7e6; border-right: 1px; border-right-style: solid; border-right-color:#82c7e6; border-bottom: 1px; border-bottom-style: solid; border-bottom-color:#82c7e6; border-left: 1px; border-left-style: solid; border-left-color:#82c7e6;">
												<tbody align="center" >
													<tr>
												<?php
													foreach($_columns as $column)
													{
														$width=round(($column->width*100)/728, 2);
												?>
														<!--Encabezados de columnas-->
														<td width="<?php echo $width; ?>%" height="30" style="border-right: 1px; border-right-style: solid; border-right-color: #82c7e6; border-bottom: 1px solid #82c7e6;">
															<span style="font-family:arial; color:<?php echo CHtml::encode($column->color); ?>; font-size:14px;"><b><?php echo CHtml::encode($column->title); ?></b></span>
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
														<td valign="middle" style="border-right: 1px; border-right-style: solid; border-right-color: #82c7e6; border-bottom: 1px solid #82c7e6;">
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
												</tbody>
											</table>
										</td>
										<td width="36">
											&nbsp;
										</td>
									</tr>
									<tr id="footerTable"><!--Pie de la tabla-->
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
										<td width="728" VALIGN="top" align="left" style="text-align:left;">
										<?php 
											echo $texts[$textCounter]->text; 
											$textCounter++;	
										?>
										</td>
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
									</tr>
									<tr id="whiteSpaces" height="10" ><!--espacios en blanco-->
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
										<td width="728" VALIGN="top" align="left" style="text-align:left;">
											<hr/>
										</td>
										<td width="36" bgcolor="white">
											&nbsp;
										</td>
									</tr>
					<?php
									$tableCounter++;
								}
							}
						}
					else
					{
					?>							
									<tr>
										<td width="36">
											&nbsp;
										</td>
										<td width="728" valign="top" align="left" bgcolor="#3da9d7">
											<span style="margin-left: 15px; font-family:arial;color:#ffffff; font-size: 21px;"><b>El reporte no tiene elementos</b></span>
										</td>
										<td width="36">
											&nbsp;
										</td>
									</tr>		
								</table>
							</td>
						</tr>
				<?php
					}
				?>							
					<!--End content report-->
					<!--Footer-->
						<tr>
							<td width="36">
								&nbsp;
							</td>
							<td>
								<div style="padding-top:10px"><!--pie de pagina--> 
									<table width="728" cellspacing="0" cellpadding="0" border="0" bgcolor="white" valign="top">
										<tr>
											<td valign="top" style="line-height: 10px; padding-left: 7px;padding-top: 7px">
												<span style="font-family:arial; color:#333333; font-size:11px;">Elaborado por HAVAS WORLDWIDE M&Eacute;XICO &copy; 2013 <br /> Leibnitz 117 piso 2<br />Colonia Anzures<br />11590, M&eacute;xico, D.F.<br /><a href="http://www.havasworldwide.com.mx" style="font-family:arial; color:#2d80a4; font-size:8px;">www.havasworldwide.com.mx</a></span>
											</td>
											<td align="right">
												<img src="http://monitoreoredes.havasworldwide.com.mx/reportes/img/ladoDerecho.jpg" alt="encabezado"/>
											</td>
										</tr>
									</table>
								</div>
							</td>
							<td width="36">
								&nbsp;
							</td>
						</tr>
					<!--end Footer-->
					<!--copyRight-->
						<tr>
							<td width="36">
								&nbsp;
							</td>
							<th>
								<div style="margin-top: -5px: width: 728px;">
									<img src="http://monitoreoredes.havasworldwide.com.mx/reportes/img/copyRight.jpg" alt="copyRight"/>
								</div>
							</th>
							<td width="36">
								&nbsp;
							</td>
						</tr>
					<!--fin de copyRight--> 
					</tbody>
				</table>
			</td>
			<td width="50">
				&nbsp;
			</td>
		</tr>
		<tr height="30">
			<td colspan="3">
				&nbsp;
			</td>
		</tr>
	</table><!--End Background-->
	</center>
</BODY>
</HTML>
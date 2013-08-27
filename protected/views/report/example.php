<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/css/form.css" />
	<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/js/report.js"></script>
<title>Axa - Monitoreo de redes sociales - Axa - Monitoreo de redes sociales - Update Report</title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">Axa - Monitoreo de redes sociales</div>
	</div><!-- header -->

	<div id="mainmenu">
		<ul id="yw2">
<li><a href="/index.php?r=site/index">Inicio</a></li>
<li><a href="/index.php?r=report/index">Reportes</a></li>
<li><a href="/index.php?r=reportItem/index">Items</a></li>
<li><a href="/index.php?r=reportText/index">Textos</a></li>
<li><a href="/index.php?r=table/index">Tablas</a></li>
<li><a href="/index.php?r=reportTable/index">Tablas de Reporte</a></li>
<li><a href="/index.php?r=user/index">Usuarios</a></li>
<li><a href="/index.php?r=site/logout">Logout (admin)</a></li>
</ul>	</div><!-- mainmenu -->
			<div class="breadcrumbs">
<a href="/index.php">Home</a> &raquo; <a href="/index.php?r=report/index">Reportes</a> &raquo; <a href="/index.php?r=report/view&id=Reporte+1">Reporte 1</a> &raquo; <span>Actualizar</span></div><!-- breadcrumbs -->
	
	<div class="span-19">
	<div id="content">
		
<h1>Actualizar reporte Reporte 1</h1>


<div class="form">
	
	<form id="report-form" action="/index.php?r=report/update&amp;id=1" method="post">	
	<table id="report" border="1">
		<thead>
			<!--ReportForm begin-->
			<tr>
				<th colspan="2">
					<p class="note">Campos marcados con <span class="required">*</span> son obligatorios.</p>
					<p class="error"></p>
				</th>
			</tr>
	
			<tr>
				<th colspan="2">
					<label for="Report_title" class="required">Título <span class="required">*</span></label>					<input size="60" maxlength="255" name="Report[title]" id="Report_title" type="text" value="Reporte 1" />										<label for="Report_status" class="required">Estado <span class="required">*</span></label>					<select name="Report[status]" id="Report_status">
<option value="1">Borrador</option>
<option value="2" selected="selected">Publicado</option>
<option value="3">Archivado</option>
</select>				</th>
			</tr>
			<!--Report Form end-->
		</thead>
		<tbody>

			<tr id="addOptions">
				<th colspan="2">
					<input type="button" value="Agregar texto" class="btnAgregarTexto">
					<input type="button" value="Agregar tabla" class="btnAgregarTabla">
					<span id="countItems"></span>
				</th>
			</tr>

			<tr id="itemText_0" class="item">
				<th width="20%" >
					<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
					<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
					<input type="button" value="Eliminar" class="btnEliminarItem"><br>
					<label for="ReportItem_0_id">ID</label>					<input name="ReportItem[0][id]" id="ReportItem_0_id" type="text" value="1" /><br>
					<label for="ReportItem_0_report_id" class="required">Reporte ID <span class="required">*</span></label>					<input name="ReportItem[0][report_id]" id="ReportItem_0_report_id" type="text" value="1" /><br>
					<label for="ReportItem_0_position">Posición</label>					<input name="ReportItem[0][position]" id="ReportItem_0_position" type="text" value="0" /><br>
					<label for="ReportItem_0_type" class="required">Tipo <span class="required">*</span></label>					<input name="ReportItem[0][type]" id="ReportItem_0_type" type="text" value="1" /><br>
				</th>
				<th width="80%">
					<p class="note">Texto:</p>
					<label for="ReportText_0_id">ID</label>					<input name="ReportText[0][id]" id="ReportText_0_id" type="text" value="1" /><br>
					
					<label for="ReportText_0_item_id" class="required">Item ID <span class="required">*</span></label>					<input name="ReportText[0][item_id]" id="ReportText_0_item_id" type="text" value="1" /><br>
					
					<label for="ReportText_0_text" class="required">Texto <span class="required">*</span></label>					<textarea rows="6" cols="50" name="ReportText[0][text]" id="ReportText_0_text">Este es el primer texto de prueba.
						Pertenece al reporte 1 y al item 1</textarea>				
				</th>
			</tr>
			<tr id="itemTable_1" class="item">
				<th width="20%" >
					<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
					<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
					<input type="button" value="Eliminar" class="btnEliminarItem"><br>
					<label for="ReportItem_1_id">ID</label>					<input name="ReportItem[1][id]" id="ReportItem_1_id" type="text" value="2" /><br>
					<label for="ReportItem_1_report_id" class="required">Reporte ID <span class="required">*</span></label>					<input name="ReportItem[1][report_id]" id="ReportItem_1_report_id" type="text" value="1" /><br>
					<label for="ReportItem_1_position">Posición</label>					<input name="ReportItem[1][position]" id="ReportItem_1_position" type="text" value="1" /><br>
					<label for="ReportItem_1_type" class="required">Tipo <span class="required">*</span></label>					<input name="ReportItem[1][type]" id="ReportItem_1_type" type="text" value="0" /><br>
				</th>
				<th width="80%" >
					<table>
						<tr>
							<th colspan="5">
								<p class="note">Tabla</p>
								<label for="ReportTable_1_id">ID</label>
								<input name="ReportTable[1][id]" id="ReportTable_1_id" type="text" value="1" />
								<br>
								
								<label for="ReportTable_1_item_id" class="required">Item ID <span class="required">*</span></label>
								<input name="ReportTable[1][item_id]" id="ReportTable_1_item_id" type="text" value="2" /><br>
								<label for="ReportTable_1_table_id" class="required">Tabla ID <span class="required">*</span></label>								<input name="ReportTable[1][table_id]" id="ReportTable_1_table_id" type="text" value="1" /><br>
								<label for="ReportTable_1_status">Estado</label>
								<input name="ReportTable[1][status]" id="ReportTable_1_status" type="text" value="1" />
							</th>
						</tr>
						<tr>
							<th width="100">
								<font color="#000066">Sitio</font>
							</th>
							<th width="100">
								<font color="#000066">Usuario</font>
							</th>
							<th width="50">
								<font color="#000066">Alcance</font>
							</th>
							<th width="127">
								<font color="#000066">Contenido</font>
							</th>
							<th width="127">
								<font color="#000066">Url</font>
							</th>
						</tr>
						
						<tr>
							<th>
								<label for="ReportTableCell_0_color">Color</label>
								<input name="ReportTableCell[0][color]" id="ReportTableCell_0_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_0_content">Contenido</label>								
								<textarea cols="16" rows="2" name="ReportTableCell[0][content]" id="ReportTableCell_0_content">Contenido Primera celda</textarea>						
							</th>
							<th>
								<label for="ReportTableCell_1_color">Color</label>
								<input name="ReportTableCell[1][color]" id="ReportTableCell_1_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_1_content">Contenido</label>
								<textarea cols="16" rows="2" name="ReportTableCell[1][content]" id="ReportTableCell_1_content">Contenido celda 2</textarea>
							</th>
							<th>
								<label for="ReportTableCell_2_color">Color</label>
								<input name="ReportTableCell[2][color]" id="ReportTableCell_2_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_2_content">Contenido</label>
								<textarea cols="16" rows="2" name="ReportTableCell[2][content]" id="ReportTableCell_2_content">Contenido celda 3</textarea>
							</th>
							<th>
								<label for="ReportTableCell_3_color">Color</label>
								<input name="ReportTableCell[3][color]" id="ReportTableCell_3_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_3_content">Contenido</label>
								<textarea cols="16" rows="2" name="ReportTableCell[3][content]" id="ReportTableCell_3_content">Contenido celda 4</textarea>
							</th>
							<th>
								<label for="ReportTableCell_4_color">Color</label>
								<input name="ReportTableCell[4][color]" id="ReportTableCell_4_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_4_content">Contenido</label>
								<textarea cols="16" rows="2" name="ReportTableCell[4][content]" id="ReportTableCell_4_content">contenido celda 5</textarea>
							</th>
						</tr>
						<tr>
							<th>
								<label for="ReportTableCell_5_color">Color</label>								<input name="ReportTableCell[5][color]" id="ReportTableCell_5_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_5_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[5][content]" id="ReportTableCell_5_content">Contenido de Fila 2 Columna 1</textarea>						</th>
													<th>
								<label for="ReportTableCell_6_color">Color</label>								<input name="ReportTableCell[6][color]" id="ReportTableCell_6_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_6_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[6][content]" id="ReportTableCell_6_content">Contenido de Fila 2 Columna 2</textarea>						</th>
													<th>
								<label for="ReportTableCell_7_color">Color</label>								<input name="ReportTableCell[7][color]" id="ReportTableCell_7_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_7_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[7][content]" id="ReportTableCell_7_content">Contenido de Fila 2 Columna 3</textarea>						</th>
													<th>
								<label for="ReportTableCell_8_color">Color</label>								<input name="ReportTableCell[8][color]" id="ReportTableCell_8_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_8_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[8][content]" id="ReportTableCell_8_content">Contenido de Fila 2 Columna 4</textarea>						</th>
													<th>
								<label for="ReportTableCell_9_color">Color</label>								<input name="ReportTableCell[9][color]" id="ReportTableCell_9_color" type="text" maxlength="10" value="#000000" /><br>
								<label for="ReportTableCell_9_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[9][content]" id="ReportTableCell_9_content">Contenido de Fila 2 Columna 5</textarea>
							</th>
						</tr>
															
					</table>
				</th>
			</tr>
						<tr id="itemText_2" class="item">
				<th width="20%" >
					<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
					<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
					<input type="button" value="Eliminar" class="btnEliminarItem"><br>
					<label for="ReportItem_2_id">ID</label>					<input name="ReportItem[2][id]" id="ReportItem_2_id" type="text" value="3" /><br>
					<label for="ReportItem_2_report_id" class="required">Reporte ID <span class="required">*</span></label>					<input name="ReportItem[2][report_id]" id="ReportItem_2_report_id" type="text" value="1" /><br>
					<label for="ReportItem_2_position">Posición</label>					<input name="ReportItem[2][position]" id="ReportItem_2_position" type="text" value="2" /><br>
					<label for="ReportItem_2_type" class="required">Tipo <span class="required">*</span></label>					<input name="ReportItem[2][type]" id="ReportItem_2_type" type="text" value="1" /><br>
				</th>
				<th width="80%">
					<p class="note">Texto:</p>
					<label for="ReportText_2_id">ID</label>					<input name="ReportText[2][id]" id="ReportText_2_id" type="text" value="2" /><br>
					
					<label for="ReportText_2_item_id" class="required">Item ID <span class="required">*</span></label>					<input name="ReportText[2][item_id]" id="ReportText_2_item_id" type="text" value="3" /><br>
					
					<label for="ReportText_2_text" class="required">Texto <span class="required">*</span></label>					<textarea rows="6" cols="50" name="ReportText[2][text]" id="ReportText_2_text">Este es el segundo texto de prueba.
Pertenece al reporte 1 y al item 3</textarea>				</th>
			</tr>
						<tr id="itemTable_3" class="item">
				<th width="20%" >
					<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
					<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
					<input type="button" value="Eliminar" class="btnEliminarItem"><br>
					<label for="ReportItem_3_id">ID</label>					<input name="ReportItem[3][id]" id="ReportItem_3_id" type="text" value="4" /><br>
					<label for="ReportItem_3_report_id" class="required">Reporte ID <span class="required">*</span></label>					<input name="ReportItem[3][report_id]" id="ReportItem_3_report_id" type="text" value="1" /><br>
					<label for="ReportItem_3_position">Posición</label>					<input name="ReportItem[3][position]" id="ReportItem_3_position" type="text" value="3" /><br>
					<label for="ReportItem_3_type" class="required">Tipo <span class="required">*</span></label>					<input name="ReportItem[3][type]" id="ReportItem_3_type" type="text" value="0" /><br>
				</th>
				<th width="80%" >
					<table>
						<tr>
							<th colspan="5">
								<p class="note">Tabla</p>
								<label for="ReportTable_3_id">ID</label>								<input name="ReportTable[3][id]" id="ReportTable_3_id" type="text" value="2" /><br>
								
								<label for="ReportTable_3_item_id" class="required">Item ID <span class="required">*</span></label>								<input name="ReportTable[3][item_id]" id="ReportTable_3_item_id" type="text" value="4" /><br>
								
								<label for="ReportTable_3_table_id" class="required">Tabla ID <span class="required">*</span></label>								<input name="ReportTable[3][table_id]" id="ReportTable_3_table_id" type="text" value="3" /><br>
								
								<label for="ReportTable_3_status">Estado</label>								<input name="ReportTable[3][status]" id="ReportTable_3_status" type="text" value="0" />							</th>
						</tr>
						<tr>
													<th width="100">
								<font color="#99CC33">Columna1</font>
							</th>
													<th width="100">
								<font color="#3366CC">Columna2</font>
							</th>
													<th width="100">
								<font color="#993399">Columna3</font>
							</th>
													<th width="100">
								<font color="#FF0000">Columna 4</font>
							</th>
													<th width="100">
								<font color="#000000">Columna 5</font>
							</th>
												</tr>
						
												<tr>
													<th>
								<label for="ReportTableCell_10_color">Color</label>								<input name="ReportTableCell[10][color]" id="ReportTableCell_10_color" type="text" maxlength="10" value="#ccc000" /><br>
								<label for="ReportTableCell_10_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[10][content]" id="ReportTableCell_10_content">fila 3 Columna 1</textarea>						</th>
													<th>
								<label for="ReportTableCell_11_color">Color</label>								<input name="ReportTableCell[11][color]" id="ReportTableCell_11_color" type="text" maxlength="10" value="#ccc000" /><br>
								<label for="ReportTableCell_11_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[11][content]" id="ReportTableCell_11_content">fila 3 Columna 2</textarea>						</th>
													<th>
								<label for="ReportTableCell_12_color">Color</label>								<input name="ReportTableCell[12][color]" id="ReportTableCell_12_color" type="text" maxlength="10" value="#ccc000" /><br>
								<label for="ReportTableCell_12_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[12][content]" id="ReportTableCell_12_content">fila 3 Columna 3</textarea>						</th>
													<th>
								<label for="ReportTableCell_13_color">Color</label>								<input name="ReportTableCell[13][color]" id="ReportTableCell_13_color" type="text" maxlength="10" value="#ccc000" /><br>
								<label for="ReportTableCell_13_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[13][content]" id="ReportTableCell_13_content">fila 3 Columna 4</textarea>						</th>
													<th>
								<label for="ReportTableCell_14_color">Color</label>								<input name="ReportTableCell[14][color]" id="ReportTableCell_14_color" type="text" maxlength="10" value="#ccc000" /><br>
								<label for="ReportTableCell_14_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[14][content]" id="ReportTableCell_14_content">fila 3 Columna 5</textarea>						</th>
												</tr>
												<tr>
													<th>
								<label for="ReportTableCell_15_color">Color</label>								<input name="ReportTableCell[15][color]" id="ReportTableCell_15_color" type="text" maxlength="10" value="#cc3300" /><br>
								<label for="ReportTableCell_15_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[15][content]" id="ReportTableCell_15_content">Fila 4 Columna 1</textarea>						</th>
													<th>
								<label for="ReportTableCell_16_color">Color</label>								<input name="ReportTableCell[16][color]" id="ReportTableCell_16_color" type="text" maxlength="10" value="#cc3300" /><br>
								<label for="ReportTableCell_16_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[16][content]" id="ReportTableCell_16_content">Fila 4 Columna 2</textarea>						</th>
													<th>
								<label for="ReportTableCell_17_color">Color</label>								<input name="ReportTableCell[17][color]" id="ReportTableCell_17_color" type="text" maxlength="10" value="#cc3300" /><br>
								<label for="ReportTableCell_17_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[17][content]" id="ReportTableCell_17_content">Fila 4 Columna 3</textarea>						</th>
													<th>
								<label for="ReportTableCell_18_color">Color</label>								<input name="ReportTableCell[18][color]" id="ReportTableCell_18_color" type="text" maxlength="10" value="#cc3300" /><br>
								<label for="ReportTableCell_18_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[18][content]" id="ReportTableCell_18_content">Fila 4 Columna 4</textarea>						</th>
													<th>
								<label for="ReportTableCell_19_color">Color</label>								<input name="ReportTableCell[19][color]" id="ReportTableCell_19_color" type="text" maxlength="10" value="#cc3300" /><br>
								<label for="ReportTableCell_19_content">Contenido</label>								<textarea cols="16" rows="2" name="ReportTableCell[19][content]" id="ReportTableCell_19_content">Fila 4 Columna 5</textarea>						</th>
												</tr>
															
					</table>
				</th>
			</tr>
						
			<tr id="itemText" style="display:none;">
				<th width="20%">
					<input type="button" value="Agregar texto" class="btnAgregarTexto"> <br>
					<input type="button" value="Agregar tabla" class="btnAgregarTabla"><br>
					<input type="button" value="Eliminar" class="btnEliminarItem"><br>
					<label for="ReportItem_3_id">ID</label>					<input name="ReportItem[3][id]" id="ReportItem_3_id" type="text" value="4" /><br>
					<label for="ReportItem_3_report_id" class="required">Reporte ID <span class="required">*</span></label>					<input name="ReportItem[3][report_id]" id="ReportItem_3_report_id" type="text" value="1" /><br>
					<label for="ReportItem_3_position">Posición</label>					<input name="ReportItem[3][position]" id="ReportItem_3_position" type="text" value="3" /><br>
					<label for="ReportItem_3_type" class="required">Tipo <span class="required">*</span></label>					<input name="ReportItem[3][type]" id="ReportItem_3_type" type="text" value="0" /><br>
				</th>
				<th width="80%">
					<p class="note">Texto:</p>
					<label for="ReportText_3_id">ID</label>					<input name="ReportText[3][id]" id="ReportText_3_id" type="text" value="2" /><br>
					
					<label for="ReportText_3_item_id" class="required">Item ID <span class="required">*</span></label>					<input name="ReportText[3][item_id]" id="ReportText_3_item_id" type="text" value="3" /><br>
					
					<label for="ReportText_3_text" class="required">Texto <span class="required">*</span></label>					<textarea rows="6" cols="50" name="ReportText[3][text]" id="ReportText_3_text">Este es el segundo texto de prueba.
Pertenece al reporte 1 y al item 3</textarea>				</th>
			</tr>
			
		</tbody>
		<tfoot>
			<tr>
				<th colspan="2">
					<span id="countItems"></span><br>
					<input type="submit" name="yt0" value="Guardar" />				</th>
			</tr>
		</tfoot>
	</table>
	</form></div>		

	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<div class="portlet" id="yw0">
<div class="portlet-decoration">
<div class="portlet-title">Operaciones</div>
</div>
<div class="portlet-content">
<ul class="operations" id="yw1">
<li><a href="/index.php?r=report/index">Ver todos los reportes</a></li>
<li><a href="/index.php?r=report/create">Crear un nuevo reporte</a></li>
<li><a href="/index.php?r=report/view&amp;id=1">Ver reporte</a></li>
<li><a href="/index.php?r=report/admin">Administrar reportes</a></li>
</ul></div>
</div>	</div><!-- sidebar -->
</div>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; 2013 by My Company.<br/>
		All Rights Reserved.<br/>
		Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a>.	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

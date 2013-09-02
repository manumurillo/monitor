$(document).ready(function() {
	var itemCounter	= ($('tr.item').length);
	var rowCounter 	= ($('tr.row').length);
	var cellCounter = ($('div.content').length);
	var textCounter = ($('div.text').length);
	
	$('#countItems').html('Total de items: '+itemCounter);
	$('#countRows').html('Total de filas: '+rowCounter);
	$('#countCells').html('Total de celdas: '+cellCounter);
	$('#countTexts').html('Total de textos: '+textCounter);
	
	//Se asigna al evento onClick de cada elemento con la clase .addTextButton la función addText
	$(".addTextButton").each(function (){
		$(this).on("click",addText);
	});
	
	//Se asigna a cada elemento con la clase .addTableButton la función addTable
	$(".addTableButton").each(function (){
		$(this).on("click",addTable);
	});
	
	//Se asigna a cada elemento con id #deleteItem la función deleteItem
	$(document).on('click','#deleteItem',deleteItem);
	
	//Se asigna a cada elemento con id #addTableRow la función addTableRow
	$(document).on('click','#addTableRow',addTableRow);
	
	//Se asigna a cada elemento con id #delTableRow la función addTableRow
	$(document).on('click','#delTableRow',delTableRow);
	
	//Se asigna al formulario #report-form la función validateForm
	$("#report-form").each(function (){
		$(this).on("submit",validateForm);
	});
	
	//Se asigna la funcion AddAutoComplete a los elementos con clase .autoComplete
	$(".autoComplete").each(function (){
		$(this).on("click",AddAutoComplete);
	});

	/* Función addText
	 * Permite agregar el formulario para items tipo texto.
	 */
	function addText(){
	
		//Se clona el elemento con id itemText y su contenido.
		$newItem = $('#itemText').clone(true);
		
		//Se aumenta el contador de items y el contador de áreas de texto 
		itemCounter++;
		textCounter++;
		
		//Se cambian los atributos id, class y la propiedad css display al elemento clonado.
		$newItem.attr("id", "itemText_"+itemCounter);
		$newItem.attr("class", "item");
		$newItem.css("display","table-row");
		
		//Se obtiene el primer elemento hijo del elemento clonado
		var child = $newItem.children().eq(0);
		
		//Se cambia el id y nombre del campo ReportItem->type
		$(child).children("input").eq(0).attr("id","ReportItem_"+itemCounter+"_type");
		$(child).children("input").eq(0).attr("name","ReportItem["+itemCounter+"][type]");
		
		//Se cambia el id y nombre del campo ReportItem->id
		$(child).children("input").eq(1).attr("id","ReportItem_"+itemCounter+"_id");
		$(child).children("input").eq(1).attr("name","ReportItem["+itemCounter+"][id]");
		
		//Se cambia el id y nombre del campo ReportText->id
		$(child).children("input").eq(2).attr("id","ReportText_"+textCounter+"_id");
		$(child).children("input").eq(2).attr("name","ReportText["+textCounter+"][id]");
		
		//Se cambia el id y nombre del campo ReportText->item_id
		$(child).children("input").eq(3).attr("id","ReportText_"+textCounter+"_item_id");
		$(child).children("input").eq(3).attr("name","ReportText["+textCounter+"][item_id]");
		
		//Se cambia nombre, id y clase al campo ReportText->text.
		var id = "ReportText_"+textCounter+"_text";
		$(child).children("div").eq(1).attr("id","ReportText_"+textCounter+"_text").html('');
		$(child).children("div").eq(1).attr("class","isRequired text");
		
		/*
		 * Se obtiene el padre (a nivel 2) del botón que activó el evento (en este caso, la fila tr) 
		 * para insertar el elemento clonado debajo este.
		 */
		var parent = $(this).parents().get(1);
		$(parent).after($newItem);
		
		//Se agrega el editor tinymce al campo ReportText->text
		tinymce.init({
			selector:	"#ReportText_"+textCounter+"_text",
			  inline:	true,
			 plugins:
					[	"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
						"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
						"table directionality emoticons template textcolor paste textcolor"
					],
			toolbar1:	"undo redo | styleselect formatselect fontselect fontsizeselect | preview code",
			toolbar2: 	"forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink",
			toolbar3: 	"bullist numlist | table | hr removeformat | subscript superscript charmap ",
			 menubar: 	false,
  toolbar_items_size: 	'small',
			language: 	'es',
		  auto_focus: 	"ReportText_"+textCounter+"_text"
		});
		
		//Se cambian los mensajes de items y textos.
		$('#countItems').html('Total de items:'+($('tr.item').length));
		$('#countTexts').html('Total de textos:'+($('div.text').length));
	}
	
	/* Función addTable
	 * Permite agregar el formulario para items tipo table.
	 */
	function addTable(){
		
		//Se clona el elemento con id itemTable y su contenido.
		$newItem = $('#itemTable').clone(true);
		//Se aumenta el contador de items
		itemCounter++;

		//Se cambia el id, class y la propiedad css display del elemento clonado.
		$newItem.attr("id", "itemTable_"+itemCounter);
		$newItem.attr("class", "item");
		$newItem.css("display","table-row");
		
		//Se obtiene el primer elemento hijo del elemento clonado.
		var child = $newItem.children().eq(0);
		
		//Se cambia el nombre y el id del atributo ReportItem->type
		$(child).children("input").eq(0).attr("id","ReportItem_"+itemCounter+"_type");
		$(child).children("input").eq(0).attr("name","ReportItem["+itemCounter+"][type]");
		
		//Se cambia el nombre y el id del atributo ReportItem->id
		$(child).children("input").eq(1).attr("id","ReportItem_"+itemCounter+"_id");
		$(child).children("input").eq(1).attr("name","ReportItem["+itemCounter+"][id]");
		
		//Se cambia el nombre y el id del atributo ReportTable->id
		$(child).children("input").eq(2).attr("id","ReportTable_"+itemCounter+"_id");
		$(child).children("input").eq(2).attr("name","ReportTable["+itemCounter+"][id]");
		
		//Se cambia el nombre y el id del atributo ReportTable->item_id
		$(child).children("input").eq(3).attr("id","ReportTable_"+itemCounter+"_item_id");
		$(child).children("input").eq(3).attr("name","ReportTable["+itemCounter+"][item_id]");
		
		//Se cambia el nombre y el id del atributo ReportTable->status
		$(child).children("input").eq(4).attr("id","ReportTable_"+itemCounter+"_status");
		$(child).children("input").eq(4).attr("name","ReportTable["+itemCounter+"][status]");
		
		//Se cambia el id y nombre del Select que muestra las tablas creadas.
		$(child).children("select").eq(0).attr("id","ReportTable_"+itemCounter+"_table_id").val('');
		$(child).children("select").eq(0).attr("name","ReportTable["+itemCounter+"][table_id]");
		$(child).children("select").eq(0).attr("class","selectRequired");
		
		//Se cambia el id y nombre del campo rowCounter
		$(child).children(".rowCount").attr("id","ReportTable_"+itemCounter+"_rowCounter");
		$(child).children(".rowCount").attr("name","ReportTable["+itemCounter+"][rowCounter]");
		
		//Se cambia el id del div con id #layoutTable
		$(child).children("#layoutTable").eq(0).attr("id","layoutTable"+itemCounter);
		
		/*
		 * Se obtiene el padre (a nivel 2) del botón que activó el evento (en este caso, la fila tr) 
		 * para insertar el elemento clonado debajo este.
		 */
		var parent = $(this).parents().get(1);
		$(parent).after($newItem);
		
		//Se cambia el mensaje del total de items
		$('#countItems').html('Total de items: '+($('tr.item').length));
		
		/* Variables que obtienen el total de items de texto y celdas antes de que el usuario seleccione
		 * la tabla que desea agregar al reporte.
		 */
		var cellsExist=($('div.content').length);
		var textsExist=($('div.text').length);
		
		//Función que agrega el evento onChange al select que muestra las tablas disponibles.
		jQuery(function($)
			{
			jQuery('body').on('change','#ReportTable_'+itemCounter+'_table_id',
			function()
				{
				$('#ReportTable_'+itemCounter+'_table_id option[value='+$(this).val()+']').attr("selected",true); 
				jQuery.ajax(
						{
						'type': 'POST',
						'url': 	'/index.php?r=table/listTableLayout',
						'data':	{
									'id':this.value,
									'cellCounter':cellCounter,
									'textCounter':textCounter,
									'rowCounter':rowCounter
								},
						'cache':false,
						'success':	
							function(html)
							{
								//El esquema de la tabla seleccionada se inserta en el layoutTable específico.
								jQuery("#layoutTable"+itemCounter).html(html);
								
								//Se aumenta el contador de filas.
								rowCounter++;
								
								//Se obtiene el total de celdas después de la inserción de la tabla y se modifica su contador.
								var cellTotal = ($('div.content').length);
								var insertedCells = cellTotal - cellsExist;
								cellCounter += insertedCells;
								
								//Se cambia el mensaje del total de celdas y total de filas.
								$('#countCells').html('Total de celdas: '+($('div.content').length));
								$('#countRows').html('Total filas: '+($('tr.row').length));
								
								//También se obtiene el total de textos de tabla y se modifica su contador.
								var textTotal = ($('div.text').length);
								var insertedTexts = textTotal - textsExist;
								textCounter += insertedTexts; 
								
								//Se cambia el mensaje de total de textos.
								$('#countTexts').html('Total de textos: '+($('div.text').length));
								
								//Se cambia el valor de rowCount de la tabla creada.
								var parent = $('#ReportTable_'+itemCounter+'_table_id').parents().get(0);
								var r=$(parent).children(".rowCount").val(1);	
								$(parent).children("#errorTable").html("");	
								cellsExist++;
								
								//Se asigna el evento autoComplete a la celda que contenga la clase autoComplete.
								for(cellsExist; cellsExist<=cellTotal; cellsExist++)
								{
									if(/autoComplete/.test($("#ReportTableCell_"+cellsExist+"_content").attr("class")))
									{
										console.log("Asignado el evento autocomplete a: ReportTableCell_"+cellsExist+"_content");
										$("#ReportTableCell_"+cellsExist+"_content").on("click",AddAutoComplete);
									}
								}	
							}		
						});
					return false;
				});
		
			});
	}
	
	/*
	 * Función que asigna el editor de texto a las celdas.
	 * @param int cellInit indica el contador de la celda de inicio
	 * @param int cellFin  indica el contador de la celda final
	 */
	function addTextEditor(cellInit, cellFin){
		for(cellInit; cellInit<=cellFin; cellInit++)
		{
			tinymce.init({
				selector: '#ReportTableCell_'+cellInit+'_content',
				inline: true,
				plugins: [
					'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
					'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
					'table directionality emoticons template textcolor paste textcolor'
				],
				toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect | preview code',
				toolbar2: 'forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink',
				toolbar3: 'bullist numlist | table | hr removeformat | subscript superscript charmap',

				menubar: false,
				toolbar_items_size: 'small',
				language: 'es'
			});
			$('input[type=hidden][name=ReportTableCell_'+cellInit+'_content]').attr('class','content');
			
			//Asignación del evento autocomplete si la celda lo requiere.
			if(/autoComplete/.test($("#ReportTableCell_"+cellInit+"_content").attr("class")))
			{
				console.log("Asignado el evento autocomplete a: ReportTableCell_"+cellInit+"_content");
				$("#ReportTableCell_"+cellInit+"_content").on("click",AddAutoComplete);
			}
		}
	}
	
	/*
	 * Función que asigna a cada elemento con id deleteItem
	 * el evento que permite eliminar el item del reporte
	 */
	function deleteItem(){
		//Se obtiene el padre  (a nivel 3) del botón seleccionado y se elimina
		var parent = $(this).parents().get(2);
		$(parent).remove();
		
		//Se cambian los mensajes
		$('#countItems').html('Total de items: '+($('tr.item').length));
		$('#countRows').html('Total de filas: '+($('tr.row').length));
		$('#countCells').html('Total de celdas: '+($('div.content').length));
		$('#countTexts').html('Total de textos:'+($('div.text').length));
	}
	
	/*
	 * Función que asigna a cada elemento con id addTableRow
	 * el evento que permite insertar una fila en un item tipo Tabla
	 */
	function addTableRow(){
		console.log('Iniciando clonacion');

		//Se identifica al padre que contiene al elemento addTableRow (en este caso, <tr>
		var parent = $(this).parents().get(1);
		
		//Se clona el elemento padre con todos los atributos que contiene.
		$newItem = $(parent).clone(true);
		
		//Se aumenta el contador de filas.
		rowCounter++;
		//Se aumenta el campo rowCount de la tabla.
		var sixParent = $(this).parents().get(5);
		var r=$(sixParent).children(".rowCount").val();
		r++;
		var r=$(sixParent).children(".rowCount").val(r);
		
		var cellInit=cellCounter;
		
		//Por cada elemento th con id 'cells', cambiamos el id y nombre
		$newItem.children('#cells').each(function(){
			//Se aumenta el valor de cellCounter.
			cellCounter++;
			//console.log("CellCounter: "+cellCounter+"\n"); 
			//Se asignan los nuevos atributos de cada campo
			var oldDiv = $(this).children("div").eq(0);
			if(/autoComplete/.test($(oldDiv).attr("class")))
				var newDiv="<div id='ReportTableCell_"+cellCounter+"_content' class='content autoComplete'></div>";
			else
				var newDiv="<div id='ReportTableCell_"+cellCounter+"_content' class='content'></div>";
			$(this).children("div").eq(0).remove();
			$(this).children("span").remove();
			$(this).prepend(newDiv);
			$(this).children("input[type=hidden]").eq(1).attr("id","ReportTableCell_"+cellCounter+"_column_id");
			$(this).children("input[type=hidden]").eq(1).attr("name","ReportTableCell["+cellCounter+"][column_id]");
			$(this).children("input[type=hidden]").eq(2).attr("id","ReportTableCell_"+cellCounter+"_row_id").val('0');
			$(this).children("input[type=hidden]").eq(2).attr("name","ReportTableCell["+cellCounter+"][row_id]");
			$(this).children("input[type=hidden]").eq(0).remove();
		});
		
		//Se obtiene la columna que corresponde a los controles de la fila
		var a = $newItem.children("#cellControls");
		
		//Se elimina el primer div para eliminar todo lo clonado de wColorPicker
		$(a).children("div").eq(0).remove();

		//Se crea un nuevo div que contendrá wColorPicker
		$(a).prepend(document.createElement('div')) ;
		$(a).children("div").eq(0).attr('id','nuevoDiv'+rowCounter);
		var nvoId="nuevoDiv"+rowCounter;
		
		//Se asignan nuevos id y nombre al campo de color
		var color=$(a).children("input[type=text]").eq(0).val();
		$(a).children("input[type=text]").eq(0).attr("id","ReportTableRow_"+rowCounter+"_color");
		$(a).children("input[type=text]").eq(0).attr("name","ReportTableRow["+rowCounter+"][color]");
		
		$(a).children("input[type=hidden]").eq(0).attr("id","ReportTableRow_"+rowCounter+"_id").val('0');
		$(a).children("input[type=hidden]").eq(0).attr("name","ReportTableRow["+rowCounter+"][id]");
		
		//El item clonado se inserta después de la fila que invocó el evento.
		$(parent).after($newItem);
		
		//Se agrega el editor tinymce a casa celda clonada
		var cellFin = cellCounter;
		addTextEditor(cellInit+1, cellFin+1);
								
		//Se actualizan los mensajes de filas y celdas.
		$('#countRows').html('Total de filas: '+($('tr.row').length));
		$('#countCells').html('Total areas: '+($('div.content').length));
		
		//Se asigna el evento wColorPicker a la nueva fila.
		var nvoIDC='ReportTableRow_'+rowCounter+'_color';
		$('#'+nvoId).wColorPicker({
			initColor: color,
			mode: 'click',
			effect: 'slide', 
			theme: 'red',
			onSelect: function(color){
				$('#'+nvoIDC).css('color', color).val(color);
			},
			onMouseover: function(color){
				$('#'+nvoIDC).css('color', color).val(color);
			},
			onMouseout: function(color){
				$('#'+nvoIDC).css('color', color).val(color);
			}
		});				
	}
	
	/*
	 * Función que asigna a cada elemento con id delTableRow
	 * el evento que permite eliminar una fila específica.
	 */
	function delTableRow(){
	
		//Se obtiene el total de filas que tiene la tabla, si es la última, envía un mensaje de confirmación
		var parent2 = $(this).parents().get(5);
		var r=$(parent2).children(".rowCount").val();
		if(r==1)
		{
			if (confirm('¿Está seguro de eliminar la última fila?\nSe eliminará toda la tabla. '))
			{ 
				$(parent2).remove();
				
				//Se cambian los mensajes
				$('#countItems').html('Total de items: '+($('tr.item').length));
				$('#countRows').html('Total de filas: '+($('tr.row').length));
				$('#countCells').html('Total de celdas: '+($('div.content').length));
				$('#countTexts').html('Total de textos:'+($('div.text').length));
			}
		}
		else
		{
			r--;
			var r=$(parent2).children(".rowCount").val(r);
			
			var parent = $(this).parents().get(1);
			$(parent).remove();
			
			$('#countRows').html('Total de filas: '+($('tr.row').length));
			$('#countCells').html('Total de celdas: '+($('div.content').length));	
		}
	}
	
	/*
	 * Función que valida el formulario onSubmit
	 * @return boolean band regresa falso la validación tuvo errores.
     * @return boolean band verdadero si la validación no tuvo errores.	 
	 */ 
	function validateForm(event){
		var band = true;
		
		//Validamos cada elemento con la clase isRequired (se aplica sólo en Items tipo texto)
		jQuery.each($('.isRequired'),function(){
			//Verificamos su valor
			if ($(this).html()=='<p><br data-mce-bogus="1"></p>' || $(this).html()=='')
			{
				var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>El texto no debe quedar vacío. De ser así, elimine el item.</font><br>";
				console.log("El texto no debe quedar vacío. De ser así, elimine el item.");
				var parent = $(this).parents().get(0);
				$(parent).children("div:last").html(ERROR_MESSAGE);
				band = false;		
			}
			else
			{
				var parent = $(this).parents().get(0);
				$(parent).children("#errorText").html("");
			}
		});
		
		//Validamos que se haya escrito el título del reporte
		if($('#Report_title').val()=='')
		{
			var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>Debe escribir el título del reporte.</font><br>";
			console.log("Debe escribir el título del reporte.");
			$('#errorTitle').html(ERROR_MESSAGE);	
			$('#Report_title').focus();
			band = false;
		}
		else
		{
			$('#errorTitle').html("");	
		}
		
		//Validamos cada elemento con la clase selectRequired (se aplica sólo en el select de table_id)
		jQuery.each($('.selectRequired'),function(){
			//Verificamos su valor
			if ($(this).val()=='')
			{
				var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>Debe seleccionar una tabla o elimine el item.</font><br>";
				console.log("Debe seleccionar una tabla o elimine el item.>>"+$(this).val()+"<<");
				var parent = $(this).parents().get(0);
				$(parent).children("#errorTable").html(ERROR_MESSAGE);
				$(this).focus();
				band = false;		
			}
			else
			{
				var parent = $(this).parents().get(0);
				$(parent).children("#errorTable").html("");
			}
		});
		
		return band;
	}
	
		//Para los botones de Publicar/Guardar Borrador/Vista Previa
	
	//Si es nuevo reporte.
	$("#saveReport, #saveReport1").on("click", function(event){
		$('#Report_status').attr("value","1");
		$('#report-form').attr("action", "/index.php?r=report/create");
		$('#report-form').attr("target","_self");
	});
	
	$("#publishReport, #publishReport1").on("click", function(event){
		$('#Report_status').attr("value","2");
		$('#report-form').attr("action", "/index.php?r=report/create");
		$('#report-form').attr("target","_self");
	});
	
	
	//Si el reporte será actualizado.
	$(document).on("click", "#saveReportUpdate, #saveReportUpdate1", function(event){
		$('#Report_status').attr("value","1");
		var reportId=$('#Report_id').val();
		$('#report-form').attr("action", "/index.php?r=report/update&id="+reportId);
		$('#report-form').attr("target","_self");
		$('#report-form').submit();
	});	
	
	$(document).on("click", "#publishReportUpdate, #publishReportUpdate1", function(event){
		$('#Report_status').attr("value","2");
		var reportId=$('#Report_id').val();
		$('#report-form').attr("action", "/index.php?r=report/update&id="+reportId);
		$('#report-form').attr("target","_self");
		$('#report-form').submit();
	});
	
	//Vista previa
	$(document).on('click','#previewReport, #previewReport1', function(){
		var reportClone = $("#report-form").clone(true);
		$(reportClone).attr("id","newReportForm");
		$(reportClone).attr("action","/index.php?r=report/preview");
		$(reportClone).attr("target","_blank");
		$(reportClone).css("display","none");

		var parent = $('#report-form').parents().get(0);
		$(parent).after(reportClone);
		
		$("#newReportForm").find("div.text, div.content").each(function(){
			var nameHidden = $(this).attr("id");
			$('input[type=hidden][name='+nameHidden+']').val($(this).html());
		});
		$("#newReportForm").submit();
		$("#newReportForm").remove();
		
	});
	
});	
	/*
	 * Función que asigna el editor de texto a items, tablas y celdas.
	 * @param int cellInit indica el contador de la celda de inicio
	 * @param int cellFin  indica el contador de la celda final
	 */
	function addEditorT(selector){
		tinymce.init({
			selector: '#'+selector,
			inline: true,
			plugins: [
				'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
				'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
				'table directionality emoticons template textcolor paste textcolor'
			],
			toolbar1: 'undo redo | styleselect formatselect fontselect fontsizeselect | preview code',
			toolbar2: 'forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | link unlink',
			toolbar3: 'bullist numlist | table | hr removeformat | subscript superscript charmap',

			menubar: false,
			toolbar_items_size: 'small',
			language: 'es'
		});
		//Asignación del evento autocomplete si la celda lo requiere.
		if(/autoComplete/.test($("#"+selector).attr("class")))
		{
			//console.log("Asignado el evento autocomplete a: "+selector);
			$("#"+selector).on("click",AddAutoComplete);
		}
	}
	
	/*
	 * Función que asigna el el evento autocomplete a la celda específica.
	 */
	function AddAutoComplete()
	{
		var par = $(this).parent();
		var col=$(par).children('.column').val();
		$(this).autocomplete({
			source: function(request, response) {
				$.ajax({
					type: 'GET',
					url: '/index.php?r=report/autocompleteCell',
					data: {
						columnID: col, 
						term: request.term
					},
					dataType:"json",
					success: function(data) {
						response(data);
					},
				})
			},
			minLength: 1, 
		});	
	}
	
	function addColorPicker(colorCounter, input, colorInit)
	{
		$('#wColorPicker'+colorCounter).wColorPicker({
				initColor: colorInit,
				effect: 'slide', 
				theme: 'red',
				mode: 'click',
				onSelect: function(color){
					$('#'+input).css('color', color).val(color);
				},
				onMouseover: function(color){
					$('#'+input).css('color', color).val(color);
				},
				onMouseout: function(color){
					$('#'+input).css('color', color).val(color);
				}
			});
	}
	
	
	function showHide(element, button) {
		$("#"+element).toggle();
		if ($("#"+element).css("display")==="block"){
			$("#"+button).css('background','#ffffff url(../images/hide.png) no-repeat');
		}
		else{
			$("#"+button).css('background','#ffffff url(../images/show.png) no-repeat');
		}
	}
jQuery(document).ready(function() {
	var itemCounter	= (jQuery('tr.item').length);
	var rowCounter 	= (jQuery('tr.row').length);
	var cellCounter = (jQuery('div.content').length);
	var textCounter = (jQuery('div.text').length);
	
	jQuery('#countItems').html('Total de items: '+itemCounter);
	jQuery('#countRows').html('Total de filas: '+rowCounter);
	jQuery('#countCells').html('Total de celdas: '+cellCounter);
	jQuery('#countTexts').html('Total de textos: '+textCounter);
	
	//Se asigna al evento onClick de cada elemento con la clase .addTextButton la función addText
	jQuery(".addTextButton").each(function (){
		jQuery(this).on("click",addText);
	});
	
	//Se asigna a cada elemento con la clase .addTableButton la función addTable
	jQuery(".addTableButton").each(function (){
		jQuery(this).on("click",addTable);
	});
	
	//Se asigna a cada elemento con id #deleteItem la función deleteItem
	jQuery(document).on('click','#deleteItem',deleteItem);
	
	//Se asigna a cada elemento con id #addTableRow la función addTableRow
	jQuery(document).on('click','#addTableRow',addTableRow);
	
	//Se asigna a cada elemento con id #delTableRow la función addTableRow
	jQuery(document).on('click','#delTableRow',delTableRow);
	
	//Se asigna al formulario #report-form la función validateForm
	jQuery("#report-form").each(function (){
		jQuery(this).on("submit",validateForm);
	});
	
	//Se asigna la funcion AddAutoComplete a los elementos con clase .autoComplete
	jQuery(".autoComplete").each(function (){
		jQuery(this).on("click",AddAutoComplete);
	});

	/* Función addText
	 * Permite agregar el formulario para items tipo texto.
	 */
	function addText(){
	
		//Se clona el elemento con id itemText y su contenido.
		jQuerynewItem = jQuery('#itemText').clone(true);
		
		//Se aumenta el contador de items y el contador de áreas de texto 
		itemCounter++;
		textCounter++;
		
		//Se cambian los atributos id, class y la propiedad css display al elemento clonado.
		jQuerynewItem.attr("id", "itemText_"+itemCounter);
		jQuerynewItem.attr("class", "item");
		jQuerynewItem.css("display","table-row");
		
		//Se obtiene el primer elemento hijo del elemento clonado
		var child = jQuerynewItem.children().eq(0);
		
		//Se cambia el id y nombre del campo ReportItem->type
		jQuery(child).children("input").eq(0).attr("id","ReportItem_"+itemCounter+"_type");
		jQuery(child).children("input").eq(0).attr("name","ReportItem["+itemCounter+"][type]");
		
		//Se cambia el id y nombre del campo ReportItem->id
		jQuery(child).children("input").eq(1).attr("id","ReportItem_"+itemCounter+"_id");
		jQuery(child).children("input").eq(1).attr("name","ReportItem["+itemCounter+"][id]");
		
		//Se cambia el id y nombre del campo ReportText->id
		jQuery(child).children("input").eq(2).attr("id","ReportText_"+textCounter+"_id");
		jQuery(child).children("input").eq(2).attr("name","ReportText["+textCounter+"][id]");
		
		//Se cambia el id y nombre del campo ReportText->item_id
		jQuery(child).children("input").eq(3).attr("id","ReportText_"+textCounter+"_item_id");
		jQuery(child).children("input").eq(3).attr("name","ReportText["+textCounter+"][item_id]");
		
		//Se cambia nombre, id y clase al campo ReportText->text.
		var id = "ReportText_"+textCounter+"_text";
		jQuery(child).children("div").eq(1).attr("id","ReportText_"+textCounter+"_text").html('');
		jQuery(child).children("div").eq(1).attr("class","isRequired text");
		
		/*
		 * Se obtiene el padre (a nivel 2) del botón que activó el evento (en este caso, la fila tr) 
		 * para insertar el elemento clonado debajo este.
		 */
		var parent = jQuery(this).parents().get(1);
		jQuery(parent).after(jQuerynewItem);
		
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
		jQuery('#countItems').html('Total de items:'+(jQuery('tr.item').length));
		jQuery('#countTexts').html('Total de textos:'+(jQuery('div.text').length));
	}
	
	/* Función addTable
	 * Permite agregar el formulario para items tipo table.
	 */
	function addTable(){
		
		//Se clona el elemento con id itemTable y su contenido.
		var newItem = jQuery('#itemTable').clone(true);
		//Se aumenta el contador de items
		itemCounter++;

		//Se cambia el id, class y la propiedad css display del elemento clonado.
		jQuery(newItem).attr("id", "itemTable_"+itemCounter);
		jQuery(newItem).attr("class", "item");
		jQuery(newItem).css("display","table-row");
		
		//Se obtiene el primer elemento hijo del elemento clonado.
		var child = jQuery(newItem).children().eq(0);
		
		//Se cambia el nombre y el id del atributo ReportItem->type
		jQuery(child).children("input").eq(0).attr("id","ReportItem_"+itemCounter+"_type");
		jQuery(child).children("input").eq(0).attr("name","ReportItem["+itemCounter+"][type]");
		
		//Se cambia el nombre y el id del atributo ReportItem->id
		jQuery(child).children("input").eq(1).attr("id","ReportItem_"+itemCounter+"_id");
		jQuery(child).children("input").eq(1).attr("name","ReportItem["+itemCounter+"][id]");
		
		//Se cambia el nombre y el id del atributo ReportTable->id
		jQuery(child).children("input").eq(2).attr("id","ReportTable_"+itemCounter+"_id");
		jQuery(child).children("input").eq(2).attr("name","ReportTable["+itemCounter+"][id]");
		
		//Se cambia el nombre y el id del atributo ReportTable->item_id
		jQuery(child).children("input").eq(3).attr("id","ReportTable_"+itemCounter+"_item_id");
		jQuery(child).children("input").eq(3).attr("name","ReportTable["+itemCounter+"][item_id]");
		
		//Se cambia el nombre y el id del atributo ReportTable->status
		jQuery(child).children("input").eq(4).attr("id","ReportTable_"+itemCounter+"_status");
		jQuery(child).children("input").eq(4).attr("name","ReportTable["+itemCounter+"][status]");
		
		//Se cambia el id y nombre del Select que muestra las tablas creadas.
		jQuery(child).children("select").eq(0).attr("id","ReportTable_"+itemCounter+"_table_id").val('');
		jQuery(child).children("select").eq(0).attr("name","ReportTable["+itemCounter+"][table_id]");
		jQuery(child).children("select").eq(0).attr("class","selectRequired");
		
		//Se cambia el id y nombre del campo rowCounter
		jQuery(child).children(".rowCount").attr("id","ReportTable_"+itemCounter+"_rowCounter");
		jQuery(child).children(".rowCount").attr("name","ReportTable["+itemCounter+"][rowCounter]");
		
		//Se cambia el id del div con id #layoutTable
		jQuery(child).children("#layoutTable").eq(0).attr("id","layoutTable"+itemCounter);
		
		/*
		 * Se obtiene el padre (a nivel 2) del botón que activó el evento (en este caso, la fila tr) 
		 * para insertar el elemento clonado debajo este.
		 */
		var parent = jQuery(this).parents().get(1);
		jQuery(parent).after(jQuery(newItem));
		
		//Se cambia el mensaje del total de items
		jQuery('#countItems').html('Total de items: '+(jQuery('tr.item').length));
		
		/* Variables que obtienen el total de items de texto y celdas antes de que el usuario seleccione
		 * la tabla que desea agregar al reporte.
		 */

		//Función que agrega el evento onChange al select que muestra las tablas disponibles.
		jQuery('body').on('change','#ReportTable_'+itemCounter+'_table_id',
		function()
		{
			jQuery('#ReportTable_'+itemCounter+'_table_id option[value='+jQuery(this).val()+']').attr("selected",true); 
			//jQuery('#ReportTable_'+itemCounter+'_table_id').attr("disabled","disabled"); 
			jQuery("#layoutTable"+itemCounter).children("#load").css("display","inline"); 
			console.log("Valores antes de enviar la consulta: \nCellCounter: "+cellCounter+" Textcounter: "+textCounter+" rowCounter: "+rowCounter)
			jQuery.ajax(
					{
					'type': 'POST',
					'url': 	'/index.php/table/listTableLayout',
					'data':	{
								'id':this.value,
								'cellCounter':cellCounter,
								'textCounter':textCounter,
								'rowCounter':rowCounter
							},
					'dataType': 'json',
					'cache':false,
					'success':	
						function(html)
						{
							//El esquema de la tabla seleccionada se inserta en el layoutTable específico.
							jQuery("#layoutTable"+itemCounter).html(html['layout']);
							
							//Se aumenta el contador de filas.
							rowCounter++;
							var numInsertedCells = html['cellCounter'];
							cellCounter += numInsertedCells;
							
							//Se cambia el mensaje del total de celdas y total de filas.
							jQuery('#countCells').html('Total de celdas: '+(jQuery('div.content').length));
							jQuery('#countRows').html('Total filas: '+(jQuery('tr.row').length));
							
							//También se obtiene el total de textos de tabla y se modifica su contador.
							var insertedTexts = html['textCounter'];
							textCounter += insertedTexts; 
							
							//Se cambia el mensaje de total de textos.
							jQuery('#countTexts').html('Total de textos: '+(jQuery('div.text').length));
							
							//Se cambia el valor de rowCount de la tabla creada.
							var parent = jQuery('#ReportTable_'+itemCounter+'_table_id').parents().get(0);
							var r=jQuery(parent).children(".rowCount").val(1);	
							jQuery(parent).children("#errorTable").html("");
							
							var rangeInit = cellCounter-numInsertedCells;
							var rangeEnd = cellCounter;
							//Se asigna el evento autoComplete a la celda que contenga la clase autoComplete.
							for(rangeInit; rangeInit<=rangeEnd; rangeInit++)
							{
								if(/autoComplete/.test(jQuery("#ReportTableCell_"+rangeInit+"_content").attr("class")))
								{
									jQuery("#ReportTableCell_"+rangeInit+"_content").on("click",AddAutoComplete);
								}
							}	
						}		
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
			jQuery('input[type=hidden][name=ReportTableCell_'+cellInit+'_content]').attr('class','content');
			
			//Asignación del evento autocomplete si la celda lo requiere.
			if(/autoComplete/.test(jQuery("#ReportTableCell_"+cellInit+"_content").attr("class")))
			{
				jQuery("#ReportTableCell_"+cellInit+"_content").on("click",AddAutoComplete);
			}
		}
	}
	
	/*
	 * Función que asigna a cada elemento con id deleteItem
	 * el evento que permite eliminar el item del reporte
	 */
	function deleteItem(){
		//Se obtiene el padre  (a nivel 3) del botón seleccionado y se elimina
		var parent = jQuery(this).parents().get(2);
		jQuery(parent).remove();
		
		//Se cambian los mensajes
		jQuery('#countItems').html('Total de items: '+(jQuery('tr.item').length));
		jQuery('#countRows').html('Total de filas: '+(jQuery('tr.row').length));
		jQuery('#countCells').html('Total de celdas: '+(jQuery('div.content').length));
		jQuery('#countTexts').html('Total de textos:'+(jQuery('div.text').length));
	}
	
	/*
	 * Función que asigna a cada elemento con id addTableRow
	 * el evento que permite insertar una fila en un item tipo Tabla
	 */
	function addTableRow(){
		//Se identifica al padre que contiene al elemento addTableRow (en este caso, <tr>
		var parent = jQuery(this).parents().get(1);
		
		//Se clona el elemento padre con todos los atributos que contiene.
		var newItem = jQuery(parent).clone(true);
		
		//Se aumenta el contador de filas.
		rowCounter++;
		//Se aumenta el campo rowCount de la tabla.
		var sixParent = jQuery(this).parents().get(5);
		var r=jQuery(sixParent).children(".rowCount").val();
		r++;
		var r=jQuery(sixParent).children(".rowCount").val(r);
		
		var cellInit=cellCounter;
	
		//Por cada elemento th con id 'cells', cambiamos el id y nombre
		jQuery(newItem).children('#cells').each(function(){
			//Se aumenta el valor de cellCounter.
			cellCounter++;
			//Se asignan los nuevos atributos de cada campo
			var oldDiv = jQuery(this).children("div").eq(0);
			if(/autoComplete/.test(jQuery(oldDiv).attr("class")))
				var newDiv="<div id='ReportTableCell_"+cellCounter+"_content' class='content autoComplete'></div>";
			else
				var newDiv="<div id='ReportTableCell_"+cellCounter+"_content' class='content'></div>";
			jQuery(this).children("div").eq(0).remove();
			jQuery(this).children("span").remove();
			jQuery(this).prepend(newDiv);
			jQuery(this).children("input[type=hidden]").eq(1).attr("id","ReportTableCell_"+cellCounter+"_column_id");
			jQuery(this).children("input[type=hidden]").eq(1).attr("name","ReportTableCell["+cellCounter+"][column_id]");
			jQuery(this).children("input[type=hidden]").eq(2).attr("id","ReportTableCell_"+cellCounter+"_row_id").val('0');
			jQuery(this).children("input[type=hidden]").eq(2).attr("name","ReportTableCell["+cellCounter+"][row_id]");
			jQuery(this).children("input[type=hidden]").eq(0).remove();
		});
		
		//Se obtiene la columna que corresponde a los controles de la fila
		var a = jQuery(newItem).children("#cellControls");
		
		//Se elimina el primer div para eliminar todo lo clonado de wColorPicker
		jQuery(a).children("div").eq(0).remove();

		//Se crea un nuevo div que contendrá wColorPicker
		jQuery(a).prepend(document.createElement('div')) ;
		jQuery(a).children("div").eq(0).attr('id','nuevoDiv'+rowCounter);
		var nvoId="nuevoDiv"+rowCounter;
		
		//Se asignan nuevos id y nombre al campo de color
		var color=jQuery(a).children("input[type=text]").eq(0).val();
		jQuery(a).children("input[type=text]").eq(0).attr("id","ReportTableRow_"+rowCounter+"_color");
		jQuery(a).children("input[type=text]").eq(0).attr("name","ReportTableRow["+rowCounter+"][color]");
		
		jQuery(a).children("input[type=hidden]").eq(0).attr("id","ReportTableRow_"+rowCounter+"_id").val('0');
		jQuery(a).children("input[type=hidden]").eq(0).attr("name","ReportTableRow["+rowCounter+"][id]");
		
		//El item clonado se inserta después de la fila que invocó el evento.
		jQuery(parent).after(jQuery(newItem));
		
		//Se agrega el editor tinymce a cada celda clonada
		var cellFin = cellCounter;
		addTextEditor(cellInit+1, cellFin);
								
		//Se actualizan los mensajes de filas y celdas.
		jQuery('#countRows').html('Total de filas: '+(jQuery('tr.row').length));
		jQuery('#countCells').html('Total areas: '+(jQuery('div.content').length));
		
		//Se asigna el evento wColorPicker a la nueva fila.
		var nvoIDC='ReportTableRow_'+rowCounter+'_color';
		jQuery('#'+nvoId).wColorPicker({
			initColor: color,
			mode: 'click',
			effect: 'slide', 
			theme: 'red',
			onSelect: function(color){
				jQuery('#'+nvoIDC).css('color', color).val(color);
			},
			onMouseover: function(color){
				jQuery('#'+nvoIDC).css('color', color).val(color);
			},
			onMouseout: function(color){
				jQuery('#'+nvoIDC).css('color', color).val(color);
			}
		});				
	}
	
	/*
	 * Función que asigna a cada elemento con id delTableRow
	 * el evento que permite eliminar una fila específica.
	 */
	function delTableRow(){
	
		//Se obtiene el total de filas que tiene la tabla, si es la última, envía un mensaje de confirmación
		var parent2 = jQuery(this).parents().get(5);
		var r=jQuery(parent2).children(".rowCount").val();
		if(r==1)
		{
			if (confirm('¿Está seguro de eliminar la última fila?\nSe eliminará toda la tabla. '))
			{ 
				jQuery(parent2).remove();
				
				//Se cambian los mensajes
				jQuery('#countItems').html('Total de items: '+(jQuery('tr.item').length));
				jQuery('#countRows').html('Total de filas: '+(jQuery('tr.row').length));
				jQuery('#countCells').html('Total de celdas: '+(jQuery('div.content').length));
				jQuery('#countTexts').html('Total de textos:'+(jQuery('div.text').length));
			}
		}
		else
		{
			r--;
			var r=jQuery(parent2).children(".rowCount").val(r);
			
			var parent = jQuery(this).parents().get(1);
			jQuery(parent).remove();
			
			jQuery('#countRows').html('Total de filas: '+(jQuery('tr.row').length));
			jQuery('#countCells').html('Total de celdas: '+(jQuery('div.content').length));	
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
		jQuery.each(jQuery('.isRequired'),function(){
			//Verificamos su valor
			if (jQuery(this).html()=='<p><br data-mce-bogus="1"></p>' || jQuery(this).html()=='')
			{
				var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>El texto no debe quedar vacío. De ser así, elimine el item.</font><br>";
				console.log("El texto no debe quedar vacío. De ser así, elimine el item.");
				var parent = jQuery(this).parents().get(0);
				jQuery(parent).children("div:last").html(ERROR_MESSAGE);
				band = false;		
			}
			else
			{
				var parent = jQuery(this).parents().get(0);
				jQuery(parent).children("#errorText").html("");
			}
		});
		
		//Validamos que se haya escrito el título del reporte
		if(jQuery('#Report_title').val()=='')
		{
			var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>Debe escribir el título del reporte.</font><br>";
			console.log("Debe escribir el título del reporte.");
			jQuery('#errorTitle').html(ERROR_MESSAGE);	
			jQuery('#Report_title').focus();
			band = false;
		}
		else
		{
			jQuery('#errorTitle').html("");	
		}
		
		//Validamos cada elemento con la clase selectRequired (se aplica sólo en el select de table_id)
		jQuery.each(jQuery('.selectRequired'),function(){
			//Verificamos su valor
			if (jQuery(this).val()=='')
			{
				var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>Debe seleccionar una tabla o elimine el item.</font><br>";
				console.log("Debe seleccionar una tabla o elimine el item.>>"+jQuery(this).val()+"<<");
				var parent = jQuery(this).parents().get(0);
				jQuery(parent).children("#errorTable").html(ERROR_MESSAGE);
				jQuery(this).focus();
				band = false;		
			}
			else
			{
				var parent = jQuery(this).parents().get(0);
				jQuery(parent).children("#errorTable").html("");
			}
		});
		
		return band;
	}
	
		//Para los botones de Publicar/Guardar Borrador/Vista Previa
	
	//Si es nuevo reporte.
	jQuery("#saveReport, #saveReport1").on("click", function(event){
		jQuery('#Report_status').attr("value","1");
		jQuery('#report-form').attr("action", "/index.php/report/create");
		jQuery('#report-form').attr("target","_self");
	});
	
	jQuery("#publishReport, #publishReport1").on("click", function(event){
		jQuery('#Report_status').attr("value","2");
		jQuery('#report-form').attr("action", "/index.php/report/create");
		jQuery('#report-form').attr("target","_self");
	});
	
	
	//Si el reporte será actualizado.
	jQuery(document).on("click", "#saveReportUpdate, #saveReportUpdate1", function(event){
		jQuery('#Report_status').attr("value","1");
		var reportId=jQuery('#Report_id').val();
		jQuery('#report-form').attr("action", "/index.php/report/update/"+reportId);
		jQuery('#report-form').attr("target","_self");
		jQuery('#report-form').submit();
	});	
	
	jQuery(document).on("click", "#publishReportUpdate, #publishReportUpdate1", function(event){
		jQuery('#Report_status').attr("value","2");
		var reportId=jQuery('#Report_id').val();
		jQuery('#report-form').attr("action", "/index.php/report/update/"+reportId);
		jQuery('#report-form').attr("target","_self");
		jQuery('#report-form').submit();
	});
	
	//Vista previa
	jQuery(document).on('click','#previewReport, #previewReport1', function(){
		if(navigator.appVersion.indexOf("MSIE 8.")!=-1){
			var msj="";
			jQuery("#report-form").attr("action","/index.php/report/preview");
			jQuery("#report-form").attr("target","_blank");
			jQuery("#report-form").submit();
		}
		else{
			var reportClone = jQuery("#report-form").clone(true);
			jQuery(reportClone).attr("id","newReportForm");
			jQuery(reportClone).attr("action","/index.php/report/preview");
			jQuery(reportClone).attr("target","_blank");
			jQuery(reportClone).css("display","none");

			var parent = jQuery('#report-form').parents().get(0);
			jQuery(parent).after(reportClone);
			
			jQuery("#newReportForm").find("div.text, div.content").each(function(){
				var nameHidden = jQuery(this).attr("id");
				jQuery('input[type=hidden][name='+nameHidden+']').val(jQuery(this).html());
			});
			jQuery("#newReportForm").submit();
			jQuery("#newReportForm").remove();
		}
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
		if(/autoComplete/.test(jQuery("#"+selector).attr("class")))
		{
			//console.log("Asignado el evento autocomplete a: "+selector);
			jQuery("#"+selector).on("click",AddAutoComplete);
		}
	}
	
	/*
	 * Función que asigna el el evento autocomplete a la celda específica.
	 */
	function AddAutoComplete()
	{
		var par = jQuery(this).parent();
		var col=jQuery(par).children('.column').val();
		jQuery(this).autocomplete({
			source: function(request, response) {
				jQuery.ajax({
					type: 'GET',
					url: '/index.php/report/autocompleteCell',
					data: {
						columnID: col, 
						term: request.term
					},
					dataType:"json",
					success: function(data) {
						response(data);
					}
				})
			},
			minLength: 1
		});	
	}
	
	function addColorPicker(colorCounter, input, colorInit)
	{
		jQuery('#wColorPicker'+colorCounter).wColorPicker({
				initColor: colorInit,
				effect: 'slide', 
				theme: 'red',
				mode: 'click',
				onSelect: function(color){
					jQuery('#'+input).css('color', color).val(color);
				},
				onMouseover: function(color){
					jQuery('#'+input).css('color', color).val(color);
				},
				onMouseout: function(color){
					jQuery('#'+input).css('color', color).val(color);
				}
			});
	}
	
	
	function showHide(element, button) {
		jQuery("#"+element).toggle();
		if (jQuery("#"+element).css("display")==="block"){
			jQuery("#"+button).css('background','#ffffff url(../images/hide.png) no-repeat');
		}
		else{
			jQuery("#"+button).css('background','#ffffff url(../images/show.png) no-repeat');
		}
	}
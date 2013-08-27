$(document).ready(function() {
	var itemCounter = ($('tr.item').length);
	var rowCounter = ($('tr.row').length);
	var cellCounter = ($('textarea.content').length);
	var textCounter = ($('textarea.text').length);
	
	var strMensaje='Total de items: '+itemCounter;
		$('#countItems').html(strMensaje);
	
	var strMensaje='Total de filas: '+rowCounter;
		$('#countRows').html(strMensaje);
	
	var strMensaje='Total áreas de texto: '+cellCounter;
		$('#countCells').html(strMensaje);
	
	var strMensaje='Total textos: '+textCounter;
		$('#countTexts').html(strMensaje);
			
	$(".btnAgregarTexto").each(function (){
		$(this).bind("click",addText);
	});
	$(".btnAgregarTabla").each(function (){
		$(this).bind("click",addTable);
	});
	
/*function addText
	Permite agregar items tipo texto al reporte.
	*/
	function addText(){
		//Clonamos el elemento con id itemText con sus hijos.
		$newItem = $('#itemText').clone(true);
		//Aumantamos el valor del contador de Items
		itemCounter++;
		//Aumentamos el valor del contador de áreas de texto.
		textCounter++;
		
		//Cambiamos id, clase y atributo display al elemento clonado.
		$newItem.attr("id", "itemText_"+itemCounter);
		$newItem.attr("class", "item");
		$newItem.css("display","table-row");
		
		//Primera columna de la fila clonada.
		var a = $newItem.children().eq(0); 
		
		//Cambiar el id y nombre del atributo ReportItem->type
		$(a).children("input").eq(3).attr("id","ReportItem_"+itemCounter+"_type");
		$(a).children("input").eq(3).attr("name","ReportItem["+itemCounter+"][type]");
		
		//Cambiar el id y nombre del atributo ReportItem->id
		$(a).children("input").eq(4).attr("id","ReportItem_"+itemCounter+"_id");
		$(a).children("input").eq(4).attr("name","ReportItem["+itemCounter+"][id]");
		
		
		//Segunda columna de la fila clonada.
		var b = $newItem.children().eq(1);

		//Cambiar nombre, id y clase al atributo text de ReportText.
		$(b).children("textarea").eq(0).attr("id","ReportText_"+textCounter+"_text").val('');
		$(b).children("textarea").eq(0).attr("name","ReportText["+textCounter+"][text]");
		$(b).children("textarea").eq(0).attr("class","text isRequired");
		
		//Cambiar el id y nombre del atributo ReportText->id
		$(b).children("input").eq(0).attr("id","ReportText_"+textCounter+"_id");
		$(b).children("input").eq(0).attr("name","ReportText["+textCounter+"][id]");
		
		//Cambiar el id y nombre del atributo ReportText->item_id
		$(b).children("input").eq(1).attr("id","ReportText_"+textCounter+"_item_id");
		$(b).children("input").eq(1).attr("name","ReportText["+textCounter+"][item_id]");
		
		//Obtener el padre del botón (La fila) agregar e insertar la nueva fila debajo este.
		var parent = $(this).parents().get(1);
		$(parent).after($newItem);
		
		$('#ReportText_'+textCounter+'_text').jqte({
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
	
		//Cambiar mensajes.
		var strMensaje='Total de items:'+($('tr.item').length);
		$('#countItems').html(strMensaje);
		
		var strMensaje='Total de textos:'+($('textarea.text').length);
		$('#countTexts').html(strMensaje);
	}
	
	function addTable(){
		//Clonamos el elemtnso con id itemTable y sus hijos.
		$newItem = $('#itemTable').clone(true);
		//Aumentamos el contador de items
		itemCounter++;
		var newItemCounter=itemCounter;
		//Cambiamor id, class y atributo display del elemento clonado.
		$newItem.attr("id", "itemTable_"+itemCounter);
		$newItem.attr("class", "item");
		$newItem.css("display","table-row");
		
		//Primera columna de la fila
		var a = $newItem.children().eq(0);
		
		//Cambiamos el nombre y el id del atributo ReportItem->type
		$(a).children("input").eq(3).attr("id","ReportItem_"+itemCounter+"_type");
		$(a).children("input").eq(3).attr("name","ReportItem["+itemCounter+"][type]");
		
		//Cambiamos el nombre y el id del atributo ReportItem->id
		$(a).children("input").eq(4).attr("id","ReportItem_"+itemCounter+"_id");
		$(a).children("input").eq(4).attr("name","ReportItem["+itemCounter+"][id]");
		
		//Segunda columna de la fila.
		var b = $newItem.children().eq(1);
		
		//Cambiamos el id y nombre del Select que muestra las tablas creadas.
		$(b).children("select").eq(0).attr("id","ReportTable_"+itemCounter+"_table_id").val('');
		$(b).children("select").eq(0).attr("name","ReportTable["+itemCounter+"][table_id]");
		$(b).children("select").eq(0).attr("class","selectRequired");
		
		//Cambiamos el id del div con id #layoutTable
		$(b).children("#layoutTable").eq(0).attr("id","layoutTable"+itemCounter);
		
		//Cambiamos el nombre y el id del atributo ReportTable->id
		$(b).children("input").eq(0).attr("id","ReportTable_"+itemCounter+"_id");
		$(b).children("input").eq(0).attr("name","ReportTable["+itemCounter+"][id]");
		
		//Cambiamos el nombre y el id del atributo ReportTable->item_id
		$(b).children("input").eq(1).attr("id","ReportTable_"+itemCounter+"_item_id");
		$(b).children("input").eq(1).attr("name","ReportTable["+itemCounter+"][item_id]");
		
		//Cambiamos el nombre y el id del atributo ReportTable->status
		$(b).children("input").eq(2).attr("id","ReportTable_"+itemCounter+"_status");
		$(b).children("input").eq(2).attr("name","ReportTable["+itemCounter+"][status]");
		
		//Cambiamos el nombre del campo rowCounter
		$(b).children(".rowCount").attr("id","ReportTable_"+itemCounter+"_rowCounter");
		$(b).children(".rowCount").attr("name","ReportTable["+itemCounter+"][rowCounter]");
		
		
		var parent = $(this).parents().get(1);
		$(parent).after($newItem);

		var strMensaje='Total de items: '+($('tr.item').length);
		$('#countItems').html(strMensaje);
		
		var cellsExist=($('textarea.content').length);
		var textsExist=($('textarea.text').length);
		
		jQuery(function($) {
			jQuery('body').on('change','#ReportTable_'+newItemCounter+'_table_id',function(){
				jQuery.ajax({'type':'POST',
							'url':'/index.php?r=table/listTableLayout',
							'data':{'id':this.value,'cellCounter':cellCounter,'textCounter':textCounter,'rowCounter':rowCounter},
							'cache':false,
							'success':function(html){
								jQuery("#layoutTable"+newItemCounter).html(html);
								rowCounter++;
								var cellTotal = ($('textarea.content').length);
								var insertedCells = cellTotal - cellsExist;
								cellCounter += insertedCells;
								
								var strMensaje='Total de áreas de texto: '+($('textarea.content').length);
								$('#countCells').html(strMensaje);
								
								var strMensaje='Total filas: '+($('tr.row').length);
								$('#countRows').html(strMensaje);
								
								var textTotal = ($('textarea.text').length);
								var insertedTexts = textTotal - textsExist;
								textCounter += insertedTexts; 
								
								var strMensaje='Total de textos: '+($('textarea.text').length);
								$('#countTexts').html(strMensaje);
								
								var parent2 = $('#ReportTable_'+itemCounter+'_table_id').parents().get(0);
								var r=$(parent2).children(".rowCount").val(1);	
								$(parent2).children("#errorTable").html("");		
							}		
				});
				return false;
			});
		
		});
	}
	
	$(document).on('click','.btnEliminarItem',function(){
		var parent = $(this).parents().get(1);
		$(parent).remove();

		var strMensaje='Total items: '+($('tr.item').length);
		$('#countItems').html(strMensaje);
		var strMensaje='Total filas: '+($('tr.row').length);
		$('#countRows').html(strMensaje);
		var strMensaje='Total areas: '+($('textarea.content').length);
		$('#countCells').html(strMensaje);
		var strMensaje='Total de textos:'+($('textarea.text').length);
		$('#countTexts').html(strMensaje);
	});
	
	
	$(document).on('click','#addTableRow',function(){
		var parent2 = $(this).parents().get(5);
		var r=$(parent2).children(".rowCount").val();
		r++;
		var r=$(parent2).children(".rowCount").val(r);
		
		
		//Se identifica al padre que contiene al elemento addTableRow (en este caso, <tr>
		var parent = $(this).parents().get(1);
		
		//Se clona el elemento padre con todos los atributos que contiene.
		$newItem = $(parent).clone(true);
		
		//Se obtiene la columna que corresponde a los controles de la fila
		var a = $newItem.children("#cellControls");
		
		//Se elimina el primer div para eliminar todo lo clonado de wColorPicker
		$(a).children("div").eq(0).remove();
		
		//Se aumenta el contador de filas.
		rowCounter++;
		var cellInit=cellCounter;
		//Por cada elemento hijo llamado 'th', cambiamos el id y nombre
		$newItem.children('#cells').each(function(){
			//Se aumenta el valor de cellCounter.
			cellCounter++;
			var textArea = $('<textarea id="ReportTableCell_'+cellCounter+'_content" name="ReportTableCell['+cellCounter+'][content]" style="width:100%;"/>'); 
			//Se asignan los nuevos atributos de cada campo
			$(this).children("div").eq(0).remove();
			$(this).append(textArea);
			$(this).children("input[type=hidden]").eq(0).attr("id","ReportTableCell_"+cellCounter+"_column_id");
			$(this).children("input[type=hidden]").eq(0).attr("name","ReportTableCell["+cellCounter+"][column_id]");
			$(this).children("input[type=hidden]").eq(1).attr("id","ReportTableCell_"+cellCounter+"_row_id").val('0');
			$(this).children("input[type=hidden]").eq(1).attr("name","ReportTableCell["+cellCounter+"][row_id]");
		});
		
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
		
		//El item clonado se inserta después de la fila clonada.
		$(parent).after($newItem);
		var cellFin = cellCounter;
		addTextEditor(cellInit+1, cellFin+1);
		
		//Se actualizan los valores de filas y celdas.
		var strMensaje='Total filas: '+($('tr.row').length);
		$('#countRows').html(strMensaje);
		
		var strMensaje='Total areas: '+($('textarea.content').length);
		$('#countCells').html(strMensaje);
		
		var nvoIDC='ReportTableRow_'+rowCounter+'_color';
		
		//Se asigna el evento wColorPicker a la nueva fila.
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
	});
	
	$(document).on('click','#delTableRow',function(){
	
		var parent2 = $(this).parents().get(5);
		var r=$(parent2).children(".rowCount").val();
		
		if(r==1)
		{
			if (confirm('¿Está seguro de eliminar la última fila?')) { 
				r--;
				var r=$(parent2).children(".rowCount").val(r);
				
				var parent = $(this).parents().get(1);
				$(parent).remove();
				
				var strMensaje='Total filas: '+($('tr.row').length);
				$('#countRows').html(strMensaje);
				
				var strMensaje='Total areas: '+($('textarea.content').length);
				$('#countCells').html(strMensaje);
			}
		}
		else{
		
			r--;
			var r=$(parent2).children(".rowCount").val(r);
			
			var parent = $(this).parents().get(1);
			$(parent).remove();
			
			var strMensaje='Total filas: '+($('tr.row').length);
			$('#countRows').html(strMensaje);
			
			var strMensaje='Total areas: '+($('textarea.content').length);
			$('#countCells').html(strMensaje);	
		}
	});

	//Validate report-form
	$("#report-form").on("submit", function(event){
		var band = true;
		//Validamos cada elemento con la clase isRequired (se aplica sólo en Items tipo texto)
		jQuery.each($('.isRequired'),function(){
			//Verificamos su valor
			if ($(this).val()=='')
			{
				var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>El texto no debe quedar vacío. De ser así, elimine el item.</font><br>";
				var parent = $(this).parents().get(0);
				$(parent).children("#errorText").html(ERROR_MESSAGE);
				$(this).focus();
				band = false;		
			}
			else
			{
				var parent = $(this).parents().get(0);
				$(parent).children("#errorText").html("");
			}
		});
		
		if($('#Report_title').val()=='')
		{
			var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>Debe escribir el título del reporte.</font><br>";
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
	});
	
	//Para los botones de Publicar/Guardar Borrador/Vista Previa
	
	//Si es nuevo reporte.
	$("#saveReport").on("click", function(event){
		$('#Report_status').attr("value","1");
		$('#report-form').attr("action", "/index.php?r=report/create");
		$('#report-form').attr("target","_self");
	});
	
	$("#publishReport").on("click", function(event){
		$('#Report_status').attr("value","2");
		$('#report-form').attr("action", "/index.php?r=report/create");
		$('#report-form').attr("target","_self");
	});
	
	//Si el reporte será actualizado.
	$("#saveReportUpdate").on("click", function(event){
		$('#Report_status').attr("value","1");
		var reportId=$('#Report_id').val();
		$('#report-form').attr("action", "/index.php?r=report/update&id="+reportId);
		$('#report-form').attr("target","_self");
	});	
	
	$("#publishReportUpdate").on("click", function(event){
		$('#Report_status').attr("value","2");
		var reportId=$('#Report_id').val();
		$('#report-form').attr("action", "/index.php?r=report/update&id="+reportId);
		$('#report-form').attr("target","_self");
	});	

	//Vista previa
	$("#previewReport").on("click", function(event){
		$('#report-form').attr("action", "/index.php?r=report/preview");
		$('#report-form').attr("target","_blank");
	});
	
	function addTextEditor(cellInit, cellFin){
		for(cellInit; cellInit<=cellFin; cellInit++)
		{
			$('#ReportTableCell_'+cellInit+'_content').jqte({
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
		}
	}
});

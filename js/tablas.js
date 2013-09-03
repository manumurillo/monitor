jQuery(document).ready(function() {
	var counter = ($('#tblTabla thead tr th').length);
	jQuery(".btnAgregarColumna").each(function (){
		jQuery(this).bind("click",addColumn);
	});
	
/*function addColumn
	Permite agregar campos dinámicos para agregar columnas a la tabla.
	*/
	function addColumn(){
		
		//Identificamos la tabla con el id 'tblTabla'
		var objTabla = jQuery('#tblTabla');
		
		//Obtenemos el total de columnas existentes y le sumamos 1.
		iTotalColumnasExistentes=(jQuery('#tblTabla thead tr th').length);
		iTotalColumnasExistentes++;
		
		//En la cabecera de la tabla agregamos una columna con un link que permitirá eliminar la columna.
		jQuery('<th>').html('<a href="" class="clsEliminar">Eliminar</a>').appendTo(jQuery(objTabla).find('thead tr'));
		
		//Clonamos el div y los elementos que están dentro de él. con id 'columnForm'.
		var newTd = jQuery('#columnForm').clone(true);
		
		//Aumentamos el valor del contador en 1.
		counter++;
		var newCounter=counter;
		
		//Realizamos algunas modificaciones específicas al nuevo item clonado.
		//Le asignamos un nuevo id
		jQuery(newTd).attr("id", "columnForm_"+newCounter);
		//Mostramos el div
		jQuery(newTd).css('display', 'block');		
		//Removemos el primer div que se encuentra dentro del elemento 	que se clonó.
		jQuery(newTd).children("div").eq(0).remove();
		//Al último div, le asignamos un nuevo id 
		jQuery(newTd).children("div:last").attr("id","wColorPicker"+newCounter);
		
		//Se cambia el id y nombre de los cada campo del item clonado.
		jQuery(newTd).children("input").eq(0).attr("id",'TableColumn_'+newCounter+'_title').val('');
		jQuery(newTd).children("input").eq(0).attr("class",'isRequiredTitle');
		jQuery(newTd).children("input").eq(1).attr("id",'TableColumn_'+newCounter+'_width').val('');
		jQuery(newTd).children("input").eq(1).attr("class",'isRequiredWidth');
		jQuery(newTd).children("input").eq(2).attr("id",'TableColumn_'+newCounter+'_position').val(newCounter);
		jQuery(newTd).children("select").eq(0).attr("id",'TableColumn_'+newCounter+'_autocomplete');
		jQuery(newTd).children("input").eq(3).attr("id",'TableColumn_'+newCounter+'_color');	
		jQuery(newTd).children("input").eq(4).attr("id",'TableColumn['+newCounter+'][id]');

		jQuery(newTd).children("input").eq(0).attr("name",'TableColumn['+newCounter+'][title]');
		jQuery(newTd).children("input").eq(1).attr("name",'TableColumn['+newCounter+'][width]');
		jQuery(newTd).children("input").eq(2).attr("name",'TableColumn['+newCounter+'][position]');
		jQuery(newTd).children("select").eq(0).attr("name",'TableColumn['+newCounter+'][autocomplete]');
		jQuery(newTd).children("input").eq(3).attr("name",'TableColumn['+newCounter+'][color]');
		jQuery(newTd).children("input").eq(4).attr("name",'TableColumn['+newCounter+'][id]');
		
		//Cadena del id del campo color.
		colorID='TableColumn['+newCounter+'][color]';
		
		//Insertamos el div clonado dentro del th.
		jQuery('<th>').html(newTd).appendTo(jQuery(objTabla).find('tbody tr'));
		
		//Le asignamos el evento wColorPicker al nuevo campo color.
		jQuery('#wColorPicker'+newCounter).wColorPicker({
			initColor: '#000000',
			mode: 'click',
			effect: 'slide', 
			theme: 'red',
			onSelect: function(color){
				jQuery('#TableColumn_'+newCounter+'_color').css('color', color).val(color);
			},
			onMouseover: function(color){
				jQuery('#TableColumn_'+newCounter+'_color').css('color', color).val(color);
			},
			onMouseout: function(color){
				jQuery('#TableColumn_'+newCounter+'_color').css('color', color).val(color);
			}
		});
		
		//Actualizamos el mensaje con el total de columnas existentes.
		var strMensaje='La tabla tiene '+iTotalColumnasExistentes+((iTotalColumnasExistentes==1)?' columna':' columnas');
		jQuery('#count').html(strMensaje);
	}

	//Al hacer clic en el enlace al encabezado de cada columna, se eliminará dicha columna.
	jQuery('.clsEliminar').live('click',function(e){
		e.preventDefault();
		var objTabla=jQuery('#tblTabla'),
		iColumnaAEliminar=jQuery(this).parents('th').prevAll().length,
		iTotalColumnasExistentes=jQuery('#tblTabla thead tr th').length;

		jQuery(objTabla).find('tr').each(function(){
			jQuery(this).find('td:eq('+iColumnaAEliminar+'),th:eq('+iColumnaAEliminar+')').remove();
		});
	
		iTotalColumnasExistentes--;
		
		var strMensaje='La tabla tiene '+iTotalColumnasExistentes+((iTotalColumnasExistentes==1)?' columna':' columnas');
		jQuery('#count').html(strMensaje);
	});
	
	//Validate report-form
	jQuery("#table-form").on("submit", function(event){
		var band = true;
			//Validamos cada elemento con la clase isRequired (se aplica sólo para titulo y ancho de columnas)
			jQuery.each(jQuery('.isRequiredTitle'),function(){
				//Verificamos su valor
				if (jQuery(this).val()==='')
				{
					var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>El título es necesario.</font><br>";
					var parent=jQuery(this).parent();
					jQuery(parent).children("#errorTitleColumn").html(ERROR_MESSAGE);
					jQuery(this).focus();
					band = false;		
				}
				else
				{
					var parent=jQuery(this).parent();
					jQuery(parent).children("#errorTitleColumn").html("");
				}
			});
			
			jQuery.each(jQuery('.isRequiredWidth'),function(){
				//Verificamos su valor
				if (jQuery(this).val()==='')
				{
					var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>El ancho de la columna es necesario.</font><br>";
					var parent=jQuery(this).parent();
					jQuery(parent).children("#errorWidthColumn").html(ERROR_MESSAGE);
					jQuery(this).focus();
					band = false;		
				}
				else
				{
					var parent=jQuery(this).parent();
					jQuery(parent).children("#errorWidthColumn").html("");
				}
			});
			
		
		if(jQuery('#Table_name').val()==='')
		{
			var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>Debe escribir el nombre de la tabla.</font><br>";
			jQuery('#errorNameTable').html(ERROR_MESSAGE);	
			jQuery('#Table_name').focus();
			band = false;
		}
		else
		{
			jQuery('#errorNameTable').html("");	
		}
			
		return band;
	});
});

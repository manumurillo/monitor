$(document).ready(function() {
	var counter = ($('#tblTabla thead tr th').length);
	$(".btnAgregarColumna").each(function (){
		$(this).bind("click",addColumn);
	});
	
/*function addColumn
	Permite agregar campos dinámicos para agregar columnas a la tabla.
	*/
	function addColumn(){
		
		//Identificamos la tabla con el id 'tblTabla'
		var $objTabla = $('#tblTabla');
		
		//Obtenemos el total de columnas existentes y le sumamos 1.
		iTotalColumnasExistentes=($('#tblTabla thead tr th').length);
		iTotalColumnasExistentes++;
		
		//En la cabecera de la tabla agregamos una columna con un link que permitirá eliminar la columna.
		$('<th>').html('<a href="" class="clsEliminar">Eliminar</a>').appendTo($objTabla.find('thead tr'));
		
		//Clonamos el div y los elementos que están dentro de él. con id 'columnForm'.
		$newTd = $('#columnForm').clone(true);
		
		//Aumentamos el valor del contador en 1.
		counter++;
		var newCounter=counter;
		
		//Realizamos algunas modificaciones específicas al nuevo item clonado.
		//Le asignamos un nuevo id
		$newTd.attr("id", "columnForm_"+newCounter);
		//Mostramos el div
		$newTd.css('display', 'block');		
		//Removemos el primer div que se encuentra dentro del elemento 	que se clonó.
		$newTd.children("div").eq(0).remove();
		//Al último div, le asignamos un nuevo id 
		$newTd.children("div:last").attr("id","wColorPicker"+newCounter);
		
		//Se cambia el id y nombre de los cada campo del item clonado.
		$newTd.children("input").eq(0).attr("id",'TableColumn_'+newCounter+'_title').val('');
		$newTd.children("input").eq(0).attr("class",'isRequiredTitle');
		$newTd.children("input").eq(1).attr("id",'TableColumn_'+newCounter+'_width').val('');
		$newTd.children("input").eq(1).attr("class",'isRequiredWidth');
		$newTd.children("input").eq(2).attr("id",'TableColumn_'+newCounter+'_position').val(newCounter);
		$newTd.children("select").eq(0).attr("id",'TableColumn_'+newCounter+'_autocomplete');
		$newTd.children("input").eq(3).attr("id",'TableColumn_'+newCounter+'_color');	
		$newTd.children("input").eq(4).attr("id",'TableColumn['+newCounter+'][id]');

		$newTd.children("input").eq(0).attr("name",'TableColumn['+newCounter+'][title]');
		$newTd.children("input").eq(1).attr("name",'TableColumn['+newCounter+'][width]');
		$newTd.children("input").eq(2).attr("name",'TableColumn['+newCounter+'][position]');
		$newTd.children("select").eq(0).attr("name",'TableColumn['+newCounter+'][autocomplete]');
		$newTd.children("input").eq(3).attr("name",'TableColumn['+newCounter+'][color]');
		$newTd.children("input").eq(4).attr("name",'TableColumn['+newCounter+'][id]');
		
		//Cadena del id del campo color.
		colorID='TableColumn['+newCounter+'][color]';
		
		//Insertamos el div clonado dentro del th.
		$('<th>').html(	$newTd ).appendTo($objTabla.find('tbody tr'));
		
		//Le asignamos el evento wColorPicker al nuevo campo color.
		$('#wColorPicker'+newCounter).wColorPicker({
			initColor: '#000000',
			mode: 'click',
			effect: 'slide', 
			theme: 'red',
			onSelect: function(color){
				$('#TableColumn_'+newCounter+'_color').css('color', color).val(color);
			},
			onMouseover: function(color){
				$('#TableColumn_'+newCounter+'_color').css('color', color).val(color);
			},
			onMouseout: function(color){
				$('#TableColumn_'+newCounter+'_color').css('color', color).val(color);
			}
		});
		
		//Actualizamos el mensaje con el total de columnas existentes.
		var strMensaje='La tabla tiene '+iTotalColumnasExistentes+((iTotalColumnasExistentes==1)?' columna':' columnas');
		$('#count').html(strMensaje);
	}

	//Al hacer clic en el enlace al encabezado de cada columna, se eliminará dicha columna.
	$('.clsEliminar').live('click',function(e){
		e.preventDefault();
		var $objTabla=$('#tblTabla'),
		iColumnaAEliminar=$(this).parents('th').prevAll().length,
		iTotalColumnasExistentes=$('#tblTabla thead tr th').length;

		$objTabla.find('tr').each(function(){
			$(this).find('td:eq('+iColumnaAEliminar+'),th:eq('+iColumnaAEliminar+')').remove();
		});
	
		iTotalColumnasExistentes--;
		
		var strMensaje='La tabla tiene '+iTotalColumnasExistentes+((iTotalColumnasExistentes==1)?' columna':' columnas');
		$('#count').html(strMensaje);
	});
	
	//Validate report-form
	$("#table-form").on("submit", function(event){
		var band = true;
			//Validamos cada elemento con la clase isRequired (se aplica sólo para titulo y ancho de columnas)
			jQuery.each($('.isRequiredTitle'),function(){
				//Verificamos su valor
				if ($(this).val()=='')
				{
					var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>El título es necesario.</font><br>";
					var parent=jQuery(this).parent();
					$(parent).children("#errorTitleColumn").html(ERROR_MESSAGE);
					$(this).focus();
					band = false;		
				}
				else
				{
					var parent=jQuery(this).parent();
					$(parent).children("#errorTitleColumn").html("");
				}
			});
			
			jQuery.each($('.isRequiredWidth'),function(){
				//Verificamos su valor
				if ($(this).val()=='')
				{
					var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>El ancho de la columna es necesario.</font><br>";
					var parent=jQuery(this).parent();
					$(parent).children("#errorWidthColumn").html(ERROR_MESSAGE);
					$(this).focus();
					band = false;		
				}
				else
				{
					var parent=jQuery(this).parent();
					$(parent).children("#errorWidthColumn").html("");
				}
			});
		
		if($('#Table_name').val()=='')
		{
			var ERROR_MESSAGE="<font style='color:#A60000; font-size:10px'>Debe escribir el nombre de la tabla.</font><br>";
			$('#errorNameTable').html(ERROR_MESSAGE);	
			$('#Table_name').focus();
			band = false;
		}
		else
		{
			$('#errorNameTable').html("");	
		}
			
		return band;
	});
});

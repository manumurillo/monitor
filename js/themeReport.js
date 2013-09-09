jQuery(document).ready(function() {

	//Se cambia el estilo del reporte al predeterminado.
	jQuery(document).on('click','#defaultTheme',applyDefaultTheme);
	
	//Se cambia el estilo del reporte a tonos claros.
	jQuery(document).on('click','#lightTheme',applyLightTheme);
	
	//Se cambia el estilo del reporte a tonos oscuros.
	jQuery(document).on('click','#darkTheme',applyDarkTheme);
	
	//Se cambian algunos atributos del reporte a color negro.
	jQuery(document).on('click','#blackTheme',applyBlackTheme);
	
	//Se aplica al estilo del reporte tonos grises.
	jQuery(document).on('click','#grayScaleTheme',applyGrayScaleTheme);
	
	//Se cambia el estilo del reporte a una forma compacta.
	jQuery(document).on('click','#whiteTheme',applyWhiteTheme);
	
	//Se cambia el estilo del reporte a una forma compacta.
	jQuery(document).on('click','#exportToHtml',exportToHtml);
	
	jQuery('#prev').click(function(event) {
		console.log(jQuery('#themeMove').css("marginLeft").replace(/px/,""));
		var marginLeft = jQuery('#themeMove').css("marginLeft").replace(/px/,""); 
		if(marginLeft>=0)
			event.preventDefault();		
		else
		{
			jQuery('#themeMove').animate({
				marginLeft: "+=150"
			}, "slow");
		}
	});
	
	jQuery('#next').click(function(event) {
		console.log(jQuery('#themeMove').css("marginLeft").replace(/px/,""));
		var marginLeft = jQuery('#themeMove').css("marginLeft").replace(/px/,""); 
		if(marginLeft<=-150)
			event.preventDefault();
		else{
			jQuery('#themeMove').animate({
				marginLeft: "-=150"
			}, "slow");
		}
	});
	
});

	function applyDefaultTheme(){
		jQuery('#table-background').css("background-color","#071947");
		jQuery('#table-background').css("border","0px");
		jQuery('.division-report').css("background-color","#071947");
		jQuery('#reportContent').css("border","0px");
		
		jQuery('#reportTitle').css("color","#ffffff");
		jQuery('#titleBack').css("background-color","#3da9d7");

		jQuery('.hr').css("background-color","#A8A8B7");
		
		jQuery('.tableTitleText').css("color","#2d80a4");
		jQuery('.contentTable').css("border","solid 0px #2693FF");
		
		jQuery('.tableHead').css("border","solid 1px #2693FF");
		
		jQuery('.cells').css("border","solid 1px #2693FF");
		
		jQuery('#result').html("<p><b>Tema: Default</b><br>Aplica el tema predeterminado para el reporte.</p>");
		selectedTheme('defaultTheme');
	}
	
	function applyLightTheme(){
		jQuery('#table-background').css("background-color","#7396FF");
		jQuery('#table-background').css("border","0px");
		jQuery('.division-report').css("background-color","#4C79FF");
		jQuery('#reportContent').css("border","0px");
		
		jQuery('#reportTitle').css("color","#ffffff");
		jQuery('#titleBack').css("background-color","#73B9FF");

		jQuery('.hr').css("background-color","#73B9FF");
		
		jQuery('.tableTitleText').css("color","#007FFF");
		jQuery('.contentTable').css("border","solid 1px #4CA6FF");
		
		jQuery('.tableHead').css("border","solid 1px #4CA6FF");
		
		jQuery('.cells').css("border","solid 1px #4CA6FF");
		jQuery('#result').html("<p><b>Tema: Claro</b><br>Aplica al reporte una combinación de colores azules claros.</p>");	
		selectedTheme('lightTheme');		
	}
	
	function applyDarkTheme(){
		jQuery('#table-background').css("background-color","#660000");
		jQuery('#table-background').css("border","0px");
		jQuery('.division-report').css("background-color","#660000");
		jQuery('#reportContent').css("border","0px");
		
		jQuery('#reportTitle').css("color","#FFFFFF");
		jQuery('#titleBack').css("background-color","#8C2300");

		jQuery('.hr').css("background-color","#8C0000");
		
		jQuery('.tableTitleText').css("color","#400000");
		jQuery('.contentTable').css("border","solid 1px #400000");
		
		jQuery('.tableHead').css("border","solid 1px #8C0000");
		
		jQuery('.cells').css("border","solid 1px #B30000");
		jQuery('#result').html("<p><b>Tema: Oscuro</b><br>Aplica al reporte una combinación de colores rojizos oscuros.</p>");	
		selectedTheme('darkTheme');
	}
	
	function applyBlackTheme(){
		jQuery('#table-background').css("background-color","#000000");
		jQuery('#table-background').css("border","0px");
		jQuery('.division-report').css("background-color","#000000");
		jQuery('#reportContent').css("border","0px");
		
		jQuery('#reportTitle').css("color","#FFFFFF");
		jQuery('#titleBack').css("background-color","#000000");

		jQuery('.hr').css("background-color","#000000");
		
		jQuery('.tableTitleText').css("color","#000000");
		jQuery('.contentTable').css("border","solid 1px #000000");
		
		jQuery('.tableHead').css("border","solid 1px #000000");
		
		jQuery('.cells').css("border","solid 1px #000000");
		jQuery('#result').html("<p><b>Tema: Negro</b><br>Aplica el color negro al fondo, título, bordes de celdas, etc. del reporte.</p>");	
		selectedTheme('blackTheme');

	}
	
	function applyGrayScaleTheme(){
		jQuery('#table-background').css("background-color","#575748");
		jQuery('#table-background').css("border","0px");
		jQuery('.division-report').css("background-color","#575748");
		jQuery('#reportContent').css("border","0px");
		
		jQuery('#reportTitle').css("color","#FFFFFF");
		jQuery('#titleBack').css("background-color","#757584");

		jQuery('.hr').css("background-color","#313140");
		
		jQuery('.tableTitleText').css("color","#333333");
		jQuery('.contentTable').css("border","solid 1px #111111");
		
		jQuery('.tableHead').css("border","solid 1px #444444");
		
		jQuery('.cells').css("border","solid 1px #444444");
		jQuery('#result').html("<p><b>Tema: Escalas de grises</b><br>Aplica al estilo del reporte tonalidades en gris.</p>");
		selectedTheme('grayScaleTheme');
	}
	
	function applyWhiteTheme(){
		jQuery('#table-background').css("background-color","#FFFFFF");
		jQuery('#table-background').css("border","solid 2px #000000");
		jQuery('.division-report').css("background-color","#FFFFFF");
		jQuery('#reportContent').css("border","solid 1px #666666");
		
		jQuery('#reportTitle').css("color","#000000");
		jQuery('#titleBack').css("background-color","#FFFFFF");

		jQuery('.hr').css("background-color","#000000");
		
		jQuery('.tableTitleText').css("color","#000000");
		jQuery('.contentTable').css("border","solid 1px #000000");
		
		jQuery('.tableHead').css("border","solid 1px #000000");
		
		jQuery('.cells').css("border","solid 1px #000000");
		jQuery('#result').html("<p><b>Tema: Blanco</b><br>Aplica el color blanco al fondo y título del reporte.</p>");	
		selectedTheme('whiteTheme');

	}
	
	function exportToHtml(){
		var content = jQuery('#Report').html();
		var id = jQuery('#Report_id').val();
		jQuery('#load').css("display","inline");
		jQuery.ajax(
		{
		'type': 'POST',
		'url': 	'/index.php?r=report/export',
		'data':	{
					'content':content,
					'id':id
				},
		'cache':false,
		'success':	
			function(html)
			{
				//Se muestra el enlace para descargar el reporte en html
				jQuery('#load').css("display","none");
				jQuery("#result").html(html);
				jQuery("#result").fadeIn(1500);
			}		
		});
	}
	
	function selectedTheme(themeName){
		jQuery('.theme').each(function(){
			jQuery(this).css("border","0px");
			jQuery(this).css("opacity","1");
		});
		var parent = jQuery("#"+themeName).parents().get(0);
		jQuery(parent).css("border","solid 2px #B32D00");
		jQuery(parent).css("opacity",".5");
	}
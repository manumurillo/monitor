<?php
/* @var $this ReportController */
/* @var $model Report */

$this->breadcrumbs=array(
	'Reportes'=>array('index'),
	$report->title=>array('view','id'=>$report->title),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Ver todos los reportes', 'url'=>array('index')),
	array('label'=>'Crear un nuevo reporte', 'url'=>array('create')),
	array('label'=>'Ver reporte', 'url'=>array('view', 'id'=>$report->id)),
	array('label'=>'Administrar reportes', 'url'=>array('admin')),
);
?>

<h1>Actualizar reporte <?php echo $report->title; ?></h1>

<?php echo $this->renderPartial
			('_form', 
				array(
					'report'=>$report, 
					'items'=>$items, 
					'texts'=>$texts, 
					'rTables'=>$rTables, 
					'rows'=>$rows, 
					'cells'=>$cells, 
					'item'=>$item,
					'text'=>$text,
					'rTable'=>$rTable,
				)
		); 

?>

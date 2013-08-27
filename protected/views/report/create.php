<?php
/* @var $this ReportController */
/* @var $model Report */

$this->breadcrumbs=array(
	'Reportes'=>array('index'),
	'Crear nuevo reporte',
);

$this->menu=array(
	array('label'=>'Ver todos los reportes', 'url'=>array('index')),
	array('label'=>'Administrar reportes', 'url'=>array('admin')),
);?>
<h1>Crear nuevo reporte</h1>
<?php echo $this->renderPartial('_form', array(
			'report'=>$report, 
			'item'=>$item, 
			'text'=>$text, 
			'rTable'=>$rTable, 
			'row'=>$row, 
			'cell'=>$cell,
	)); 
?>


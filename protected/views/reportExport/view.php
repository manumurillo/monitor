<?php
/* @var $this ReportExportController */
/* @var $model ReportExport */

$this->breadcrumbs=array(
	'Report Exports'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ReportExport', 'url'=>array('index')),
	array('label'=>'Create ReportExport', 'url'=>array('create')),
	array('label'=>'Update ReportExport', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReportExport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportExport', 'url'=>array('admin')),
);
?>

<h1>View ReportExport #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'date_export',
	),
)); ?>

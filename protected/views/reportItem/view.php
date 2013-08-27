<?php
/* @var $this ReportItemController */
/* @var $model ReportItem */

$this->breadcrumbs=array(
	'Report Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReportItem', 'url'=>array('index')),
	array('label'=>'Create ReportItem', 'url'=>array('create')),
	array('label'=>'Update ReportItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReportItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportItem', 'url'=>array('admin')),
);
?>

<h1>View ReportItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'report_id',
		'position',
		'type',
	),
)); ?>

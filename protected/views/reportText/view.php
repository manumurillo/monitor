<?php
/* @var $this ReportTextController */
/* @var $model ReportText */

$this->breadcrumbs=array(
	'Report Texts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReportText', 'url'=>array('index')),
	array('label'=>'Create ReportText', 'url'=>array('create')),
	array('label'=>'Update ReportText', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReportText', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportText', 'url'=>array('admin')),
);
?>

<h1>View ReportText #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'text',
	),
)); ?>

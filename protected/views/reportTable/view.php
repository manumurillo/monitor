<?php
/* @var $this ReportTableController */
/* @var $model ReportTable */

$this->breadcrumbs=array(
	'Report Tables'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReportTable', 'url'=>array('index')),
	array('label'=>'Create ReportTable', 'url'=>array('create')),
	array('label'=>'Update ReportTable', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReportTable', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportTable', 'url'=>array('admin')),
);
?>

<h1>View ReportTable #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'item_id',
		'table_id',
		'status',
	),
)); ?>

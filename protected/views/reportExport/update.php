<?php
/* @var $this ReportExportController */
/* @var $model ReportExport */

$this->breadcrumbs=array(
	'Report Exports'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportExport', 'url'=>array('index')),
	array('label'=>'Create ReportExport', 'url'=>array('create')),
	array('label'=>'View ReportExport', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReportExport', 'url'=>array('admin')),
);
?>

<h1>Update ReportExport <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
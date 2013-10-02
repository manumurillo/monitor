<?php
/* @var $this ReportExportController */
/* @var $model ReportExport */

$this->breadcrumbs=array(
	'Report Exports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportExport', 'url'=>array('index')),
	array('label'=>'Manage ReportExport', 'url'=>array('admin')),
);
?>

<h1>Create ReportExport</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this ReportTableController */
/* @var $model ReportTable */

$this->breadcrumbs=array(
	'Report Tables'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportTable', 'url'=>array('index')),
	array('label'=>'Manage ReportTable', 'url'=>array('admin')),
);
?>

<h1>Create ReportTable</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
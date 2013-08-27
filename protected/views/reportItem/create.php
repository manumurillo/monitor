<?php
/* @var $this ReportItemController */
/* @var $model ReportItem */

$this->breadcrumbs=array(
	'Report Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportItem', 'url'=>array('index')),
	array('label'=>'Manage ReportItem', 'url'=>array('admin')),
);
?>

<h1>Create ReportItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
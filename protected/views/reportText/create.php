<?php
/* @var $this ReportTextController */
/* @var $model ReportText */

$this->breadcrumbs=array(
	'Report Texts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportText', 'url'=>array('index')),
	array('label'=>'Manage ReportText', 'url'=>array('admin')),
);
?>

<h1>Create ReportText</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
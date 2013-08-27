<?php
/* @var $this ReportItemController */
/* @var $model ReportItem */

$this->breadcrumbs=array(
	'Report Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportItem', 'url'=>array('index')),
	array('label'=>'Create ReportItem', 'url'=>array('create')),
	array('label'=>'View ReportItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReportItem', 'url'=>array('admin')),
);
?>

<h1>Update ReportItem <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
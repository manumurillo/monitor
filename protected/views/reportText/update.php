<?php
/* @var $this ReportTextController */
/* @var $model ReportText */

$this->breadcrumbs=array(
	'Report Texts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportText', 'url'=>array('index')),
	array('label'=>'Create ReportText', 'url'=>array('create')),
	array('label'=>'View ReportText', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReportText', 'url'=>array('admin')),
);
?>

<h1>Update ReportText <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
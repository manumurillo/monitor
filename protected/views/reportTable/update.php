<?php
/* @var $this ReportTableController */
/* @var $model ReportTable */

$this->breadcrumbs=array(
	'Report Tables'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportTable', 'url'=>array('index')),
	array('label'=>'Create ReportTable', 'url'=>array('create')),
	array('label'=>'View ReportTable', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReportTable', 'url'=>array('admin')),
);
?>

<h1>Update ReportTable <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
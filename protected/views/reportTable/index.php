<?php
/* @var $this ReportTableController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Report Tables',
);

$this->menu=array(
	array('label'=>'Create ReportTable', 'url'=>array('create')),
	array('label'=>'Manage ReportTable', 'url'=>array('admin')),
);
?>

<h1>Report Tables</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

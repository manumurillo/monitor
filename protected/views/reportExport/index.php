<?php
/* @var $this ReportExportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Report Exports',
);

$this->menu=array(
	array('label'=>'Create ReportExport', 'url'=>array('create')),
	array('label'=>'Manage ReportExport', 'url'=>array('admin')),
);
?>

<h1>Report Exports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

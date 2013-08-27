<?php
/* @var $this ReportTextController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Report Texts',
);

$this->menu=array(
	array('label'=>'Create ReportText', 'url'=>array('create')),
	array('label'=>'Manage ReportText', 'url'=>array('admin')),
);
?>

<h1>Report Texts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

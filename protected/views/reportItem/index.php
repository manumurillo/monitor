<?php
/* @var $this ReportItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Report Items',
);

$this->menu=array(
	array('label'=>'Create ReportItem', 'url'=>array('create')),
	array('label'=>'Manage ReportItem', 'url'=>array('admin')),
);
?>

<h1>Report Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

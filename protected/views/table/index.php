<?php
/* @var $this TableController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tablas',
);

$this->menu=array(
	array('label'=>'Crear nueva tabla', 'url'=>array('create')),
	array('label'=>'Administrar tablas', 'url'=>array('admin')),
);
?>

<h1>Tablas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

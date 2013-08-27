<?php
/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs=array(
	'Tablas'=>array('index'),
	'Crear una nueva tabla',
);

$this->menu=array(
	array('label'=>'Ver todas las tablas', 'url'=>array('index')),
	array('label'=>'Administrar tablas', 'url'=>array('admin')),
);
?>

<h1>Crear una nueva tabla.</h1>

<?php echo $this->renderPartial('_form', array('table'=>$table, 'column'=>$column)); ?>
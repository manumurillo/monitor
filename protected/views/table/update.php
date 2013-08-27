<?php
/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs=array(
	'Tablas'=>array('index'),
	$table->name=>array('view','id'=>$table->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Ver todas las tablas', 'url'=>array('index')),
	array('label'=>'Crear nueva tabla', 'url'=>array('create')),
	array('label'=>'Administrar tablas', 'url'=>array('admin')),
);
?>

<h1><?php echo $table->name; ?></h1>

<?php echo $this->renderPartial('_form', array(
						'table'=>$table,
						'column'=>$column,
						'columns'=>$table->columns,
		)); 
	?>
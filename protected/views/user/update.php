<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->username=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lista de usuarios', 'url'=>array('index')),
	array('label'=>'Crear nuevo usuario', 'url'=>array('create')),
	array('label'=>'Ver detalles de usuario', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar usuarios', 'url'=>array('admin')),
);
?>

<h1>Actualizar usuario <?php echo $model->id; ?> (<?php echo $model->username; ?>)</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
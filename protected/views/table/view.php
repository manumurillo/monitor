<?php
/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs=array(
	'Tablas'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Lista de tablas', 'url'=>array('index')),
	array('label'=>'Crear  nueva tabla', 'url'=>array('create')),
	array('label'=>'Modificar esta tabla', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar esta tabla', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar la tabla?')),
	array('label'=>'Administrar tablas', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?></h1>
<table border="1">
	<tr>
		<th align="center" valign="center" colspan="<?php echo CHtml::encode($model->columnsCount); ?>">
			<h3><?php echo CHtml::encode($model->title); ?></h3>
		</th>
	</tr>
	<tr>
		<th align="left" valign="top" colspan="<?php echo CHtml::encode($model->columnsCount); ?>">
			Descripci&oacute;n:<br><?php echo $model->description; ?>
		</th>
	</tr>
	<?php $this->renderPartial('_columns',array(
		'columns'=>$model->columns,
	)); ?>
	<tr>
		<th align="left" valign="top" colspan="<?php echo CHtml::encode($model->columnsCount); ?>">
			Pie de la tabla:<?php echo $model->footer; ?>
		</th>
	</tr>
</table>
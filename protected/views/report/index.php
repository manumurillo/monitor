<?php
/* @var $this ReportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reportes',
);

$this->menu=array(
	array('label'=>'Crear nuevo reporte', 'url'=>array('create')),
	array('label'=>'Administrar reportes', 'url'=>array('admin')),
);
?>

<h1>Reportes</h1>

<?php if(!empty($_GET['tag'])): ?>
<h1>Reportes etiquetados con <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>
 
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
)); ?>

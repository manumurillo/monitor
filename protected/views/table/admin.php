<?php
/* @var $this TableController */
/* @var $model Table */

$this->breadcrumbs=array(
	'Tablas'=>array('index'),
	'Administración de tablas',
);

$this->menu=array(
	array('label'=>'Ver todas las tablas', 'url'=>array('index')),
	array('label'=>'Crear nueva tabla', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#table-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar tablas</h1>

<p>
Puede utilizar los siguientes operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ó <b>=</b>) para especificar los criterios de búsqueda.
</p>

<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'table-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'title',
			'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode($data->name), $data->url)'
		
		),
		'title',
		'description:html',
		'footer:html',
		array(
            'name'=>'status',
            'value'=>'Lookup::item("ReportTableStatus",$data->status)',
            'filter'=>Lookup::items('ReportTableStatus'),
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
	'summaryText'=>'Mostrando {start}-{end} de {page} resultados',
	'emptyText'=>'Muy pronto...',
)); ?>

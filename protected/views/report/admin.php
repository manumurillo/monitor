<?php
/* @var $this ReportController */
/* @var $model Report */

$this->breadcrumbs=array(
	'Reportes'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Lista de reportes', 'url'=>array('index')),
	array('label'=>'Crear nuevo reporte', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#report-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Reportes</h1>

<p>

Puede utilizar los comparadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
0 <b>=</b>) para realizar una búsqueda más específica.
</p>

<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); 
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'report-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'title',
            'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
        ),
		array(
            'name'=>'status',
            'value'=>'Lookup::item("ReportStatus",$data->status)',
            'filter'=>Lookup::items('ReportStatus'),
        ),
		array(
			'name'=>'date_created',			
			'value' => 'Yii::app()->dateFormatter->format("dd-MMM-y / HH:MM", $data->date_created)',
			'filter'=>false,
		),
		array(
			'name'=>'date_update',
			'value' => 'Yii::app()->dateFormatter->format("dd-MMM-y / HH:MM", $data->date_update)',
			'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
			'header'=>'Opciones',
			'htmlOptions' => array('style'=>'width:80px; text-align:center'),
			'template'=>'{view}{update}{export}{delete}',
			'buttons'=>array
			(
				'export' => array
				(
					'label'=>'Exportar a HTML',     //Text label of the button.
					'url'=>'Yii::app()->createUrl("report/export", array("id"=>$data->id))',       //A PHP expression for generating the URL of the button.
					'imageUrl'=>Yii::app()->request->baseUrl.'/assets/50459d89/gridview/export_html.png',  //Image URL of the button.
				),
			),
		),
	),
)); ?>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>¡Bienvenido! <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>
	A través de esta aplicación, se podrán crear reportes sobre el monitoreo de redes sociales.
</p>
<h2>Reportes recientemente creados</i></h2>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'report-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
            'name'=>'id',
			'htmlOptions' => array('style'=>'width:80px; text-align:left'),
        ),
		array(
            'name'=>'name',
            'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode($data->name), $data->url, array("target"=>"_blank"))',
			'htmlOptions' => array('style'=>'width:20px; text-align:left'),
        ),
		array(
			'name'=>'date_export',			
			'value' => 'Yii::app()->dateFormatter->format("dd-MMM-y / HH:MM", $data->date_export)',
			'htmlOptions' => array('style'=>'width:100px; text-align:center'),
		),
		array(
			'class'=>'CButtonColumn',
			'header'=>'Opciones',
			'htmlOptions' => array('style'=>'width:100px; text-align:center'),
			'template'=>'{view}{delete}{download}',
			'buttons'=>array
			(
				'view' => array
				(
					'url'=>'$data->url', 
					'visible'=>"!Yii::app()->user->isGuest",
					'options'=>array('target'=>'_blank'),
				),
				'delete' => array
				(
					'url'=>'Yii::app()->createUrl("reportExport/delete", array("id"=>$data->id))',
					'visible'=>"!Yii::app()->user->isGuest",
					'deleteConfirmation'=>"js:'¿Está seguro de eliminar este reporte?'",
				),
				'download' => array
				(
					'url'=>'$data->url', 
					'label'=>'Descargar HTML', 
					'visible'=>"!Yii::app()->user->isGuest",
					'url'=>'Yii::app()->createUrl("../HtmlReports/download.php?file=$data->name")', 
					'imageUrl'=>Yii::app()->request->baseUrl.'/assets/50459d89/gridview/download.png',
				),
			),
		),
	),
));

?>
<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<title><?php echo CHtml::encode(Yii::app()->name); ?> - <?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainMbMenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
				array(
					'label'=>'Inicio', 
					'url'=>array('/site/index')
				),
				array(
					'label'=>'Reportes',
					'url'=>array('/report/index'),
					'items'=>array(
						array(
							'label'=>'Ver todos los reportes',
							'url'=>array('/report/index')
						),
						array(
							'label'=>'Gestión de reportes',
							'url'=>array('/report/admin'),
							'visible'=>!Yii::app()->user->isGuest
						),
						array(
							'label'=>'Crear un nuevo reporte',
							'url'=>array('/report/create'),
							'visible'=>!Yii::app()->user->isGuest
						)
					)
				),
				array(
					'label'=>'Tablas',
					'url'=>array('/table/index'),
					'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array(
							'label'=>'Mostrar todas las tablas',
							'url'=>array('/table/index')
						),
						array(
							'label'=>'Gestión de tablas',
							'url'=>array('/table/admin')					
						),
						array(
							'label'=>'Crear una nueva tabla',
							'url'=>array('/table/create')					
						)
					)
				),
				array(
					'label'=>'Usuarios',
					'url'=>array('/user/index'),
					'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array(
							'label'=>'Listar a todos los usuarios',
							'url'=>array('/user/index')
						),
						array(
							'label'=>'Administración de usuarios',
							'url'=>array('/user/admin')					
						),
						array(
							'label'=>'Agregar un usuario',
							'url'=>array('/user/create')				
						)
					)
				),
				array(
					'label'=>'A cerca de', 
					'url'=>array('/site/page', 'view'=>'about')
				),
				array(
					'label'=>'Iniciar sesión', 
					'url'=>array('/site/login'), 
					'visible'=>Yii::app()->user->isGuest
				),
				array(
					'label'=>'Cerrar sesión ('.Yii::app()->user->name.')', 
					'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest
				)
			)
		)); 
	?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> | Havas Worldwide M&eacute;xico.<br/>
		Todos los derechos reservados.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

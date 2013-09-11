<?php
/* @var $this ReportController */
/* @var $model Report */
$this->breadcrumbs=array(
	'Reportes'=>array('index'),
	$report->title,
);
$this->menu=array(
	array('label'=>'Administrar Reportes', 'url'=>array('admin'), 'visible'=>!Yii::app()->user->isGuest),
	array('label'=>'Ver todos los reportes', 'url'=>array('index'), 'visible'=>!Yii::app()->user->isGuest),
	array('label'=>'Crear un nuevo reporte', 'url'=>array('create'), 'visible'=>!Yii::app()->user->isGuest),
	array('label'=>'Modificar reporte', 'url'=>array('update', 'id'=>$report->id), 'visible'=>!Yii::app()->user->isGuest),
	array('label'=>'Exportar a HTML', 'url'=>array('export', 'id'=>$report->id), 'visible'=>!Yii::app()->user->isGuest),
	array('label'=>'Eliminar reporte', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$report->id),'confirm'=>'¿Está seguro de eliminar este Reporte?'), 'visible'=>!Yii::app()->user->isGuest),
	
);
$itemCounter = $textCounter = $tableCounter = $cellCounter = $rowCounter = $colorCounter = 0;

function toLink($text)
{
	$patron = '/<a.*<\/a>/';
	$url= preg_replace_callback($patron, 'toLinkAgain', $text, -1);
	return $url;
}

function toLinkAgain($n)
{
	if (is_array($n))
		$n = $n[0];
	$patron1 = '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i';
	preg_match($patron1,$n,$coincidencias);
	$contenido = strip_tags($n);
	$contenido2 = chunk_split($contenido, 39, "<br/>\t");
	$enlace= $coincidencias[0];
	$return = "<a href='$enlace' target='_blank'>$contenido2</a>";
	return $return;
}
	
?>
<table>
	<thead>
		<tr>
			<th align="left" valign="middle"> 
				<span style="margin-left: 15px; font-family:arial;color:#ffffff; font-size: 21px;">
					<?php echo CHtml::encode($report->title); ?>
				</span>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if($items)
		{
			foreach($items as $item)
			{
				if($item->type==ReportItem::TYPE_TEXT)
				{
					$texts[$textCounter] = ReportText::model()->findByAttributes(array('item_id'=>$item->id));	
		?>
		<tr>
			<th align="left" valign="middle">
				<span style="font-family:arial; color:#545454; font-size:12px;">
					<?php echo $texts[$textCounter]->text; ?>
				</span>
				<hr/>
			</th>
		</tr>
		<?php
					$textCounter++;
				}
				else
				{
		?>
		<tr>
			<td align="left" valign="middle">
		<?php
					$_table = Table::model()->findByPk($rTables[$tableCounter]->table_id);
					$_columns = $_table->columns;
					echo "<span style='font-family:arial; color:#2d80a4; font-size:14px;'><b>".CHtml::encode($_table->title)."</b></span>
					<br>
					".
					$texts[$textCounter]->text;
					$textCounter++;	
		?>
				<table width="100%" cellspacing="0" cellpadding="0" bgcolor="white" valign="top" border="0" style="border: 1px solid #82c7e6;">
					<tr>
					<?php
					foreach($_columns as $column)
					{
					?>
						<td align="center" valign="middle" style="border: 1px solid #82c7e6;" width="<?php echo CHtml::encode($column->width); ?>px">
							<font color="<?php echo CHtml::encode($column->color); ?>"><b><?php echo CHtml::encode($column->title); ?></b></font>
						</td>
					<?php 
					}
					?>
					</tr>					
					<?php
						for($r=1; $r<=$rTables[$tableCounter]->rowsCount; $r++)
						{
					?>
					<tr>
					<?php
							for($c=1; $c<=$_table->columnsCount; $c++)
							{
					?>
						<td valign="middle" style="border: 1px solid #82c7e6;">
							<span style="word-wrap: break-word; font-family:arial; color:<?php echo CHtml::encode($cells[$cellCounter]->color);?>; font-size:11px;">
								<?php echo toLink($cells[$cellCounter]->content);?>
							</span>
						</td>
					<?php 
								$cellCounter++;
							}							
							$rowCounter++;
						echo "</tr>";
						}
					?>				
				</table>
		<?php		
					echo $texts[$textCounter]->text."<br>";
						$textCounter++;	
					echo "<hr/>";
					$tableCounter++;
				}
		?>
				
			</td>
		</tr>
		
		<?php
			}
		}
		else
		{
		?>
		<tr>
			<th align="left" valign="middle">El reporte no tiene items</th>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
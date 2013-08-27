<?php
/* @var $this ReportController */
/* @var $model Report */
$this->breadcrumbs=array(
	'Reportes'=>array('index'),
);
$itemCounter = $textCounter = $tableCounter = $cellCounter = $rowCounter = $colorCounter = 0;									
?>
<table>
	<thead>
		<tr>
			<th align="left"> 
				<span style="margin-left: 15px; font-family:arial;color:#ffffff; font-size: 21px;">
					<?php echo CHtml::encode($report->title); ?>
				</span>
			</th>
			<th align="right"> 
				<input type="button" value="Cerrar" onclick="window.close();return false;"/>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if($items)
		{
			foreach($items as $item)
			{
				if($item['type']==ReportItem::TYPE_TEXT)
				{
		?>
		<tr>
			<td colspan="2">
				<span style="font-family:arial; color:#545454; font-size:12px;">
					<?php echo $texts[$textCounter]['text'];?>
				</span>
				<hr/>
			</td>	
		</tr>
		<?php
					$textCounter++;
				}
				else
				{
		?>
		<tr>
			<td colspan="2">
		<?php
					$_table = Table::model()->findByPk($rTables[$tableCounter]['table_id']);
					$_columns = $_table->columns;
					echo "<span style='font-family:arial; color:#2d80a4; font-size:14px;'><b>".CHtml::encode($_table->title)."</b></span>
					<br>
					<span style='font-family:arial; color:#545454; font-size:12px;'>".$texts[$textCounter]['text']."</span><br>";
					$textCounter++;	
		?>
				<table cellspacing="0" cellpadding="0" bgcolor="white" valign="top" border="0" style="border-top: 1px; border-top-style: solid; border-top-color:#82c7e6; border-right: 1px; border-right-style: solid; border-right-color:#82c7e6; border-bottom: 1px; border-bottom-style: solid; border-bottom-color:#82c7e6; border-left: 1px; border-left-style: solid; border-left-color:#82c7e6;">
					<tr>
					<?php
					foreach($_columns as $column)
					{
					?>
						<td valign="middle" style="border-right: 1px; border-right-style: solid; border-right-color: #82c7e6; border-bottom: 1px solid #82c7e6;" width="<?php echo CHtml::encode($column->width); ?>px">
							<font color="<?php echo CHtml::encode($column->color); ?>"><b><?php echo CHtml::encode($column->title); ?></b></font>
						</td>
					<?php 
					}
					?>
					</tr>					
					<?php
						for($r=1; $r<=$rTables[$tableCounter]['rowCounter']; $r++)
						{
					?>
					<tr align="center">
					<?php
							for($c=1; $c<=$_table->columnsCount; $c++)
							{
					?>
						<td align="center" valign="middle" style="border-right: 1px; border-right-style: solid; border-right-color: #82c7e6; border-bottom: 1px solid #82c7e6;">
							<span style="font-family:arial; color:<?php echo CHtml::encode($rows[$rowCounter]['color']);?>; font-size:11px;">
								<?php echo $cells[$cellCounter]['content'];?>
							</span>
						</td>
					<?php 
								$cellCounter++;
							}							
							$rowCounter++;
						}
					?>
				</table>
		<?php		
					echo "<span style='font-family:arial; color:#545454; font-size:12px;'>".$texts[$textCounter]['text']."</span><br>";
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
			<th colspan="2">El reporte no tiene items</th>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
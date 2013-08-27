<?php 
	$table=Table::model()->findByPk($rtable->table_id);
?>
	<div id="comments">
		Estado de la tabla: <?php echo $rtable->status; ?><br/>
		ID de la Tabla: <?php echo $rtable->id; ?><br/>
	</div>
	<table border="1">
		<thead>		
			<tr>
				<th colspan="<?php echo CHtml::encode($table->columnsCount	); ?>" align="center">
					<?php echo CHtml::encode($table->title); ?>
				</th>
			</tr>
			<tr>
				<th colspan="<?php echo CHtml::encode($table->columnsCount	); ?>" align="center">
					<h1>Descripción:</h1>
					<?php echo CHtml::encode($textos[0]->text); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="<?php echo CHtml::encode($table->columnsCount	); ?>" align="center">
					<?php echo CHtml::encode($table->description); ?>
				</th>
			</tr>
			<tr>
			<?php 		
			$columns=$table->columns;
			foreach($columns as $column)
			{
			?>
				<th width="<?php echo CHtml::encode($column->width); ?>">
				<font color="<?php echo CHtml::encode($column->color); ?>"><?php echo CHtml::encode($column->title); ?></font>
				</th>
			<?php 
			}
			?>
			</tr>
			
		<?php
			foreach($rows as $row)
			{
		?>
			<tr>
		<?php	
				foreach($columns as $column)
				{
					$cell=ReportTableCell::model()->findByAttributes(array('row_id'=>$row->id,'column_id'=>$column->id));
		?>
				<th>
					<font color="<?php echo CHtml::encode($cell->color); ?>"><?php echo CHtml::encode($cell->content); ?></font>
				</th>
		<?php 	
				}
		?>
			</tr>	
		<?php
			}
		?>
			
		</tbody>
		<tfoot>
			<tr>
				<th colspan="<?php echo CHtml::encode($table->columnsCount	); ?>" align="center">
					<h1>Pie:</h1>
					<?php echo CHtml::encode($textos[1]->text); ?>
				</th>
			</tr>
		</tfoot>
	</table>
	
	<br/><br/>

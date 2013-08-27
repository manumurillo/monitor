	<tr>	
		<?php foreach($columns as $column): ?>
		<th width="<?php echo CHtml::encode($column->width); ?>">
			<font color="<?php echo CHtml::encode($column->color); ?>"><b><?php echo CHtml::encode($column->title); ?></b></font>
		</th>
		<?php endforeach;?>
	</tr>
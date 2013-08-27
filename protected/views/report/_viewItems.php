<?php foreach($items as $item): ?>
	<div id="comment">
			**************Item numero; <?php echo $item->id; ?>***************<br/>
			Posición: <?php echo $item->position; ?><br/>
			Tipo: <?php echo $item->viewTextType($item->type) ?><br/>
			<?php
			if ($item->type==1){
					$text=ReportText::model()->findByAttributes(array('item_id'=>$item->id));
					$this->renderPartial('_viewText',array(
					'text'=>$text,
				)); 
			}
			else
			{
				$reportTable=ReportTable::model()->findByAttributes(array('item_id'=>$item->id));
				$this->renderPartial('_viewTable',array(
					'rtable'=>$reportTable,
					'textos'=>$reportTable->texts,
					'rows'=>$reportTable->rows,
				)); 
			}
			?>
	</div>
	<br/><br/>
<?php endforeach; ?>




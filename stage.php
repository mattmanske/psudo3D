<?php // Stage Setup
	$model = new riftObject();
	$cntrl = new riftController(6, 35);

	$cntrl->drawGrid();

	for ($i = 0; $i < 5; $i++):
		$piece = $model->randPiece(2);
		$cntrl->drawPiece($piece);
	endfor;

?>
</div>
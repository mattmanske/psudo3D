<?php // Stage Setup
	$model = new riftObject();
	$cntrl = new riftController(4, 30);

	$cntrl->drawGrid();

	$cntrl->drawPiece($model->randPiece());

?>
</div>
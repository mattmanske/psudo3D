<?php // Stage Setup
	$model = new riftObject();
	$cntrl = new riftController(4, 55);

	$cntrl->drawGrid();

	for ($i = 0; $i < 5; $i++):
		$piece = $model->randPiece(2);
		$cntrl->drawPiece($piece);
	endfor;

?>
</div>

<div style="width:40px; height:60px; -webkit-transform: skew(0, -24deg); background:red"></div>


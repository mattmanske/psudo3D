<?php // HTML Setup

	function print_nice($val){
		echo '<pre>';
		print_r($val);
		echo '</pre>';
	}

	include_once('objectModel.php');
	include_once('pieceModel.php');
	include_once('modelController.php');

	$driftbox = true;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>3D Modeler - Canvas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="scripts/handler.css" />
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
		<script type="text/javascript" src="scripts/jcanvas.min.js" ></script>
		<script type="text/javascript" src="scripts/canvas.script.js" ></script>
	</head>
	<body drift="<?php ($driftbox ? 'drift' : 'none') ?>">
		<h1>3D Modeler - Canvas</h1>
		<div>
			<a href="?view=front">Front</a> -
			<a href="?view=back">Back</a>
		</div>
		<?php // Stage Setup

			$model = new riftObject();
			$cntrl = new riftController(4, 60, $_GET['view']);

			$cntrl->drawGrid();

			if ($driftbox){
				$drift = $model->driftBox();
				foreach ($drift as $piece):
					$cntrl->drawPiece($piece);
				endforeach;
			} else {
				for ($i = 0; $i < 5; $i++):
					$piece = $model->randPiece(2);
					$cntrl->drawPiece($piece);
				endfor;
			}
		?></div>
	</body>
</html>

<?php // HTML Setup

	function print_nice($val){
		echo '<pre>';
		print_r($val);
		echo '</pre>';
	}

	include_once('objectModel.php');
	include_once('pieceModel.php');
	include_once('modelController.php');

?>

<!DOCTYPE html>
<html>
	<head>
		<title>3D Modeler</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="scripts/handler.css" />
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
		<script type="text/javascript" src="scripts/jcanvas.min.js" ></script>
		<script type="text/javascript" src="scripts/script.js" ></script>
	</head>
	<body>
		<h1>3D Modeler</h1>
		<?php include_once('stage.php'); ?>
	</body>
</html>

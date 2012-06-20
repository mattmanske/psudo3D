<?php // HTML Setup

	include_once('objectModel.php');
	include_once('modelController.php');

?>

<!DOCTYPE html>
<html>
	<head>
		<title>3D Modeler</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="handler.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="script.js" type="text/javascript"></script>
	</head>
	<body>
		<h1>3D Modeler</h1>
		<div id="stage">
			<?php include_once('stage.php'); ?>
		</div>
	</body>
</html>

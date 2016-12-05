<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="language" content="en">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/app/build/app.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
			</div>

		</div>
	</nav>


	<div class="container" id="page">

		<?php echo $content; ?>

	</div>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/bower_components/react/react.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/bower_components/react/react-dom.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/app/build/bundle.js"></script>

</body>
</html>

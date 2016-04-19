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
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container" id="page">

		<div class="starter-template">
			<h1>Bootstrap starter template</h1>
			<p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
		</div>

		<?php echo $content; ?>

		<div class="clear"></div>

		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
			All Rights Reserved.<br/>
			<?php echo Yii::powered(); ?>
		</div>

	</div>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/app/build/bundle.js"></script>

</body>
</html>

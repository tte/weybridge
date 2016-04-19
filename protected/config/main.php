<?php
if (file_exists(dirname(__FILE__).'/secure.php'))
	require_once dirname(__FILE__).'/secure.php';
else {
	echo "Secure config missing. Please, define your `secure.php` file at config folder. Check `example.secure.php`.";
	die;
}

date_default_timezone_set('Europe/Moscow');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Weybridge',
	'charset'=>'utf-8',
	'homeUrl' => '/',
	'timeZone'=>"Europe/Moscow",
	'defaultController' => "Index",
	'layout' => "main",

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.helpers.*',
		'application.components.providers.*',
		'application.components.services.*',
		'application.components.system.*'
	),

	'modules'=>array(),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => require(dirname(__FILE__).'/routes.php'),
		),

		// database settings are configured in database.php
		'db' => $db,

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'CURL' => array(
			'class' => 'ext.curl.Curl',
			'options'=>array(
				'setOptions'=>array(
					CURLOPT_SSL_VERIFYPEER => false,
				),
			),
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

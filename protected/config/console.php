<?php
if (file_exists(dirname(__FILE__).'/secure.php'))
	require_once dirname(__FILE__).'/secure.php';
else {
	echo "Secure config missing. Please, define your `secure.php` file at config folder. Check `example.secure.php`.";
	die;
}

error_reporting(E_ALL & ~E_STRICT);
date_default_timezone_set('Europe/Moscow');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Weybridge',
	'charset'=>'utf-8',
	'timeZone'=>"Europe/Moscow",

	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
		'application.commands.*',
		'application.components.*',
		'application.components.helpers.*',
		'application.components.providers.*',
		'application.components.services.*',
		'application.components.system.*'
	),

	// application components
	'components'=>array(

		// database settings are configured in database.php
		'db' => $db,

		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => require(dirname(__FILE__).'/routes.php'),
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),

	),
);

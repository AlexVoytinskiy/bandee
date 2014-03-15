<?php

Yii::setPathOfAlias('vendor', 'application.vendor');

// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'BANDEE.ru',
	'theme' => 'classic',
	'language' => 'ru',
	'preload' => array('log'),
	'import' => array(
		'application.models.*',
		'application.components.*',
	),
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123',
			'ipFilters' => array('127.0.0.1', '::1'),
		),
		'user'
	),
	'components' => array(
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'class' => 'WebUser',
		),
		'request' => array(
			// 'enableCsrfValidation' => true,
			// 'enableCookieValidation' => true,
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'authManager' => array(
			'class' => 'PhpAuthManager',
			'defaultRoles' => array('guest'),
		),
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=bandee',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
		'clientScript' => array(
			'coreScriptPosition' => CClientScript::POS_END,
			'packages' => array(
				'jquery' => array(
					'baseUrl' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/',
					'js' => array('jquery.min.js'),
				),
				'jqueryui' => array(
					'baseUrl' => '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/',
					'js' => array('jquery-ui.min.js'),
					'css' => array('themes/smoothness/jquery-ui.css'),
				),
				'bootstrap' => array(
					'baseUrl' => '//netdna.bootstrapcdn.com/bootstrap/3.1.1/',
					'js' => array('js/bootstrap.min.js'),
					'css' => array('css/bootstrap.min.css', 'css/bootstrap-theme.min.css'),
					'depends' => array('jquery'),
				),
			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',
	),
);
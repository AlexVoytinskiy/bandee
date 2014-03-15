<?php

return CMap::mergeArray(
	require(dirname(__FILE__) . '/main.php'),
	array(
		'components' => array(
			'db' => array(
				'connectionString' => 'mysql:host=localhost;dbname=bandee',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'enableProfiling' => true,
				'enableParamLogging' => true,
			),
			'log' => array(
				'class' => 'CLogRouter',
				'routes' => array(
					array(
						'class' => 'application.vendor.malyshev.yii-debug-toolbar.YiiDebugToolbarRoute',
					),
				),
			),
		),
	)
);

<?php

return CMap::mergeArray(
	require(dirname(__FILE__) . '/main.php'),
	array(
		'components' => array(
			'db' => array(
				'connectionString' => 'mysql:host=localhost;dbname=u8248353_bandee',
				'emulatePrepare' => true,
				'username' => 'u8248353_bandee',
				'password' => 'K62me4yvIq',
				'charset' => 'utf8',
			),
		),
	)
);
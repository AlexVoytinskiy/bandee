<?php

if ($_SERVER['HTTP_HOST'] === 'bandee.ru') {
	defined('YII_DEBUG') or define('YII_DEBUG', false);
	$yii = dirname(__FILE__) . '/protected/vendor/yiisoft/yii/framework/yiilite.php';
	$config = dirname(__FILE__) . '/protected/config/production.php';
} else {
	defined('YII_DEBUG') or define('YII_DEBUG', true);
	$yii = dirname(__FILE__) . '/protected/vendor/yiisoft/yii/framework/yii.php';
	$config = dirname(__FILE__) . '/protected/config/development.php';
}

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
require_once($yii);

Yii::createWebApplication($config)->run();


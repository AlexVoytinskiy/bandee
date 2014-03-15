<?php

return array(
	'guest' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Guest',
		'bizRule' => null,
		'data' => null
	),
	'0' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Banned',
		'children' => array(
			'guest',
		),
		'bizRule' => null,
		'data' => null
	),
	'1' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'User',
		'children' => array(
			'0',
		),
		'bizRule' => null,
		'data' => null
	),
	'2' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Vip',
		'children' => array(
			'1',
		),
		'bizRule' => null,
		'data' => null
	),
	'3' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Moderator',
		'children' => array(
			'2',
		),
		'bizRule' => null,
		'data' => null
	),
	'4' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Admin',
		'children' => array(
			'3',
		),
		'bizRule' => null,
		'data' => null
	),
);
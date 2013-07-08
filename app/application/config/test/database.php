<?php

return array(
	'profile' => false,
	'default' => 'mysql',
	'connections' => array(
		'mysql' => array(
			'driver'   => 'mysql',
			'host'     => '127.0.0.1',
			'database' => 'O2_ecards',
			'username' => 'pd3_o2',
			'password' => 'pd3o2',
			'charset'  => 'utf8',
			'prefix'   => '',
			'port'	   => 3306,
			PDO::ATTR_CASE              => PDO::CASE_LOWER,
			PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_ORACLE_NULLS      => PDO::NULL_NATURAL,
			PDO::ATTR_STRINGIFY_FETCHES => false,
			PDO::ATTR_EMULATE_PREPARES  => false,
		),

	),

);
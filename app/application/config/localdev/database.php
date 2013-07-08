<?php

return array(
	'profile' => false,
	'default' => 'mysql',
	'connections' => array(
		'mysql' => array(
			'driver'   => 'mysql',
			'host'     => '127.0.0.1',
			'database' => '02_ecards',
			'username' => 'pd3_02',
			'password' => 'pd302',
			'charset'  => 'utf8',
			'prefix'   => '',
			'port'	   => 8889,
			PDO::ATTR_CASE              => PDO::CASE_LOWER,
			PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_ORACLE_NULLS      => PDO::NULL_NATURAL,
			PDO::ATTR_STRINGIFY_FETCHES => false,
			PDO::ATTR_EMULATE_PREPARES  => false,
		),

	),

);
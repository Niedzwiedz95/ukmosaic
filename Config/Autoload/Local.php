<?php
	return
	[
        /* Database info. */
        'db' =>
        [
            'driver'         => 'Pdo_Mysql',
            'dsn'            => 'mysql:dbname=ug207337_mosaic2',
            'username'       => 'ug207337_baza',
            'password'       => 'Business.123',
            'driver_options' =>
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
            ]
        ],
	];
?>
<?php
	return [
		'dsn' => 'mysql:host=localhost; dbname=mvc; charset=utf8',
		'login' => 'root',
		'password' => '',
		'options' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
	];
?>
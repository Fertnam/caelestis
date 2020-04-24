<?php
	/**
	 * Зарегистрировать функцию для автоматической загрузки классов
	 *
	 * @param array $routeSegments Сегменты пути
	 */
	spl_autoload_register(function($className) {
		$path = APPLICATION_PATH . str_replace('\\', '/', $className) . '.php';

		if (is_file($path)) {
			require_once $path;	
		}
	});
?>
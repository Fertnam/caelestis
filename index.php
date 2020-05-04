<?php
	use components\Router;
	use components\exceptions\router\RouteNotFoundException;

	//Общие настройки
	session_start();

	ini_set('display_errors', 1);
	ini_set("log_errors", 1);
	error_reporting(E_ALL);

	//Определяем константы
	define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
	define('LAYOUTS_PATH', ROOT_PATH . '/templates/layouts/');
	define('APPLICATION_PATH', ROOT_PATH . '/application/');
	define('CONFIG_PATH', APPLICATION_PATH . 'config/');
	define('LOGS_PATH', APPLICATION_PATH . '/logs/');
	define('MAIL_HEADERS', "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: \"Caelestis\" <fertnamchannel@gmail.com>'\r\nReply-To: fertnamchannel@gmail.com\r\nX-Mailer: PHP/" . phpversion());

	//Подключение файлов системы
	require_once APPLICATION_PATH . 'components/functions/autoload.php';
	require_once APPLICATION_PATH . 'components/functions/exception_handler.php';
	require_once APPLICATION_PATH . 'components/functions/compute_offset.php';

	try {
		$Router = new Router((string) $_SERVER['REQUEST_URI']);
		$Router->run();
	} catch (RouteNotFoundException $Exception) {
		Router::setError404();
	}
?>
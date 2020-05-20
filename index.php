<?php
	use components\Database;
	use components\Router;
	use models\User;
	use components\exceptions\router\RouteNotFoundException;
	use Illuminate\Database\Capsule\Manager as Capsule;

	//Общие настройки
	ini_set('display_errors', 1);
	ini_set("log_errors", 1);
	error_reporting(E_ALL);
	
	//Определяем константы
	$phpVersion = phpversion();
	
	define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
	define('LAYOUTS_PATH', ROOT_PATH . '/templates/layouts/');
	define('APPLICATION_PATH', ROOT_PATH . '/app/');
	define('CONFIG_PATH', APPLICATION_PATH . 'config/');
	define('LOGS_PATH', APPLICATION_PATH . '/logs/');
	define('FORUM_PATH', 'http://caelestis.el/forum/');
	define('MAIL_HEADERS', "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: \"Caelestis\" <fertnamchannel@gmail.com>'\r\nReply-To: fertnamchannel@gmail.com\r\nX-Mailer: PHP/$phpVersion");

	//Подключение файлов системы
	require_once ROOT_PATH . '/vendor/autoload.php';
	require_once APPLICATION_PATH . 'components/functions/autoload.php';
	require_once APPLICATION_PATH . 'components/functions/exception_handler.php';
	require_once APPLICATION_PATH . 'components/functions/compute_offset.php';

	//Подключаемся к БД
	Database::connect();

	//Стартуем сессию
	session_start();
	session_regenerate_id();

	try {
		$Router = new Router((string) $_SERVER['REQUEST_URI']);
		$Router->run();
	} catch (RouteNotFoundException $Exception) {
		Router::setError404();
	} finally {
		$dbData = require(CONFIG_PATH . 'db_params.php');
		Capsule::disconnect($dbData['database']);
	}
?>
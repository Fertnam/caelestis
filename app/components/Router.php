<?php
	namespace components;

	use components\exceptions\router\RouteNotFoundException;
	
	/**
	 * Класс, описывающий функционал роутера
	 *
	 * @version 1.0 Alpha
	 */
	class Router {
		/**
		 * @access protected
		 *
		 * @var string $_uri текущий uri
		 * @var array $_routes Список роутов
		 */
		protected $_uri,
				  $_routes;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access public
		 *
		 * @param string $uri текущий uri
		 * @param string $routesPath Путь к роутам
		 */
		public function __construct(string $uri) {
			$this->_routes = require(CONFIG_PATH . 'routes.php');
			$this->_uri = trim($uri, '/');
		}

		/**
		 * Вычленить контроллер, его метод и параметры из сегментов пути
		 *
		 * @access protected
		 *
		 * @param array $routeSegments Сегменты пути
		 *
		 * @return array Структурированный массив с контроллером, акшионом и параметрами
		 */
		protected function getRouteData(array $routeSegments) : array {
			$result['controller'] = array_shift($routeSegments) . 'Controller';
			$result['action'] = 'action' . array_shift($routeSegments);
			$result['params'] = $routeSegments;

			return $result;
		}

		/**
		 * Активировать роутер
		 *
		 * @access public
		 *
		 * @throws RouteNotFoundException
		 */
		public function run() {
			$isRouteFound = false;

			foreach ($this->_routes as $pattern => $path) {
				if (preg_match("~$pattern~", $this->_uri)) {
					$internalRoute = preg_replace("~$pattern~", $path, $this->_uri);

					$routeSegments = explode('/', $internalRoute);

					$route = $this->getRouteData($routeSegments);

					$controllerObject = new $route['controller']();

					call_user_func_array([$controllerObject, $route['action']], $route['params']);

					$isRouteFound = true;
					break;
				}
			}

			if (!$isRouteFound) {
				throw new RouteNotFoundException();
			}
		}

		/**
		 * Установить ошибку 404 (страница не найдена)
		 *
		 * @access public
		 *
		 * @static
		 */
		public static function setError404() {
			header('HTTP/1.1 404 Not Found');
			header('Status: 404 Not Found');
		}
	}
?>
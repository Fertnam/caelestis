<?php
	namespace components;
	
	/**
	 * Класс, описывающий подключение к БД (паттерн Singleton)
	 *
	 * @version 1.0 Alpha
	 */
	class Database {
		/**
		 * @access public
		 *
		 * @static
		 *
		 * @var PDO $_Connection Подключение к БД
		 */
		private static $_Connection;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access private
		 *
		 * @throws PDOException
		 *
		 * @return $this
		 */
		private function __construct() {
			$dbParamsPath = CONFIG_PATH . 'db_params.php';
			$dbParams = is_file($dbParamsPath) ? require($dbParamsPath) : null;

			self::$_Connection = new \PDO($dbParams['dsn'], $dbParams['login'], $dbParams['password'], $dbParams['options']);
		}

		/**
		 * Вернуть подключение к БД
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @throws PDOException
		 *
		 * @return PDO Подключение к БД
		 */
		public static function getConnection() : \PDO {
			try {
				if (empty(self::$_Connection)) {
					new self;
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return self::$_Connection;
		}
	}
?>
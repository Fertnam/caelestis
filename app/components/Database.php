<?php
	namespace components;

	use Illuminate\Database\Capsule\Manager as Capsule;
	
	/**
	 * Класс, описывающий подключение к БД (паттерн Singleton)
	 *
	 * @version 1.0
	 */
	class Database extends abstr\Singleton {
		/**
		 * @access protected
		 *
		 * @var Capsule Подключение к БД
		 *
		 * @static
		 */
		protected static $_Element;
		
		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access protected
		 */
		protected function __construct() {
			self::$_Element = new Capsule;

			self::$_Element->addConnection(require(CONFIG_PATH . 'db_params.php'));
			self::$_Element->setAsGlobal();
			self::$_Element->bootEloquent();
		}

		/**
		 * Подключиться к БД
		 *
		 * @access public
		 *
		 * @static
		 */
		public static function connect() {
			self::getSingleton();
		}
	}
?>
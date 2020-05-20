<?php
	namespace components\abstr;
	
	/**
	 * Класс, описывающий структуру паттерна Singleton (все классы-singleton наследуются от него)
	 *
	 * @version 1.0
	 */
	abstract class Singleton {
		/**
		 * @access private
		 *
		 * @var mixed $_Element Единичный экземпляр
		 *
		 * @static
		 */
		private static $_Element;

		/**
		 * Получить единичный экземпляр (первичная логика должны быть в конструкторе суперкласса)
		 *
		 * @access public
		 *
		 * @static
		 * @final
		 *
		 * @return mixed Единичный экземпляр
		 */
		public final static function getSingleton() {
			if (empty(static::$_Element)) {
				new static;
			}

			return static::$_Element;
		}
	}
?>
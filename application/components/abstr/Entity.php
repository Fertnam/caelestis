<?php
	namespace components\abstr;

	/**
	 * Абстрактный класс, описывающий некую сущность
	 *
	 * @version 1.0 Alpha
	 */
	abstract class Entity {
		/**
		 * @access protected
		 *
		 * @var array $_data Данные сущности
		 */
		protected $_data;

		/**
		 * Получить данные сущности в виде массива
		 *
		 * @access public
		 *
		 * @return array Данные сущности
		 */
		public final function getData() : array {
			return $this->_data;
		}

		/**
		 * Получить данные сущности в виде строки JSON
		 *
		 * @access public
		 *
		 * @return string Строка JSON с данными сущности
		 */
		public final function getJSON() : string {
			return json_encode($this->_data, JSON_UNESCAPED_UNICODE);
		}
	}
?>
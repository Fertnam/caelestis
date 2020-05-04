<?php
	namespace entities\user;

	/**
	 * Класс, описывающий сущность текущего пользователя сессии
	 *
	 * @version 1.0 Alpha
	 */
	class Session extends \entities\user\abstr\Existing {
		/**
		 * Конструктор для создания экземпляра данной сущности
		 *
		 * @access public
		 *
		 * @return $this
		 */
		public function __construct() {
			$this->_data = &$_SESSION;
		}
	}
?>
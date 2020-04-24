<?php
	namespace models\user\entities;

	/**
	 * Класс, описывающий сущность текущего пользователя сессии
	 *
	 * @version 1.0 Alpha
	 */
	class Session extends \models\user\entities\abstr\Existing {
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
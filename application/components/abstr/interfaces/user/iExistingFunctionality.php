<?php
	namespace components\abstr\interfaces\user;

	/**
	 * Интерфейс, хранящий функциональность сущности существующего пользователя
	 *
	 * @version 1.0 Alpha
	 */
	interface iExistingFunctionality {
		public function activateOnSite(&$comment = null) : bool;
		public function activateOnForum(&$comment = null) : bool;
		public function activateComplex(&$comment = null) : bool;
	}
?>
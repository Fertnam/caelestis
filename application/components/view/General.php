<?php
	namespace components\view;

	/**
	 * Класс, описывающий View для шаблона general
	 *
	 * @version 1.0 Alpha
	 */
	class General extends \components\abstr\View {
		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access public
		 *
		 * @param string $pageName Имя страницы
		 *
		 * @return $this
		 */
		public function __construct(string $pageName) {
			parent::__construct('general', $pageName);
		}
	}
?>
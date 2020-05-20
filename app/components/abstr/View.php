<?php
	namespace components\abstr;

	use components\Pagination;

	/**
	 * Класс, описывающий View (вид страницы)
	 *
	 * @abstract
	 * @version 1.0
	 */
	abstract class View {
		/**
		 * @access protected
		 *
		 * @var array $_pagesComponents Массив с данными о конкретной странице
		 * @var string $_pageLayout Имя страничного шаблона
		 */
		protected $_pagesComponents,
				  $_pageLayout;
				  
		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access protected
		 *
		 * @param string $pageLayout Имя шаблона
		 * @param string $pageName Имя страницы
		 */
		protected function __construct(string $pageLayout, string $pageName) {
			$this->_pageLayout = $pageLayout;

			$pages = require(CONFIG_PATH . "layout_pages/$this->_pageLayout.php");

			$this->_pagesComponents = $pages[$pageName];
		}

		/**
		 * Сгенерировать HTML-страницу на основе переданных данных
		 *
		 * @access public
		 *
		 * @param array $data Данные
		 * @param Pagination $Pagination Объект пагинации
		 */
		public function generate(array $data = null, Pagination $Pagination = null) {
			require LAYOUTS_PATH . "$this->_pageLayout/template.php";
		}
	}
?>
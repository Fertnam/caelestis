<?php
	namespace components;
	
	/**
	 * Класс, описывающий пагинацию
	 *
	 * @version 1.0 Alpha
	 */
	class Pagination {
		/**
		 * @access public
		 *
		 * @var string Гет-индекс
		 */
		const GET_INDEX = 'page-';

		/**
		 * @access private
		 *
		 * @var int Номер текущей страницы
		 * @var int Номер предыдущей страницы
		 * @var int Номер следующей страницы
		 * @var int Общее количество записей
		 * @var int Количество записей на одной странице
		 * @var int Количество страниц
		 */
		private $_currentPage,
				$_previousPage,
				$_nextPage,
				$_pageTotal,
				$_pageLimit,
				$_pageAmount;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access public
		 *
		 * @param int $pageTotal Общее количество записей
		 * @param int $pageLimit Количество записей на одной странице
		 * @param int $currentPage Номер текущей страницы
		 *
		 * @return $this
		 */
		public function __construct(int $pageTotal, int $pageLimit, int $currentPage) {
			$this->_pageTotal = $pageTotal;
			$this->_pageLimit = $pageLimit;
			$this->_pageAmount = (int) ceil($this->_pageTotal / $this->_pageLimit);

			$this->setCorrectCurrentPage($currentPage);
		}

		/**
		 * Установить корректную текущую страницу
		 *
		 * @access private
		 *
		 * @param int $currentPage Номер текущей страницы
		 */
		private function setCorrectCurrentPage(int $currentPage) {
			$this->_currentPage = $currentPage;

			if ($currentPage > 0) {
				if ($currentPage > $this->_pageAmount) {
					$this->_currentPage = $this->_pageAmount;
				}
			} else {
				$this->_currentPage = 1;
			}
		}

		/**
		 * Получить HTML-код пагинации
		 *
		 * @access public
		 *
		 * @return string HTML-код пагинации
		 */
		public function getHTML() : string {
			$result = $this->getLeftPart() . "<p>$this->_currentPage</p>" . $this->getRightPart();

			return $result;
		}

		/**
		 * Получить HTML-код левой части пагинации
		 *
		 * @access private
		 *
		 * @return string HTML-код левой части пагинации
		 */
		private function getLeftPart() : string {
			$result = "<a href=\"" . self::GET_INDEX . ($this->_currentPage - 1) . "\" id=\"prev-page\"><i class=\"fas fa-arrow-left\"></i></a>";

			return $result;
		}

		/**
		 * Получить HTML-код правой части пагинации
		 *
		 * @access private
		 *
		 * @return string HTML-код правой части пагинации
		 */
		private function getRightPart() : string {
			$result = "<a href=\"" . self::GET_INDEX . ($this->_currentPage + 1) . "\" id=\"next-page\"><i class=\"fas fa-arrow-right\"></i></a>";

			return $result;
		}

		/**
		 * Получить номер текущей страницы
		 *
		 * @access public
		 *
		 * @return int Номер текущей страницы
		 */
		public function getCurrentPage() : int {
			return $this->_currentPage;
		}
	}
?>
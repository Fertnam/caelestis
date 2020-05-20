<?php
	namespace factories;

	use models\Article;
	use models\Banlist;
	use components\Pagination as PaginationComponent;

	/**
	 * Класс фабрики для генерации пагинации в зависимости от страничных данных
	 *
	 * @version 1.0 Alpha
	 */
	class Pagination {
		/**
		 * Получить пагницию для списка статей
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param int $page Номер страницы
		 * @param int $limitCount Количество статей на одну страницу
		 *
		 * @return PaginationComponent Объект с пагинацией
		 */
		public static function getByArticles(int $page = 1, int $limitCount = Article::SHOW_BY_DEFAULT) : PaginationComponent {
			return new PaginationComponent(Article::all()->count(), $limitCount, $page);
		}

		/**
		 * Получить пагницию для списка пернаментных банов
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param int $page Номер страницы
		 * @param int $limitCount Количество пернаментных банов на одну страницу
		 *
		 * @return PaginationComponent Объект с пагинацией
		 */
		public static function getByPernamentBans(int $page = 1, int $limitCount = Banlist::PERNAMENTBANS_SHOW_BY_DEFAULT) : PaginationComponent {
			return new PaginationComponent(Banlist::all()->count(), $limitCount, $page);
		}

		/**
		 * Получить пагницию для списка временных банов
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param int $page Номер страницы
		 * @param int $limitCount Количество временных банов на одну страницу
		 *
		 * @return PaginationComponent Объект с пагинацией
		 */
		public static function getByTempBans(int $page = 1, int $limitCount = Banlist::TEMPBANS_SHOW_BY_DEFAULT) : PaginationComponent {
			return new PaginationComponent(Banlist::all()->count(), $limitCount, $page);
		}
	}
?>
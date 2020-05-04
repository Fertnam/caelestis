<?php
	namespace models;

	use components\Database;

	/**
	 * Класс модели для получения данных о статьях
	 *
	 * @version 1.0 Alpha
	 */
	class Article {
		/**
		 * @access public
		 *
		 * @var int Количество записей на одну страницу по-умолчанию
		 */
		const SHOW_BY_DEFAULT = 3;

		/**
		 * Получить данные о статьях для одной страницы
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @param int $page Номер страницы
		 * @param int $count Количество статей на страницу
		 *
		 * @throws PDOException
		 *
		 * @return array Массив статей
		 */
		public static function getArticlesByPage(int $page, int $count = self::SHOW_BY_DEFAULT) : array {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->prepare('SELECT * FROM cs_article ORDER BY id DESC LIMIT :offset, :count');

				$WritingQuery->bindValue(':offset', compute_offset($page, $count), \PDO::PARAM_INT);
				$WritingQuery->bindParam(':count', $count, \PDO::PARAM_INT);

				$WritingQuery->execute();

				$result = $WritingQuery->fetchAll();
				$result = (!empty($result)) ? $result : [];
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Получить количество всех статей
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @throws PDOException
		 *
		 * @return int Количество статей в таблице
		 */
		public static function getArticlesCount() : int {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->query('SELECT COUNT(*) FROM cs_article');

				$result = $WritingQuery->fetchColumn();
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
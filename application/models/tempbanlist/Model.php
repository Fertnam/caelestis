<?php
	namespace models\tempbanlist;

	use components\Database;

	/**
	 * Класс модели для получения данных о временных банах
	 *
	 * @version 1.0 Alpha
	 */
	class Model {
		/**
		 * @access public
		 *
		 * @var int Количество записей на одну страницу по-умолчанию
		 */
		const SHOW_BY_DEFAULT = 6;

		/**
		 * Получить данные о временных банах для одной страницы
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @param int $page Номер страницы
		 * @param int $count Количество банов на страницу
		 *
		 * @throws PDOException
		 *
		 * @return array Массив временных банов
		 */
		public static function getBansByPage(int $page, int $count = self::SHOW_BY_DEFAULT) : array {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->prepare('SELECT * FROM banlist WHERE end IS NOT NULL ORDER BY id DESC LIMIT :offset, :count');

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
		 * Получить количество всех временных банов
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @throws PDOException
		 *
		 * @return int Количество временных банов в таблице
		 */
		public static function getBansCount() : int {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->query('SELECT COUNT(*) FROM banlist WHERE end IS NOT NULL');

				$result = $WritingQuery->fetchColumn();
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
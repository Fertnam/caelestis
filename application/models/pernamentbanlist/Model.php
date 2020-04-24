<?php
	namespace models\pernamentbanlist;

	use components\Database;

	/**
	 * Класс модели для получения данных о пернаментных банах
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
		 * Получить данные о пернаментных банах для одной страницы
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
		 * @return array Массив пернаментных банов
		 */
		public static function getBansByPage(int $page, int $count = self::SHOW_BY_DEFAULT) : array {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->prepare('SELECT * FROM banlist WHERE end IS NULL ORDER BY id DESC LIMIT :offset, :count');

				$WritingQuery->bindValue(':offset', compute_offset($page, $count), \PDO::PARAM_INT);
				$WritingQuery->bindParam(':count', $count, \PDO::PARAM_INT);

				$WritingQuery->execute();

				$result = $WritingQuery->fetchAll();
				$result = (!empty($result)) ? $result : [];

				for ($index = 0; $index < count($result); $index++) {
					$result[$index]['end'] = 'Никогда';
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Получить количество всех пернаментных банов
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @throws PDOException
		 *
		 * @return int Количество пернаментных банов в таблице
		 */
		public static function getBansCount() : int {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->query('SELECT COUNT(*) FROM banlist WHERE end IS NULL');

				$result = $WritingQuery->fetchColumn();
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
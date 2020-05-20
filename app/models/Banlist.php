<?php
	namespace models;

	use components\Database;

	/**
	 * Класс модели для получения данных о банах
	 *
	 * @version 1.0 Alpha
	 */
	class Banlist {
		/**
		 * @access public
		 *
		 * @var int Количество записей временных банов на одну страницу по-умолчанию
		 * @var int Количество записей пернаментных банов на одну страницу по-умолчанию
		 */
		const TEMPBANS_SHOW_BY_DEFAULT = 6,
			  PERNAMENTBANS_SHOW_BY_DEFAULT = 6;

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
		public static function getTempBansByPage(int $page, int $count = self::TEMPBANS_SHOW_BY_DEFAULT) : array {
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
		public static function getPernamentBansByPage(int $page, int $count = self::PERNAMENTBANS_SHOW_BY_DEFAULT) : array {
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
		public static function getTempBansCount() : int {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->query('SELECT COUNT(*) FROM banlist WHERE end IS NOT NULL');

				$result = $WritingQuery->fetchColumn();
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
		public static function getPernamentBansCount() : int {
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
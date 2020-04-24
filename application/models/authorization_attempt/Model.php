<?php
	namespace models\authorization_attempt;

	use components\Database;
	
	/**
	 * Класс модели для получения данных о попытках авторизации
	 *
	 * @version 1.0 Alpha
	 */
	class Model {
		/**
		 * Получить актуальные данные о попытках авторизации по указанному ip
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @param string $ip ip для поиска
		 *
		 * @throws PDOException
		 *
		 * @return array Данные попытки
		 */
		public static function getActualData(string $ip) : array {
			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->prepare('SELECT aa.id AS id, aa.attempt_count AS attempt_count, aa.last_time AS last_time, ui.ip FROM authorization_attempt AS aa JOIN user_ip AS ui ON (aa.user_ip_id = ui.id) WHERE ui.ip = :ip AND aa.last_time >= (CURRENT_TIMESTAMP() - INTERVAL 10 MINUTE)');

				$WritingQuery->bindParam(':ip', $ip);
			 	$WritingQuery->execute();

			 	$result = $WritingQuery->fetch();
				$result = (!empty($result)) ? $result : [];
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
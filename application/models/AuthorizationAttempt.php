<?php
	namespace models;

	use components\Database;
	
	/**
	 * Класс модели для получения данных о попытках авторизации
	 *
	 * @version 1.0 Alpha
	 */
	class AuthorizationAttempt {
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

				$WritingQuery = $DbConnect->prepare('SELECT ca.id, ca.count, ca.last_time, ci.ip FROM cs_authorization_attempt AS ca JOIN cs_ip AS ci ON (ca.cs_ip_id = ci.id) WHERE ci.ip = :ip AND ca.last_time >= (CURRENT_TIMESTAMP() - INTERVAL 10 MINUTE)');

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
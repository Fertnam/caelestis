<?php
	namespace models;

	use components\Database;

	/**
	 * Класс модели для получения данных о пользователях
	 *
	 * @version 1.0 Alpha
	 */
	class User {
		/**
		 * @access public
		 *
		 * @var int Режим выборки по email или логину
		 * @var int Режим выборки по коду активации
		 * @var int Режим выборки по id
		 */
		const EMAIL_USERNAME_MODE = 1,
			  ACTIVATION_CODE_MODE = 2,
			  ID_MODE = 3;

		/**
		 * Получить данные пользователя по определенному маркеру
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param mixed Маркер для выборки
		 * @param int $mode Режим выборки
		 *
		 * @throws PDOException
		 *
		 * @return array Данные пользователя
		 */
		public static function getData($marker, int $mode = self::EMAIL_USERNAME_MODE) : array {
			try {
				$DbConnect = Database::getConnection();

				$whereSql = self::getWhereSql($mode);

				$WritingQuery = $DbConnect->prepare("SELECT cu.*, cg.name AS group_name FROM cs_user AS cu JOIN cs_group AS cg ON (cu.cs_group_id = cg.id) WHERE $whereSql");

				$WritingQuery->bindParam(':marker', $marker);
				$WritingQuery->execute();

				$result = $WritingQuery->fetch();
				$result = (!empty($result)) ? $result : [];
			} catch (\PDOException $Exception) {
				throw $Exception;
			}
			
			return $result;
		}

		/**
		 * Получить данные пользователя вместе с списком его ip по определенному маркеру
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @param mixed Маркер для выборки
		 * @param int $mode Режим выборки
		 * @param array $columns Список столбцов для выборки
		 *
		 * @throws PDOException
		 *
		 * @return array Массив с данными
		 */
		public static function getDataWithIp($marker, int $mode = self::EMAIL_USERNAME_MODE) : array {
			try {
				$result = self::getData($marker, $mode);

				if (!empty($result)) {
					$result['ip_list'] = self::getIpList($marker);
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Получить список привязанных к аккаунту пользователя ip через определенный маркер
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @param mixed Маркер для выборки
		 * @param int $mode Режим выборки
		 *
		 * @throws PDOException
		 *
		 * @return array Массив ip, привязанных к запрашиваемому пользователю
		 */
		public static function getIpList($marker, int $mode = self::EMAIL_USERNAME_MODE) : array {
			$result = [];

			try {
				$DbConnect = Database::getConnection();

				$whereSql = self::getWhereSql($mode);

				$WritingQuery = $DbConnect->prepare("SELECT ip FROM cs_ip WHERE id IN (SELECT cs_ip_id FROM cs_user_to_cs_ip WHERE cs_user_id = (SELECT id FROM cs_user WHERE $whereSql))");

				$WritingQuery->bindParam(':marker', $marker);
				$WritingQuery->execute();

				$ipList = $WritingQuery->fetchAll(\PDO::FETCH_NUM);

				foreach ($ipList as $ipArray) {
					$result[] = $ipArray[0];
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Получить кусок SQL-запроса, который относится WHERE
		 *
		 * @access private
		 *
		 * @static 
		 *
		 * @param int $mode Режим выборки
		 *
		 * @return string кусок sql-запроса
		 */
		private static function getWhereSql(int $mode) : string {
			switch ($mode) {
				default:
				case self::EMAIL_USERNAME_MODE:
					$result = 'username = :marker OR email = :marker';
				break;

				case self::ACTIVATION_CODE_MODE:
					$result = 'activation_code = :marker';
				break;

				case self::ID_MODE:
					$result = 'id = :marker';
				break;
			}

			return $result;
		}
	}
?>
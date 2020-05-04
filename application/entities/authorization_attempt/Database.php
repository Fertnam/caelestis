<?php
	namespace entities\authorization_attempt;

	use models\AuthorizationAttempt as AuthorizationAttemptModel;
	use components\Database as DatatabaseConnect;

	/**
	 * Класс, описывающий сущность попытки авторизации, полученной из БД
	 *
	 * @version 1.0 Alpha
	 */
	class Database extends \components\abstr\Entity {
		/**
		 * @access public
		 *
		 * @var int Количество возможных попыток по-умолчанию
		 */
		const POSSIBLE_ATTEMPT_COUNT = 3;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access private
		 *
		 * @param array $attemptData Массив с данными о попытки
		 *
		 * @return $this
		 */
		private function __construct(array $data) {
			$this->_data = $data;
		}

		/**
		 * Статический фабричный метод для получения экземпляра сущности по указанному ip
		 *
		 * @access public
		 *
		 * @static 
		 *
		 * @param string $ip ip для поиска
		 *
		 * @throws PDOException
		 *
		 * @return mixed Экземпляр сущности
		 */
		public static function getEntity(string $ip) {
			try {
				$attemptData = AuthorizationAttemptModel::getActualData($ip);
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return (!empty($attemptData)) ? new self($attemptData) : new Artificial($ip);
		}

		/**
		 * Обновить текущую попытку авторизации
		 *
		 * @access public
		 *
		 * @throws PDOException
		 */
		public function update() {
			try {
				$DbConnect = DatatabaseConnect::getConnection();
				
				$WritingQuery = $DbConnect->prepare('UPDATE cs_authorization_attempt SET count = count + 1, last_time = CURRENT_TIMESTAMP() WHERE id = :id');

				$WritingQuery->bindParam(':id', $this->_data['id'], \PDO::PARAM_INT);

				$WritingQuery->execute();

				$this->_data['count']++;
			} catch (\PDOException $Exception) {
				throw $Exception;
			}
		}

		/**
		 * Проверить валидность текущей попытки
		 *
		 * @access public
		 *
		 * @param mixed &$restTime переменная-контейнер, в которую будет занесено оставшееся время до следующей попытки
		 *
		 * @return bool Результат проверки
		 */
		public function isValid(&$restTime = null) : bool {
			$result = false;

			if ($this->_data['count'] <= self::POSSIBLE_ATTEMPT_COUNT) {
		 		$result = true;
		 	} else {
		 		$restTime = (strtotime($this->_data['last_time']) + 600) - time();
		 	}

			return $result;
		}
	}
?>
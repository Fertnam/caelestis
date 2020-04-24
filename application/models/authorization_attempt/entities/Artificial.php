<?php
	namespace models\authorization_attempt\entities;

	use components\Database as DatatabaseConnect;

	/**
	 * Класс, описывающий сущность несуществующей попытки авторизации
	 *
	 * @version 1.0 Alpha
	 */
	class Artificial extends \components\abstr\Entity {
		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access private
		 *
		 * @param string $ip ip, с которой проводится попытка
		 *
		 * @return $this
		 */
		public function __construct(string $ip) {
			$this->_data['ip'] = $ip;
		}

		/**
		 * Занести данную попытку в БД
		 *
		 * @access public
		 *
		 * @throws PDOException
		 */
		public function update() {
			try {
				$DbConnect = DatatabaseConnect::getConnection();

				$DbConnect->beginTransaction();

				$WritingQuery = $DbConnect->prepare('INSERT INTO user_ip(ip) VALUES (:ip) ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id)');

		 		$WritingQuery->bindParam(':ip', $this->_data['ip']);
		 		$WritingQuery->execute();

		 		$DbConnect->query('INSERT INTO authorization_attempt(user_ip_id) VALUES (' . $DbConnect->lastInsertId() . ')');

		 		$DbConnect->commit();
			} catch (\PDOException $Exception) {
				$DbConnect->rollBack();

				throw $Exception;
			}
		}

		/**
		 * Проверить валидность текущей попытки (всегда возвращается true)
		 *
		 * @access public
		 *
		 * @param mixed &$restTime переменная-контейнер, в которую будет занесено оставшееся время до следующей попытки (всегда будет 0)
		 *
		 * @return bool Результат проверки
		 */
		public function isValid(&$restTime = null) : bool {
			$restTime = 0;

			return true;
		}
	}
?>
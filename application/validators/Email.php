<?php
	namespace validators;

	use components\Phraser;
	use components\Database;

	/**
	 * Класс для валидации email пользователя
	 *
	 * @version 1.0 Alpha
	 */
	class Email {
		/**
		 * @access public
		 *
		 * @var string Регулярное выражение для проверки структуры
		 * @var int Максимальная длина email
		 */
		const PATTERN = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/',
			  MAX_LENGTH = 120;

		/**
		 * @access private
		 *
		 * @var string Email
		 * @var int Длина email
		 */
		private $_email,
				$_emailLength;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access public
		 *
		 * @param string $email Email для валидации
		 *
		 * @return $this
		 */
		public function __construct(string $email) {
			$this->_email = $email;
			$this->_emailLength = strlen($this->_email);
		}

		/**
		 * Проверить email на соответствие регулярному выражению
		 *
		 * @access public
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isMatchToPattern(&$comment = null) : bool {
			$result = false;

			if (!preg_match(self::PATTERN, $this->_email)) {
				$comment = Phraser::getPhraser()->getPhrase('email_incorrect_structure');
			} elseif ($this->_emailLength > self::MAX_LENGTH) {
				$comment = Phraser::getPhraser()->getPhrase('email_max_length', [
					'length' => $this->_emailLength
				]);
			} else {
				$result = true;
			}

			return $result;
		}

		/**
		 * Проверить email на уникальность
		 *
		 * @access public
		 *
		 * @throws PDOException
		 *
		 * @return bool Результат проверки
		 */
		public function isFree() : bool {
			$result = false;

			try {
				$DbConnect = Database::getConnection();

				$WritingQuery = $DbConnect->prepare('SELECT COUNT(*) FROM site_user WHERE email = :email');

				$WritingQuery->bindParam(':email', $this->_email);

				$WritingQuery->execute();

				if ($WritingQuery->fetchColumn() == 0) {
					$result = true;
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Проверить email на конечную пригодность
		 *
		 * @access public
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @throws PDOException
		 *
		 * @return bool Результат проверки
		 */
		public function isValid(&$comment = null) : bool {
			$result = false;

			try {
				$result = $this->isMatchToPattern($comment);

				if ($result) {
					$result = $this->isFree();

					if (!$result) {
						$comment = Phraser::getPhraser()->getPhrase('email_already_busy');
					}
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
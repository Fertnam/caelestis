<?php
	namespace validators;

	use components\Phraser;
	use models\User;
	
	/**
	 * Класс для валидации логина пользователя
	 *
	 * @version 1.0 Alpha
	 */
	class Username {
		/**
		 * @access public
		 *
		 * @var string Регулярное выражение для проверки структуры
		 * @var int Минимальная длина логина
		 * @var int Максимальная длина логина
		 */
		const USERNAME_PATTERN = '/^\w*$/',
			  MIN_LENGTH = 3,
			  MAX_LENGTH = 24;

		/**
		 * @access private
		 *
		 * @var string Логин
		 * @var int Длина логина
		 */
		private $_username,
				$_usernameLength;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access public
		 *
		 * @param string $username Логин для валидации
		 *
		 * @return $this
		 */
		public function __construct(string $username) {
			$this->_username = $username;
			$this->_usernameLength = strlen($this->_username);
		}

		/**
		 * Проверить логин на соответствие регулярному выражению
		 *
		 * @access public
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isMatchToPattern(&$comment = null) : bool {
			$result = false;

			if (!preg_match(self::USERNAME_PATTERN, $this->_username)) {
				$comment = Phraser::getSingleton()->getPhrase('username_incorrect_structure');
			} elseif ($this->_usernameLength < self::MIN_LENGTH) {
				$comment = Phraser::getSingleton()->getPhrase('username_min_length', [
					'length' => $this->_usernameLength
				]);
			} elseif ($this->_usernameLength > self::MAX_LENGTH) {
				$comment = Phraser::getSingleton()->getPhrase('username_max_length', [
					'length' => $this->_usernameLength
				]);
			} else {
				$result = true;
			}

			return $result;
		}

		/**
		 * Проверить логин на уникальность
		 *
		 * @access public
		 *
		 * @throws PDOException
		 *
		 * @return bool Результат проверки
		 */
		public function isFree() : bool {
			try {
				$result = (User::where('username', $this->_username)->count() === 0) ? true : false;
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Проверить логин на конечную пригодность
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
						$comment = Phraser::getSingleton()->getPhrase('username_already_busy');
					}
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
<?php
	namespace validators;

	use components\Phraser;

	/**
	 * Класс для валидации пароля пользователя
	 *
	 * @version 1.0 Alpha
	 */
	class Password {
		/**
		 * @access public
		 *
		 * @var string Регулярное выражение для проверки вхождения цифр
		 * @var string Регулярное выражение для проверки вхождения заглавных латинских букв
		 * @var string Регулярное выражение для проверки маленьких латинских букв
		 * @var int Минимальная длина пароля
		 * @var int Максимальная длина пароля
		 */
		const NUMBERS_EXISTENCE_PATTERN = '/(?=.*[0-9])/',
			  UPPER_LATIN_EXISTANCE_PATTERN = '/(?=.*[A-Z])/',
			  LOWER_LATIN_EXISTANCE_PATTERN = '/(?=.*[a-z])/',
			  MIN_LENGTH = 6,
			  MAX_LENGTH = 128;

		/**
		 * @access private
		 *
		 * @var string Пароль
		 * @var string Повторение пароля
		 * @var int Длина пароля
		 */
		private $_password,
				$_passwordRepeat,
				$_passwordLength;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access public
		 *
		 * @param string $password Пароль для валидации
		 * @param string $passwordRepeat Повторение пароля (необязательно)
		 *
		 * @return $this
		 */
		public function __construct(string $password, string $passwordRepeat = null) {
			$this->_password = $password;
			$this->_passwordRepeat = $passwordRepeat;
			$this->_passwordLength = strlen($this->_password);
		}

		/**
		 * Проверить пароль на соответствие регулярным выражениям
		 *
		 * @access public
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isMatchToPattern(&$comment = null) : bool {
			$result = false;

			if ($this->_passwordLength < self::MIN_LENGTH) {
				$comment = Phraser::getSingleton()->getPhrase('password_min_length', [
					'length' => $this->_passwordLength
				]);
			} elseif ($this->_passwordLength > self::MAX_LENGTH) {
				$comment = Phraser::getSingleton()->getPhrase('password_max_length', [
					'length' => $this->_passwordLength
				]);
			} else {
				if (!preg_match(self::NUMBERS_EXISTENCE_PATTERN, $this->_password)) {
					$comment = Phraser::getSingleton()->getPhrase('password_not_exists_numbers');
				} elseif (!preg_match(self::UPPER_LATIN_EXISTANCE_PATTERN, $this->_password)) {
					$comment = Phraser::getSingleton()->getPhrase('password_not_exists_upper_latin');
				} elseif (!preg_match(self::LOWER_LATIN_EXISTANCE_PATTERN, $this->_password)) {
					$comment = Phraser::getSingleton()->getPhrase('password_not_exists_lower_latin');
				} else {
					$result = true;
				}
			}

			return $result;
		}

		/**
		 * Проверить пароль и его повторение на совпадение друг с другом
		 *
		 * @access public
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isIdentity(&$comment = null) : bool {
			$result = false;
			
			if (!is_null($this->_passwordRepeat)) {
				if (strcmp($this->_password, $this->_passwordRepeat) === 0) {
					$result = true;
				} else {
					$comment = Phraser::getSingleton()->getPhrase('password_not_identity');
				}
			} else {
				$comment = Phraser::getSingleton()->getPhrase('password_not_argument');
			}

			return $result;
		}

		/**
		 * Проверить пароль на конечную пригодность
		 *
		 * @access public
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isValid(&$comment = null) : bool {
			return $this->isMatchToPattern($comment) && $this->isIdentity($comment);
		}
	}
?>
<?php
	namespace entities\user;

	use components\Phraser;
	use components\abstr\interfaces\user\iDatabaseFunctionality;
	use models\User as UserModel;
	use \entities\authorization_attempt\Database as AuthorizationAttempt;

	/**
	 * Класс, описывающий сущность пользователя, полученного из БД
	 *
	 * @version 1.0 Alpha
	 */
	class Database extends abstr\Existing implements iDatabaseFunctionality {
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
		 * Конструктор для создания экземпляра данной сущности
		 *
		 * @access private
		 *
		 * @param array $data Данные пользователя
		 *
		 * @return $this
		 */
		private function __construct(array $data) {
			$this->_data = $data;
		}

		/**
		 * Статический фабричный метод для получения экземпляра сущности по определенному маркеру
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param mixed Маркер для выборки
		 * @param int $mode Режим выборки
		 * @param bool Подгружать список привязанных ip или нет
		 *
		 * @return $this | Undetected
		 */
		public static function getEntity($marker, int $mode = self::EMAIL_USERNAME_MODE) {
			switch ($mode) {
				default:
				case self::EMAIL_USERNAME_MODE:
					$userData = UserModel::getDataWithIp($marker);
				break;

				case self::ACTIVATION_CODE_MODE:
					$userData = UserModel::getDataWithIp($marker, UserModel::ACTIVATION_CODE_MODE);
				break;
			}

			return (!empty($userData)) ? new self($userData) : new Undetected;
		}

		/* -------- Авторизация -------- */
		/**
		 * Авторизовать сущность на сайте
		 *
		 * @access public
		 */
		public function authorizateOnSite() {
			$_SESSION = $this->_data;
		}

		/**
		 * Авторизовать сущность в лаунчере
		 *
		 * @access public
		 *
		 * @return string Строка-активатор
		 */
		public function authorizateOnLauncher() : string {
			return "OK:{$this->_data['username']}";
		}

		/**
		 * Проверить возможность авторизации сущности (без учета защиты по IP и брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isAuthorizationPossible(string $password, &$comment = null) : bool {
			$result = false;

			$Phraser = Phraser::getPhraser();

			if (!$this->isActivated()) {
				$comment = $Phraser->getPhrase('user_not_activated');
			} elseif ($this->isBanned()) {
				$comment = $Phraser->getPhrase('user_banned');
			} elseif (!$this->isPasswordCorrect($password)) {
				$comment = $Phraser->getPhrase('user_incorrect_password');
			} else {
				$result = true;
			}

			return $result;
		}

		/**
		 * Проверить возможность авторизации сущности (с учетом защиты по IP, но без учета брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param string $ip Проверяемый ip
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isAuthorizationPossibleSubjectToIpGuard(string $password, string $ip, &$comment = null) : bool {
			$result = $this->isIpCorrect($ip);

			if ($result) {
				$result = $this->isAuthorizationPossible($password, $comment);
			} else {
				$comment = Phraser::getPhraser()->getPhrase('user_incorrect_ip', [
					'ip' => $ip
				]);
			}

			return $result;
		}

		/**
		 * Проверить возможность авторизации (с учетом брутфорса, но без учета защиты по IP)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param string $ip Проверяемый ip
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isAuthorizationPossibleSubjectToBruteForceGuard(string $password, string $ip, &$comment = null) : bool {
			$result = false;

			try {
				$AuthorizationAttempt = AuthorizationAttempt::getEntity($ip);

				if ($AuthorizationAttempt->isValid($restTime)) {
					$result = $this->isAuthorizationPossible($password, $comment);

					if (!$result) {
						$AuthorizationAttempt->update();
					}
				} else {
					$comment = Phraser::getPhraser()->getPhrase('user_brute_force_guard', [
						'rest_time' => $restTime
					]);
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Проверить возможность авторизации сущности (с учетом защиты по IP и с учетом брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param string $ip ip посетителя
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isAuthorizationPossibleComplex(string $password, string $ip, &$comment = null) : bool {
			$result = false;

			try {
				$AuthorizationAttempt = AuthorizationAttempt::getEntity($ip);

				if ($AuthorizationAttempt->isValid($restTime)) {
					$result = $this->isAuthorizationPossibleSubjectToIpGuard($password, $ip, $comment);

					if (!$result) {
						$AuthorizationAttempt->update();
					}
				} else {
					$comment = Phraser::getPhraser()->getPhrase('user_brute_force_guard', [
						'rest_time' => $restTime
					]);
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
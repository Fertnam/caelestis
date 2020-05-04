<?php
	namespace entities\user;

	use components\Phraser;
	use components\abstr\interfaces\user\iDatabaseFunctionality;
	use components\abstr\interfaces\iExists;

	/**
	 * Null-класс, описывающий сущность НЕНАЙДЕННОГО пользователя
	 *
	 * @version 1.0 Alpha
	 */
	class Undetected implements iDatabaseFunctionality, iExists {
		/* -------- АКТИВАЦИЯ -------- */
		/**
		 * Заглушка активации Null-сущности на сайте
		 *
		 * @access public
		 * 
		 * @final
		 *
		 * @return bool Статус активации
		 */
		public final function activateOnSite(&$comment = null) : bool {
			$comment = Phraser::getPhraser()->getPhrase('user_not_exists');

			return false;
		}

		/**
		 * Заглушка активации Null-сущности на форуме
		 *
		 * @access public
		 * 
		 * @final
		 *
		 * @return bool Статус активации
		 */
		public final function activateOnForum(&$comment = null) : bool {
			$comment = Phraser::getPhraser()->getPhrase('user_not_exists');

			return false;
		}

		/**
		 * Заглушка активации Null-сущности на обоих ресурсах (на сайте и на форуме)
		 *
		 * @access public
		 * 
		 * @final
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Статус активации
		 */
		public final function activateComplex(&$comment = null) : bool {
			$comment = Phraser::getPhraser()->getPhrase('user_incorrect_activation_code');

			return false;
		}

		/**
		 * Проверить, существует ли данная сущность на самом деле
		 *
		 * @access public
		 * 
		 * @final
		 *
		 * @return bool Статус проверки
		 */
		public final function isExists() : bool {
			return false;
		}

		/* -------- Авторизация -------- */
		/**
		 * Заглушка проверки возможности авторизации Null-сущности (без учета защиты по IP и брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isAuthorizationPossible(string $password, &$comment = null) : bool {
			$comment = Phraser::getPhraser()->getPhrase('user_not_exists');

			return false;
		}

		/**
		 * Заглушка проверки возможности авторизации Null-сущности (с учетом защиты по IP, но без учета брутфорса)
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
			$comment = Phraser::getPhraser()->getPhrase('user_not_exists');

			return false;
		}

		/**
		 * Заглушка проверки возможности авторизации Null-сущности (с учетом брутфорса, но без учета защиты по IP)
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
			$comment = Phraser::getPhraser()->getPhrase('user_not_exists');

			return false;
		}

		/**
		 * Заглушка проверки возможности авторизации Null-сущности (с учетом защиты по IP и с учетом брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param string $ip Проверяемый ip
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function isAuthorizationPossibleComplex(string $password, string $ip, &$comment = null) : bool {
			$comment = Phraser::getPhraser()->getPhrase('user_not_exists');

			return false;
		}
	}
?>
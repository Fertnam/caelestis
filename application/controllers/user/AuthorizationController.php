<?php
	namespace controllers\user;

	use components\Phraser;
	use components\Logger;
	use entities\user\Database as DatabaseUser;

	/**
	 * Класс контроллера, описывающий авторизацию аккаунтов пользователей
	 *
	 * @version 1.0 Alpha
	 */
	class AuthorizationController {
		/**
		 * Провести авторизацию пользователя на сайте
		 *
		 * @access public
		 *
		 * @param mixed $username Логин пользователя
		 * @param mixed $password Пароль пользователя
		 */
		public function actionSite($username, $password) {
			$result = ['success' => false, 'comment' => Phraser::getPhraser()->getPhrase('user_successful_authorization')];

			try {
				$DatabaseUser = DatabaseUser::getEntity($username);

				$result['success'] = $DatabaseUser->isAuthorizationPossibleSubjectToBruteForceGuard($password, $_SERVER['REMOTE_ADDR'], $result['comment']);

				if ($result['success']) {
					$DatabaseUser->authorizateOnSite();
				}
			} catch (\PDOException $Exception) {
				$result['comment'] = Phraser::getPhraser()->getPhrase('database_error');

				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}

		/**
		 * Провести авторизацию пользователя в лаунчере
		 *
		 * @access public
		 *
		 * @param mixed $username Логин пользователя
		 * @param mixed $password Пароль пользователя
		 */
		public function actionLauncher($username, $password) {
			try {
				$DatabaseUser = DatabaseUser::getEntity($username);

				$validationStatus = $DatabaseUser->isAuthorizationPossibleComplex($password, $_SERVER['REMOTE_ADDR'], $result);

				if ($validationStatus) {
					$result = $DatabaseUser->authorizateOnLauncher();
				}
			} catch (\PDOException $Exception) {
				$result = Phraser::getPhraser()->getPhrase('database_error');

				Logger::logError($Exception);
			}

			echo $result;
		}
		
		/**
		 * Провести авторизацию пользователя в мобильном приложении
		 *
		 * @access public
		 *
		 * @param mixed $username Логин пользователя
		 * @param mixed $password Пароль пользователя
		 */
		public function actionMobile($username, $password) {
			$result = ['success' => false, 'comment' => null];
			
			try {
				$DatabaseUser = DatabaseUser::getEntity($username);

				$result['success'] = $DatabaseUser->isAuthorizationPossibleComplex($password, $_SERVER['REMOTE_ADDR'], $result['comment']);

				if ($result['success']) {
					$result['comment'] = $DatabaseUser->getJSON();
				}
			} catch (\PDOException $Exception) {
				$result['comment'] = Phraser::getPhraser()->getPhrase('database_error');

				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}
	}
?>
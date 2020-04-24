<?php
	namespace controllers\user;

	use components\Logger;
	use components\Phraser;
	use validators\Username as UsernameValidator;
	use validators\Email as EmailValidator;
	use validators\Password as PasswordValidator;

	/**
	 * Класс контроллера, описывающий валидацию данных пользователя
	 *
	 * @version 1.0 Alpha
	 */
	class ValidationController {
		/**
		 * Проверить логин пользователя
		 *
		 * @access public
		 *
		 * @param mixed $username Логин пользователя
		 */
		public function actionUsername($username) {
			$result = ['status' => false, 'comment' => Phraser::getPhraser()->getPhrase('username_correct')];

			try {
				$Validator = new UsernameValidator((string) $username);

				$result['status'] = $Validator->isValid($result['comment']);
			} catch (\PDOException $Exception) {
				$result['comment'] = Phraser::getPhraser()->getPhrase('database_error');

				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}

		/**
		 * Проверить email пользователя
		 *
		 * @access public
		 *
		 * @param mixed $email Email пользователя
		 */
		public function actionEmail($email) {
			$result = ['status' => false, 'comment' => Phraser::getPhraser()->getPhrase('email_correct')];

			try {
				$Validator = new EmailValidator((string) $email);

				$result['status'] = $Validator->isValid($result['comment']);
			} catch (\PDOException $Exception) {
				$result['comment'] = Phraser::getPhraser()->getPhrase('database_error');

				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}

		/**
		 * Проверить пароль пользователя
		 *
		 * @access public
		 *
		 * @param mixed $password Пароль пользователя
		 * @param mixed $passwordRepeat Повторение пароля пользователя
		 */
		public function actionPassword($password, $passwordRepeat) {
			$result = ['status' => false, 'comment' => Phraser::getPhraser()->getPhrase('password_correct')];
			
			$Validator = new PasswordValidator((string) $password, (string) $passwordRepeat);

			$result['status'] = $Validator->isValid($result['comment']);

			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}
	}
?>
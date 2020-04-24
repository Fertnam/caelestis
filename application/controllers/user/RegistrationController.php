<?php
	namespace controllers\user;

	use components\Phraser;
	use components\Logger;
	use models\user\entities\Artificial as ArtificialUser;
	use components\exceptions\user\registration\Basic as RegistrationException;

	/**
	 * Класс контроллера, описывающий регистрацию аккаунтов пользователей
	 *
	 * @version 1.0 Alpha
	 */
	class RegistrationController {
		/**
		 * Провести комплексную регистрацию пользователя (на сайте и форуме)
		 *
		 * @access public
		 */
		public function actionComplex() {
			$result = ['success' => false, 'comment' => Phraser::getPhraser()->getPhrase('user_successful_complex_registration')];

			try {
				$ArtificialUser = new ArtificialUser($username, $email, $password);

				if ($ArtificialUser->isRegistrationPossible($passwordRepeat, $result['comment'])) {
					$activationCode = $ArtificialUser->registerComplex();

					$result['success'] = true;
				}
			} catch (\PDOException $Exception) {
				$result['comment'] = Phraser::getPhraser()->getPhrase('database_error');

				Logger::logError($Exception);
			} catch (RegistrationException $Exception) {
				$result['comment'] = $Exception->getMessage();
				
				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);	
		}
	}
?>
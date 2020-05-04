<?php
	namespace controllers\user;

	use components\Phraser;
	use components\Mailer;
	use components\Logger;
	use entities\user\Artificial as ArtificialUser;
	use components\exceptions\user\registration\BasicRegistrationException;

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
				$ArtificialUser = new ArtificialUser('fertnam', 'fertnamchannel@gmail.com', '1Babka');

				if ($ArtificialUser->isRegistrationPossible('1Babka', $result['comment'])) {
					$activationCode = $ArtificialUser->registerComplex();

					$result['success'] = true;
				}
			} catch (\PDOException $Exception) {
				$result['comment'] = Phraser::getPhraser()->getPhrase('database_error');

				Logger::logError($Exception);
			} catch (BasicRegistrationException $Exception) {
				$result['comment'] = $Exception->getMessage();
				
				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);	
		}

		/**
		 * Провести комплексную регистрацию пользователя (для мобильных устройств)
		 *
		 * @access public
		 */
		public function actionComplex() {
			$Phraser = Phraser::getPhraser();

			$result = ['success' => false, 'comment' => $Phraser->getPhrase('user_successful_complex_registration')];

			try {
				$ArtificialUser = new ArtificialUser($_POST['username'], $_POST['email'], $_POST['password']);

				if ($ArtificialUser->isRegistrationPossible($_POST['password-repeat'], $result['comment'])) {
					$activationCode = $ArtificialUser->registerComplex();

					$result['success'] = true;

					Mailer::getMailer()->sendMail('activation_mobile', $_POST['email'], [
						'username' => $_POST['username'],
						'activation_code' => $activationCode
					]);
				}
			} catch (\PDOException $Exception) {
				$result['comment'] = $Phraser->getPhrase('database_error');

				Logger::logError($Exception);
			} catch (BasicRegistrationException $Exception) {
				$result['comment'] = $Exception->getMessage();
				
				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);	
		}
	}
?>
<?php
	namespace controllers\user;

	use components\Mailer;
	use components\Logger;
	use components\Phraser;
	use models\User;
	use models\ForumUser;
	use components\exceptions\user\registration\BasicRegistrationException;

	/**
	 * Класс контроллера, описывающий регистрацию аккаунтов пользователей
	 *
	 * @version 1.0
	 */
	class RegistrationController {
		/**
		 * Провести комплексную регистрацию пользователя (на сайте и форуме)
		 *
		 * @access public
		 */
		public function actionComplex() {
			if (!empty($_POST)) {
				$result = ['success' => false, 'comment' => Phraser::getSingleton()->getPhrase('user_successful_complex_registration')];

				try {
					$User = new User($_POST);

					if ($User->isRegPossible($_POST['repeat-password'], $result['comment'])) {
						$User->register($User->forumUser->register());

						$result['success'] = true;
					}
				} catch (BasicRegistrationException | \PDOException $Exception) {
					$result['comment'] = Phraser::getSingleton()->getPhrase('service_error');
					
					Logger::logException($Exception);
				}

				echo json_encode($result, JSON_UNESCAPED_UNICODE);
			}	
		}
	}
?>
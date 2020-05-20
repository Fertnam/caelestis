<?php
	namespace controllers\user;

	use components\Phraser;
	use components\Logger;
	use models\User;
	use components\exceptions\user\activation\BasicActivationException;
	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Database\Eloquent\ModelNotFoundException;

	/**
	 * Класс контроллера, описывающий активацию аккаунтов пользователей
	 *
	 * @version 1.0 Alpha
	 */
	class ActivationController {
		/**
		 * Провести комплексную активацию пользователя (на сайте и форуме)
		 *
		 * @access public
		 *
		 * @param mixed $activationCode Код активации
		 */
		public function actionComplex($activationCode) {
			$result = ['success' => false, 'comment' => Phraser::getSingleton()->getPhrase('user_successful_complex_activation')];

			try {
				$User = User::where('activation_code', $activationCode)->firstOrFail();

				Capsule::transaction(function() use ($User) {
					$User->activate();
					$User->forumUser->activate();
				});

				$result['success'] = true;
			} catch (ModelNotFoundException $Exception) {
				$result['comment'] = Phraser::getSingleton()->getPhrase('user_incorrect_activation_code');
			} catch (BasicActivationException | \PDOException $Exception) {
				$result['comment'] = Phraser::getSingleton()->getPhrase('service_error');
				
				Logger::logException($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}
	}
?>
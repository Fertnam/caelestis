<?php
	namespace controllers\user;

	use components\Phraser;
	use components\Logger;
	use models\user\entities\Database as DatabaseUser;
	use components\exceptions\user\activation\Basic as ActivationException;

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
			$result = ['success' => false, 'comment' => Phraser::getPhraser()->getPhrase('user_successful_complex_activation')];

			try {
				$DatabaseUser = DatabaseUser::getEntity($activationCode, DatabaseUser::ACTIVATION_CODE_MODE);

				$result['success'] = $DatabaseUser->activateComplex($result['comment']);
			} catch (\PDOException $Exception) {
				$result['comment'] = Phraser::getPhraser()->getPhrase('database_error');
				
				Logger::logError($Exception);
			} catch (ActivationException $Exception) {
				Logger::logError($Exception);
			}

			echo json_encode($result, JSON_UNESCAPED_UNICODE);
		}
	}
?>
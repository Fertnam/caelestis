<?php
	namespace components;

	use components\exceptions\user\activation\BasicActivationException;
	use components\exceptions\user\registration\BasicRegistrationException;

	/**
	 * Класс, описывающий функционал логгера
	 *
	 * @version 1.0 Alpha
	 */
	class Logger {
		/**
		 * Залоггировать исключение
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param Throwable $Exception Исходное исключение
		 */
		public static function logException(\Throwable $Exception) {
			$logPath = LOGS_PATH;

			switch(true) {
				case ($Exception instanceof \PDOException):
					$logPath .= 'database-error.log';
					$message = "Ошибка PDO: " . $Exception->getMessage();
					break;
				case ($Exception instanceof BasicActivationException):
					$logPath .= 'user/activation-error.log';
					$message = "Ошибка активации: " . $Exception->getMessage() . "\nСообщение от предыдущего исключения: " . $Exception->getPrevious()->getMessage();
					break;
				case ($Exception instanceof BasicRegistrationException):
					$logPath .= 'user/registration-error.log';
					$message = "Ошибка регистрации: " . $Exception->getMessage() . "\nСообщение от предыдущего исключения: " . $Exception->getPrevious()->getMessage();
					break;
				default:
					$logPath .= 'main-error.log';
					$message = $Exception->getMessage();
			}

			error_log($message . "\n\n", 3, $logPath);
		}
	}
?>
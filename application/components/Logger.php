<?php
	namespace components;

	use components\exceptions\user\activation\Basic as ActivationException;
	use components\exceptions\user\registration\Basic as RegistrationException;

	/**
	 * Класс, описывающий функционал логгера
	 *
	 * @version 1.0 Alpha
	 */
	class Logger {
		/**
		 * Залоггировать ошибку
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param Throwable $Exception Исходное исключение
		 */
		public static function logError(\Throwable $Exception) {
			$logPath = LOGS_PATH;

			switch(true) {
				case ($Exception instanceof \PDOException):
					$logPath .= 'database-error.log';
					$message = "Ошибка PDO: " . $Exception->getMessage();
					break;
				case ($Exception instanceof ActivationException):
					$logPath .= 'user/activation-error.log';
					$message = "Ошибка активации: " . $Exception->getMessage() . "\nСообщение от предыдущего исключения: " . $Exception->getPrevious()->getMessage();
					break;
				case ($Exception instanceof RegistrationException):
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
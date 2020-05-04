<?php
	namespace components;

	/**
	 * Класс, содержащий функционал работы с электронными письмами
	 *
	 * @version 1.0 Alpha
	 */
	class Mailer {
		/**
		 * @access private
		 *
		 * @var array $_mails Список шаблонов и компонентов для построения письма
		 * @var Mailer $_Mailer Экземпляр мейлера (паттерн Singleton)
		 */
		private $_mails;
		private static $_Mailer;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access private
		 *
		 * @return $this
		 */
		private function __construct() {
			$this->_mails = parse_ini_file(CONFIG_PATH . 'ini/mails.ini', true);
		}

		/**
		 * Вернуть мейлер
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @return Mailer объект для работы с электронными письмами
		 */
		public static function getMailer() : self {
			if (empty(self::$_Mailer)) {
				self::$_Mailer = new self;
			}

			return self::$_Mailer;
		}

		/**
		 * Получить письмо по указанному ключу
		 *
		 * @access public
		 *
		 * @param string $key Ключ письма
		 * @param array $data Массив с данными
		 *
		 * @return array Заголовок письма и его разметка
		 */
		public function getMail(string $key, array $data = []) : array {
			$result = [];

			if (array_key_exists($key, $this->_mails)) {
				$mailParts = $this->_mails[$key];

				$result['subject'] = $mailParts['subject'];
				$result['message'] = $this->_mails['templates'][$mailParts['template']];

				foreach ($mailParts['components'] as $index => $value) {
					$result['message'] = str_replace(":$index", $value, $result['message']);
				}

				foreach ($data as $index => $value) {
					$result['message'] = str_replace(":$index", $value, $result['message']);
				}
			}

			return $result;
		}

		/**
		 * Отправить письмо
		 *
		 * @access public
		 *
		 * @param string $key Ключ письма
		 * @param string $receiver Адрес получателя
		 * @param array $data Массив с данными
		 */
		public function sendMail(string $key, string $receiver, array $data = []) {
			$mailParts = $this->getMail($key, $data);

			mail($receiver, $mailParts['subject'], $mailParts['message'], MAIL_HEADERS);
		}
	}
?>
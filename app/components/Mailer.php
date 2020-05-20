<?php
	namespace components;

	/**
	 * Класс, содержащий функционал работы с электронными письмами (паттерн Singleton)
	 *
	 * @version 1.0
	 */
	class Mailer extends abstr\Singleton {
		/**
		 * @access protected
		 *
		 * @var Mailer Менеджер для работы с письмами
		 *
		 * @static
		 */
		protected static $_Element;

		/**
		 * @access private
		 *
		 * @var array $_mails Список шаблонов и компонентов для построения письма
		 */
		private $_mails;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access protected
		 */
		protected function __construct() {
			$this->_mails = parse_ini_file(CONFIG_PATH . 'ini/mails.ini', true);
			self::$_Element = $this;
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
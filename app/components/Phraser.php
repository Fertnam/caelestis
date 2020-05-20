<?php
	namespace components;

	/**
	 * Класс, описывающий фразер
	 *
	 * @version 1.0
	 */
	class Phraser extends abstr\Singleton {
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
		 * @var array $_phrases Список фраз по ключам
		 */
		private $_phrases;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access protected
		 */
		protected function __construct() {
			$this->_phrases = parse_ini_file(CONFIG_PATH . 'ini/phrases.ini');
			self::$_Element = $this;
		}

		/**
		 * Получить фразу по указанному ключу
		 *
		 * @access public
		 *
		 * @param string $key Ключ фразы
		 * @param array $data Массив с данными
		 *
		 * @return string Фраза
		 */
		public function getPhrase(string $key, array $data = []) : string {
			$result = $this->_phrases['undefined'];

			if (array_key_exists($key, $this->_phrases)) {
				$result = $this->_phrases[$key];

				foreach ($data as $index => $value) {
					$result = str_replace(":$index", $value, $result);
				}
			}

			return $result;
		}
	}
?>
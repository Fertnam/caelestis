<?php
	namespace components;

	/**
	 * Класс, описывающий фразер
	 *
	 * @version 1.0 Alpha
	 */
	class Phraser {
		/**
		 * @access private
		 *
		 * @var array $_phrases Список фраз по ключам
		 * @var Phraser $_Phraser Экзмепляр фразера (паттерн Singleton)
		 */
		private $_phrases;
		private static $_Phraser;

		/**
		 * Конструктор для создания экземпляра данного класса
		 *
		 * @access private
		 *
		 * @return $this
		 */
		private function __construct() {
			$this->_phrases = parse_ini_file(CONFIG_PATH . 'ini/phrases.ini');
		}

		/**
		 * Вернуть фразер
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @return Phraser Фразер
		 */
		public static function getPhraser() : self {
			if (empty(self::$_Phraser)) {
				self::$_Phraser = new self;
			}

			return self::$_Phraser;
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
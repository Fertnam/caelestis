<?php
	namespace models;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Capsule\Manager as Capsule;
	
	/**
	 * Класс модели для получения данных о попытках авторизации
	 *
	 * @version 1.0 Alpha
	 */
	class AuthAttempt extends Model {
		/**
		 * @access public
		 *
		 * @var bool Отключаем работу со столбцами created_at и updated_at
		 */
		public $timestamps = false;

		/**
		 * @access protected
		 *
		 * @var string Таблица для обращений
		 * @var array Список полей, доступных для массового присваивания
		 */
		protected $table = 'cs_authorization_attempt',
				  $fillable = ['cs_ip_id'];

		/**
		 * @access public
		 *
		 * @var int Количество возможных попыток по-умолчанию
		 */
		const POSSIBLE_ATTEMPT_COUNT = 3;

		/**
		 * Получить актуальную попытку по ip
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param string $ip ip
		 *
		 * @throws PDOException
		 *
		 * @return AuthAttempt попытка авторизации
		 */
		public static function actual(string $ip) {
			return self::where('last_time', '>=', Capsule::raw('(CURRENT_TIMESTAMP() - INTERVAL 10 MINUTE)'))->whereHas('ip', function($query) use ($ip) { 
				$query->where('ip', '=', $ip); 
			})->first();
		}

		/**
		 * Получить актуальную попытку или создать новую
		 *
		 * @access public
		 *
		 * @static
		 *
		 * @param string $ip ip
		 *
		 * @throws PDOException
		 */
		public static function actualOrCreate(string $ip) {
			try {
				Capsule::beginTransaction();

				$result = self::actual($ip);

				if (empty($result)) {
					$result = self::create(['cs_ip_id' => IP::firstOrcreate(compact('ip'))->id]);
				}

				Capsule::commit();
			} catch (\PDOException $Exception) {
				Capsule::rollback();

				throw $Exception;
			}

			return $result;
		}

		/**
		 * Обновить текущую попытку авторизации
		 *
		 * @access public
		 *
		 * @throws PDOException
		 */
		public function upgrade() {
			$this->count++;
			$this->last_time = Capsule::raw('CURRENT_TIMESTAMP()');

			$this->update();
		}

		/**
		 * Проверить валидность текущей попытки
		 *
		 * @access public
		 *
		 * @param mixed &$restTime контейнер, хранящий оставшееся время до следующей попытки
		 *
		 * @return bool Результат проверки
		 */
		public function isPossible(&$restTime = null) : bool {
			$result = false;

			if ($this->count <= self::POSSIBLE_ATTEMPT_COUNT) {
		 		$result = true;
		 	} else {
		 		$restTime = (strtotime($this->last_time) + 600) - time();
		 	}

			return $result;
		}

		/* -------- СВЯЗИ МЕЖДУ МОДЕЛЯМИ -------- */
		/**
		 * Установить связь 1:n с моделью IP
		 *
		 * @access public
		 */
		public function ip() {
			return $this->belongsTo(IP::class, 'cs_ip_id');
		}
	}
?>
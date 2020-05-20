<?php
	namespace models;

	use components\Phraser;
	use components\exceptions\user\registration\SiteRegistrationException;
	use components\exceptions\user\activation\SiteActivationException;
	use validators\Username;
	use validators\Email;
	use validators\Password;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Capsule\Manager as Capsule;

	/**
	 * Класс модели для работы с пользователями
	 *
	 * @version 1.0
	 */
	class User extends Model {
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
		 * @var array Список отношений, которые подвергнутся сериализации
		 */
		protected $table = 'cs_user',
				  $fillable = ['username', 'email', 'password'],
				  $with = ['group'];

		/* -------- РЕГИСТРАЦИЯ -------- */
		/**
		 * Создать аккаунт на сайте
		 *
		 * @access public
		 *
		 * @param int $xfUserId id форумного аккаунта
		 *
		 * @throws SiteRegistrationException
		 *
		 * @return string код активации аккаунта
		 */
		public function register(int $xfUserId = null) : string {
			try {
				$this->password = password_hash($this->password, PASSWORD_BCRYPT);
				$this->activation_code = hash('sha3-256', $this->username);
				$this->xf_user_id = $xfUserId;

				$this->save();
			} catch (\PDOException $Exception) {
				$message = Phraser::getSingleton()->getPhrase('user_error_of_registration_on_site', [
					'username' => $this->username,
					'email' => $this->email
				]);

				throw new SiteRegistrationException($Exception, $message);
			}

			return $this->activation_code;
		}

		/**
		 * Проверить возможность регистрации аккаунта
		 *
		 * @access public
		 *
		 * @param string $repeatPassword Повторение пароля
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @throws PDOException
		 *
		 * @return bool результат проверки
		 */
		public function validateReg(string $repeatPassword, &$comment = null) : bool {
			$Username = new Username($this->username);
			$Email = new Email($this->email);
			$Password = new Password($this->password, $repeatPassword);

			return $Password->isValid($comment) && $Username->isValid($comment) && $Email->isValid($comment);
		}

		/* -------- АКТИВАЦИЯ -------- */
		/**
		 * Активировать аккаунт на сайте
		 *
		 * @access public
		 *
		 * @throws SiteActivationException
		 */
		public function activate() {
			try {
				$this->activation_code = null;

				$this->update();
			} catch (\PDOException $Exception) {
				$message = Phraser::getSingleton()->getPhrase('user_error_of_activation_on_site');

				throw new SiteActivationException($Exception, $message);
			}
		}

		/* -------- АВТОРИЗАЦИЯ -------- */
		/**
		 * Заполнить сессию данными пользователя на сайте
		 *
		 * @access public
		 */
		public function authOnSite() {
			$_SESSION = $this->toArray();
		}

		/**
		 * Получить токен для авторизации в лаунчере
		 *
		 * @access public
		 *
		 * @return string Строка-активатор
		 */
		public function authOnLauncher() : string {
			return "OK:{$this->username}";
		}

		/**
		 * Проверить возможность авторизации аккаунта (без учета защиты по IP и брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function validateAuth(string $password, &$comment = null) : bool {
			$result = false;

			$Phraser = Phraser::getSingleton();

			if (!$this-isActivated()) {
				$comment = $Phraser->getPhrase('user_not_activated');
			} elseif ($this->isBanned()) {
				$comment = $Phraser->getPhrase('user_banned');
			} elseif (!$this->isPassword($password)) {
				$comment = $Phraser->getPhrase('user_incorrect_password');
			} else {
				$result = true;
			}

			return $result;
		}

		/**
		 * Проверить возможность авторизации (с учетом защиты по IP, но без учета брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param string $ip Проверяемый ip
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function validateAuthWithIp(string $password, string $ip, &$comment = null) : bool {
			$result = $this->isIpCorrect($ip);

			if ($result) {
				$result = $this->validateAuth($password, $comment);
			} else {
				$comment = Phraser::getSingleton()->getPhrase('user_incorrect_ip', [
					'ip' => $ip
				]);
			}

			return $result;
		}

		/**
		 * Проверить возможность авторизации (с учетом брутфорса, но без учета защиты по IP)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param string $ip Проверяемый ip
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function validateAuthWithBruteForce(string $password, string $ip, &$comment = null) : bool {
			$result = false;

			try {
				$AuthAttempt = AuthAttempt::actualOrCreate($ip);

				if ($AuthAttempt->isPossible($restTime)) {
					$result = $this->validateAuth($password, $comment);

					if (!$result) {
						$AuthAttempt->upgrade();
					}
				} else {
					$comment = Phraser::getSingleton()->getPhrase('user_brute_force_guard', [
						'rest_time' => $restTime
					]);
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/**
		 * Проверить возможность авторизации сущности (с учетом защиты по IP и с учетом брутфорса)
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 * @param string $ip ip посетителя
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @return bool Результат проверки
		 */
		public function validateAuthWithAll(string $password, string $ip, &$comment = null) : bool {
			$result = false;

			try {
				$AuthAttempt = AuthAttempt::actualOrCreate($ip);

				if ($AuthAttempt->isPossible($restTime)) {
					$result = $this->validateAuthWithIp($password, $comment);

					if (!$result) {
						$AuthAttempt->upgrade();
					}
				} else {
					$comment = Phraser::getSingleton()->getPhrase('user_brute_force_guard', [
						'rest_time' => $restTime
					]);
				}
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/* -------- ПРОВЕРКА ДАННЫХ ПОЛЬЗОВАТЕЛЯ -------- */
		/**
		 * Проверить, активирован ли аккаунт
		 *
		 * @access public
		 *
		 * @return bool Результат проверки
		 */
		public function isActivated() : bool {
			return is_null($this->activation_code);
		}

		/**
		 * Проверить, заблокирован ли аккаунт
		 *
		 * @access public
		 *
		 * @return bool Результат проверки
		 */
		public function isBanned() : bool {
			return ($this->cs_group_id == 1);
		}

		/**
		 * Проверить совпадение пароля с хешем пароля аккаунта
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 *
		 * @return bool Результат проверки
		 */
		public function isPassword(string $password) {
			return password_verify($password, $this->password);
		}

		/**
		 * Проверить, привязан ли указанный ip к списку ip аккаунта
		 *
		 * @access public
		 *
		 * @param string $ip ip для проверки
		 *
		 * @return bool Результат проверки
		 */
		public function isIpCorrect(string $ip) : bool {
			//$result = (!empty($this->_data['ip_list'])) ? in_array($ip, $this->_data['ip_list']) : true; 

			return true;
		}

		/* -------- СВЯЗИ МЕЖДУ МОДЕЛЯМИ -------- */
		/**
		 * Установить связь 1:n с моделью group
		 *
		 * @access public
		 */
		public function group() {
			return $this->belongsTo(Group::class, 'cs_group_id');
		}

		/**
		 * Установить связь 1:1 с моделью ForumUser
		 *
		 * @access public
		 */
		public function xfUser() {
			$data = [
				'username' => $this->username,
				'email' => $this->email,
				'password' => $this->password
			];

			return $this->belongsTo(ForumUser::class, 'xf_user_id', 'user_id')->withDefault($data);
		}
	}
?>
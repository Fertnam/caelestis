<?php
	namespace models;

	use components\Phraser;
	use components\exceptions\user\registration\ForumRegistrationException;
	use components\exceptions\user\activation\ForumActivationException;
	use Illuminate\Database\Eloquent\Model;
	use GuzzleHttp\Client;
	use GuzzleHttp\Exception\ClientException;

	require_once ROOT_PATH . '/forum/src/vendor/autoload.php';

	/**
	 * Класс модели для работы с пользователями форума
	 *
	 * @version 1.0
	 */
	class ForumUser extends Model {
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
		 * @var string Первичный ключ
		 * @var array Список полей, доступных для массового присваивания
		 */
		protected $table = 'xf_user',
				  $primaryKey = 'user_id',
				  $fillable = ['username', 'email', 'password'];

		/**
		 * @access public
		 *
		 * @var array Заголовки для REST API
		 */
		const HEADERS = ['XF-Api-Key' => 'qtUiwxM5VmefuLpfb3W-XiqQj2BLV6_i', 'XF-Api-User' => '1'];

		/* -------- РЕГИСТРАЦИЯ -------- */
		/**
		 * Создать аккаунт на форуме
		 *
		 * @access public
		 *
		 * @throws ForumRegistrationException
		 *
		 * @return int id форумного аккаунта
		 */
		public function register() : int {
			try {
				$Client = new Client;

				$params = [
					'headers' => self::HEADERS,
					'form_params' => [
                        'username' => $this->username,
                        'password' => $this->password,
                        'email' => $this->email,
                        'user_state' => 'moderated'
                    ]
				];

				$answer = $Client->post(FORUM_PATH . '/api/users', $params);
				$answerBody = json_decode($answer->getBody(), true);
			} catch (ClientException $Exception) {
				$message = Phraser::getSingleton()->getPhrase('user_error_of_registration_on_forum', [
					'username' => $this->username,
					'email' => $this->email
				]);

				throw new ForumRegistrationException($Exception, $message);
			}

			return $answerBody['user']['user_id'];
		}

		/* -------- АКТИВАЦИЯ -------- */
		/**
		 * Активировать аккаунт на форуме
		 *
		 * @access public
		 *
		 * @throws ForumActivationException
		 */
		public function activate() {
			try {
				$this->user_state = 'valid';

				$this->update();
			} catch (\PDOException $Exception) {
				$message = Phraser::getSingleton()->getPhrase('user_error_of_activation_on_forum');

				throw new ForumActivationException($Exception, $message);
			}
		}

		/* -------- СВЯЗИ МЕЖДУ МОДЕЛЯМИ -------- */
		/**
		 * Установить связь 1:n с моделью User
		 *
		 * @access public
		 */
		public function csUser() {
			return $this->hasOne(User::class, 'xf_user_id', 'user_id');
		}
	}
?>
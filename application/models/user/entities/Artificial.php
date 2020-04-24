<?php
	namespace models\user\entities;

	use components\Phraser;
	use components\Database;
	use GuzzleHttp\Client as XFClient;
	use GuzzleHttp\Exception\ClientException as XFClientException;
	use components\exceptions\user\registration\Basic as RegistrationException;
	use components\exceptions\user\registration\ForumFailed as ForumRegistrationException;
	use components\exceptions\user\registration\SiteFailed as SiteRegistrationException;

	/**
	 * Класс, описывающий сущность несуществующего пользователя
	 *
	 * @version 1.0 Alpha
	 */
	class Artificial extends \components\abstr\Entity {
		/**
		 * Конструктор для создания экземпляра данной сущности
		 *
		 * @access public
		 *
		 * @param string $username Логин пользователя
		 * @param string $email Email
		 * @param string $password Пароль
		 *
		 * @return $this
		 */
		public function __construct(string $username, string $email, string $password) {
			$this->_data['username'] = $username;
			$this->_data['email'] = $email;
			$this->_data['password'] = $password;
		}

		/* -------- Регистрация -------- */
		/**
		 * Зарегистрировать сущность на сайте
		 *
		 * @access public
		 * 
		 * @param mixed $xfUserId Идентификатор форумного аккаунта
		 *
		 * @throws SiteRegistrationFailedException
		 *
		 * @return string Код активации аккаунта
		 */
		public function registerOnSite($xfUserId = null) : string {
			try {
				$DbConnect = Database::getConnection();

				$passwordHash = password_hash($this->_data['password'], PASSWORD_BCRYPT);
				$activationCode = hash('sha3-256', $this->_data['username']);

				$WritingQuery = $DbConnect->prepare('INSERT INTO site_user(username, email, password, activation_code, xf_user_id) VALUES (:username, :email, :password, :activation_code, :xf_user_id)');

				$WritingQuery->bindParam(':username', $this->_data['username']);
				$WritingQuery->bindParam(':email', $this->_data['email']);
				$WritingQuery->bindParam(':password', $passwordHash);
				$WritingQuery->bindParam(':activation_code', $activationCode);
				$WritingQuery->bindParam(':xf_user_id', $xfUserId);

				$WritingQuery->execute();
			} catch (\PDOException $Exception) {
				$message = Phraser::getPhraser()->getPhrase('user_error_of_registration_on_site', [
					'username' => $this->_data['username'],
					'email' => $this->_data['email']
				]);

				throw new SiteRegistrationException($Exception, $message);
			}

			return $activationCode;
		}

		/**
		 * Зарегистрировать сущность на форуме
		 *
		 * @access public
		 *
		 * @throws ForumRegistrationFailedException
		 *
		 * @return int id форумного аккаунта
		 */
		public function registerOnForum() : int {
			require_once ROOT_PATH . '/forum/src/vendor/autoload.php';

			try {
				$Client = new XFClient();

				$params = [
					'headers' => [
                        'XF-Api-Key' => '1pVii_DCtNC-NZtgiJPNoCL4pP_naPiE',
                        'XF-Api-User' => '1'
                    ],
                    'form_params' => [
                        'username' => $this->_data['username'],
                        'password' => $this->_data['password'],
                        'email' => $this->_data['email'],
                        'user_state' => 'moderated'
                    ]
				];

				$ClientAnswer = $Client->post('mvc.caelestis/forum/api/users', $params);
				$answerBody = json_decode($ClientAnswer->getBody(), true);
			} catch (XFClientException $Exception) {
				$message = Phraser::getPhraser()->getPhrase('user_error_of_registration_on_forum', [
					'username' => $this->_data['username'],
					'email' => $this->_data['email']
				]);

				throw new ForumRegistrationException($Exception, $message);
			}

			return $answerBody['user']['user_id'];
		}

		/**
		 * Зарегистрировать сущность на обоих ресурсах (на сайте и на форуме)
		 *
		 * @access public
		 *
		 * @throws SiteRegistrationFailedException
		 * @throws ForumRegistrationFailedException
		 *
		 * @return string Код активации аккаунта
		 */
		public function registerComplex() : string {
			$activationCode;

			try {
				$xfUserId = $this->registerOnForum();
				$activationCode = $this->registerOnSite($xfUserId);
			} catch (RegistrationException $Exception) {
				throw $Exception;
			}

			return $activationCode;
		}

		/**
		 * Проверить возможность регистрации сущности
		 *
		 * @access public
		 *
		 * @param string $passwordRepeat Повторение пароля
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @throws PDOException
		 *
		 * @return bool Результат проверки
		 */
		public function isRegistrationPossible(string $passwordRepeat, &$comment = null) : bool {
			$UsernameValidator = new \validators\Username($this->_data['username']);
			$EmailValidator = new \validators\Email($this->_data['email']);
			$PasswordValidator = new \validators\Password($this->_data['password'], $passwordRepeat);

			try {
				$result = $PasswordValidator->isValid($comment) && $UsernameValidator->isValid($comment) && $EmailValidator->isValid($comment);
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}
	}
?>
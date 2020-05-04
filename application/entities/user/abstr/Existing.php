<?php
	namespace entities\user\abstr;

	use components\Phraser;
	use components\Database;
	use components\abstr\interfaces\user\iExistingFunctionality;
	use components\abstr\interfaces\iExists;
	use components\exceptions\user\activation\BasicActivationException;
	use components\exceptions\user\activation\SiteActivationException;
	use components\exceptions\user\activation\ForumActivationException;
	
	/**
	 * Абстрактный класс, описывающий сущность существующего пользователя
	 *
	 * @version 1.0 Alpha
	 */
	abstract class Existing extends \components\abstr\Entity implements iExistingFunctionality, iExists {
		/**
		 * Проверить, существует ли данная сущность на самом деле
		 *
		 * @access public
		 * 
		 * @final
		 *
		 * @return bool Статус проверки
		 */
		public final function isExists() : bool {
			return true;
		}

		/* -------- АКТИВАЦИЯ -------- */
		/**
		 * Активировать сущность на сайте
		 *
		 * @access public
		 * 
		 * @final
		 *
		 * @throws SiteActivationFailedException
		 *
		 * @return bool Статус активации
		 */
		public final function activateOnSite(&$comment = null) : bool {
			$result = true;

			$Phraser = Phraser::getPhraser();

			try {
				$DbConnect = Datatabase::getConnection();

				$WritingQuery = $DbConnect->prepare('UPDATE cs_user SET activation_code = NULL WHERE id = :id');

				$WritingQuery->bindParam(':id', $this->_data['id'], \PDO::PARAM_INT);

				$WritingQuery->execute();
				
				if ($WritingQuery->rowCount() == 0) {
					$result = false;

					$comment = $Phraser->getPhrase('user_already_activated_on_site', [
						'id' => $this->_data['id']
					]);
				}
			} catch (\PDOException $Exception) {
				$comment = $Phraser->getPhrase('user_error_of_activation_on_site');

				throw new SiteActivationException($Exception, $comment);
			}

			return $result;
		}

		/**
		 * Активировать сущность на форуме
		 *
		 * @access public
		 *
		 * @final
		 *
		 * @throws ForumActivationFailedException
		 *
		 * @return bool Статус активации
		 */
		public final function activateOnForum(&$comment = null) : bool {
			$result = true;

			$Phraser = Phraser::getPhraser();

			try {
				$DbConnect = Datatabase::getConnection();

				$WritingQuery = $DbConnect->prepare("UPDATE xf_user SET user_state = 'valid' WHERE user_id = :user_id");

				$WritingQuery->bindParam(':user_id', $this->_data['xf_user_id'], \PDO::PARAM_INT);

				$WritingQuery->execute();
				
				if ($WritingQuery->rowCount() == 0) {
					$result = false;

					$comment = $Phraser->getPhrase('user_already_activated_on_forum', [
						'xf_id' => $this->_data['xf_user_id']
					]);
				}
			} catch (\PDOException $Exception) {
				$comment = $Phraser->getPhrase('user_error_of_activation_on_forum');

				throw new ForumActivationException($Exception, $comment);
			}

			return $result;
		}

		/**
		 * Активировать сущность на обоих ресурсах (на сайте и на форуме)
		 *
		 * @access public
		 *
		 * @final
		 *
		 * @param mixed &$comment Контейнер для хранения ошибки
		 *
		 * @throws BasicActivationException
		 * @throws PDOException
		 *
		 * @return bool Статус активации
		 */
		public final function activateComplex(&$comment = null) : bool {
			$result = false;

			try {
				$DbConnect = DatatabaseConnect::getConnection();
					
				$DbConnect->beginTransaction();

				if ($this->activateOnSite($comment) && $this->activateOnForum($comment)) {
					$result = true;
					$DbConnect->commit();
				} else {
					$DbConnect->rollBack();
				}
			} catch (BasicActivationException $Exception) {
				$DbConnect->rollBack();

				throw $Exception;
			} catch (\PDOException $Exception) {
				throw $Exception;
			}

			return $result;
		}

		/* -------- Проверка данных сущности -------- */
		/**
		 * Проверить, активирован ли аккаунт сущности
		 *
		 * @access public
		 *
		 * @return bool Результат проверки
		 */
		public function isActivated() : bool {
			return is_null($this->_data['activation_code']);
		}

		/**
		 * Проверить, заблокирован ли аккаунт сущности
		 *
		 * @access public
		 *
		 * @return bool Результат проверки
		 */
		public function isBanned() : bool {
			return ($this->_data['cs_group_id'] == 1);
		}

		/**
		 * Проверить совпадение пароля с хешем пароля сущности
		 *
		 * @access public
		 *
		 * @param string $password Проверяемый пароль
		 *
		 * @return bool Результат проверки
		 */
		public function isPasswordCorrect(string $password) : bool {
			return password_verify($password, $this->_data['password']);
		}

		/**
		 * Проверить, привязан ли указанный ip к списку ip сущности
		 *
		 * @access public
		 *
		 * @param string $ip Адрес для проверки
		 *
		 * @return bool Результат проверки
		 */
		public function isIpCorrect(string $ip) : bool {
			$result = (!empty($this->_data['ip_list'])) ? in_array($ip, $this->_data['ip_list']) : true; 

			return $result;
		}
	}
?>
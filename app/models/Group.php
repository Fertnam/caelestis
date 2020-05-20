<?php
	namespace models;

	use Illuminate\Database\Eloquent\Model;

	/**
	 * Класс модели для работы с группами пользователей
	 *
	 * @version 1.0
	 */
	class Group extends Model {
		/**
		 * @access protected
		 *
		 * @var string Таблица для обращений
		 */
		protected $table = 'cs_group';
	}
?>
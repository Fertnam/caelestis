<?php
	namespace models;

	use Illuminate\Database\Eloquent\Model;

	class IP extends Model {
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
		protected $table = 'cs_ip',
				  $fillable = ['ip'];
	}
?>
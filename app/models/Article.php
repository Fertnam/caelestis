<?php
	namespace models;

	use Illuminate\Database\Eloquent\Model;

	/**
	 * Класс модели для получения данных о статьях
	 *
	 * @version 1.0 Alpha
	 */
	class Article extends Model {
		protected $table = 'cs_article';

		/**
		 * @access public
		 *
		 * @var int Количество записей на одну страницу по-умолчанию
		 */
		const SHOW_BY_DEFAULT = 3;
	}
?>
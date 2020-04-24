<?php
	namespace components\exceptions\template;
	
	class PageNotFound extends Basic {
		public function __construct(\Throwable $Exception = null) {
			parent::__construct($Exception, 'Запрашиваемая страница не существует');
		}
	}
?>
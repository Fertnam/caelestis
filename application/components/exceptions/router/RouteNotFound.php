<?php
	namespace components\exceptions\router;
	
	class RouteNotFound extends Basic {
		public function __construct(\Throwable $Exception = null) {
			parent::__construct($Exception, 'Запрашиваемый маршрут не является корректным');
		}
	}
?>
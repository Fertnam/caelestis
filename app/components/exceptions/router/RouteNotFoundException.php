<?php
	namespace components\exceptions\router;
	
	class RouteNotFoundException extends BasicRouterException {
		public function __construct(\Throwable $Exception = null) {
			parent::__construct($Exception, 'Запрашиваемый маршрут не является корректным');
		}
	}
?>
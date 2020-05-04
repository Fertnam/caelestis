<?php
	namespace components\exceptions\router;
	
	use components\exceptions\CaelestisException;
	
	class BasicRouterException extends CaelestisException {
		public function __construct(\Throwable $Exception = null, string $message = null) {
			parent::__construct($Exception, (string) $message);
		}
	}
?>
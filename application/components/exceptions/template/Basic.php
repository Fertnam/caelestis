<?php
	namespace components\exceptions\template;
	
	use components\exceptions\Caelestis;
	
	class Basic extends Caelestis {
		public function __construct(\Throwable $Exception = null, string $message = null) {
			parent::__construct($Exception, (string) $message);
		}
	}
?>
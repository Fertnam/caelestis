<?php
	namespace components\exceptions\user\activation;
	
	class SiteActivationException extends BasicActivationException {
		public function __construct(\Throwable $Exception = null, string $message = null) {
			parent::__construct($Exception, (string) $message);
		}
	}
?>
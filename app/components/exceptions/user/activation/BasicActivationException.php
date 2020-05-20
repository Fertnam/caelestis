<?php
	namespace components\exceptions\user\activation;

	use components\exceptions\CaelestisException;

	class BasicActivationException extends CaelestisException {
		public function __construct(\Throwable $Exception = null, string $message = null) {
			parent::__construct($Exception, (string) $message);
		}
	}
?>
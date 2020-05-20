<?php
	namespace components\exceptions\user\registration;

	use components\exceptions\CaelestisException;

	class BasicRegistrationException extends CaelestisException {
		public function __construct(\Throwable $Exception = null, string $message = null) {
			parent::__construct($Exception, (string) $message);
		}
	}
?>
<?php
	namespace components\exceptions\user\registration;
	
	class ForumRegistrationException extends BasicRegistrationException {
		public function __construct(\Throwable $Exception = null, string $message = null) {
			parent::__construct($Exception, (string) $message);
		}
	}
?>
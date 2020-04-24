<?php
	namespace components\exceptions;

	class Caelestis extends \Exception {
		public function __construct(\Throwable $Exception = null, string $message = null) {
			parent::__construct($message, 0, $Exception);
		}
	}
?>
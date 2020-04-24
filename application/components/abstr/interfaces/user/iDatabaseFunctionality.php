<?php
	namespace components\abstr\interfaces\user;

	/**
	 * Интерфейс, хранящий функциональность сущности пользователя, полученного из БД
	 *
	 * @version 1.0 Alpha
	 */
	interface iDatabaseFunctionality {
		public function isAuthorizationPossible(string $password, &$comment = null) : bool;
		public function isAuthorizationPossibleSubjectToIpGuard(string $password, string $ip, &$comment = null) : bool;
		public function isAuthorizationPossibleSubjectToBruteForceGuard(string $password, string $ip, &$comment = null) : bool;
		public function isAuthorizationPossibleComplex(string $password, string $ip, &$comment = null) : bool;
	}
?>
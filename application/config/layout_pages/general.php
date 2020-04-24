<?php
	return [
		'index' => [
			'title' => 'Caelestis - Главная',
			'navigation' => 'index',
			'content' => 'index'
		],
		'banlist' => [
			'title' => 'Caelestis - Временный Банлист',
			'navigation' => 'banlist',
			'content' => 'banlist'
		],
		'banlist/pernaments' => [
			'title' => 'Caelestis - Пернаментный Банлист',
			'navigation' => 'banlist',
			'content' => 'banlist'
		],
		'donate' => [
			'title' => 'Caelestis - Донат',
			'navigation' => 'donate',
			'content' => 'donate'
		],
		'rules' => [
			'title' => 'Caelestis - Правила',
			'navigation' => 'rules',
			'content' => 'rules'
		],
		'registration' => [
			'title' => 'Caelestis - Регистрация',
			'navigation' => 'other',
			'content' => 'registration'
		],
		'profile' => [
			'title' => (!empty($_SESSION['username'])) ? "{$_SESSION['username']} - профиль" : 'Страница профила недоступна',
			'navigation' => 'other',
			'content' => 'profile'
		]
	];
?>
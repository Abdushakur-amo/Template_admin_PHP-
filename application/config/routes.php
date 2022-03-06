<?php

return [
	# MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'search/{page:\d+}' => [
		'controller' => 'main',
		'action' => 'search',
	],


	# AdminController
	'admin/index' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	'admin/profil/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'profil',
	],
	'admin/setting/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'setting',
	],
	'admin/chat/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'chat',
	],


	# AccountController
	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
	],
	'account/register' => [
		'controller' => 'account',
		'action' => 'register',
	],
	'account/config' => [
		'controller' => 'account',
		'action' => 'config',
	],
	'account/setting_login' => [
		'controller' => 'account',
		'action' => 'setting_login',
	],
	'account/confirm' => [
		'controller' => 'account',
		'action' => 'confirm',
	],
	'account/recovery' => [
		'controller' => 'account',
		'action' => 'recovery',
	],
	'account/edit_password' => [
		'controller' => 'account',
		'action' => 'edit_password',
	],

	'dialog/{id:\d+}' => [
		'controller' => 'account',
		'action' => 'dialog',
	],
	'message/dialog/{did:\d+}/user/{uid:\d+}' => [
		'controller' => 'account',
		'action' => 'message',
	],
	'logout' => [
		'controller' => 'account',
		'action' => 'logout',
	],
];

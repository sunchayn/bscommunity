<?php
	
return [
	'heading' => 'pre-install process',
	'desc' => 'preparing for installing bloodstone community .',
	'title' => 'pre-install process',
	'bsc' => 'bloodstone community',
	'version' => [
		'heading' => 'checking versions',
		'php' => 'PHP 5.5 or higher',
	],
	'database' => [
		'heading' => 'database information',
		'host' => 'server host',
		'dbname' => 'database name',
		'dbuser' => 'database username',
		'dbpass' => 'database passwords',
		'pass' => '<span class="color-7">database information successfully pass the test .</span>',
		'fail' => '<span class="color-6">database information fail in test, please check them again .</span>',
	],
	'email' => [
		'heading' => 'email information',
		'host' => 'smtp host',
		'username' => 'smtp username',
		'password' => 'smtp password',
		'port' => 'smtp port',
		'noreply' => 'noreply e-mail',
		'placeholder1' => 'eg: smtp.gmail.com',
		'placeholder2' => 'eg: 587',
		'placeholder3' => 'smtp username',
		'placeholder4' => 'smtp password',
		'placeholder5' => 'eg: no-reply@domain.com',
		'fail' => '<span class="color-6">email information fail in test, please check them again .</span>',
		'pass' => '<span class="color-7">email information successfully pass the test .</span>',
	],
	'rslt' => [
		'fail' => '<span class="color-6">fail</span>',
		'pass' => '<span class="color-7">pass</span>',
	],
	'create' => [
		'pass' => 'the core file successfully created !',
		'fail' => 'the creation of core fail has been faild please repeat the process !'
	],
	'save' => 'check & save',
	'required' => 'all fields are required !',
	'next' => 'first step',
];
<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => 'clicspot.com',
		'secret' => 'key-20348db7fcb79e3dd4308323a36dd9b8',
	],

	'mandrill' => [
		'secret' => 'DPJbBTTmJFar9o4N89-Nyw',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'User',
		'secret' => '',
	],
	
	'sparkpost' => [
        'secret' => 'ac0acd4c1cb4665cd46edb4ada4aea6d24c2f278',
    ],
	
    
//    'google' => [
//        'client_id' => '418301101154-aetpt3gtumq14bjrt62jg7udahejhnfk.apps.googleusercontent.com',
//        'client_secret' => 'aU3rD-mDTQtuJ6VM5AzvFnfJ',
//        'redirect' => 'http://localhost:8000/google/callback',
//    ],
    
    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT')
    ]

];

<?php

return [

    /*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This is the key to be used for data encryption
	|
	*/
    'key' => env('SECRET_ENCRYPT_KEY'),

    /*
	|--------------------------------------------------------------------------
	| Encryption Prefix
	|--------------------------------------------------------------------------
	|
	| This prefix is used to store in database as PREFIX_EncryptedValue
	|
	*/
    'prefix' => env('ENCRYPT_PREFIX', 'TW'),

    /*
	|--------------------------------------------------------------------------
	| Encryption & Decryption Method
	|--------------------------------------------------------------------------
	|
	| This is the method to be used for data encryption & decryption
	|
	*/
    'method' => env('ENCRYPT_METHOD', 'aes-128-ecb'),
];

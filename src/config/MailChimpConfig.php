<?php
return [
    /*
    |--------------------------------------------------------------------------
    |  API Access Token protect these informations safety!!!
    |--------------------------------------------------------------------------
    |
    | Here you may specify your token API Access set an env variable.
    |
    |
    */
    'token_user' => env('token_user', 'your-token'),
	
	/*
	 |--------------------------------------------------------------------------
	 |  API URI !!!
	 |--------------------------------------------------------------------------
	 |
	 | Here you may specify your uri API Access set an env variable.
	 |
	 |
	 */
		
	'base_uri'	=>env('base_uri','uri-mailchimp'),
		
	/*|--------------------------------------------------------------------------
	|  API VERSION !!!
	|--------------------------------------------------------------------------
	|
	| Here you may specify your version API Access set an env variable.
	|
	|
	*/

	'version'=>env('version','version'),


	/*|--------------------------------------------------------------------------
	 |  LIST ID !!!
	 |--------------------------------------------------------------------------
	 |
	 | Here you may specify your list id.
	 |
	 |
	 */
	
	'list-id'=>env('list-id','list-id'),
	
 
];
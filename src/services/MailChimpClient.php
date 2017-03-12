<?php

namespace Groovel\MailChimp\services;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Request;

/**
 * Class MailChimpClient
 * @package Groovel\MailChimp\services
 *
 * Simple php client to request mailchimp API 3.0.
 */
class MailChimpClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    private static $client;
    
    private static $api_version;

    /**
     * @param $api_token
     * @param $base_uri
     * @param array $options Accept same options as Guzzle constructor
     */
    public function __construct($api_token,$base_uri,$version, array $config = [])
    {
        self::$api_version=$version;
    	$config = array_merge($config, [
            'base_uri' => $base_uri,
            'auth'     => ['apikey', $api_token],
        ]);

        self::$client = new \GuzzleHttp\Client($config);
    }

    /**
     * Shortcut.
     *
     * @param $uri
     * @param array $options
     * @return mixed
     */
    private static function getData($uri, $options = [])
    {
         return json_decode(self::$client->get(self::$api_version.'/'.$uri, $options)->getBody()->getContents());
    }

    
  private static function send($action, $method = 'POST', $data = [], array $options = [])
	{
		$json = null;
		if (!empty($data))
		{
			$json = json_encode($data);
		}

		$headers = [];
		$request = new Request($method, $action, $headers, $json);
		$response = self::$client->send($request, $options);
		
		$body = $response->getBody();
		return json_decode($body->getContents());
			
	}
	
	
    
    /**
     * get list for a given list id
     * @param $listid
     * @return mixed
     */
    public static function getList($listid){
    	return self::getData('/lists/'.$listid);
    }
    
    
    /**
     * get list of emails members for a given list id
     * @param $listid
     * @return mixed
     */
    public static function getMembersEmail($listid){
    	return self::getData('/lists/'.$listid.'/members');
    }
    
    
    /**
     * subscribe new user to a given listid
     * @param $email
     * @param $listid
     * @return mixed
     */
    public static function subscribeNewUser($email,$listid,$confirm = false){
    	$data = [
    			'email_address' => $email,
    			'status' => ($confirm ? 'pending' : 'subscribed'),
    	];
    	if (!empty($merge_fields)) $data['merge_fields'] = $merge_fields;
    	$action = self::$api_version.'/lists/'.$listid.'/members/';
    	 
    	return self::send($action, 'POST', $data);
    	
    }
    
    /**
     * get a user from a given listid with a given email
     * @param $email
     * @param $listid
     * @return mixed
     */
    
    public function getMember($email,$listid)
    {
    	$action =  "lists/".$listid."/members/" . md5($email);
   		return self::getData($action);
    }
    
    /**
     * unsubscribe new user to a given listid
     * @param $email
     * @param $listid
     * @return mixed
     */
    public static function unsubscribeUser($email,$listid){
    	$data = [
    			'status' => 'unsubscribed'
    	];
    	if (!empty($merge_fields)) $data['merge_fields'] = $merge_fields;
    	$action = self::$api_version.'/lists/'.$listid.'/members/'. md5($email);
    
    	return self::send($action, 'PATCH', $data);
    	 
    }
    
    /**
     * unsubscribe new user to a given listid
     * @param $email
     * @param $listid
     * @return mixed
     */
    public static function cleanUser($email,$listid){
    	$data = [
     			'status' => 'cleaned'
    	];
    	if (!empty($merge_fields)) $data['merge_fields'] = $merge_fields;
    	$action = self::$api_version.'/lists/'.$listid.'/members/'. md5($email);
    
    	return self::send($action, 'PATCH', $data);
    
    }
    
    
    /**
     * update status user to a given listid to a given email
     * @param $email
     * @param $listid
     * @param $status
     * @return mixed
     */
    public static function updateUser($listid,$email,$status)
    {
    	$data = [
    			'status' => $status
    	];
    	if (!empty($merge_fields)) $data['merge_fields'] = $merge_fields;
    	$action = self::$api_version.'/lists/'.$listid.'/members/'. md5($email);
    
    	return self::send($action, 'PATCH', $data);
    }
    
    
    /**
     * delete a user to a given listid to a given email
     * @param $email
     * @param $listid
     * @return mixed
     */
    public static function deleteUser($listid,$email)
    {
     	$email=md5($email);
    	$action = self::$api_version.'/lists/'.$listid.'/members/'. $email;
    	return self::send($action, 'DELETE', []);
    }

   
}

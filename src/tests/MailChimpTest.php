<?php

class MailChimpTest extends TestCase
{
	
	private $listId='list-id';
	private $fakeemail="fake-email";
	
	/**get list of user emails that has subscribed to newsletter**/
	public function testGetEmailAdressFromListMailChimp()
	{	
		$httpResponse = \MailChimp::getMembersEmail($this->listId);
		foreach($httpResponse->members as $member){
		   var_dump($member->email_address);
		}
	}
	
	public function testNewUserSubscribertoListMailChimp()
	{
		$httpResponse = \MailChimp::subscribeNewUser($this->fakeemail,$this->listId,false);
		var_dump($httpResponse);
	
	}

	public function testUpdateUserSubscribertoListMailChimp()
	{
		$httpResponse = \MailChimp::getMember($this->fakeemail,$this->listId);
		var_dump($httpResponse->id);
		$httpResponse = \MailChimp::updateUser($this->listId,$this->fakeemail,'unsubscribed');
		var_dump($httpResponse);
	
	}
	
	public function testGetUsertoListMailChimp()
	{
		$httpResponse = \MailChimp::getMember($this->fakeemail,$this->listId);
		var_dump($httpResponse->id);
	
	}
	
	public function testUnsubscribeUsertoListMailChimp()
	{
		$httpResponse = \MailChimp::getMember($this->fakeemail,$this->listId);
		$httpResponse = \MailChimp::unsubscribeUser($this->fakeemail,$this->listId);
		var_dump($httpResponse);
	
	}

	public function testDeleteUsertoListMailChimp()
	{
		$httpResponse = \MailChimp::deleteUser($this->listId,$this->fakeemail);
		var_dump($httpResponse);
	
	}
	
	
	
	

   
}

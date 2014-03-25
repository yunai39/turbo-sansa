<?php
namespace Simplex\Security\User;
use Simplex\Security\User\Encoder;
use Simplex\Security\User\UserInterface;
class UserProvider{
	
	
	public function authentificate( $username,$password){
		//Check If the user exist
		if(!$this->userExist($username)){
			throw new \Exception('userDoesNotExist');
		}
		
		
		$user = $this->fetchData($username);
		//get the salt 
		$salt = $user->getSalt();
		
		
		//check for the password
		if(!$user->getEncoder()->checkPass($password,$user->getPassword(), $user->getSalt())){
			throw new \Exception('wrongPassword');
		}
		else {
			return $user;
		}
	}
	
	public function userExist($username){
		return true;
	}
	
	
	/**
	 * This function will fetch the user in the datbase or anything else
	 */
	public function fetchData($username){
		$user = new \Simplex\Security\User\UserInterface('md5');
		$user->setPassword('azerty');
		$user->setUsername('admin');
		$user->addRole('ROLE_ADMIN');
		return $user;
	}
	
}


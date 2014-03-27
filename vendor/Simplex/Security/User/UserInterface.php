<?php
namespace Simplex\Security\User;
use Simplex\Security\User\Encoder;

interface UserInterface{
	
	public function __construct();
	
	
	public function setPassword($password);
	
	
	public function getPassword();
	
	
	public function getSalt();
	
	
	public function setUsername($username);
	
	
	public function getUsername();
	
	
	public function addRole($role);
	
	
	public function getRoles();
	
	
	public function hasRole($role);
	
}

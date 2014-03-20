<?php
namespace Simplex\Security\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Metadata\MessageEntity;
use Simplex\Controller;
use Simplex\Connect\EntityFinder;
use Simplex\Connect\DatabaseManager;;

class SecurityController extends Controller{

	
	public function logoutAction(Request $request){
		$this->session->remove('user');
 		return $this->redirect('login');
	}
	
	public function logCheckAction(Request $request){
		$user = array('username' => "TOTO", 'role' => "ROLE_ADMIN");
		$this->session->set('user',$user);
 		return $this->redirect('home');
	}
}

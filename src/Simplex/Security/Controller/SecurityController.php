<?php
namespace Simplex\Security\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Metadata\MessageEntity;
use Simplex\Controller;
use Simplex\Connect\EntityFinder;
use Simplex\Connect\DatabaseManager;;
use Simplex\Security\User\UserProvider;

class SecurityController extends Controller{

	
	public function logoutAction(Request $request){
		$this->session->remove('user');
 		return $this->redirect('login');
	}
	
	public function logCheckAction(Request $request){
		if($request->getMethod() == 'POST'){
			$username = $request->get('login');
			$password = $request->get('password');
			try{
				$userProvider = new $this->configuration['security']['user_provider']();
				$user = $userProvider->authentificate($username,$password,$this->configuration['security']['user_encoder']);
				$this->session->setUser($user);
			}catch(\Exception $e){
				$this->session->getFlashBag()->add('login_error',$e->getMessage());
			}
		}
 		return $this->redirect('login');
	}
}

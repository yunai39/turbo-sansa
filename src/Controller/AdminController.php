<?php
namespace Controller;
use Simplex\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Simplex\Connect\EntityFinder;
use Simplex\Security\User\Encoder;
use Simplex\Connect\DatabaseManager;
use Model\Form\addUserForm;
use Model\Metadata\UserEntity;
use Model\Metadata\MessageEntity;

class AdminController extends Controller{


	public function addUserFormAction(Request $request){
		$user = new UserEntity();
		$form = new addUserForm();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if($form->isValid($user)){
				echo '<pre>';
				print_r($user);
				echo '</pre>';
    			$dm = new DatabaseManager();
				$user->setSalt($user->unique_md5());
				$user->addRole('ROLE_USER');
				$user->upload();
				$encoder = new Encoder($this->configuration['security']['user_encoder']);
				$user->setPassword($encoder->hashPass($user->getPassword(),$user->getSalt()));
				$ret = $dm->add($user);	
				if($ret){
					return $this->redirect('admin');
				}
			}
		}
		$form->setAction($this->urlGenerator->getUrl('addUser'));
		return $this->render('Admin/addUser.html.twig',array('form' => $form->render()));
	}
	
		
	public function adminPageAction(Request $request){
    	$dm = new DatabaseManager();
		
		$entityFind = new EntityFinder('Model\Metadata\MessageEntity',$dm);
		$messages = $entityFind->getAll();
		$entityFind = new EntityFinder('Model\Metadata\UserEntity',$dm);
		$users = $entityFind->getAll();
 		return $this->render('Admin/adminPage.html.twig',array('users' => $users, 'messages' => $messages));
	}
}


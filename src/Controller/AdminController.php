<?php
namespace Controller;
use Simplex\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Simplex\Connect\EntityFinder;
use Simplex\Connect\DatabaseManager;
use Model\Form\addUserForm;

class AdminController extends Controller{


	public function addUserFormAction(Request $request){
		$form = new addUserForm();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if($form->isValid()){

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


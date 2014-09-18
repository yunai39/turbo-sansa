<?php
namespace Controller;
use Simplex\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Simplex\Connect\EntityFinder;
use Simplex\Security\User\Encoder;
use Simplex\Connect\DatabaseManager;
use Model\Form\addUserForm;
use Model\Form\addPictureForm;
use Model\Metadata\UserEntity;
use Model\Metadata\MessageEntity;
use Model\Metadata\PictureEntity;

class AdminController extends Controller{


	public function addUserFormAction(Request $request){
		$user = new UserEntity();
		$form = new addUserForm();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if($form->isValid($user)){
    			$dm = $this->getDatabaseManager();
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
	
	public function addPictureFormAction(Request $request){
		$picture = new PictureEntity();
		$form = new addPictureForm();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if($form->isValid($picture)){
    			$dm = $this->getDatabaseManager();
				var_dump($picture);
				var_dump($picture->upload());
				$ret = $dm->add($picture);	
				var_dump($ret);
				if($ret){
					return $this->redirect('admin');
				}
			}
		}
		$form->setAction($this->urlGenerator->getUrl('addPicture'));
		return $this->render('Admin/addPicture.html.twig',array('form' => $form->render()));
	}
		
	public function adminPageAction(Request $request){
    	$dm = $this->getDatabaseManager();
		
		$entityFind = $dm->getFinder('Model\Metadata\MessageEntity');
		$messages = $entityFind->getAll();
		$entityFind = $dm->getFinder('Model\Metadata\UserEntity');
		$users = $entityFind->getAll();
		
		$entityFind = $dm->getFinder('Model\Metadata\PictureEntity');
		$pictures = $entityFind->getAll();
 		return $this->render('Admin/adminPage.html.twig',array('users' => $users, 'messages' => $messages, 'pictures' => $pictures));
	}
}


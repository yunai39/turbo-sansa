<?php
namespace Controller;
use Simplex\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Simplex\Connect\EntityFinder;
use Simplex\Connect\DatabaseManager;;

class AdminController extends Controller{


	public function addUserFormAction(Request $request){
		if($request->getMethod() == 'POST'){
			print_r($request->files->get('pictureProfil'));
		}
		return $this->render('Admin/addUser.html.twig');
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


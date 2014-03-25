<?php
namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Metadata\MessageEntity;
use Simplex\Controller;
use Simplex\Connect\EntityFinder;
use Simplex\Connect\DatabaseManager;;

class HomeController extends Controller{
	
    public function indexAction(Request $request)
    {
    	$dm = new DatabaseManager();
		$entityFind = new EntityFinder('Model\Metadata\MessageEntity',$dm);
		$messages = $entityFind->getAll();
 		return $this->render('Default/home.html.twig',array('messages' => $messages));
    }
	
	public function adminPageAction(Request $request){
 		return $this->render('Admin/adminPage.html.twig');
	}

}

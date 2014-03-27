<?php
namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Metadata\MessageEntity;
use Model\Form\TestForm;
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

	public function formTestAction(Request $request){
		$form = new TestForm();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if($form->isValid()){
				echo 'Le formulaire est valide';
			}else{
				echo 'Error';
			}
		}
		$form->setAction($this->urlGenerator->getUrl('formTest'));
		return $this->render('Default/formTest.html.twig', array('form' => $form->render()));
	}
}

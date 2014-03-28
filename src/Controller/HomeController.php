<?php
namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Metadata\MessageEntity;
use Model\Metadata\UserEntity;
use Model\Form\TestForm;
use Simplex\Controller;
use Simplex\Connect\EntityFinder;
use Simplex\Connect\DatabaseManager;
use Simplex\Connect\Addendum\ReflectionAnnotatedClass;
use Simplex\Form\Validator as Validator;

class HomeController extends Controller{
	
    public function indexAction(Request $request)
    {
    	$dm = new DatabaseManager();
		$entityFind = new EntityFinder('Model\Metadata\MessageEntity',$dm);
		$messages = $entityFind->getAll();
		$messages[0]->getAttributs();
		/*$entity = new UserEntity();
		$entity->setEmail('skqd@veto.cl');
		$dm->add($entity);*/
 		return $this->render('Default/home.html.twig',array('messages' => $messages));
    }

	public function formTestAction(Request $request){
		$form = new TestForm();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if($form->isValid()){

			}
		}
		$form->setAction($this->urlGenerator->getUrl('formTest'));
		return $this->render('Default/formTest.html.twig', array('form' => $form->render()));
	}
}

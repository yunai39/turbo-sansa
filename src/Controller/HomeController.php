<?php
namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Metadata\MessageEntity;
use Model\Metadata\UserEntity;
use Model\Form\TestForm;
use Simplex\Controller;
use Simplex\Connect\EntityFinderPDO;
use Simplex\Connect\DatabaseManagerPDO;
use Simplex\Connect\Addendum\ReflectionAnnotatedClass;
use Simplex\Form\Validator as Validator;

class HomeController extends Controller{
	
    public function indexAction(Request $request)
    {
    	// Remplacer ça par get DM
    	$dm = $this->getDatabaseManager();
		$entityFind = $dm->getFinder('Model\Metadata\PictureEntity');
		$pictures = $entityFind->getAll();
 		return $this->render('Default/home.html.twig',array('pictures' => $pictures));
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

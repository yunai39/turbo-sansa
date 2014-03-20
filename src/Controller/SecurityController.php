<?php
namespace Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Metadata\MessageEntity;
use Simplex\Controller;
use Simplex\Connect\EntityFinder;
use Simplex\Connect\DatabaseManager;;

class SecurityController extends Controller{
	
    public function loginAction(Request $request)
    {
 		return $this->render('Security/login.html.twig');
    }

}

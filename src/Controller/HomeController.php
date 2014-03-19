<?php
namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\LeapYear;
use Model\Metadata\CourseMeta;
use Simplex\Controller;

class HomeController extends Controller{
	
    public function indexAction(Request $request)
    {

 		return $this->render('Default/home.html.twig');
    }

}

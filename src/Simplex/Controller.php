<?php
namespace Simplex;

use Twig_Environment;
use Twig_Loader_Filesystem;

use Symfony\Component\HttpFoundation\Response;

/**
 * Controller
 * This class is an implementation of controller
 */
class Controller{
    /**
    * Twig_Environment Twig  
	* @access       protected
    * @var Twig_Environment $twig
    */
	protected $twig;
	
    /**
    * Simplex\Routing\UrlGenerator Generator  
	* @access       protected
    * @var Simplex\Routing\UrlGenerator $generator
    */
	protected $urlGenerator;
	
    /**
    * Symfony\Component\HttpFoundation\Session\Session session  
	* @access       protected
    * @var Session $seesion
    */
	protected $session;

	/**
	 * Configuration array
	 * @var	array 	$configuration
	 */
	protected $configuration;
	
	/**
	* setTwig
	*
	*
	* @param        Twig_Environnement    $twig    Twig environnement
	* @access       public
	* @author       Marine BENOIT
	*/
	public function setTwig($twig){
		$this->twig = $twig;	
		return $this;
	}
	
	
	
	public function decode($array){
		
		foreach ($array as $key => $value) {
			if(is_array($value)){
				$array[$key] = $this->decode($value);
			}
			else{
				$array[$key] = utf8_encode($value);
			}
			return $array;
		}
	}
	/**
	* setSession
	*
	*
	* @param        Symfony\Component\HttpFoundation\Session\Session    $session    The session
	* @access       public
	* @author       Marine BENOIT
	*/
	public function setSession($session){
		$this->session = $session;	
		return $this;
	}
	
	/**
	* setUrlGenerator
	*
	*
	* @param        Simplex\Routing\UrlGenerator    $urlGenerator    Url generator
	* @access       public
	* @author       Marine BENOIT
	*/
	public function setUrlGenerator($urlGenerator){
		$this->urlGenerator = $urlGenerator;	
	}

	public function setConfiguration($configuration){
		$this->configuration = $configuration;
		return $this;
	}
	/**
	* render
	*
	*
	* @param        string    $view    path to the view
	* @param        array    $parameters    array of parameters
	* @param		Response $response
	* @return		Symfony\Component\HttpFoundation\Response The response
	* @access       public
	* @author       Marine BENOIT
	*/
	public function render($view, array $parameters = array(), Response $response = null)
    {
    	//$parameters = $this->decode($parameters);
		$template = $this->twig->loadTemplate($view);
		return new Response($template->display($parameters));
    }
	
	/**
	* redirect
	* Redirection 
	*
	* @param        string    $action    name of the road
	* @param        array    $arg    array of arguments
	* @access       public
	* @author       Marine BENOIT
	*/
	public function redirect($action, $arg = null){
		header('Location: '.$this->urlGenerator->getUrl($action , $arg));  
	}
	
	public function getUser(){
		if($this->session->has('user')){
			return unserialize($this->session->get('user'));
		}
		else return false;
	}
}

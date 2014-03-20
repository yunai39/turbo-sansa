<?php
namespace Simplex;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Simplex\Routing\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Twig_Environment;
use Symplex\Routing\RouteCollection;
use Simplex\Routing\UrlGenerator;
use Simplex\Session;

/**
 * Framework
 * This class will allow use to get the function associated with each url
 */
class Framework
{
	
    /**
    * Simplex\Routing\UrlMatcher Matcher  
	* @access       protected
    * @var Simplex\Routing\UrlMatcher $matcher
    */
    protected $matcher;
		
    /**
    * Symfony\Component\HttpKernel\Controller\ControllerResolver resolver  
	* @access       protected
    * @var Simplex\Routing\UrlMatcher $resolver
    */
    protected $resolver;
		
    /**
    * Simplex\Routing\UrlGenerator Generator  
	* @access       protected
    * @var Simplex\Routing\UrlGenerator $generator
    */
	protected $generator;
		
    /**
    * Twig_Environment Twig  
	* @access       protected
    * @var Twig_Environment $twig
    */
	protected $twig;
 
    /**
    * Simplex\Session session  
	* @access       protected
    * @var Session $seesion
    */
	protected $session;

	/**
	* __construct
	*
	* This function is the constructor for the Framework
	*
	* @param        UrlMatcher    			$matcher    	The road matcher
	* @param        ControllerResolver    	$resolver    	The controller resolver
	* @param        UrlGenerator    		$generator    	The url generator
	* @param        Twig_Environment    	$twig    		Twig environnement
	* @param        Session    				$session    	The session
	* @access       public
	* @author       Marine BENOIT
	*/
    public function __construct(UrlMatcher $matcher, ControllerResolver $resolver, UrlGenerator $generator,Twig_Environment $twig,Session $session)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
		$this->generator = $generator;
		$this->twig = $twig;
		$this->session = $session;
    }
	
	
	/**
	* generate
	*
	* This function call the urlgenerator
	*
	* @param        string   $name    name of the road
	* @param        array   $parameters    parameters for the url
	* @param        bool   $absolute   Whether the url should be absolute or no (not implemented yet)
	* @return 		string 	the url generated
	* @access       public
	* @author       Marine BENOIT
	*/
	public function generate($name, $parameters = array(), $absolute = false)
    {
		return $this->generator->generate($name,$parameters,$absolute);
	}
	
	
	/**
	* handle
	*
	* This function will be call every time the ask for a new page, it will handle every thing looking for the action, executing that action and then rendering the result
	*
	* @param        Request   $request    name of the road
	* @return 		Response  the response
	* @access       public
	* @author       Marine BENOIT
	*/
    public function handle(Request $request)
    {
        try {
 			$route = $this->matcher->getArg($request);
			if($route['neededRole'] != 'NO_ROLE'){
				if($this->session->has('user') == false){
					
					if(!$this->session->has('refUrl')){
						$this->session->set('refUrl' ,$request->getUri());
					}
					header('Location: '.$this->generator->getUrl('login'));   
				}
				else{
					$user = $this->session->get('user');
					if($user['role'] != $route['neededRole']){
						if(!$this->session->has('refUrl')){
						$this->session->set('refUrl' ,$request->getUri());
						}
						header('Location: '.$this->generator->getUrl('login'));   
					}
				}
			}
			$request->attributes->add($route);

 
            $controller = $this->resolver->getController($request);
			//controle du droit d'admin
			
			$controller[0]->setTwig($this->twig);
			$controller[0]->seturlGenerator($this->generator);
			$controller[0]->setSession($this->session);
            $arguments = $this->resolver->getArguments($request, $controller);
 
            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
        	$template = $this->twig->loadTemplate('Notfound.html.twig');
            return new Response($template->display(array()));
        } 
        catch (\Exception $e) {
        	$template = $this->twig->loadTemplate('Error.html.twig');
            return new Response($template->display(array('error' => $e->getMessage())));
        }
    }
}
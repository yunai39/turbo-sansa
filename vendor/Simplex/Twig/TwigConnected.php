<?php

namespace Simplex\Twig;


/**
 * TwigConnected
 * This class is a twig extention to check if the user is connected
 */
class TwigConnected extends \Twig_Extension
{
	
    /**
    * Symfony\Component\HttpFoundation\Session\Session session  
	* @access       protected
    * @var Session $seesion
    */
	protected $session;
	
		/**
	* __construct
	*
	* This function is the constructor for the TwigConnected
	*
	* @param        Session    				$session    	The session
	* @access       public
	* @author       Marine BENOIT
	*/
	public function __construct($session){
		$this->session = $session;	
	}
	
    public function getFunctions()
    {
        return array(
            'isConnected' => new \Twig_Function_Method($this, 'isConnected'),
        );
    }
	/**
	* isConnected
	*
	* This function will return true or false depending if the user is connected
	*
	* @return 		bool 	Whether the user is connected or no
	* @access       public
	* @author       Marine BENOIT
	*/
    public function isConnected()
    {
    	return $this->session->has('login');
    }

    public function getName()
    {
        return 'is_connected';
    }
}
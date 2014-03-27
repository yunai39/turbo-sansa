<?php
namespace Simplex\Routing;

class RoutingException extends \Exception{
	public function __construct() {
    	parent::__construct('The page you are asking for was not found', 404);
	}
	
	public function __toString() {
    	return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  	}
}

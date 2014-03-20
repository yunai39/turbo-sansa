<?php
namespace Simplex\Connect;

class Entity{
	
	public function __construct(array $data = array()){
		$this->hydrate($data);
	}
	
	public function hydrate(array $data)
	{
	  foreach ($data as $key => $value)
	  {
	    $method = 'set'.ucfirst($key);
	    if (method_exists($this, $method))
    	{
    		$this->$method($value);
		}
	  }
	}
	
	
	public function getAttributs(){
		return get_object_vars($this);
	}
	
	public static function getTableName(){
		return trim(__CLASS__, 'Entity');
	}
}

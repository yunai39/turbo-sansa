<?php
namespace Simplex\Connect;

class Entity{
	
	public function __construct(array $data){
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
	
	public static function getTableName(){
		return trim(__CLASS__, 'Entity');
	}
}

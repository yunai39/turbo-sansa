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
		$class = explode('\\',trim( get_called_class(), 'Entity'));
		return end($class);
	}
	
	public function copy($entity){
		foreach (get_object_vars($this) as  $value)
	  	{
		    $method = 'set'.ucfirst($value);
			$methodG = 'get'.ucfirst($value);
		    if (method_exists($this, $method))
			{
				$this->$method($entity->$methodG());
			}
	  	}
	} 
}

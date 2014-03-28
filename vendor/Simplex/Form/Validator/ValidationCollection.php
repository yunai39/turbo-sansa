<?php
namespace Simplex\Form\Validation;

use Simplex\Form\Validation\Model\ValidatorModel;

class ValidationCollection{
	
	protected $collection;
	
	public function __construct(){
		$this->collection = array();
	}
	
	public function add($name,ValidationModel $validator){
		$this->collectio[$name] = $validator;
		return $this;
	}
	
	public function get($name){
		if($this->has($name)){
			return $this->collection[$name];
		}else{
			return $this;
		}
	}
	
	public function has($name){
		return isset($this->collection[$name]);
	}
	
	public function remove($name){
		if($this->has($name)){
			unset($this->collection[$name]);
			return true;
		}
		else{
			return false;
		}
	}
	
}

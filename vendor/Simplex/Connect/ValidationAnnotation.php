<?php
namespace Simplex\Connect;
use Simplex\Connect\Addendum\Annotation;
use Simplex\Connect\Addendum\Addendum;
use Simplex\Form\Validator as Validator;
class ValidationAnnotation extends Annotation {
	protected $name;
	protected $param;
	
	public function getValidationName(){
		return $this->tableName;
	}
	
	public function getParam(){
		return $this->columns;
	}
	
	
	public function check($value){
		return 'Validator\\'.$this->name::check($value,$this->$parma);
	}
}
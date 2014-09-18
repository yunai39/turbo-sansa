<?php
namespace Simplex\Connect;
use Simplex\Connect\Addendum\Annotation;
use Simplex\Connect\Addendum\Addendum;
use Simplex\Form\Validator as Validator;
class ValidationAnnotation extends Annotation {
	protected $name;
	protected $param;
	
	public function getValidationName(){
		return $this->name;
	}
	
	public function getParam(){
		return $this->columns;
	}
	
	
	public function check($value){
		$n = 'Simplex\Form\Validator\\'.$this->name;
		return $n::check($value,$this->param);
	}
}
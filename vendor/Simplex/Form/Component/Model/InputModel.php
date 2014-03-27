<?php

namespace Simplex\Form\Component\Model;

class InputModel{
	protected $value;
	protected $validator;
	protected $config;
	protected $errors;
	
	public function __construct(array $config = array(),array $validators = array()){
		$this->config = $config;	
		$this->validator = $validators;
		$this->errors = array();
	}

	
	public function setValue($value){
		$this->value = $value;
		return $this;
		
	}
	
	public function getValue(){
		return $this->value;
	}
	
	public function render(){
		return null;	
	}
	
	public function isValid(){
		$boolTest = true;
		foreach($this->validator as $validator){
			if(! $this->errors[] = $validator::check($this->value)){
				$boolTest = false;
			}
		}
		return $boolTest;
	}
	
	public function getErrors(){
		return $this->errors;
	}
	
	
}

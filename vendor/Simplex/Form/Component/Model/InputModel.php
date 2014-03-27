<?php

namespace Simplex\Form\Component\Model;

class InputModel{
	protected $value;
	protected $validator;
	protected $config;
	
	public function __construct(){
		$this->validator = null;
		$this->config = null;
	}
	
	public function setConfig(array $config){
		$this->config = $config;
	}
	
	public function setValidator(array $validator){
		$this->validator = $validator;
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
		
		// check through the validator
		
		return true;
	}
	
	
}

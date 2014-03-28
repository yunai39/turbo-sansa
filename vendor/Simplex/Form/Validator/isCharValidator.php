<?php

namespace Simplex\Form\Validator;
use Simplex\Form\Validator\Model\ValidatorModel;

class isCharValidator extends ValidatorModel{
	public static function check($toCheck, $checkElement = array()){
		if(ctype_alpha($toCheck)){
			return true;
		}
		else{
			return \Simplex\Form\Validator\isCharValidator::getMessage();
		}
	}
	
	
	public static function getMessage($param = null){
		return 'The value need to be alphabetic character';
	}
}

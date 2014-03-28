<?php

namespace Simplex\Form\Validator;
use Simplex\Form\Validator\Model\ValidatorModel;

class isAlphANumericValidator extends ValidatorModel{
	public static function check($toCheck, $checkElement = array()){
		if(ctype_alnum($toCheck)){
			return true;
		}
		else{
			return \Simplex\Form\Validator\isAlphANumericValidator::getMessage();
		}
	}
	
	
	public static function getMessage($param = null){
		return 'The value need to be alpha numeric characters';
	}
}

<?php

namespace Simplex\Form\Validator;
use Simplex\Form\Validator\Model\ValidatorModel;

class EmailValidator extends ValidatorModel{
	public static function check($toCheck, $checkElement = array()){
		if(filter_var($toCheck, FILTER_VALIDATE_EMAIL)){
		    return true;
		}
		else{
			return \Simplex\Form\Validator\EmailValidator::getMessage();
		}
	}
	
	
	public static function getMessage($param = null){
		return 'The value need to be an email';
	}
}

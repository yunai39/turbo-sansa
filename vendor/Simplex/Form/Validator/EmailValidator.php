<?php

namespace Simplex\Form\Validator;
use Simplex\Form\Validator\Model\ValidatorModel;

class EmailValidator extends ValidatorModel{
	public static function check($toCheck,array $checkElement = array()){
		if(filter_var($toCheck, FILTER_VALIDATE_EMAIL)){
		    return true;
		}
		return false;
	}
	
	
}

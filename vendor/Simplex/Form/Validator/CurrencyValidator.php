<?php

namespace Simplex\Form\Validator;
use Simplex\Form\Validator\Model\ValidatorModel;

class CurrencyValidator extends ValidatorModel{
	public static function check($toCheck,array $checkElement = array()){
		if(preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $toCheck)){
			return true;
		}
		else{
			return \Simplex\Form\Validator\CurrencyValidator::getMessage();
		}
	}
	
	public static function getMessage($param = null){
		return 'The value need to be in currecny format XXXXXXX.XX';
	}
	
}

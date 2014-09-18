<?php

namespace Simplex\Form\Validator;
use Simplex\Form\Validator\Model\ValidatorModel;

class LengthValidator extends ValidatorModel{
	public static function check($toCheck, $checkElement = array()){
		if (strlen ($toCheck) <= $checkElement['max'] and strlen ($toCheck) >= $checkElement['min'] ){
			return true;
		}else{
			return LengthValidator::getMessage($checkElement);
		}
	}
	
	public static function getMessage($param =null){
		return 'The value need to be between '.$param['min'].' characters and '.$param['max'].' characters';
	}
}

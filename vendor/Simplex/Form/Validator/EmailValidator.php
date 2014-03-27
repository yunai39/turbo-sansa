<?php

namespace Simplex\Form\Validator;

class EmailValidator{
	public static function check($toCheck,array $checkElement = array()){
		if(filter_var($toCheck, FILTER_VALIDATE_EMAIL)){
		    return true;
		}
		return false;
	}
	
	
}

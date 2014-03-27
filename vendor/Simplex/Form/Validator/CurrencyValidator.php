<?php

namespace Simplex\Form\Validator;

class CurrencyValidator{
	public static function check($toCheck,array $checkElement = array()){
		return preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $toCheck);
	}
	
	
}

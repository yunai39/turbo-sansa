<?php

namespace Simplex\Form\Validator;

interface ValidatorModel{
	public static function check($toCheck,array $checkElement);
}

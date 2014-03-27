<?php

namespace Model\Form;

use Simplex\Form\Form;
use Simplex\Form\Validator\EmailValidator;
class TestForm extends Form{
	public function setObject(){
		$this->add('champText', 'text', array(
				'label' => 'Ceci est un text:',
				'value' => 'toto',
				'placeHolder' => 'Saississez un text'
			),
			array(
				'Simplex\Form\Validator\EmailValidator'
			)
		)
			->add('submit','submit');
		
	}
}

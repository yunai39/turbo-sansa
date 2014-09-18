<?php

namespace Model\Form;

use Simplex\Form\Form;
use Simplex\Form\Validator\EmailValidator;
class TestForm extends Form{
	public function setObject(){
		$this->add('articleName', 'text', 
				array(
					'label' => 'Name of the article',
				),
				array(
				)
			)
			->add('price','text',array(
					'label' => 'Price of an Apple',
					'pattern' => '^\$?([0-9]*)(\.[0-9]{1,2})?$'
				),
				array(
					'Simplex\Form\Validator\CurrencyValidator'
				)
			)
			->add('Password','password',
				array(
					'label' => 'Password',
					'placeHolder' =>	'Saisissez votre Mot de Passe' 
				)
			)
			->add('submit','submit')
			->add('reset','reset');
	}
}

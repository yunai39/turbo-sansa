<?php

namespace Model\Form;

use Simplex\Form\Form;
use Simplex\Form\Validator\EmailValidator;
class addUserForm extends Form{
	public function setObject(){
		$this->add('username', 'text', 
				array(
					'label' => 'Username',
					'placeHolder' => 'Type a user name',
				),
				array(
				)
			)
			->add('firstName','text',array(
					'label'			=> "First Name"
				)
			)
			->add('lastName','text',array(
					'label'			=> "Last Name"
				)
			)
			->add('password','password',array(
					'label' 		=> 'Password',
					'placeHolder'	=> 'Type a password',
					'min'			=> 6,
					'max'			=> 14
				),
				array(
				)
			)
			->add('email','text',array(
					'label'			=> "Email"
				)
			)
			->add('submit','submit')
			->add('reset','reset');
	}

	
	
	public function getName(){
		return 'form_add_user';
	}
}

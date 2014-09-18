<?php

namespace Model\Form;

use Simplex\Form\Form;
use Simplex\Form\Validator\EmailValidator;
class addPictureForm extends Form{
	public function setObject(){
		$this->add('date','text',array(
					'label'			=> "Date"
				)
			)
			->add('title','text',array(
					'label'			=> "Titre"
				)
			)
			->add('file','file', array('label' => 'Fichier Img'))
			->add('submit','submit')
			->add('reset','reset');
			
	}

	
	
	public function getName(){
		return 'form_add_picture';
	}
}

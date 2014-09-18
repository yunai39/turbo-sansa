<?php
namespace Simplex\Form\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Simplex\Form\Validator\Model\ValidatorModel;


class FileValidator extends ValidatorModel{
	public static function check($toCheck,array $checkElement = array()){
		if(!in_array($file->getExtension(), $checkElement['exts'])){
			return \Simplex\Form\Validator\FileValidator::getMessage();
		}	
		if($file->getClientSize() > $checkElement['maxSize']){
			return \Simplex\Form\Validator\FileValidator::getMessage();
		}
		return true;
	}
	
	public static function getMessage($param = null){
		return 'The file is not valid';
	}
}

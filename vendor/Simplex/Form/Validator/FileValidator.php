<?php
namespace Simplex\Form\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Simplex\Form\Validator\Model\ValidatorModel;


class FileValidator extends ValidatorModel{
	public static function check($toCheck,array $checkElement = array()){
		if(!in_array($file->getExtension(), $checkElement['exts'])){
			return false;
		}	
		if($file->getClientSize() > $checkElement['maxSize']){
			return false;
		}
		return true;
	}
	
}

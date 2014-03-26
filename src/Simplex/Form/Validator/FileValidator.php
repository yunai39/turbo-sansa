<?php
namespace Simplex\Form\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileValidator{
	public static function check($toCheck,array $checkElement){
		if(!in_array($file->getExtension(), $checkElement['exts'])){
			return false;
		}	
		if($file->getClientSize() > $checkElement['maxSize']){
			return false;
		}
		return true;
	}
	
}

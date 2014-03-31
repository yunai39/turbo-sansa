<?php
namespace Simplex\Connect\TypeAttribut;

use Simplex\Connect\TypeAttribut\AttributTypeModel;
class IntTypeAnnotation extends AttributTypeModel{
	protected $autoIncrement = FALSE;
	protected $defaultValue = 0;
	public function check($value){
		if($this->autoIncrement == true){
			return false;
		}
		
	}
	public function getAutoIncrement(){
		return $this->getAutoIncrement;
	}
}

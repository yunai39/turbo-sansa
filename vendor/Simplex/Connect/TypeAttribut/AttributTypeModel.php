<?php
namespace Simplex\Connect\TypeAttribut;
use Simplex\Connect\Addendum\Annotation;
class AttributTypeModel extends Annotation{
	protected $size;
	protected $defaultValue = '';
	protected $attribut;
	protected $isNull = FALSE;
	protected $attribut;
	protected $index;
	
	public function getSize(){
		return $this->size;
	}
	
	public function getDefaultValue(){
		return $this->defaultValue;
	}
	
	public function getAttribut(){
		return $this->attribut;
	}
	
	public function getIsNull(){
		return $this->isNull;
	}
	
	
	public function getAttribut(){
		return $this->attribut;
	}
	
	public function getIndex(){
		return $this->index;
	}
	
	public function check($value){
		return false;
	}
	
	public function checkIsNull($value){
		if($value != '' and $value !== null){
			return true;
		}elseif($this->isNull){
			return true;
		}else{
			if($this->defaultValue != '' and $this->defaultValue !== null){
				return true;
			}
			return false;
		}
	}
	
	public function checkSize($value){
		if(strlen($value)> $this->size)
			return false;
		return true;
	}
}

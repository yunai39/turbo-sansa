<?php

namespace Simplex\Form\Component\Model;

trait CustomFieldTrait{
	public function generateCustomField(){
		if(isset($this->config['customField'])){
			$render = '';
			foreach($this->config['customField'] as $key => $value){
				$render .= " ".$key."='".$value."'";
			}
			return $render;
		}
	}
}

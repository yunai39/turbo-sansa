<?php

namespace Simplex\Form\Component;

use Simplex\Form\Component\Model\InputModel;
use Simplex\Form\Component\Model\CustomFieldTrait;
class TextInput extends InputModel{
	use CustomFieldTrait;
	public function render(){
		$name = $this->config['name'];
		$render = '';
		
		
		if(isset($this->config['value']) and $this->getValue() == ''){$this->setValue($this->config['value']);}
		if(isset($this->config['divClass'])){
			$render .= "<div class='".$this->config['divClass']."'";
		}else{
			$render .= "<div>";
		}
		// Ajout du label si dénfinit
		if(isset($this->config['label'])){
			if(isset($this->config['id'])){
				$id = $this->config['id'];
			}
			else{
				$id = $name;
			}
			$render .="<label for='".$id."' >".$this->config['label']."</label>";
		}
		//ajout de l'input
		$render .= "<input type='text' id='".$id."' name='".$name."' ";
		if(isset($this->config['placeHolder'])){$render .= " placeholder='".$this->config['placeHolder']."'";}
		if(isset($this->config['maxLength'])){$render .= " maxLength='".$this->config['maxLength']."'";}
		if(isset($this->config['readOnly'])){$render .= " readOnly='".$this->config['readOnly']."'";}
		if(isset($this->config['size'])){$render .= " size='".$this->config['size']."'";}
		if(isset($this->config['defaultValue'])){$render .= " defaultValue='".$this->config['defaultValue']."'";}
		if(isset($this->config['disabled'])){$render .= " disabled='".$this->config['disabled']."'";}
		if(isset($this->config['pattern'])){$render .= " pattern='".$this->config['pattern']."'";}
		if(isset($this->config['customField'])){$render .=  $this->generateCustomField();}
		$render .= " value='".$this->getValue()."'";
		$render .= " />";
		$render .= "</div>";
		return $render;
	}

}

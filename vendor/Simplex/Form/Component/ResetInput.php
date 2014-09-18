<?php

namespace Simplex\Form\Component;

use Simplex\Form\Component\Model\InputModel;

class ResetInput extends InputModel{
	public function render(){
		$name = $this->config['name'];
		$render = '';
		if(isset($this->config['divClass'])){
			$render .= "<div class='".$this->config['divClass']."'";
		}else{
			$render .= "<div>";
		}
		if(isset($this->config['id'])){
			$id = $this->config['id'];
		}
		else{
			$id = $name;
		}
		//ajout de l'input
		$render .= "<input type='reset' id='".$id."' name='".$name."' ";
		if(isset($this->config['value'])){$render .= " value='".$this->config['value']."'";}
		$render .= " />";
		$render .= "</div>";
		return $render;
	}
	
	public function isValid(){
		return true;
	}
}

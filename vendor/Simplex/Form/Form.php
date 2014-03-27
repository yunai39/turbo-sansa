<?php
namespace Simplex\Form;
use Symfony\Component\HttpFoundation\Request;
class Form{
	
	protected $arrayElement;
	protected $error;
	protected $method;
	protected $actionUrl;
	protected $encrypt;
	
	const METHOD_POST = "POST";
	const METHOD_GET = "GET";
	
	const ENCRYPT_APPLICATION = "application/x-www-form-urlencoded";
	const ENCRYPT_MULTIPART = "multipart/form-data";
	const ENCRYPT_TEXT = "text/plain"; 
	
	public function __construct(){
		$this->arrayElement = array();
		$this->error = array();
		$this->method = self::METHOD_POST;
		$this->encrypt = self::ENCRYPT_MULTIPART;
		$this->setObject();
	}
	
	public function setObject(){
		return null;
	}
	
	public function setAction($actionUrl){
		$this->actionUrl = $actionUrl;
	}
	
	public function setMethod($method){
		$this->method = $method;
	}
	
	public function add($name,$type,$arrayConf = array(),$arrayValidator = array()){
		$inputN = 'Simplex\Form\Component\\'.ucfirst($type).'Input';
		$arrayConf['name'] = $name;
		$this->arrayElement[$name] = new $inputN($arrayConf,$arrayValidator);
		return $this;
	}
		
		
	public function render(){
		$render = <<<EOF
			<form id="{$this->getName()}" action="$this->actionUrl" method="$this->method" 	enctype="$this->encrypt" >
EOF;
		foreach($this->arrayElement as $value){
			
			$render .= <<<EOF
				{$value->render()}
EOF;
		}
		$render .= <<<EOF
			</form>
EOF;
		return $render;
	}
	
	public function getValue($key){
		if(!isset($this->arrayElement[$key])){
			throw new \Exception();
		}
		return $this->arrayElement[$key]->getValue();
	}
	
	public function isValid(){
		$test = true;
		foreach($this->arrayElement as $key => $value){
			if(!$value->isValid()){
				$error[$key] = $value->getErrors();
				$test = false;
			}
		}
		return $test;
	}
	
	public function getErrors(){
		return $this->error;
	}
	
	
	// %TODO how to handle file submit, and if the form is in method GET
	public function bind(Request $request){
		foreach($this->arrayElement as $key => $value){
			if($request->request->has($key)){
				$value->setValue($request->get($key));
			}else{
				$this->error[$key] = 'noElementInrequest';
			}
		}
	}
	
	public function getName(){
		return 'form_model';
	}
	
}

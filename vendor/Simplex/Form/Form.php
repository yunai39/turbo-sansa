<?php
namespace Simplex\Form;
use Simplex\Connect\Addendum\ReflectionAnnotatedProperty;
use Symfony\Component\HttpFoundation\Request;
use Simplex\Form\Component\FileInput;
class Form{
	
	protected $arrayElement;
	protected $error;
	protected $method;
	protected $actionUrl;
	protected $encrypt;
	protected $entity;
	protected $mapped;
	
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
		$this->mapped = false;
	}
	
	public function setMapped($mapped){
		$this->mapped = $mapped;
		return $this;
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
			
			$render .= '<div>';
			if($value->hasError()){
				$render .= $value->renderError().'<br />';
			}
			$render .= <<<EOF
				{$value->render()}
			</div>
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
	
	public function isValid($entity = null){
		$test = true;
		if($entity != null){
			$attributs = $entity->getAttributsClass();
			unset($attributs['id']);
			
			foreach($this->arrayElement as $key => $value){
				if(array_key_exists($key, $attributs)){
					$propriety = new ReflectionAnnotatedProperty(get_class ($entity) , $key);
					$v = $propriety->getAllAnnotations('Simplex\Connect\ValidationAnnotation');
					if($v != null){
						foreach($v as $validator){
							$ret = $validator->check($this->arrayElement[$key]->getValue());
							if( $ret !== true ){
								$this->arrayElement[$key]->addError($ret);
								$test = false;
							}
						}	
					}
					$m = 'set'.ucfirst($key);
					$entity->$m($this->arrayElement[$key]->getValue());
				}
				
			}
		}
		foreach($this->arrayElement as $key => $value){
			if(!$value->isValid()){
				$test = false;
			}
			if($value->hasError()){
				$this->error[$key] = $value->getErrors(); 
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
			
			if($value instanceof FileInput){
				if($request->files->has($key)){
					$value->setValue($request->files->get($key));
				}
			}
			elseif($request->request->has($key)){
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

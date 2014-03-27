<?php
namespace Model\Metadata;
use Simplex\Connect\Entity;
use Simplex\Connect\TableAnnotation  as TableAnnotation;

/**
 * @TableAnnotation("messages")
 */
class MessageEntity extends Entity{
	protected $id;
	protected $title;
	protected $message;
	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}
	
	public function getTitle(){
		return $this->title;
	}
	public function setTitle($title){
		$this->title = $title;
		return $this;
	}
	
	public function getMessage(){
		return $this->message;
	}
	public function setMessage($message){
		$this->message = $message;
		return $this;
	}
	

}

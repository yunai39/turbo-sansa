<?php
namespace Model\Metadata;
use Simplex\Connect\Entity;
use Simplex\Connect\TableAnnotation  as TableAnnotation;
use Simplex\Connect\AttributAnnotation  as AttributAnnotation;
use Simplex\Connect\TypeAttribut  as TypeAttribut;

/**
 * @TableAnnotation(tableName="messages", database="default")
 */
class MessageEntity extends Entity{
	
	/**
	 * @AttributAnnotation(name= "id", column s ="id",type=@TypeAttribut\IntTypeAnnotation(size=5,defaultValue=5))
	 */
	protected $id;

	/**
	 * @AttributAnnotation(name= "id", columns = "id", type = @TypeAttribut\IntTypeAnnotation( size=5 , defaultValue=5 ))
	 */
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

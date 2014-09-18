<?php
namespace Model\Metadata;
use Simplex\Connect\Entity;
use Simplex\Connect\TableAnnotation  as TableAnnotation;
use Simplex\Connect\AttributAnnotation  as AttributAnnotation;
use Simplex\Connect\TypeAttribut  as TypeAttribut;

/**
 * @TableAnnotation(tableName="picture", database="default")
 */
class PictureEntity extends Entity{
	
	/**
	 * @AttributAnnotation(name= "id", column s ="id",type=@TypeAttribut\IntTypeAnnotation(size=5,defaultValue=5))
	 */
	protected $id;


	/**
	 * @AttributAnnotation(name= "title", columns="title",type="string")
	 */
	protected $title;
	/**
	 * @AttributAnnotation(name= "date", columns="date",type="string")
	 */
	protected $date;
	/**
	 * @AttributAnnotation(name= "picturePath", columns="picturePath",type="string")
	 */
	protected $picturePath;
	
	
		
	public $file;
	public function setFile($file){
		$this->file = $file;
		return $this;
	}
	public function getFile(){
		return $this->file;
	}
	public function upload(){
		if($this->file == null){
			return false;
		}
		
		$this->file->move('profileUser',$this->file->getClientOriginalName());
		$this->picturePath = 'profileUser/'.$this->file->getClientOriginalName(); 
		return true;
	}
	
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
	
	public function getDate(){
		return $this->date;
	}
	public function setDate($date){
		$this->date = $date;
		return $this;
	}
	
	
	public function getPicturePath(){
		return $this->picturePath;
	}
	public function setPicturePath($picturePath){
		$this->picturePath = $picturePath;
		return $this;
	}

}

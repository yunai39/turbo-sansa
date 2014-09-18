<?php
namespace Simplex\Connect;
use Simplex\Connect\Addendum\Annotation;
use Simplex\Connect\Addendum\Addendum;

use Simplex\Connect\Addendum\Annotation\TypeAttribut as TypeAttribut;
class AttributAnnotation extends Annotation {
	protected $name;
	protected $columns;
	protected $type;
	
	public function getTableName(){
		return $this->tableName;
	}
	
	public function getColumns(){
		return $this->columns;
	}
	
	public function getType(){
		return $this->type;
	}
	
}
<?php
namespace Simplex\Connect;
use Simplex\Connect\Addendum\Annotation;
use Simplex\Connect\Addendum\Addendum;

/** @Target("class") */
class TableAnnotation extends \Simplex\Connect\Addendum\Annotation {
	protected $tableName;
	protected $database;
	
	public function getTableName(){
		return $this->tableName;
	}
	
}
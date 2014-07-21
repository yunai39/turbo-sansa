<?php

namespace Simplex\Connect;
use Simplex\Connect\Addendum\ReflectionAnnotatedClass;
use Simplex\Connect\Addendum\ReflectionAnnotatedProperty;
use Simplex\Connect\Entity;

class DatabaseManager{
	protected $dbs;
	protected $config;
	protected $finders;
	protected $connect;
	
	public function __construct($databaseInfo){
		$this->config = $databaseInfo;
		$finder = array();
	}
	
	public function getConnect($dbName = 'default'){ return NULL; 	}
	
	public function add(Entity $entity){ return NULL; 	}
	
	public function update($entity){return NULL;	}
	
	public function getFinder($entityClass){return NULL; }
}

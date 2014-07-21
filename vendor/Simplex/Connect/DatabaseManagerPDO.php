<?php

namespace Simplex\Connect;
use Simplex\Connect\Addendum\ReflectionAnnotatedClass;
use Simplex\Connect\Addendum\ReflectionAnnotatedProperty;
use Simplex\Connect\Entity;

class DatabaseManagerPDO extends DatabaseManager{
	protected $dbs;
	protected $config;
	protected $finders;
	protected $connect;
	
	public function __construct(){
		include(__DIR__.'/../../../config/databaseInfo.php');
		$this->config = $databaseInfo;
		$this->finders = array();
		$this->connect = array();
	}
	
	public function getConnect($dbName = 'default'){
		if(isset($this->config[$dbName]['link'])){
			return $this->config[$dbName]['link'];
		}
		else{
			$dn = $this->config[$dbName]['driver'].':host='.$this->config[$dbName]['host'].';dbname='.$this->config[$dbName]['db'];
			$this->config[$dbName]['link'] = new \PDO($dn,$this->config[$dbName]['username'],$this->config[$dbName]['password']);
			return $this->config[$dbName]['link'];
		}
	}
	
	public function add(Entity $entity){
		$attributs = $entity->getAttributs();
		unset($attributs['id']);
		echo '<pre>';
		print_r($attributs);
		echo '</pre>';
		//Check that the value are valid
		$error = array();
		foreach($attributs as $key => $value){
			$propriety = new ReflectionAnnotatedProperty(get_class ($entity) , $key);
			$v = $propriety->getAllAnnotations('Simplex\Connect\AttributAnnotation');
			if($v != null ){
			}
		}
		
		$sql = "INSERT INTO ".$entity->getTableName()." ";
		$columns = '';
		$values = '';
		$firstLoop = true;
		foreach ($attributs as $key => $value) {
			if(!$firstLoop){
				$columns .= ',';
				$values .= ',';
			}
			$columns .= $key;
			$values .= ':'.$key;
			$firstLoop = false;
		}
		$sql .= '('.$columns.') VALUES ('.$values.')';
		$request = $this->getConnect()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

		return $request->execute($attributs);
	}
	
	public function update($entity){
		$attributs = $entity->getAttributs();
		$id = $attributs['id'];
		$sql = "UPDATE ".$entity->getTableName()." SET ";
		$firstLoop = true;
		foreach ($attributs as $key => $value) {
			if(!$firstLoop){
				$sql .= ',';
			}
			$sql .= $key.'=:'.$key;
			$firstLoop = false;
		}
		$sql .= ' WHERE id=:id';
		
		$request = $this->getConnect()->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
		return $request->execute($attributs);
	}
	
	public function getFinder($entityClass){
		if(isset($this->finders[$entityClass])){
			return $this->finders[$entityClass];
		}else{
			$this->finders[$entityClass] = new EntityFinderPDO($entityClass,$this->getConnect());
			return $this->finders[$entityClass] ;
		}
		
	}
}

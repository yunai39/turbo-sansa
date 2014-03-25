<?php

namespace Simplex\Connect;
use Simplex\Connect\DatabaseManage;

class DatabaseManager{
	protected $dbs;
	protected $config;
	
	public function __construct(){
		include(__DIR__.'/../../../config/databaseInfo.php');
		$this->config = $databaseInfo;
	}
	
	public function getConnect($dbName = 'default'){
		return PDOConnect::getConnect($this->config[$dbName]);
	}
	
	public function add($entity){
		$attributs = $entity->getAttributs();
		unset($attributs['id']);
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
		var_dump($sql);
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
}

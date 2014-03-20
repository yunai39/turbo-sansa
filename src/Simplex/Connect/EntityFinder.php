<?php

namespace Simplex\Connect;
use Simplex\Connect\MySQLConnect;

class EntityFinder{
	protected $db;
	protected $entityClass;
	public function __construct($entityClass){
		$this->db =  MySQLConnect::getConnect();
		$this->entityClass = $entityClass;
	}
	
	public function get($id){
		$tableName = call_user_func($this->entityClass.'::getTableName');
		$sql = "SELECT * FROM ".$tableName." where id=:id";
		$request = $this->db->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
		$request->execute(array( ':id' => $id));
		if(!$request){
			return false;
		}
		$data = $request->fetch(\PDO::FETCH_ASSOC);
		return new $this->entityClass($data);
	}
	
	public function getBy(array $array){
		$tableName = call_user_func($this->entityClass.'::getTableName');
		$sql = "SELECT * FROM ".$tableName;
		$notFirst = false;
		foreach ($array as $key => $value) {
			if($notFirst){
				$sql .= " AND ";
			}
			else{
				$sql .=" WHERE ";
			}
			$sql .= " ".$key." = :".$key." ";  
		}
		$request = $this->db->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
		$request->execute($array);
		if(!$request){
			return false;
		}
		$entities = array();
		while($data = $request->fetch(\PDO::FETCH_ASSOC)){
			$entities[$data['id']] = $this->entityClass($data);
		}
		return $entities;
	}
	
	public function getAll(){
		$tableName = call_user_func($this->entityClass.'::getTableName');
		$sql = "SELECT * FROM ".$tableName;
		$request = $this->db->query($sql);
		if(!$request){
			return false;
		}
		$entities = array();
		while($data = $request->fetch(\PDO::FETCH_ASSOC)){
			$entities[$data['id']] = new $this->entityClass($data);
		}
		return $entities;

	}
}

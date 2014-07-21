<?php

namespace Simplex\Connect;

class PDOConnect extends Connect{
	public static $connect;
	
	public static function getConnect($databaseInfo){
		
		if(self::$connect != Null){
			return self::$connect;
		}
		else{
			$dn = $databaseInfo['driver'].':host='.$databaseInfo['host'].';dbname='.$databaseInfo['db'];
			self::$connect = new \PDO($dn,$databaseInfo['username'],$databaseInfo['password']);
			return self::$connect;
		}
	}

}

<?php

namespace Simplex\Connect;

class MySQLConnect{
	public static $connect;
	
	public static function getConnect(){
		
		if(self::$connect != Null){
			return self::$connect;
		}
		else{
			include(__DIR__.'/../../databaseInfo.php');
			
			$dn = $databaseInfo['driver'].':host='.$databaseInfo['host'].';dbname='.$databaseInfo['db'];
			self::$connect = new \PDO($dn,$databaseInfo['username'],$databaseInfo['password']);
			return self::$connect;
		}
	}

}

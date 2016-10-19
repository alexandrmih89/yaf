<?php
namespace database;
class Database{
	private $_connection;	
	private static $_instance;
	public $last_query;
	
	public static function getInstance(){
		if(!self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {		
		$config = new \Yaf_Config_Ini(APP_PATH . '/config/app.ini','db');
	 	try {
	 		$this->_connection = new \PDO(
	 			'mysql:host=' . $config->db->host . ':'.$config->db->port.';'.
	 			'dbname=' . $config->db->dbname . ';charset=UTF8', 
	 			$config->db->username, 
	 			$config->db->password
	 		);
	 		
		} catch (\PDOException $e) {
		    echo 'Error: ' . $e->getMessage();
		    exit;
		}				
	}
	
	private function __clone(){}
	
	public function getConnection(){
		return $this->_connection;
	}
	
	public function query($sql){
		$this->last_query = $sql;
		$database = self::getInstance();
		$connection = $database->getConnection();		
		try{
			$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);			
			$stmt = $connection->query($sql);			
			$result = $stmt->fetchALL(\PDO::FETCH_ASSOC);
			unset($connection);
		}catch(\PDOException $e){
			echo $e->getMessage();
			exit;		
		}
		
		return $result;
	}
	
	public function query_fetch_obj($sql, $class=''){
		$this->last_query = $sql;
		$database = self::getInstance();
		$connection = $database->getConnection();		
		try{
			$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);			
			$stmt = $connection->query($sql);			
			$result = $stmt->fetchAll(\PDO::FETCH_CLASS, $class);
			unset($connection);
		}catch(\PDOException $e){
			echo $e->getMessage();
			exit;		
		}
		
		return $result;
	}
	
	public function exec($sql){
		$this->last_query = $sql;
		$database = self::getInstance();
		$connection = $database->getConnection();		
		try{
			$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);			
			$count = $connection->exec($sql);			
			unset($connection);
		}catch(\PDOException $e){
			echo $e->getMessage();
			exit;		
		}
		
		return $count;
	}
	
	public function lastInsertId(){
		$database = self::getInstance();
		$connection = $database->getConnection();
		return $connection->lastInsertId();
	}
	
	public function quote($param){
		$database = self::getInstance();
		$connection = $database->getConnection();		
		$result = $connection->quote($param);
		unset($connection);
		
		return $result;
	}
	
	public function quote_array(array $arr){
		$result = array();
		$database = self::getInstance();		 
		$connection = $database->getConnection();		
		if(!empty($arr)){			
			foreach ($arr as $key => $value) {
				$result[$key] = $connection->quote($value);
			}
		}
		unset($connection);		
		return $result;
	}
	
}

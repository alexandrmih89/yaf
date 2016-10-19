<?php

/**
 * WARNING!!! NOT CHANGE!!!
 *
 * @author Alexandr
 */

use database\Database;
class DatabaseObject {
	protected static $table_name;	
	protected static $db_fields;
	private static $_instance;
	
	public static function getInstance(){
		if(!self::$_instance){
			$class_name = get_called_class();			
			self::$_instance = new $class_name;
		}
		return self::$_instance;
	}

	public static function findAll(){
		$sql = "SELECT * FROM ".static::$table_name."";
		return static::find_by_sql($sql);		
	}
	
	public static function find_by_id($uid=0){
		$id = abs((int)$uid);
		$sql = "SELECT * FROM ".static::$table_name." WHERE id={$id} LIMIT 1";
		unset($id);
		$obj_array = static::find_by_sql($sql);		
		return !empty($obj_array) ? array_shift($obj_array) : false;
	}
	
	public static function find_by_sql($sql=''){
		$db = Database::getInstance();
		$obj_array = $db->query_fetch_obj($sql, get_called_class());		
		return $obj_array;
	}
	
	public static function count_all(){
		$db = Database::getInstance();
		$sql = "SELECT count(*) FROM ".static::$table_name;
		$result_set = $db->query($sql);
		$arr = array_shift($result_set);
		unset($result_set, $sql, $db);
		return $arr[key($arr)];
	}	
	
	protected function attributes(){
		//return get_object_vars($this);
		$attributes = array();
		foreach (static::$db_fields as $field) {
			if(property_exists($this, $field)){
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	protected function sanitized_attributes() {
		$db = Database::getInstance();
		return $db->quote_array($this->attributes());
	}

	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}

	public function create(){
		$db = Database::getInstance();
		
		$attributes = $this->sanitized_attributes();		
		
		$sql = "INSERT INTO ".static::$table_name." (".join(", ", array_keys($attributes)).") "
			 . "VALUES (".join(", ", array_values($attributes)).")";
		
		if($db->exec($sql)){
			$this->id = $db->lastInsertId();			
			return true;
		}else{
			return false;
		}
	}
	
	public function update(){
		$db = Database::getInstance();
		$id = abs((int)$this->id);
		$attributes = $this->sanitized_attributes();
		
		$attribute_pairs = array();
		foreach ($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}={$value}";
		}
		$sql = "UPDATE " . static::$table_name . " SET " . join(", ", $attribute_pairs) . " "
			 . "WHERE id = {$id}";
		
		if($db->exec($sql) == 1){
			return true;
		}else{
			return false;
		}
	}
	
	public function delete(){
		$db = Database::getInstance();
		$id = abs((int)$this->id);
		$sql = "DELETE FROM ".static::$table_name." WHERE id = {$id} LIMIT 1";
		if($db->exec($sql) == 1){
			return true;
		}else{
			return false;
		}
	}
}

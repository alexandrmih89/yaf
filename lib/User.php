<?php
use database\Database;
/**
 * Description of User
 *
 * @author alexas
 */
class User extends DatabaseObject {
	
	protected static $table_name = 'users';
	protected static $db_fields = array('id', 'username', 'password', 'first_name', 'last_name');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	public static function authenticate($username="", $password="") {

	    /*$db = Yaf_Registry::get('db');
		$found_user = $db->getConnection();*/
		
		$db = Database::getInstance();
		$result_array = array();		
		$user = $db->quote_array(array('username'=>$username, 'password'=>$password));
	    $sql  = "SELECT * FROM ".self::$table_name." ";
	    $sql .= "WHERE username = {$user['username']} ";
	    //$sql .= "AND password = {$user['password']} ";
	    $sql .= "LIMIT 1";

	    $result_array = self::find_by_sql($sql);	
		
		if(!empty($result_array)){
			$obj = array_shift($result_array);
			return (self::is_password_verify($password, $obj->password)) ? $obj : false;		
		}else{			
			return false;
		}
		//return !empty($result_array) ? array_shift($result_array) : false;	
	}
	
	public function full_name(){
		if(isset($this->first_name) && isset($this->last_name)){
			return $this->first_name . ' ' . $this->last_name;
		}else{
			return "";
		}
	}
	
	public function get_password_hash($password){
		return password_hash($password, PASSWORD_BCRYPT);
	}
	
	public static function is_password_verify($password, $hash) {
		if(password_verify($password, $hash)) {
			return true;
		}else {
			return false;
		}
	}
	
}

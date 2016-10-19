<?php
use database\Database;
class CategoryModel extends DatabaseObject
{
	public $id;
	public $parent;
	public $name;
	public $path;
	public $visible;
	public $table_ads;
	protected static $table_name = 'category';
	protected static $db_fields = array('id', 'parent', 'name', 'path', 'visible', 'table_ads');
	
	public static function find_by_path($path=''){
		$db = Database::getInstance();
		$path = $db->quote($path);
		$sql = "SELECT id, parent, name, path, visible, table_ads "
				. "FROM ".static::$table_name." "
				. "WHERE path={$path} AND visible = 1 "
				. "LIMIT 1";		
		unset($path);
		$obj_array = static::find_by_sql($sql);		
		return !empty($obj_array) ? array_shift($obj_array) : false;	
	}
	
	public static function find_by_parent($parent=''){
		$db = Database::getInstance();
		$parent = $db->quote($parent);
		$sql = "SELECT id, parent, name, path, visible, table_ads "
				. "FROM ".static::$table_name." "
				. "WHERE parent={$parent} "
				. "AND visible = 1";		
		unset($path);
		$obj_array = static::find_by_sql($sql);		
		return !empty($obj_array) ? $obj_array : false;
	}
	
	public function create_category_with_ads_table(){
		$db = Database::getInstance();
		if($this->create()){		
			$sql = "CREATE TABLE IF NOT EXISTS `".$this->table_ads."` (
				`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				`title` varchar(50) DEFAULT NULL,
				`text` text,
				`price` float DEFAULT NULL,
				`tree` int(11) DEFAULT NULL,
				`ctime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				`mtime` timestamp NULL DEFAULT NULL,
				PRIMARY KEY (`id`)
			)";
			$res = $db->exec($sql);
			return true;
		}else{
			return false;
		}		
	}
	
	public function delete_category_and_ads_table(){
		$db = Database::getInstance();
		if($this->delete()){		
			$sql = "DROP TABLE IF EXISTS ".$this->table_ads;
			$res = $db->exec($sql);
			return true;
		}else{
			return false;
		}
	}
}


<?php
use database\Database;
class ListModel extends DatabaseObject
{
	public $id;
	public $list;
	public $level;	
	protected static $table_name = 'list';
	protected static $db_fields = array('id', 'list', 'level');
	public $errors = array();
	
	public function save(){
		if(isset($this->id)){
			$this->update();
		}else{
			if(!empty($this->errors)){return false;}
			
			if(empty($this->list)){
				$this->errors[] = "Enter the name of the list.";
				return false;
			}
			
			if(empty($this->level)){
				$this->errors[] = "Enter the type of the list.";
				return false;
			}
			
			if($this->create()){
				return true;
			}
		}
	}
	
	
}


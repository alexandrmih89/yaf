<?php

class CatalogModel
{
	public static function getSubcatByCatPath($path){
		$return = array();
		
		$db = Yaf_Registry::get ('db');
		$connection = $db->getConnection();	
		
		$sql = "SELECT *
				FROM category 
				WHERE parent IN (SELECT id 
									FROM category 
									WHERE path = '{$path}'
								)";
		
		$stmt = $connection->query($sql);
		$return = $stmt->fetchALL(PDO::FETCH_ASSOC);	
		
		return $return;
	}
	
	public static function getAdsByTables($tables){
		$return = array();		
		$db = Yaf_Registry::get ('db');
		$connection = $db->getConnection();
		//пагинация
		$sql = "SELECT count(*) FROM ".implode(' UNION SELECT count(*) FROM ', $tables);		
		$stmt = $connection->query($sql);			
		$counts = $stmt->fetchALL(PDO::FETCH_ASSOC);
		$total_count = 0;
		foreach ($counts as $count){			
			$total_count += $count["count(*)"];
		}		
		$per_page = isset($_GET['per-page']) && $_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 20;		
		if(isset($_GET['page'])){	$page = (int)$_GET['page'];
		}else{	$page = 1;	}	
		$pagination = new Pagination($page, $per_page, $total_count);
		//получаем объявления с учетом пагинации
		$sql = "SELECT id,title,text,price,ctime "
				. "FROM ".implode(' UNION SELECT id,title,text,price,ctime FROM ', $tables)." LIMIT {$per_page} OFFSET {$pagination->offset()}";		
		$stmt = $connection->query($sql);		
		$return['ads'] = $stmt->fetchALL(PDO::FETCH_ASSOC);
		$return['pagination'] = $pagination;
		
		return $return;
	}

	public static function getCategoryName($category){
		
		$db = Yaf_Registry::get ('db');
		$connection = $db->getConnection();
		$path = $connection->quote($category);
			
		$sql = "SELECT name FROM category WHERE path = {$path}";
		$stmt = $connection->query($sql);
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($result){
			$return = $result;
		}else{
			$return = false;
		}
		
		unset($connection, $path, $sql, $stmt, $result);		
		
		return $return;
		
	}
	
	public static function getCategoryData($category){
		$db = Yaf_Registry::get ('db');
		$connection = $db->getConnection();
		$path = $connection->quote($category);
			
		$sql = "SELECT id, parent, name, path, visible, table_ads FROM category WHERE path = {$path}";
		$stmt = $connection->query($sql);
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($result){
			$return = $result;
		}else{
			$return = false;
		}
		
		unset($connection, $path, $sql, $stmt, $result);		
		
		return $return;
	}

	public static function getPagiData($item_count, $num){

		//узнаем текущую страницу
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}
		// Находим общее число страниц
		$total = intval(($item_count - 1) / $num) + 1; 
		// Определяем начало сообщений для текущей страницы 
		$page = intval($page); 
		// Если значение $page меньше единицы или отрицательно 
		// переходим на первую страницу 
		// А если слишком большое, то переходим на последнюю 
		if(empty($page) or $page < 0) $page = 1; 
		if($page > $total) $page = $total; 
		// Вычисляем начиная к какого номера 
		// следует выводить сообщения 
		$start = $page * $num - $num;
		unset($page, $total, $item_count, $num);
		return $start;
	}

	public static function getAllCategory(){
		$return = array();
		
		$db = Yaf_Registry::get ('db');
		$connection = $db->getConnection();
		try{	
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT id, parent, name, path, table_ads FROM category WHERE visible = 1 AND parent > 0";
		
		$stmt = $connection->query($sql);
		
		$return = $stmt->fetchALL(PDO::FETCH_ASSOC);
		
		}catch(PDOException $e){
			echo $e->getMessage();exit;
		}
		unset($db, $connection, $sql, $stmt);
		return $return;
	}

	public static function getAsstdCategory(array $categories){
		
		$return = array();

		foreach ($categories as $key=>$category) {			
			if($category['parent'] == '1'){
				$return[$key]['category'] = $category;
				foreach ($categories as $item) {
					if($item['parent'] == $category['id']){						
						$return[$key]['child'][] = $item;
					}else{						
						continue;
					}
				}				
			}else{
				continue;
			}
		}
		
		return $return;		
	}
}
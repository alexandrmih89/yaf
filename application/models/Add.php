<?php
//use database\dataBase;
class AddModel
{
	public static function setAd($data){
		
		
		
		$text = htmlspecialchars(trim(strip_tags($data['text'])));
		$tree = abs((int)$data['category']);
		$title = htmlspecialchars(trim(strip_tags($data['title'])));
		$price = abs((float)$data['price']);
		
		/********save file**********/
		$photo = new Images();
		$photo->caption = $data['caption'];
		$photo->attach_file($_FILES['file_uploaded']);
		if($photo->save()){
			$message = 'YES';
		}else{
			$message = join('<br />', $photo->errors);
		}
		//echo $message;
		//print_r($data);exit;
		
		/********save file**********/
		
		
		
		
		$db = Yaf_Registry::get('db');
		$connection = $db->getConnection();			
            
		//ловим ошибки запросов	
		try{
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$text = $connection->quote($text);
			$tree = $connection->quote($tree);
			$title = $connection->quote($title);
			$price = $connection->quote($price);
			//$sql = "INSERT INTO ads (title, text, tree, price) VALUES($title, $text, $tree, $price)";
			$sql = "INSERT INTO ".$data['category']." (title, text, tree, price) VALUES($title, $text, $tree, $price)";
			
			$result = $connection->exec($sql);
			if($result === false){
				die('error!');
			}
		}catch(PDOException $e){
			echo $e->getMessage();exit;
		}
		
		unset($data, $text, $tree, $title, $price, $db, $connection, $sql);

	}

}
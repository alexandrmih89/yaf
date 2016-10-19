<?php

class Funcs{
	public static $uri=array(); //uri в виде массива
	function __construct(){
		//Заполняем uri
		if(strpos($_SERVER['REQUEST_URI'],'?')!==false){	
			$uri=substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'?'));
		}else{ 
			$uri=$_SERVER['REQUEST_URI'];			
		}
		$search = array('.html', '.htm');
		$replace = array('', '');
		$uri = str_replace($search, $replace, $uri);	
		
		if($uri{strlen($uri)-1} === '/'){
			$uri = substr($uri,1,(strlen($uri)-1)-1);
		}else{
			$uri = substr($uri,1,strlen($uri)-1);
		}		
		self::$uri=explode('/',$uri);
	}	
}


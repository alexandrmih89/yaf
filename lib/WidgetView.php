<?php

/**
 * Description of View
 *
 * @author alexas
 */
class WidgetView {
	public static function widget($templ,$row=array()){
		$widget_dir = \Yaf_Registry::get ('widget_dir');		
		foreach($row as $c6e0b8a9=>$c1608d6){			
			eval('$'.$c6e0b8a9.'=$c1608d6;');
		}
		ob_start();			
			include($widget_dir.'/views/'.$templ.'.php');
			$str=ob_get_contents();
		ob_end_clean();
		print $str;		
	}
	
	public static function getWidget($templ,$row=array()){
		$widget_dir = \Yaf_Registry::get ('widget_dir');
		foreach($row as $c6e0b8a9=>$c1608d6){
			eval('$'.$c6e0b8a9.'=$c1608d6;');
		}
		ob_start();
			include($widget_dir.'/views/'.$templ.'.php');
			$str=ob_get_contents();
		ob_end_clean();
		return $str;
	}
}

<?php
class AlertWidget{
	public static function run(){
		$message = Yaf_Registry::get('message');		
		WidgetView::widget('alert',array('message'=>$message));
	}
}
?>
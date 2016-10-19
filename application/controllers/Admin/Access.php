<?php

class Admin_AccessController extends FrontController
{
    public function init(){
		parent::init();
		
		$session = Yaf_Registry::get('session');		
		if(!$session->is_logged_in()){
			header("Location: /admin/login");
    		exit;
		}
	}
}
<?php

/**
 * Description of Session
 *
 * @author Alexandr
 */
class Session {
	private static $_instance;
	private $_logged_in = false;
	public $user_id;
	public $session;
	public $message;
	public $message_code;
	public $message_status;

	private function __clone(){}

	public static function getInstance(){
		if(!self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->session = \Yaf_Session::getInstance();
		$this->session->start();
		$this->check_message();
		$this->check_login();
		if($this->is_logged_in()){
			//action to take right away if user is logged in
		}else{
			//action to take right away if user is not logged in
		}
	}

	public function is_logged_in() {
    	return $this->_logged_in;
	}

	private function check_login() {		
		if($this->session->__isset('user_id')){
			$this->user_id = $this->session->__get('user_id');
			$this->_logged_in = true;
		}else{
			unset($this->user_id);
			$this->_logged_in = false;
		}		
  	}
	
	private function check_message(){
		if($this->session->__isset('message')){			
			$this->message = $this->session->__get('message')["message"];
			$this->message_status = $this->session->__get('message')["status"];
			$this->message_code = $this->session->__get('message')["code"];
			$this->session->__unset('message');
		}else{
			$this->message = '';
			$this->message_status = '';
			$this->message_code = '';
		}
	}

	public function login($user) {
		// database should find user based on username/password
		if($user){
			$this->user_id = $user->id;
			$this->session->__set('user_id', $user->id);
			$this->logged_in = true;
		}
	}

  	public function logout() {
    	$this->session->__unset('user_id');
    	unset($this->user_id);
   		$this->_logged_in = false;
	}
	
	private function get_msg_status($code){
		switch($code){
			case 1:	 $return = 'success'; break;
			case 2:	 $return = 'info'; break;
			case 3:	 $return = 'warning'; break;
			case 4:	 $return = 'danger'; break;
			default: $return = 'info';  break;
		}
		return $return;
	}
	
	
	public function message($msg="", $code=1) {		
		if(!empty($msg)){
			$status = $this->get_msg_status($code);
			$this->session->__set('message', 
								  array('message'=>$msg,'code'=>$code,'status'=>$status)
								);
			
		}else{
			return array('message'=>$this->message, 
						'code'=>$this->message_code, 
						'status'=>$this->message_status);
		}
	}
	
}

<?php

class AuthorizationController extends FrontController
{
    protected $layout = 'admin';
    
   

    public function loginAction() 
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
		$post = $this->getRequest()->getPost();
        if(($this->getRequest()->isPost()) && ($post['submit'] == 'Login')){
        	$username = trim(strip_tags($post['username']));
  			$password = trim(strip_tags($post['password']));  			
			$session = Yaf_Registry::get('session');  			
			//find user by name and password
  			$found_user = User::authenticate($username, $password);			  
  			if ($found_user) {
   				$session->login($found_user);
				//log_action('Login', "{$found_user->username} logged in.");
				header("Location: /admin");
    			exit;
			} else {
				// username/password combo was not found in the database
			    $message = "Username/password combination incorrect.";
			}
        }

        $this->heading = 'Home Page';
        $this->getView()->setLayout($this->layout);
        $this->getView()->assign('title', 'Вход');
        $this->getView()->display('index/login.phtml');
    }

    public function logoutAction() 
    {
        $session = Yaf_Registry::get('session');
		$session->logout();
		if(!$session->is_logged_in()){
			header("Location: /admin/login");
    		exit;
		}
    }

    
}
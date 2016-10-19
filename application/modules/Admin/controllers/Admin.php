<?php

class AdminController extends Admin_AccessController
{
    protected $layout = 'admin';   

    public function indexAction() 
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        $this->heading = 'Home Page';
        $this->getView()->setLayout($this->layout);
        $this->getView()->assign('title', 'Админка');
        $this->getView()->display('index/index.phtml');
       	
    }
    
   

}

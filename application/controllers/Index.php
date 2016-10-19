<?php

class IndexController extends FrontController
{
    protected $layout = 'index';   

    public function indexAction() 
    {
    	Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        $this->heading = 'Home Page';
        $this->getView()->setLayout($this->layout);
        
        $this->getView()->assign('title', 'Доска объявлений');       
        $categories = CatalogModel::getAsstdCategory(CatalogModel::getAllCategory());
        $this->getView()->assign('categories',$categories);
        //$aaa = $this->getView()->render('index/index.phtml',array('categories'=>$categories));
        $this->getView()->display('index/index.phtml');
       	
    }
}

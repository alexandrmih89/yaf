<?php
//use database\dataBase;
class AddController extends FrontController
{
    protected $layout = 'index';
    
   

    public function indexAction() 
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        $this->heading = 'Home Page';
        $this->getView()->setLayout($this->layout);
        $this->getView()->assign('title', 'Разместить объявление');

        $categories = CatalogModel::getAsstdCategory(CatalogModel::getAllCategory());
		
        $this->getView()->assign('categories', $categories);
        $this->getView()->display('add/add.phtml');
       	
    }

    public function addtodbAction(){
        if($this->getRequest()->isPost()){
			$post = $this->getRequest()->getPost();
			//var_dump($this->getRequest()->isGet());exit;
            //$text = trim(strip_tags($_POST['text']));
            //$tree = trim(strip_tags($_POST['category']));
            $model = AddModel::setAd($post);
            header("Location: /add");
            exit();
        }else{
            Yaf_Dispatcher::getInstance()->autoRender(FALSE);
           $this->forward("error", "err404");            
        }
    }
}

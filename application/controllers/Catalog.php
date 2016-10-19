<?php

class CatalogController extends FrontController
{
    protected $layout = 'index';
    
    public function categoryAction() 
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        $params = $this->getRequest()->getParams();
		$path = trim(strip_tags($params['category']));
		
		$category_data = CatalogModel::getCategoryData($path);
		if($category_data){
			//получаем информацию о подкатегориях
			$subcategories = CatalogModel::getSubcatByCatPath($path);
			//составляем массив таблиц объявлений подкатегорий
			$tables = array();
			foreach ($subcategories as $sub){
				$tables[] = $sub['table_ads'];
			}
			//получаем объявления
			$ads = CatalogModel::getAdsByTables($tables);

			$this->heading = 'Home Page';
			$this->getView()->setLayout($this->layout);
			$this->getView()->assign('title', 'Каталог');

			$this->getView()->assign('category_title', $category_data['name']);

			$this->getView()->assign('ads', $ads['ads']);
			$this->getView()->assign('pagi', $ads['pagination']);
			$this->getView()->display('catalog/catalog.phtml');
		}else{
			//ошибка 404
            $this->forward("error", "err404");
		}	
    }

    public function subcategoryAction() 
    {
		Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        $params = $this->getRequest()->getParams();
		$path = trim(strip_tags($params['subcategory']));
		
		$category_data = CatalogModel::getCategoryData($path);
		if($category_data){
			$tables = array();
			$tables[] = $category_data['table_ads'];
			//получаем объявления
			$ads = CatalogModel::getAdsByTables($tables);
			$this->heading = 'Home Page';
			$this->getView()->setLayout($this->layout);
			$this->getView()->assign('title', 'Каталог');

			$this->getView()->assign('category_title', $category_data['name']);

			$this->getView()->assign('ads', $ads['ads']);
			$this->getView()->assign('pagi', $ads['pagination']);
			$this->getView()->display('catalog/catalog.phtml');
		}else{
			//ошибка 404
            $this->forward("error", "err404");
		}
		    	
    }
    
}

<?php

class CategoryController extends Admin_AccessController
{
    protected $layout = 'admin';   

    public function indexAction() 
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        //$categories = Admin_CategoryModel::getCategory();
		$sql = "SELECT id, parent, name, path, visible, table_ads FROM category WHERE parent = 1";
		$categories = CategoryModel::find_by_sql($sql);
        $this->getView()->setLayout($this->layout);
        $this->getView()->assign('title', 'Админка|Категории');
        $this->getView()->assign('categories', $categories);
        $this->getView()->display('category/index.phtml');
              	
    }
	
	public function createAction()
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);      
        $this->getView()->setLayout($this->layout);
        $params = $this->getRequest()->getParams();
		
        if($this->getRequest()->isPost()){
            $post = $this->getRequest()->getPost();
			//var_dump($post);exit;
			$cat = CategoryModel::getInstance();
			$cat->parent = isset($params['category_id']) ? $params['category_id'] : 1;
			$cat->name = $post['name'];
			$cat->path = $post['path'];
			$cat->table_ads = $post['table'];
			$cat->visible = isset($post['visible']) ?  $post['visible'] : 1;
			//$cat->save();
			$cat->create_category_with_ads_table();
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit;
        }
        $this->getView()->assign('title', 'Админка|Добавить категорию');        
        $this->getView()->display('category/create.phtml');
    }
	
    public function editAction()
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);        
        $this->getView()->setLayout($this->layout);
        $params = $this->getRequest()->getParams();
        if($this->getRequest()->isPost()){
			$post = $this->getRequest()->getPost();            
			$cat = CategoryModel::find_by_id($params['id']);
			$cat->name = $post['name'];
			$cat->path = $post['path'];
			$cat->visible = $post['visible'];
			$cat->save();
            header("Location: ".$_SERVER['REQUEST_URI']);
            exit;
        }
        $this->getView()->assign('title', 'Админка|Редактировать категорию');        
        
        $category = CategoryModel::find_by_id($params['id']);
		$this->getView()->assign('category', $category);

        //get subcategories by category id        
		$subcategories = CategoryModel::find_by_parent($params['id']);
		//var_dump($subcategories);exit;
        $this->getView()->assign('subcategories', $subcategories);
		
        $this->getView()->display('category/edit.phtml');
    }

    public function deleteAction()
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
		$referer = $_SERVER['HTTP_REFERER'];
		$url_arr = parse_url($referer);
		$parts = explode('/', $url_arr['path']);
		
		//удаляем категорию если запрос из раздела /admin/category
		if($url_arr['host'] == $_SERVER['HTTP_HOST'] && 
		   $parts[1]		== 'admin' && 
		   $parts[2]		== 'category')
		{
			$params = $this->getRequest()->getParams();	
			$subcategories = CategoryModel::find_by_parent($params['id']);
			$session = Yaf_Registry::get('session');
			//если не содержит подкатегорий
			if(!$subcategories){
				$category = CategoryModel::find_by_id($params['id']);
				$category->delete_category_and_ads_table();
				//$category->delete();
				//msg				
				$session->message('Категория успешно удалена');
			}else{
				$msg  = 'Категория содержит несколько подкатегорий. '
						. 'Сначала удалите все дочерние подкатегории.';
				$session->message($msg, 4);
			}
					
			
						
		}		
			
		header("Location: ".$referer);
		exit;        
    }
    
   

}

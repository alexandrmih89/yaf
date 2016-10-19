<?php

class SubcategoryController extends Admin_AccessController
{
    protected $layout = 'admin';   

    public function createAction()
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);        
        $this->getView()->setLayout($this->layout);
        $params = $this->getRequest()->getParams();
        if($this->getRequest()->isPost()){
			$post = $this->getRequest()->getPost();            
			$subcategory = CategoryModel::getInstance();
			$subcategory->name = $post['name'];
			$subcategory->path = $post['path'];
			$subcategory->visible = 1;
			$subcategory->parent = $params['category_id'];
			$subcategory->save();
            header("Location: /admin/category/edit/id/".$params['category_id']);
            exit;            
        }
        
    }
	
	public function editAction() {
		Yaf_Dispatcher::getInstance()->autoRender(FALSE);        
        $this->getView()->setLayout($this->layout);
        $params = $this->getRequest()->getParams();
        if($this->getRequest()->isPost()){
			$post = $this->getRequest()->getPost();            
			$cat = CategoryModel::find_by_id($params['id']);
			$cat->name = $post['name'];
			$cat->path = $post['path'];
			$cat->visible = $post['visible'];
			$cat->parent = $post['parent'];
			$cat->save();
            header("Location: ".$_SERVER['REQUEST_URI']);
            exit;
        }
        $this->getView()->assign('title', 'Админка|Редактировать подкатегорию');        
        
        $subcategory = CategoryModel::find_by_id($params['id']);
		$this->getView()->assign('subcategory', $subcategory);      
		
        $this->getView()->display('subcategory/edit.phtml');
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
			$subcategory = CategoryModel::find_by_id($params['id']);			
			$subcategory->delete();
		}		
			
		header("Location: ".$referer);
		exit;        
    }

    
   

}

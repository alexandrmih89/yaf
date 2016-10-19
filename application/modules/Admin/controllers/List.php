<?php

class ListController extends Admin_AccessController
{
    protected $layout = 'admin';
	
	protected $list_arr = array('1' => "Одноуровневый список", 
								'2' => "Двухуровневый");

	public function indexAction() 
    {
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
		$this->getView()->setLayout($this->layout);
		
		$lists = ListModel::findAll();
		//echo '<pre>'.print_r($lists,1).'</pre>'; exit;
		
        $this->getView()->assign('title', 'Админка|Списки подстановки');
        $this->getView()->assign('list_arr', $this->list_arr);
        $this->getView()->assign('lists', $lists);
        $this->getView()->display('list/index.phtml');    	
    }
	
	public function createAction()
	{
		Yaf_Dispatcher::getInstance()->autoRender(FALSE);
		if( $this->getRequest()->isPost() && 
			isset($_POST['list_insert']) && $_POST['list_insert'] == 'form' )
		{
			//echo '<pre>'.print_r($this->getRequest()->getPost(),1).'</pre>'; exit;
			$data = $this->getRequest()->getPost();
			
			$list = ListModel::getInstance();
			$list->list = $data['list'];
			$list->level = $data['level'];
			
			if(!$list->save()){
				$session = Yaf_Registry::get('session');
				$session->message($list->errors[0], 3);
				//print_r($list->errors);
			}
			
			header("Location: /admin/list");
			exit;  
		}else{
			Yaf_Dispatcher::getInstance()->autoRender(FALSE);
			$this->forward("error", "err404"); 
		}
	}
	
}

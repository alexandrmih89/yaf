<?php

use eYaf\Layout;
use eYaf\Request;
use database\Database;

class Bootstrap extends Yaf_Bootstrap_Abstract
{
	public function _initErrorHandler(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->setErrorHandler(array(get_class($this),'error_handler'));
    }
    
    public function _initConfig(Yaf_Dispatcher $dispatcher)
    {
        $this->config = Yaf_Application::app()->getConfig();
    }
	
	public function _initLoader($dispatcher) {
       
    }
	
	public function _initRequest(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->setRequest(new Request());
    }

    public function _initDatabase(Yaf_Dispatcher $dispatcher)
    {
        $db = Database::getInstance();
        Yaf_Registry::set ('db', $db);	
    }

    public function _initSession(Yaf_Dispatcher $dispatcher)
    {
        $session = Session::getInstance();
		Yaf_Registry::set ('session', $session);
		$message = $session->message();
		Yaf_Registry::set ('message', $message);
    }
	
	public function _initWidgets()
	{
		$widget_dir = $this->config['application']['directory'].'/'.'widgets';
		Yaf_Registry::set ('widget_dir', $widget_dir);
		if(file_exists($widget_dir)){
			$handle = opendir($widget_dir);			
			while ($class = readdir($handle)){
				if($class != '.' && 
				   $class != '..' && 
				   substr($class,0,1)!='_' && 
				   strpos($class,'.php') &&
				   strpos($class,'Widget')){					
					require_once $widget_dir.'/'.$class;
				}
			}
			closedir($handle);
		}		
	}
	public function _initUser(Yaf_Dispatcher $dispatcher)
    {	
		
    }
	
    public function _initRoute(Yaf_Dispatcher $dispatcher)
    {
        $config = new Yaf_Config_Ini(APP_PATH . '/config/routing.ini');
        $dispatcher->getRouter()->addConfig($config);
		
    }
    
    public function _initModules(Yaf_Dispatcher $dispatcher)
    {
        $app = $dispatcher->getApplication();
        $modules = $app->getModules();
        
    }
    
    public function _initLayout(Yaf_Dispatcher $dispatcher)
    {
        $layout = new Layout($this->config->application->layout->directory);
        $dispatcher->setView($layout);        
    }
    
	public function _initFuncs(Yaf_Dispatcher $dispatcher)
    {
        $funcs = new Funcs();
		Yaf_Registry::set ('uri', $funcs::$uri);
    }
    /**
     * Custom error handler.
     *
     * Catches all errors (not exceptions) and creates an ErrorException.
     * ErrorException then can caught by Yaf_ErrorController.
     *
     * @param integer $errno   the error number.
     * @param string  $errstr  the error message.
     * @param string  $errfile the file where error occured.
     * @param integer $errline the line of the file where error occured.
     *
     * @throws ErrorException
     */
    public static function error_handler($errno, $errstr, $errfile, $errline)
    {
        // Do not throw exception if error was prepended by @
        //
        // See {@link http://www.php.net/set_error_handler}
        //
        // error_reporting() settings will have no effect and your error handler 
        // will be called regardless - however you are still able to read 
        // the current value of error_reporting and act appropriately. 
        // Of particular note is that this value will be 0 
        // if the statement that caused the error was prepended 
        // by the @ error-control operator.
        //
        if (error_reporting() === 0) return;
		throw new ErrorException($errstr, Yaf_Application::app()->getLastErrorNo(), $errno, $errfile, $errline);
    }

}
?>

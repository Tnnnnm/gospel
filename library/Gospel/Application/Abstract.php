<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

abstract class Gospel_Application_Abstract {
	
	/**
	 * request
	 *
	 * @var Gospel_Http_Request_Abstract
	 */
	public $_request;
	
	/**
	 * constructor
	 */
	public function __construct(){
		//初始化自动载入类
		spl_autoload_register('Gospel_Application::aotuLoadLib');
		//http
		$this->_request = new Gospel_Http_Request();
	}

	/**
	 * 设置配置
	 * 
	 * @param string $file
	 * @return void
	 */
	public function setConfig($file){
		$config = array();
		if(file_exists($file)){
			$config = include_once $file;
		}else{
			throw new Gospel_Config_Exception('NOT FOUND CONFIG FILE '.$file, 404);
		}
		Gospel_Manager::register(Gospel_Manager::APP_CONFIG, $config);
	}

	/**
	 * init
	 */
	protected function init(){
		
	}
	
	/**
	 * action分配之前
	 * 
	 * @param Gospel_Http_Request $request
	 * @return void
	 */
	protected function beforeDispatch(Gospel_Http_Request &$request){

	}
	
	/**
	 * action分配之后
	 * 
	 * @param Gospel_Http_Request $request
	 * @return void
	 */
	protected function afterDispatch(Gospel_Http_Request &$request){

	}

	/**
	 * controller分配
	 *
	 * @param Gospel_Http_Request $request
	 * @return void
	 */
	protected function dispatch(Gospel_Http_Request &$request){
		$this->beforeDispatch($request);
		$cstr = ucfirst($request->getModule());
		$cstr .= '_Controller_';
		$cstr .= ucwords($request->getController());
		$controller = new $cstr($request);
		$this->afterDispatch($request);
	}
	
	/**
	 * 自动载入类方法
	 *
	 * @param string $className
	 * @return void
	 */
	protected static function aotuLoadLib($className){
		$classFile = '';
		$dirs = explode('_', $className);
		foreach ($dirs as $dir){
			$classFile .= $dir.'/';
		}
		$classFile = substr($classFile, 0, -1);
		$classFile .= '.php';
		include_once $classFile;
	}
	
	/**
	 * 程序执行入口
	 *
	 * @return void
	 */
	public function run(){
		$this->init();
		$this->dispatch($this->_request);
	}

}
	
/**
* // +----------------------------------------------------------------------------
* // | @ Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
* // +----------------------------------------------------------------------------
* // | @ author: lenush <jnicklasj@gmail.com> qq:707207845
* // +----------------------------------------------------------------------------
* Local variables:
* tab-width:4
* basic-offset:4
* indent-tabs-mode:t
* End:
*/

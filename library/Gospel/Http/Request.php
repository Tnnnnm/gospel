<?php

// +-----------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +-----------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +-----------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +-----------------------------------------------------------------------

class Gospel_Http_Request extends Gospel_Http_Request_Abstract{
	/**
	 * 初始化
	 *
	 * @return void
	 * @see Gospel/Http/Request/Gospel_Http_Request_Abstract::init()
	 */
	protected function init(){
		$data = array();
		// better to have:regex mapping routing
		if(__CLI__){
			self::cliparse();
		}else{
			self::usuallyparse();
		}
	}
	
	private function usuallyparse(){
		if(empty($_SERVER['PATH_INFO'])){
			foreach ($_REQUEST as $key=>$val){
				$data[$key] = $val;
			}
		}else{
			$paths = explode("/", trim($_SERVER['PATH_INFO'],'/'));
			$data['ctl'] = array_shift($paths);
			$data['act'] = array_shift($paths);
			foreach ($paths as $key => $val){
				$data['parameters'] = $val;
			}
		}
		$data['REQUEST_METHOD'] = strtoupper($_SERVER['REQUEST_METHOD']);
		$data['REMOTE_ADDR'] = strtoupper($_SERVER['REMOTE_ADDR']);
		$data['SERVER_NAME'] = strtolower($_SERVER['SERVER_NAME']);
		$this->_data = $data;
	}

	private function cliparse(){
		#$data['ctl'] = $_SERVER['argv'][1];
		#$data['act'] = $_SERVER['argv'][2];
		#$this->_data = $data;
	}

}
	
/**
* // +---------------------------------------------------------------------
* // | @ Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
* // +---------------------------------------------------------------------
* // | @ author: lenush <jnicklasj@gmail.com> qq:707207845
* // +---------------------------------------------------------------------
* Local variables:
* tab-width:4
* basic-offset:4
* indent-tabs-mode:t
* End:
*/

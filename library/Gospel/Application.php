<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

require_once 'Gospel/Application/Abstract.php';
class Gospel_Application extends Gospel_Application_Abstract {

	//初始化操作
	protected function init(){
		$this->initDb();
		$this->initCache();
		$this->initHost();
	}

	/**
	 * 域名程序解析
	 */
	protected function initHost(){
		$host = $this->_request->getServerName();
		$module = '';
		switch($host){
			case 'demo.local':
				$module = 'gos';
				break;
			case 'release.local':
				$module = 'pel';
				break;
			default :
				$module = 'gos';
				break;
		}
		$this->_request->setItem('module', $module);
	}
	
	/**
	 * 初始化数据源
	 */
	private function initDb(){
		$config = Gospel_Manager::get(Gospel_Manager::APP_CONFIG);
		Gospel_Manager::register(Gospel_Manager::APP_ADAPTERS, new Gospel_Db_Manager($config['database']));
	}
	
	/**
	 * cache
	 */
	private function initCache(){
		Gospel_Manager::register(Gospel_Manager::APP_FILECACHE, Gospel_Cache::factory(Gospel_Cache::C_FILE, './cache'));
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

<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class Gospel_Db_Manager extends Gospel_Db_Manager_Abstract {
	/**
	 * 结构函数
	 * 
	 * @param array $config
	 */
	public function __construct(array $config){
		$this->_config = $config;
		$this->_adapters = array();
	}
	
	/**
	 * 获取数据源
	 * 
	 * @param string $dbIdenty 数据源标识
	 * @return Gospel_Db_Adapter
	 */
	public function getAdapter($dbIdenty){
		$return = null;
		if(array_key_exists($dbIdenty, $this->_adapters)){
			$return = $this->_adapters[$dbIdenty];
		}else if(array_key_exists($dbIdenty, $this->_config)){
			$return = $this->crateAdaper($this->_config[$dbIdenty]);
			if($return instanceof Gospel_Db_Adapter){
				$this->_adapters[$dbIdenty] = $return;
			}else{
				throw new Gospel_Db_Exception('The DbAdapter Install Failure.', 404);
			}
		}else{
			throw new Gospel_Db_Exception('No the match db server in config file, please check it again.', 404);
		}
		return $return;
	}
	
	/**
	 * 创建连接源
	 * 
	 * @param array $config
	 * @return Gospel_Db_Adapter
	 */
	private function crateAdaper(array $config){
		$return = new Gospel_Db_Adapter($config);
		return $return;
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
<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

final class Gospel_Manager {
	/**
	 * 设置
	 * 
	 * @var string
	 */
	const APP_CONFIG = 'config';
	
	/**
	 * 数据
	 * 
	 * @var string
	 */
	const APP_ADAPTERS = 'dbAdapters';
	
	/**
	 * 缓存
	 * 
	 * @var Gospel_Cahce_File
	 */
	const APP_FILECACHE = 'filecache';
	
	/**
	 * 存储变量
	 *
	 * @var array
	 */
	protected static $_mem = array();

	/**
	 * 变量是否已注册
	 *
	 * @return boolean
	 */
	public static function hasRegisted($key){
		$return =false;
		if(array_key_exists($key, self::$_mem)){ 
			$return = true;
		}
		return $return;
	}

	/**
	 * 注册变量
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public static function register($key, $value){
		$return = false;
		if(!self::hasRegisted($key)){
			self::$_mem[$key] = $value;
			$return = true;
		}
		return $return;
	}

	/**
	 * 获取变量
	 *
	 * @param string $key
	 * @return mixed
	 */
	public static function get($key){
		$return = null;
		if(self::hasRegisted($key)){
			$return = self::$_mem[$key];
		}
		return $return;
	}
	
	/**
	 * 清理
	 * 
	 * @return void
	 */
	public function clear(){
		self::$_mem = array();
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

<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class Gospel_Cache {
	/**
	 * 文件缓存
	 *@var string
	 */
	const C_FILE='file';
	
	/**
	 * memcache缓存
	 *@var string
	 */
	const C_MEMCACHE = 'memcache';
	
	/**
	 * 外部不可实例化
	 */
	private function __construct(){
		
	}
	
	/**
	 * 缓存引擎工厂方法
	 *
	 * @param string $cacheType
	 * @param string $resource
	 * @return Gospel_Cache_Interface
	 */
	public static function factory($cacheType, $resource){
		$return = null;
		switch ($cacheType){
			case Gospel_Cache::C_FILE:
				$return = new Gospel_Cache_File($resource);
				break;
			case Gospel_Cache::C_MEMCACHE:
				/**
				 * @todo ..............
				 */
				break;
			default:
				throw new Gospel_Cache_Exception('you input cache engine name is not support', 404);
				break;
		}
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
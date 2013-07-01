<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

interface Gospel_Cache_Interface {
	/**
	 * 存储内容
	 *
	 * @param string $key
	 * @param string $value
	 * @param int $expire
	 * @return void
	 */
	public function save($key, $value, $expire);
	
	/**
	 * 销毁缓存
	 *
	 * @param string $key
	 * @return void
	 */
	public function destroy($key);
	
	/**
	 * 读取缓存内容
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function read($key);
	
	/**
	 * 反序列化读取
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function seriaRead($key);
	
	/**
	 * 查看缓存是否过期
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function isExpire($key);

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
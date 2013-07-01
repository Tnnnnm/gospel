<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

abstract class Gospel_Db_Manager_Abstract {	
	/**
	 * 数据源列表
	 * 
	 * @var Gospel_Db_Adapter[] array
	 */
	protected $_adapters;
	
	/**
	 * 数据连接设置
	 * 
	 * @var array
	 */
	private $_config;
	
	/**
	 * 获取数据源
	 * 
	 * @param string $dbIdenty 数据源标识
	 * @return Gospel_Db_Adapter
	 */
	abstract protected function getAdapter($dbIdenty);
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
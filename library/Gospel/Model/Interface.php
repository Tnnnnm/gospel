<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

interface Gospel_Model_Interface {
	
	/**
	 * 获取单条记录
	 * 
	 * @param mixed $where
	 * @param boolean $isDetail
	 * @return array
	 */
	public function getItem($where, $isDetail=false);
	
	/**
	 * 获取多条记录
	 * 
	 * @param mixed $where
	 * @param string $sort
	 * @param int $page
	 * @param int $psize
	 * @return array
	 */
	public function getItems($where, $sort, $page=1, $psize=10);
	
	/**
	 * 获取统计数量
	 * 
	 * @param mixed $where
	 * @return int
	 */
	public function getTotal($where);
	
	/**
	 * 添加记录
	 * 
	 * @param array $item、
	 * @return int
	 */
	public function append(array $item);
	
	/**
	 * 修正记录
	 * 
	 * @param mixed $where
	 * @param array $set
	 * @return int
	 */
	public function alter($where, array $set);

	/**
	 * 删除记录
	 * 
	 * @param mixed $where
	 * @return int
	 */
	public function remove($where);
	
	/**
	 * 获取数据访问源
	 * 
	 * @return Gospel_Db_Adapter
	 */
	public function getAdapter();
	
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
<?php

// +-----------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +-----------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +-----------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +-----------------------------------------------------------------------

final class Gos_Model_Category extends Gospel_Model_Abstract {
	
	protected function init(){	
		$this->mainDao = new Gos_Dao_Category();
	}
	
	/**
	 * 获取单条记录
	 * 
	 * @param mixed $where
	 * @param boolean $isDetail
	 * @return array
	 */
	public function getItem($where, $isDetail=false){
        $return = array();
		if(!empty($where)){
			$where = $this->getWhere($where);
			$return = $this->mainDao->getOne($where);
			if($return){
				$items = array();
			}
		}
		return $return;
	}
	
	/**
	 * 获取多条记录
	 * 
	 * @param mixed $where
	 * @param string $sort
	 * @param int $page
	 * @param int $psize
	 * @return array
	 */
	public function getItems($where, $sort, $offset=0, $psize=10){
		$return = array();
		if(!empty($where)){
			$where = $this->getWhere($where);
			$items = $this->mainDao->getList($where, $sort, $offset, $psize);
			$page = $this->getPage($this->mainDao,$where, $offset, $psize);
			#$return['data'] = $items;
			#$return['pager'] = $page;
			$return = $items;
            		unset($items);
			unset($page);
		}
		return $return;
	}
	
	/**
	 * 获取统计数量
	 * 
	 * @param mixed $where
	 * @return int
	 */
	public function getTotal($where){
		
	}
	
	/**
	 * 添加记录
	 * 
	 * @param array $item、
	 * @return int
	 */
	public function append(array $item){
        $sql = $this->proToSqls($this->mainDao,$item);	
        return $this->mainDao->update($sql);
	}
	
	/**
	 * 修正记录
	 * 
	 * @param mixed $where
	 * @param array $set
	 * @return int
	 */
	public function alter($where, array $set){
		$set = $this->getSet($set);
		$where = $this->getWhere($where);
		return $this->mainDao->saveData($where,$set);
	}

	/**
	 * 删除记录
	 * 
	 * @param mixed $where
	 * @return int
	 */
	public function remove($where){
		// return $this->getWhere($where);
		// return $this->mainDao->delete($where);
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

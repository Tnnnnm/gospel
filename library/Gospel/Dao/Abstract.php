<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

abstract class Gospel_Dao_Abstract {

	/**
	 * 表名字
	 *
	 * @var string
	 */
	protected $_table;
	
	/**
	 * 数据访问源
	 * 
	 * @var Gospel_Dao_Adapter
	 */
	protected $_adapter;

	/**
	 * construct
	 */
	public function __construct(){
		$this->initDb();
		$dbMg = Gospel_Manager::get(Gospel_Manager::APP_ADAPTERS);
		$this->_adapter = $dbMg->getAdapter('x01');
		$this->init();
	}

	/**
	 * special for unit test	
	 * 初始化数据源
	 */
	private function initDb(){
		$config = Gospel_Manager::get(Gospel_Manager::APP_CONFIG);
		$dbArray = array(
			'x01' => array(
				'host' => '127.0.0.1',
				'username' => 'root',
				'password' => 'rails',
				'dbname' => 'ihj',
			)
		);
		Gospel_Manager::register('dbAdapters', new Gospel_Db_Manager($dbArray));
	}
	/**
	 * 初始操作
	 *
	 * @return void
	 */
	protected function init(){

	}

	/**
	 * 获取数据访问源
	 *
	 * @return Gospel_Db_Adapter
	 */
	public function getAdapter(){
		return $this->_adapter;
	}

	/**
	 * 获取表名字
	 *
	 * @return string
	 */
	public function getTableName(){
		return $this->_table;
	}

	/**
	 * 获取列表
	 * @param string $where
	 * @param string $order
	 * @param int $offset
	 * @param int $limit
	 * @return array
	 */
	public function getList($where, $order, $offset=0, $limit=10){
		$return = array();
		if($where){
			$query = 'SELECT * FROM ';
			$query .= $this->getTableName();
			$query .= ' WHERE '.$where;
			$query .= ' ORDER BY '.$order;
			$query .= ' LIMIT '.$offset.','.$limit;
			$return = $this->_adapter->queryAll($query);
		}
		return $return;
	}

	/**
	 * 删除记录
	 *
	 * @param string $where
	 * @return boolean
	 * @throws Gospel_Db_Exception
	 */
	public function delete($where){
		$return = 0;
		if(!empty($where)){
			$query = 'DELETE FROM ';
			$query .= $this->getTableName();
			$query .= ' WHERE ';
			$query .= $where;
			try{
				$return = $this->_adapter->queryUpdate($query);
			}catch(Gospel_Db_Exception $mde){
				throw $mde;
			}
		}
		return $return;
	}

	/**
	 * 获取单条记录
	 *
	 * @param string $where
	 * @return array
	 * @throws Gospel_Db_Exception
	 */
	public function getOne($where){
		$return  = array();
		if($where){
			$query = 'SELECT * FROM ';
			$query .= $this->getTableName();
			$query .= ' WHERE '.$where;
			$query .= ' LIMIT 0,1';
			try{
				$return = $this->_adapter->queryRow($query);
			}catch(Gospel_Db_Exception $mde){
				throw $mde;
			}
		}
		return $return;
	}

	/**
	 * 获取表字段信息
	 *
	 * @return array
	 * @throws Gospel_Db_Exception
	 */
	public function getTableFields(){
		$return = array();
		try{
			$return = $this->_adapter->getTableFields($this->getTableName());
		}catch(Gospel_Db_Exception $mde){
			throw $mde;
		}
		return $return;
	}
	
	/**
	 * 统计满足条件记录数量
	 * 
	 * @param string $where
	 * @return int
	 */
	public function getWhereTotal($where){
		$sql = 'SELECT COUNT(*) FROM '.$this->getTableName();
		$sql .= ' WHERE '.$where;
		$return = $this->_adapter->queryTotal($sql);
		return $return;
	}

	/**
	 * 更新数据
	 *
	 * @param string $query
	 * @return int
	 */
	public function update($query){
		// echo $query;
		$return = 0;
		if($query){
			$return  = $this->_adapter->queryUpdate($query);
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

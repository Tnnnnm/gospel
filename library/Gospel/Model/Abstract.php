<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

abstract class Gospel_Model_Abstract implements Gospel_Model_Interface {
	
	/**
	 * dao源
	 * 
	 * @var Gospel_Dao_Abstract
	 */
	protected $mainDao;
	
	public function __construct(){
		$this->init();
	}
	
	protected function init(){
		
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
		}
		return $return;
	}
	
	/**
	 * 获取数据访问源
	 * 
	 * @return Gospel_Db_Adapter
	 */
	public function getAdapter(){
		return $this->mainDao->getAdapter();
	}
	
	/**
	 * 获取更新sql
	 *
	 * @param array $set
	 * @return string
	 */
	protected function getSet(array $set){
		$return = '';
		foreach ($set as $key=>$val){
			if(!empty($key)){
				$return .= ' '.$key."='".$val."',";
			}
		}
		$return = substr($return, 0, -1);
		return $return;
	}
	
	/**
	 * 解析成where语句
	 *
	 * @param mixed $wparam
	 * @return string
	 */
	protected function getWhere($wparam){
		$where = '';
		if(empty($wparam)){
			$where .= '1>2';
		}elseif (is_string($wparam)){
			$where .= $wparam;
		}elseif (is_array($wparam)){
			foreach ($wparam as $val){
				$where .= $val.' AND ';
			}
			if($where != ''){
				$where .= '1=1';
			}
		}
		return $where;
	}
	
	/**
	 * 获取文件缓存实例
	 *
	 * @return Gospel_Cache_Interface
	 */
	protected function getFileCache(){
		return Gospel_Manager::get(Gospel_Manager::APP_FILECACHE);
	}
	
	/**
	 * 获取满足条件的记录数量
	 * 
	 * 
	 * @return int
	 */
	protected function getWhereTotal(Gospel_Dao_Abstract $dao, $where){
		$return = 0;
		if(!empty($where)){
			$where = $this->getWhere($where);
			$return = $dao->getWhereTotal($where);
		}
		return $return;
	}
	
	/**
	 * 获取页码
	 * 
	 * @param Gospel_Dao_Abstract $dao
	 * @param unknown_type $where
	 * @return array
	 */
	protected function getPage(Gospel_Dao_Abstract $dao, $where, $start, $psize){
		$page = array();
		$page['rtotal'] = $this->getWhereTotal($dao, $where);
		$page['offset'] = $start;
		$page['psize'] = $psize;
		$pnum = ceil($start/$psize);
//		调整当前页码
//		$page['page'] = $pnum>0?$pnum:1;
                $page['page'] = $pnum>0?$pnum + 1:1;
		return $page;
	}
	
	/**
	 * 加工成insert语句
	 * 
	 * @param Gospel_Dao_Abstract $dao
	 * @param array $set
	 * @throws Gospel_Dao_Exception
	 */
	protected function proToSqls($dao, $set){
		$return = '';
		if($set){
			$fileCache = $this->getFileCache();
			$table = $dao->getTableName();
			$key = 'dao'.$table.'_fields';
			$fields = array();
			if($fileCache->isExpire($key)){
				$fields = $dao->getTableFields();
				$fileCache->save($key, $fields, 0);
			}else {
				$fields = $fileCache->seriaRead($key);
			}
			$query = 'INSERT INTO '.$table;
			$keys = ' (';
			$values = '';
			foreach($set as $key=>$value){
				if(array_key_exists($key, $fields)){
					$keys .= '`'.$key.'`,';
					if(!in_array($key, array('nCreateTime'))){
						$type = strtolower($fields[$key]['type']);
						switch($type){
							case 'int':
								$values .= sprintf("%u,", $value);
								break;
							case 'string':
								$value = mb_substr($value, 0, $fields[$key]['length']);
								$values .= sprintf("'%s',", $value);
								break;
							case 'real':
								$values .= sprintf("%f,", $value);
								break;
							default:
								$values .= "'".$value."',";
								break;
						}
					}else{
						$values .= Gospel_Utility::getTimeStamp().',';
					}
				}
			}
			$keys = substr($keys, 0, -1);
			$keys .= ')';
			$values = substr($values, 0, -1);
			$query .= $keys;
			$query .= ' VALUES (';
			$query .= $values;
			$query .= ');';
			$return = $query;
		}
		// echo $return;
		return $return;
	}

	/**
	 * 加工成update语句(时间紧 只实现功能 没考虑字段缓存)
	 * 
	 * @param Gospel_Dao_Abstract $dao
	 * @param fix $where
	 * @param array $set
	 * @throws Gospel_Dao_Exception
	 */
	protected function proUpdateSqls($dao, $where, $set){
		$return = '';
		if($set){
		$table = $dao->getTableName();
		$return = 'UPDATE '.$table.' SET '.$set.' WHERE '.$where;
		return $return;
		}
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

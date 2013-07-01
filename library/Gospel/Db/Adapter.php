<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class Gospel_Db_Adapter {

	/**
	 * 设置参数
	 *
	 * @var array
	 */
	private $_config;

	/**
	 * 连接源
	 *
	 * @var $_link
	 */
	private static $_link = null;

	/**
	 * construct
	 *
	 * @param array $config = array(
	 * 	'host'=>'',
	 * 	'username'=>'',
	 * 	'password'=>'',
	 * 	'dbname'=>'',
	 * 	'charset'=>'utf8'|'gbk'
	 * )
	 * @return void
	 */
	public function __construct(array $config){
		$this->_config = $config;
	}

	/**
	 * 获取连接源
	 *
	 * @return Resource
	 * @throws Gospel_Db_Exception
	 */
	private function getLink(){
		if(self::$_link === null){
			$link = @mysql_connect($this->_config['host'], $this->_config['username'], $this->_config['password']);
			if($link){
				self::$_link = $link;
				@mysql_select_db($this->_config['dbname'], self::$_link);
				@mysql_query("SET NAMES'utf8'", self::$_link);
			}else{
				throw new Gospel_Db_Exception(mysql_error(), mysql_errno());
			}
		}
		return self::$_link;
	}

	/**
	 * 获取数据库名字
	 *
	 * @param string $table
	 * @return string
	 * @throws Gospel_Db_Exception
	 */
	public function getTableFields($table){
		$return = array();
		$result = mysql_list_fields($this->_config['dbname'], $table, $this->getLink());
		if($result){
			$fnum = mysql_num_fields($result);
			for($i=0; $i<$fnum; $i++){
				$field = mysql_fetch_field($result, $i);
				$len = mysql_field_len($result, $i);
				$return[$field->name] = array('type'=>$field->type, 'length'=>$len);
			}
		}else{
			throw new Gospel_Db_Exception(mysql_error($this->getLink()), mysql_errno($this->getLink()));
		}
		return $return;
	}

	/**
	 * 数据更新操作
	 *
	 * @param string $sql
	 * @return int
	 * @throws Gospel_Db_Exception
	 */
	public function queryUpdate($sql){
		$return = 0;
		if(!empty($sql)){
			try{
				$result = @mysql_query($sql, $this->getLink());
				if($result){
					if(strtolower(substr($sql, 0, 6)) != 'insert'){
						$return = mysql_affected_rows($this->getLink());
					}else{
						$return = mysql_insert_id($this->getLink());
					}
				}else {
					throw new Gospel_Db_Exception(mysql_error($this->getLink()), mysql_errno($this->getLink()));
				}
			}catch (Gospel_Db_Exception $mde){
				throw $mde;
			}
		}
		return $return;
	}

	/**
	 * 获取单条记录操作
	 *
	 * @param string $sql
	 * @return Array
	 * @throws Gospel_Db_Exception
	 */
	public function queryRow($sql){
		$return = array();
		if(!empty($sql)){
			try{
				$result = @mysql_query($sql, $this->getLink());
				if($result){
					$return = mysql_fetch_assoc($result);
					mysql_free_result($result);
				} else {
					throw new Gospel_Db_Exception(mysql_error($this->getLink()), mysql_errno($this->getLink()));
				}
			}catch (Gospel_Db_Exception $mde){
				throw $mde;
			}
		}

		return $return;
	}

	/**
	 * 获取条件记录总数
	 *
	 * @param string $sql
	 * @return int
	 * @throws Gospel_Db_Exception
	 */
	public function queryTotal($sql){
		$return = 0;
		if(!empty($sql)){
			$result = @mysql_query($sql, $this->getLink());
			if($result){
				$row = mysql_fetch_row($result);
				$return = $row[0];
				mysql_free_result($result);
			}else{
				throw new Gospel_Db_Exception(mysql_error($this->getLink()), mysql_errno($this->getLink()));
			}
		}
		return $return;
	}

	/**
	 * 获取条件记录集合
	 *
	 * @param string $query
	 * @return Array
	 * @throws Gospel_Db_Exception
	 */
	public function queryAll($query){
		$return =array();
		if(!empty($query)){
			try{
				$result = @mysql_query($query, $this->getLink());
				if($result){
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						array_push($return, $row);
					}
					mysql_free_result($result);
				}else{
					throw new Gospel_Db_Exception(mysql_error($this->getLink()), mysql_errno($this->getLink()));
				}
			}catch (Gospel_Db_Exception $mde){
				throw $mde;
			}
		}
		return $return;
	}

	/**
	 * 开始事务处理
	 *
	 * @return void
	 * @throws Gospel_Db_Exception
	 */
	public function startTrans(){
		try{
			$result = mysql_query('SET AUTOCOMMIT=0', $this->getLink());
			if(!$result){
				throw new Gospel_Db_Exception(mysql_error($this->getLink()), mysql_errno($this->getLink()));
			}
		}catch (Gospel_Db_Exception $mde){
			throw $mde;
		}
	}

	/**
	 * 提交事务
	 *
	 * @return void
	 * @throws Gospel_Db_Exception
	 */
	public function commitTrans(){
		try{
			$result = mysql_query('COMMIT', $this->getLink());
			if(empty($result)){
				throw new Gospel_Db_Exception(mysql_error($this->getLink()), mysql_errno($this->getLink()));
			}
		}catch (Gospel_Db_Exception $mde){
			throw $mde;
		}
	}

	/**
	 * destruct
	 *
	 * @return void
	 */
	public function __destruct(){
		if(self::$_link !== null){
			mysql_close(self::$_link);
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

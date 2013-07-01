<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------


class Gospel_Controller_Api_Exception extends Gospel_Exception{
	/**
	 * 异常数据
	 *
	 * @var array
	 */
	protected $_data = array();

	/**
	 * constructor
	 *
	 * @param string $message
	 * @param int $code
	 * @param mixed $data
	 * @return void
	 */
	public function __construct($code, $message, $data=''){
		parent::__construct($message, $code);
		$this->_data['code'] = $code;
		$this->_data['message'] = $message;
		$this->_data['result'] = $data;
	}

	public function toJson(){
		echo json_encode($this->_data);
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
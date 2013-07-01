<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

final class Gospel_Controller_Ajax_Exception extends Gospel_Exception {
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
	 * @param int $total
	 * @param $previous
	 * @return void
	 */
	public function __construct($message, $code, $data=null, $total=1, $previous=null){
		parent::__construct($message, $code, $previous);
		$this->_data['code'] = $code;
		$this->_data['message'] = $message;
		$this->_data['result'] = $data;
		$this->_data['total'] = $total;
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
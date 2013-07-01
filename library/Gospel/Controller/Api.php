<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class Gospel_Controller_Api extends Gospel_Controller_Abstract {

	/**
	 * 分发Action
	 *
	 * @return void
	 * @throws Gospel_Controller_Api_Exception
	 */
	protected function dispathAction(Gospel_Http_Request_Abstract &$request){
		$action = $this->_req->getAction();
		$action = strtolower($action);
		//$action .= 'Action';(make trouble for unit test)
		if(method_exists($this, $action)){
			try{
				$this->{$action}();
			}catch(Gospel_Controller_Api_Exception $gcae){
				$gcae->toJson();
			}
		}else{
			throw new Gospel_Controller_Api_Exception(404, 'not found the '.$action.' in '.get_class($this));
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

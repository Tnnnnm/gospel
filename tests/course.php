<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class System extends PHPUnit_Framework_TestCase {
	
	public function setUp(){
		set_include_path('/var/www/agile/library');
		include_once 'Gospel/Controller/Abstract.php';
		include_once 'Gospel/Controller/Api.php';
		include_once 'Gospel/Http/Request/Abstract.php';
		include_once 'Gospel/Http/Request.php';
		include_once 'Gospel/Model/Interface.php';
		include_once 'Gospel/Model/Abstract.php';
		include_once 'Gospel/Manager.php';
		include_once 'Gospel/Db/Manager/Abstract.php';
		include_once 'Gospel/Db/Manager.php';
		include_once 'Gospel/Db/Adapter.php';
		include_once 'Gospel/Dao/Abstract.php';
		include_once '/var/www/agile/application/Gos/Model/System.php';
		include_once '/var/www/agile/application/Gos/Dao/System.php';
		include_once '/var/www/agile/application/Gos/Controller/System.php';
	}
	
	public function testBootstrap(){
		define('__CLI__',true);
	}
	
	/**
	  * 单元测试 启动函数 bootstrap
	  * @retrn void
	  */
	private function gos_unit_bootstrap(){
		$this->req = new Gospel_Http_Request();
		$this->req->setItem('ctl','System');
		$this->req->setItem('act','unitTest');
		$this->obj = new Gos_Controller_System($this->req);

	}

	/**
	  * students 
	  * @test
	  */
	public function courses(){
		self::gos_unit_bootstrap();
		//$res = $this->obj->students('','','');
		//$this->assertEquals('李四',$res[1]['uName']);
		$res = $this->obj->students('李','','');
		$this->assertEquals('张三',$res[0]['uName']);
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

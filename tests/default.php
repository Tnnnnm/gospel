<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class defaults extends PHPUnit_Framework_TestCase {
	
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
		include_once '/var/www/agile/application/Gos/Model/Category.php';
		include_once '/var/www/agile/application/Gos/Dao/Category.php';
		include_once '/var/www/agile/application/Gos/Controller/Default.php';
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
		$this->req->setItem('ctl','Default');
		$this->req->setItem('act','unitTest');
		$this->obj = new Gos_Controller_Default($this->req);

	}

	/**
	  * categories
	  * @test
	  */
	public function getAllCategories(){
		self::gos_unit_bootstrap();
		$res = $this->obj->getCategory();
		//var_dump($res);
		//$this->assertEquals('132','12');
		//$this->assertEquals(1,$res[0][status]);
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

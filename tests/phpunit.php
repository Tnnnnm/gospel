<?php
include '../index.php';
class php_unit extends PHPUnit_Framework_TestCase{

    public function setUp(){
	#define('__CLI__', true);
	#set_include_path('/var/www/agile/library');
	#spl_autoload_register('aotuLoadLib');
	#include '../application/Gos/Controller/Default.php';
	}

    /**
     * have to this or name a function start with test
     * @test
     */
    public function isEquals(){
	$stack = array(1,2,3,4);
	$this->assertEquals(2,$stack[1]);
	}

    public function testArrEquals(){
	$stack = array('hello',23,34,);
	$this->assertEquals(3,count($stack));
	$this->assertEquals(23,$stack[1]);
	
	}	
	
    public function testGospel(){
	// var_dump(get_included_files());
	$req = new Gospel_Http_Request();
	$obj = new Gos_Controller_Default($req);
	}	

}
	/**
	 * 自动载入类方法
	 *
	 * @param string $className
	 * @return void
	 */
	function aotuLoadLib($className){
		$classFile = '';
		$dirs = explode('_', $className);
		foreach ($dirs as $dir){
			$classFile .= $dir.'/';
		}
		$classFile = substr($classFile, 0, -1);
		$classFile .= '.php';
		include_once $classFile;
	}	

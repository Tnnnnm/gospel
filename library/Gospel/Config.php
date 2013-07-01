<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class Gospel_Config {
	/**
	 * 配置数据
	 *
	 * @var Gospel_Config_Abstract
	 */
	private static $_config = null;

	/**
	 * 工厂方法
	 *
	 * @param string $file	配置文件路径
	 * @param string $ext	txt|xml
	 * @return Gospel_Config_Abstract
	 * @throws Gospel_Config_Exception
	 */
	public static function getInstance($file, $ext='txt'){
		if(self::$_config === null){
			try{
				switch ($ext){
					case 'txt':
						self::$_config = new Gospel_Config_Ini($file);
						break;
					case 'xml':
						break;
					case 'json':
						break;
					default:
						break;
				}
			}catch(Gospel_Config_Exception $mce){
				throw $mce;
			}
		}
		return self::$_config;
	}

	/**
	 * constructor
	 */
	private function __construct(){

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
<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class Gospel_Config_Ini extends Gospel_Config_Abstract {
	/**
	 * constuctor
	 *
	 * @param string $file
	 * @return void
	 * @throws Gospel_Config_Exception
	 */
	public function __construct($file){
		if(file_exists($file)){
			$fp = fopen($file, 'r');
			while (!feof($fp)){
				$line = fgetss($fp, 1024);
				$line = preg_replace('/\s+/', '', $line);
				if(!in_array(substr($line, 0, 1), array(';', '['))){
					array_push($this->_lines, $line);
				}
			}
			fclose($fp);
		}else{
			throw new Gospel_Config_Exception('Can\'t Found The Config File:'.$file, 404);
		}
	}

	/**
	 * 数组返回数据
	 *
	 * @return array
	 */
	public function toArray(){
		$return = array();
		foreach ($this->_lines as $line){
			if(preg_match('/^[\w\.]+=([^=])+$/i', $line)){
				$command = explode('=', $line);
				$keys = explode('.', $command[0]);
				$value = preg_replace('/[\'\"]+/', '', $command[1]);
				//$keys = array_reverse($keys);
				//$tmp = $command[1];
				$str = 'return';
				foreach ($keys as $key){
					$str .= "['".$key."']";
				}
				$eval = '$'.$str."='".$value."';";
				eval($eval);
			}
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
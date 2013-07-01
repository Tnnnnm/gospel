<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

class Gospel_Cache_File implements Gospel_Cache_Interface {
	/**
	 * 缓存目录
	 *
	 * @var string
	 */
	private $_cacheDir = '';
	
	/**
	 * construct
	 *
	 * @param string $cacheDir;
	 */
	public function __construct($cacheDir){
		if(is_dir($cacheDir)){
			$this->_cacheDir = $cacheDir;
		}else {
			throw new Gospel_Cache_Exception('the cachefile\'s dir is not exist', 404);
		}
	}
	
	/**
	 * 存储内容
	 *
	 * @param string $key
	 * @param string $value
	 * @param int $expire 单位是秒
	 * @return boolean
	 * @throws Gospel_Cache_Exception
	 */
	public function save($key, $value, $expire){
		if(!preg_match('/[a-zA-Z0-9]{6,20}/', $key)){
			throw new Gospel_Cache_Exception('key name is invalid.', 500);
		}
		if(is_array($value)){
			$value = serialize($value);
		}
		$saveFile = $this->getCacheFile($key);
		$fp = fopen($saveFile, 'w');
		fwrite($fp, $value);
		fclose($fp);
		$actime = Gospel_Utility::getTimeStamp();
		$permanence = 0;
		if($expire == 0){
			$permanence = 1;
		}
		$expire = $actime + $expire;
		$meta = array('actime'=>$actime, 'expire'=>$expire, 'permanence'=>$permanence);
		$xfp = fopen($this->getExtraFile($key), 'w');
		fwrite($xfp, serialize($meta));
		fclose($xfp);
		return true;
	}
	
	/**
	 * 销毁缓存
	 *
	 * @param string $key
	 * @return void
	 */
	public function destroy($key){
		$saveFile = $this->getCacheFile($key);
		$metaFiel = $this->getExtraFile($key);
		if(file_exists($saveFile)){
			unlink($saveFile);
		}
		if(file_exists($metaFiel)){
			unlink($metaFiel);
		}
	}
	
	/**
	 * 读取缓存内容
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function read($key){
		$saveFile = $this->getCacheFile($key);
		$return = '';
		if(file_exists($saveFile)){
			$return .= file_get_contents($saveFile);
		}
		return $return;
	}
	
	/**
	 * 反序列化读取
	 *
	 * @param string $key
	 * @return array
	 */
	public function seriaRead($key){
		$saveFile = $this->getCacheFile($key);
		$return = array();
		if(file_exists($saveFile)){
			$return = unserialize(file_get_contents($saveFile));
		}
		return $return;
	}
	
	/**
	 * 查看缓存是否过期
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function isExpire($key){
		$metaFile = $this->getExtraFile($key);
		$return = true;
		if(file_exists($metaFile)){
			$meta = unserialize(file_get_contents($metaFile));
			if(isset($meta['expire'])){
				if(($meta['expire'] < Gospel_Utility::getTimeStamp()) && ($meta['permanence'] == 0)){
					$return = true;
				}else {
					$return = false;
				}
			}
		}
		return $return;
	}
	
	/**
	 * 获取信息的文件存储路径
	 *
	 * @param string $key
	 * @return string
	 */
	private function getCacheFile($key){
		$dir = $this->makeDir($key);
		$dir .= '/'.$key.'.data';
		return $dir;
	}
	
	/**
	 * 获取文件附加信息
	 *
	 * @param string $key
	 * @return string
	 */
	private function getExtraFile($key){
		$dir = $this->makeDir($key);
		$dir .= '/'.$key;
		$dir .= '.meta';
		return $dir;
	}
	
	/**
	 * 生成缓存文件路径
	 *
	 * @param string $key'
	 * @return string
	 */
	private function makeDir($key){
		$dir = $this->_cacheDir;
		$dir .= '/'.substr($key, 0, 2);
		if(!is_dir($dir)){
			mkdir($dir, 0755);
		}
		$dir .= '/'.substr($key, 2, 2);
		if(!is_dir($dir)){
			mkdir($dir, 0755);
		}
		return $dir;
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
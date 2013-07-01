<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

final class Gospel_Http_Cookie {
	/**
	 * 设置cookie
	 *
	 * @param string $key
	 * @param String|Array $val
	 * @param int $expire
	 * @param string $domain
	 * @param string $dir
	 * @return boolean
	 */
	public static function setCookie($key, $val, $expire){
		$return = false;
		if(!self::hasKey($key)){
			$value = '';
			if(is_array($val)){
				foreach ($val as $key=>$va){
					$value .= $key.'='.$val.'&';
				}
				$value = mb_substr($value, 0, -1);
			}else {
				$value = $val;
			}
			$expire = time()+$expire;
			if(setcookie($key, $value, $expire, '/', '')){
				$return = true;
			}
		}
		return $return;
	}

	/**
	 * 获取cookie值
	 *
	 * @param string $key
	 */
	public static function getCookie($key){
		$return  = '';
		if(self::hasKey($key)){
			$return = $_COOKIE[$key];
		}
		return $return;
	}

	/**
	 * 销毁cookie
	 *
	 * @param string $key
	 * @return boolean
	 */
	public static function destroy($key){
		$return  = false;
		if(!empty($key)){
			if(self::hasKey($key)){
				$expire = time()-7200;
				if(setcookie($key, '', $expire, '/', '')){
					$return = true;
				}
			}
		}
		return $return;
	}

	/**
	 * 检测是否存在cookie
	 *
	 * @param string $key
	 * @return boolean
	 */
	private static function hasKey($ckey){
		$return = false;
		foreach ($_COOKIE as $key=>$val){
			if($key == $ckey){
				$return = true;
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
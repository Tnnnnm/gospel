<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

error_reporting(0);

final class Gospel_Utility {

    /**
     * 时间戳
     * @var int
     */
    private static $_timestamp = 0;

    /**
     * 密钥
     * @var int
     */
    private static $crypt_key = "198708250695";

    /**
     * 验证码session下标
     */
    private static $seKey = 'me.ihj';

    /**
     * 验证码过期时间
     */
    private static $expire = 3000;
    private static $codeSet = '346789ABCDEFGHJKLMNPQRTUVWXY';
    private static $fontSize = 25;     // 验证码字体大小(px)
    private static $useCurve = true;   // 是否画混淆曲线
    private static $useNoise = true;   // 是否添加杂点	
    private static $imageH = 0;        // 验证码图片宽
    private static $imageL = 0;        // 验证码图片长
    private static $length = 4;        // 验证码位数
    private static $bg = array(243, 251, 254);  // 背景
    private static $_image = null;     // 验证码图片实例
    private static $_color = null;     // 验证码字体颜色

    /**
     * 获取时间戳
     * 
     * @return int
     */

    public static function getTimeStamp() {
        if (self::$_timestamp == 0) {
            self::$_timestamp = time();
        }
        return self::$_timestamp;
    }

    /**
     * 时间戳格式化
     * @param type $timeString
     * @param type $format
     * @return string 
     */
    public static function str2Date($timeString, $format = 'Y-m-d H:i:s') {
        if (empty($timeString)) {
            return '';
        }
        $format = str_replace('#', ':', $format);
        return date($format, $timeString);
    }

    /**
     * 获取微时间
     * 
     * @return float
     */
    public static function getMicroTime() {
        list($usec, $sec) = explode(' ', microtime());
        return ((float) $usec + (float) $sec);
    }

    /**
     * 重定向
     * @param type $linkto
     * @param type $type
     * @param type $wait_sec 
     */
    public function redirect($linkto, $type = 0, $wait_sec = 0) {
        if ($linkto) {
            if ($type == 0) {
                echo $GLOBALS['redirect'] = '<meta http-equiv=refresh content="' . $wait_sec . ';url=' . $linkto . '">';
                exit();
            } else {
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $linkto);
                exit();
            }
        }
    }

    /**
     * 加密
     * @param type $txt
     * @return type 
     */
    public static function Hjencrypt($txt) {
        srand((double) microtime() * 1000000);
        $encrypt_key = md5(rand(0, 32000));
        $ctr = 0;
        $tmp = '';
        for ($i = 0; $i < strlen($txt); $i++) {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $encrypt_key[$ctr] . ($txt[$i] ^ $encrypt_key[$ctr++]);
        }
        return base64_encode(self::__key($tmp, $crypt_key));
    }

    /**
     * 解密
     * @param type $txt
     * @return type 
     */
    public static function Hjdecrypt($txt) {
        $txt = self::__key(base64_decode($txt), $crypt_key);
        $tmp = '';
        for ($i = 0; $i < strlen($txt); $i++) {
            $md5 = $txt[$i];
            $tmp .= $txt[++$i] ^ $md5;
        }
        return $tmp;
    }

    /**
     * 过程
     * @param type $txt
     * @param type $encrypt_key
     * @return type 
     */
    private function __key($txt, $encrypt_key) {
        $encrypt_key = md5($encrypt_key);
        $ctr = 0;
        $tmp = '';
        for ($i = 0; $i < strlen($txt); $i++) {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
        }
        return $tmp;
    }

    /**
     * 验证码保存到session的格式为： $_SESSION[self::$seKey] = array('code' => '验证码值', 'time' => '验证码创建时间');
     */
    public static function entry() {
        // 图片宽(px)
        self::$imageL || self::$imageL = self::$length * self::$fontSize * 1.5 + self::$fontSize * 1.5;
        // 图片高(px)
        self::$imageH || self::$imageH = self::$fontSize * 2;
        // 建立一幅 self::$imageL x self::$imageH 的图像
        self::$_image = imagecreate(self::$imageL, self::$imageH);
        // 设置背景      
        imagecolorallocate(self::$_image, self::$bg[0], self::$bg[1], self::$bg[2]);
        // 验证码字体随机颜色
        self::$_color = imagecolorallocate(self::$_image, mt_rand(1, 120), mt_rand(1, 120), mt_rand(1, 120));
        // 验证码使用随机字体 
        $ttf = dirname(__FILE__) . '/Assets/TTFS/ttf.ttf';
        if (self::$useNoise) {
            // 绘杂点
            self::_writeNoise();
        }
        if (self::$useCurve) {
            // 绘干扰线
            self::_writeCurve();
        }
        // 绘验证码
        $code = array(); // 验证码
        $codeNX = 0; // 验证码第N个字符的左边距
        for ($i = 0; $i < self::$length; $i++) {
            $code[$i] = self::$codeSet[mt_rand(0, 27)];
            $codeNX += mt_rand(self::$fontSize * 1.2, self::$fontSize * 1.6);
            // 写一个验证码字符
            imagettftext(self::$_image, self::$fontSize, mt_rand(-40, 70), $codeNX, self::$fontSize * 1.5, self::$_color, $ttf, $code[$i]);
        }
        // 保存验证码
        isset($_SESSION) || session_start();
        $_SESSION[self::$seKey]['code'] = join('', $code); // 把校验码保存到session
        $_SESSION[self::$seKey]['time'] = time();  // 验证码创建时间

        header('Cache-Control: private, max-age=0, no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header("content-type: image/png");
        // 输出图像
        imagepng(self::$_image);
        imagedestroy(self::$_image);
    }
    
    /**
     * 绘验证码
     */
    protected static function _writeCurve() {
        $A = mt_rand(1, self::$imageH / 2);                  // 振幅
        $b = mt_rand(-self::$imageH / 4, self::$imageH / 4);   // Y轴方向偏移量
        $f = mt_rand(-self::$imageH / 4, self::$imageH / 4);   // X轴方向偏移量
        $T = mt_rand(self::$imageH * 1.5, self::$imageL * 2);  // 周期
        $w = (2 * M_PI) / $T;

        $px1 = 0;
        $px2 = mt_rand(self::$imageL / 2, self::$imageL * 0.667);  // 曲线横坐标结束位置 	    	
        for ($px = $px1; $px <= $px2; $px = $px + 0.9) {
            if ($w != 0) {
                $py = $A * sin($w * $px + $f) + $b + self::$imageH / 2;  // y = Asin(ωx+φ) + b
                $i = (int) ((self::$fontSize - 6) / 4);
                while ($i > 0) {
                    imagesetpixel(self::$_image, $px + $i, $py + $i, self::$_color);
                    $i--;
                }
            }
        }
        $A = mt_rand(1, self::$imageH / 2);                  // 振幅		
        $f = mt_rand(-self::$imageH / 4, self::$imageH / 4);   // X轴方向偏移量
        $T = mt_rand(self::$imageH * 1.5, self::$imageL * 2);  // 周期
        $w = (2 * M_PI) / $T;
        $b = $py - $A * sin($w * $px + $f) - self::$imageH / 2;
        $px1 = $px2;
        $px2 = self::$imageL;
        for ($px = $px1; $px <= $px2; $px = $px + 0.9) {
            if ($w != 0) {
                $py = $A * sin($w * $px + $f) + $b + self::$imageH / 2;  // y = Asin(ωx+φ) + b
                $i = (int) ((self::$fontSize - 8) / 4);
                while ($i > 0) {
                    imagesetpixel(self::$_image, $px + $i, $py + $i, self::$_color);
                    $i--;
                }
            }
        }
    }

    /**
     * 往图片上写不同颜色的字母或数字
     */
    protected static function _writeNoise() {
        for ($i = 0; $i < 10; $i++) {
            //杂点颜色
            $noiseColor = imagecolorallocate(
                    self::$_image, mt_rand(150, 225), mt_rand(150, 225), mt_rand(150, 225)
            );
            for ($j = 0; $j < 5; $j++) {
                // 绘杂点
                imagestring(
                        self::$_image, 5, mt_rand(-10, self::$imageL), mt_rand(-10, self::$imageH), self::$codeSet[mt_rand(0, 27)], // 杂点文本为随机的字母或数字
                        $noiseColor
                );
            }
        }
    }
    
    /**
     * 验证码校验
     * @param type $code
     * @return boolean 
     */
    public static function VerifyValidate($code) {
        isset($_SESSION) || session_start();
        // 验证码不能为空
        if (empty($code) || empty($_SESSION[self::$seKey])) {
            return false;
        }
        // session 过期
        if (time() - $_SESSION[self::$seKey]['time'] > self::$expire) {
            unset($_SESSION[self::$seKey]);
            return false;
        }

        if (strtoupper($code) == $_SESSION[self::$seKey]['code']) {
            return true;
        }
        return false;
    }

    /**
     * 通过经纬度获取地址
     * 
     * @param float $lat
     * @param float $lng
     * @return String
     */
    public static function getAddressByLan($lat, $lng) {
        $api = 'http://ditu.google.cn/maps/geo?q=' . $lat . ',' . $lng . '&output=json';
        $client = new Hicd_Http_Curl();
        $client->setUrl($api);
        $response = $client->get();
        $return = $response->jsonDecode();
        print_r($return);
    }

    /**
     * 通过地址获取经纬度
     * 
     * @param String $address
     * @return array
     */
    public static function getLanByAddress($address) {
        $api = 'http://ditu.google.cn/maps/geo';
        $api .= '?q=' . urlencode($address);
        $api .= '&output=json&oe=utf8&sensor=false';
        $api .= '&key=ABQIAAAAYzHw6g0Pp1KIP87dt7M2dhSID2V4O09l3avVt76v7izRJpFFEBS2st7ySiYTzuEnhhYRoMb1w1Hk5Q';
        //echo $api;
        $client = new Hicd_Http_Curl();
        $client->setProxy('127.0.0.1:8580');
        $client->setUrl($api);
        $response = $client->get();
        $return = $response->jsonDecode();
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
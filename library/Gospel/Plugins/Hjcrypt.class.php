<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

final class Hjcrypt {
    
    /**
     * 密钥
     * 
     * @var int
     */
    private static $crypt_key = "198708250695";
    
    /**
     * 加密
     * @param type $txt
     * @return type 
     */
    public static function Hjencrypt($txt) {
       srand((double)microtime() * 1000000);
       $encrypt_key = md5(rand(0,32000));
       $ctr = 0;
       $tmp = '';
       for($i = 0;$i<strlen($txt);$i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $encrypt_key[$ctr].($txt[$i]^$encrypt_key[$ctr++]);
       }
       return base64_encode(self::__key($tmp,$crypt_key));
    }
    
    /**
     * 解密
     * @param type $txt
     * @return type 
     */
    public static function Hjdecrypt($txt) {
       $txt = self::__key(base64_decode($txt),$crypt_key);
       $tmp = '';
       for($i = 0;$i < strlen($txt); $i++) {
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
    private function __key($txt,$encrypt_key) {
       $encrypt_key = md5($encrypt_key);
       $ctr = 0;
       $tmp = '';
       for($i = 0; $i < strlen($txt); $i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
       }
       return $tmp;
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
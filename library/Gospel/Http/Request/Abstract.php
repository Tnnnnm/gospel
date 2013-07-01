<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------


class Gospel_Http_Request_Abstract {

    /**
     * request数据
     *
     * @var array
     */
    protected $_data;

    public function __construct() {
        $this->init();
    }

    /**
     * 获取整数值
     *
     * @param string $key
     * @return int
     */
    public function getInt($key) {
        $return = 0;
        if ($this->hasKey($key)) {
            $return = intval($this->_data[$key]);
        }
        return $return;
    }

    /**
     * 判断key
     *
     * @param string $key
     * @return boolean
     */
    protected function hasKey($key) {
        $return = false;
        if (array_key_exists($key, $this->_data)) {
            $return = true;
        }
        return $return;
    }

    /**
     * 获取控制器参数
     *
     * @return string
     */
    public function getController() {
        $return = 'Default';
        if ($this->hasKey('ctl')) {
            $return = $this->getString('ctl');
        }
        return $return;
    }

    /**
     * 获取类模块
     * 
     * @return string
     */
    public function getModule() {
        $return = 'default';
        if ($this->hasKey('module')) {
            $return = $this->getString('module');
        }
        return $return;
    }

    /**
     * 获取action
     *
     * @return string
     */
    public function getAction() {
        $return = 'index';
        if ($this->hasKey('act')) {
            $return = $this->getString('act');
        }
        return $return;
    }

    /**
     * 获取string值
     *
     * @param string $key
     * @return string
     */
    public function getString($key) {
        $return = '';
        if ($this->hasKey($key)) {
            $return = $this->parseStr($this->_data[$key]);
        }
        return $return;
    }

    /**
     * 获取数组值
     *
     * @param string $key
     * @return array
     */
    public function getArray($key) {
        $return = array();
        if ($this->hasKey($key)) {
            $return = $this->_data[$key];
        }
        return $return;
    }

    /**
     * 设置变量
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setItem($key, $value) {
        if (!empty($key)) {
            $this->_data[$key] = $value;
        }
    }

    /**
     * 字符串转义&数据库过滤
     *
     * @param string $str
     * @return string
     */
    protected function parseStr($str) {
        if (!get_magic_quotes_gpc()) {
            $str = addslashes($str);
        }
        return $str;
    }

    /**
     * 是否GET请求
     *
     * @return boolean
     */
    public function isGet() {
        if ($this->_data['REQUEST_METHOD'] == 'GET') {
            return true;
        }
        return false;
    }

    /**
     * 获取客户端的ip
     *
     * @return string
     */
    public function getClientIp() {
        $return = '';
        $ip = $this->_data['REMOTE_ADDR'];
        if (preg_match('/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/', $ip)) {
            $return = $ip;
        } else {
            $return = 'hidden';
        }
        return $return;
    }

    /**
     * 获取域名
     *
     * @return string
     */
    public function getServerName() {
        return $this->_data['SERVER_NAME'];
    }

    /**
     * 是否POST请求
     *
     * @return boolean
     */
    public function isPost() {
        $return = false;
        if ($this->_data['REQUEST_METHOD'] == 'POST') {
            $return = true;
        }
        return $return;
    }
    
    /**
     * 是否AJAX请求
     *
     * @return boolean
     */
    public function isAjax() {
        $xhr = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : false;
        return (bool) ('xmlhttprequest' == $xhr);
    }

    /**
     * 统一POST
     * @param type $key
     * @param type $default
     * @return type 
     */
    public function getPost($key = null, $default = null) {
        unset($_REQUEST);
        return (isset($_POST[$key])) ? $this->parseStr($_POST[$key]) : $default;
    }
    
    /**
     * 统一GET
     * @param type $key
     * @param type $default
     * @return type 
     */
    public function getGet($key = null, $default = null) {
        unset($_REQUEST);
        return (isset($_GET[$key])) ? $this->parseStr($_GET[$key]) : $default;
    }

    /**
     * 初始化
     * 
     * @return void
     */
    protected function init() {
        //init todo
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

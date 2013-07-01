<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

include_once 'Gospel/View/rain.tpl.class.php';
//include 'Gospel/Plugins/RedBean.class.php';

//no error reporting
//error_reporting(0);

abstract class Gospel_Controller_Abstract {

  /**
   * request
   *
   * @var Gospel_Http_Request_Abstract
   */
  protected $_req;
  protected $tpl;

  /**
   * constructor
   *
   * @param Gospel_Http_Request $request
   * @throws Gospel_Controller_Exception
   */
  public function __construct(Gospel_Http_Request_Abstract &$request) {
    header("Content-Type:text/html;charset=utf-8");
    try {
      $this->_req = $request;
      $this->init();
      $this->initView();
      //$this->initRed();
      $this->beforeDespatch($this->_req);
      $this->dispathAction($this->_req);
      $this->afterDispatch($this->_req);
    } catch (Gospel_Controller_Exception $e) {
      throw $e;
    }
  }

  /**
   * 分发Action
   *
   * @return void
   * @throws Gospel_Controller_Exception
   */
  protected function dispathAction(Gospel_Http_Request_Abstract &$request) {
    $action = $request->getAction();
    $action = strtolower($action);
    $action .= 'Action';
    if (method_exists($this, $action)) {
      $this->{$action}();
    } else {
      throw new Gospel_Controller_Exception('not found the ' . $action . ' in ' . get_class($this), 404);
    }
  }

  /**
   * 分发action之前
   * @param Gospel_Http_Request_Abstract $request
   * @return string 
   */
  protected function beforeDespatch(Gospel_Http_Request_Abstract &$request) {
  }

  /**
   * 分发action之后
   * @param Gospel_Http_Request_Abstract $request 
   */
  protected function afterDispatch(Gospel_Http_Request_Abstract &$request) {

  }

  /**
   * 获取请求
   *
   * @return Gospel_Http_Request
   */
  protected function getRequest() {
    return $this->_req;
  }

  /**
   * 重写初始化
   *
   * @return void
   */
  protected function init(){

  }

  /**
   * 跳转action
   *
   * @param string $url
   * @param array $para
   * @return void
   */
  protected function _redirect($url, array $para = array()) {

  }

  /**
   * View初始化
   * @return type 
   */
  protected function initView() {
    $this->tpl = new RainTPL();
    raintpl::configure("base_url", null);
    if(__CLI__){
      // echo realpath(dirname($_SERVER['PHP_SELF']));
      raintpl::configure("tpl_dir", "/var/www/agile/application/Gos/View/tpl/");
      raintpl::configure("cache_dir", "/var/www/agile/application/Gos/View/tmp/");
    }else{
      raintpl::configure("tpl_dir", "application/".ucfirst($this->getRequest()->getModule()) . "/View/tpl/");
      raintpl::configure("cache_dir", "application/".ucfirst($this->getRequest()->getModule()) . "/View/tmp/");
    }
    return $this->tpl;
  }

  /**
   *
   * ORM初始化
   * @return object
   */
  protected function initRed() {
    $dbMg = Gospel_Manager::get(Gospel_Manager::APP_CONFIG);
    $dbhost = $dbMg['database']['x01']['host'];
    $dbuser = $dbMg['database']['x01']['username'];
    $dbpass = $dbMg['database']['x01']['password'];
    $dbname = $dbMg['database']['x01']['dbname'];
    $this->red = R::setup("mysql:host=$dbhost;dbname=$dbname", "$dbuser", "$dbpass");
    R::freeze(true);
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

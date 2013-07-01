<?php

// +-----------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +-----------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +-----------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +-----------------------------------------------------------------------

define('__CLI__',false);
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

$include = get_include_path();
$include .= PATH_SEPARATOR;
$include .= realpath(dirname(__FILE__) . '/library');
$include .= PATH_SEPARATOR;
$include .= APPLICATION_PATH;
set_include_path($include);

//inclide files
require './library/Gospel/Application.php';
try {
    $app = new Gospel_Application();
    $app->setConfig(APPLICATION_PATH . '/config.php');
    $app->run();
} catch (Gospel_Exception $ge) {
    $ge->debug();
} catch (Exception $e) {
    print_r($e);
}

/**
* // +---------------------------------------------------------------------
* // | @ Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
* // +---------------------------------------------------------------------
* // | @ author: lenush <jnicklasj@gmail.com> qq:707207845
* // +---------------------------------------------------------------------
* Local variables:
* tab-width:4
* basic-offset:4
* indent-tabs-mode:t
* End:
*/

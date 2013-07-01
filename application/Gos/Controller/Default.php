<?php

// +-----------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +-----------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +-----------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +-----------------------------------------------------------------------

final class Gos_Controller_Default extends Gospel_Controller_Api {

    public function unitTest() {
        #echo 'phpunit testing!';
    }

    public function index() {
//        $module = new Gos_Model_Category();
//        $where = 'id=1';
//        $category = $module->getItems($where, 'id');
//        return $category;
        $this->tpl->draw('default/index');
    }

}
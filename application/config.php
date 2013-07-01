<?php

// +----------------------------------------------------------------------------
// | @Copyright (c) 2012 http://t00ls.net.
// +----------------------------------------------------------------------------
// | @Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------------
// | @author: lenush <jnicklasj@gmail.com> qq:707207845
// +----------------------------------------------------------------------------

return array(
	'database'=>array(
		'x01'=>array(
			//'host' => Gospel_Utility::Hjdecrypt('BTkBOwE5AT0PPQVtAT4FcgYu'),
			//'username' => Gospel_Utility::Hjdecrypt('VnQCOAw4XHU='),
			//'password'=> Gospel_Utility::Hjdecrypt('BiRQZF1vBTRadw=='),
			//'dbname' => Gospel_Utility::Hjdecrypt('BTwAPQo7')
			'host'=>'localhost',
			'username'=>'root',
			'password'=>'',
			'dbname'=>'ihj'
		),
		'x02'=>array(
			'host'=>'db.dbname1.com',
			'username'=>'root',
			'password'=>'root',
			'dbname'=>'dbname'
		)
	),
	'memcache'=>array(
		'x01'=>array(
			'host'=>'db.memcache1.com',
			'port'=>'1200'
		),
		'x02'=>array(
			'host'=>'db.memcache2.com',
			'port'=>'1200'
		)
	)
);
//end

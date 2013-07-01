<?php

/*
 * This is a minimal example of Testify
 * 
 */

require 'unit.php';

$tf = new Testify("A basic test suite.");

// Add a test case
$tf->test("Just testing around", function($tf){

	$tf->assert(true);
	$tf->assertFalse(false);
	$tf->assertEqual(2,'1');
	$tf->assertIdentical(1,1);
	
	$tf->assertInArray('a',array(1,2,3,4,5,'a'));
	$tf->pass();

});

$tf->run();

?>

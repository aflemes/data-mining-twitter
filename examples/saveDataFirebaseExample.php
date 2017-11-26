<?php
	require_once("../class/firebaseTest.php");
	
	$_todoMilk = array("name" => "leite");
	
	$_test = new firebaseTest();
	$_test ->_nodo = _todoMilk;
	
	$_test->setUp();
	$_test->testSet();
?>
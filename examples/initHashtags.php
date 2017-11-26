<?php
	require_once("../class/firebaseTest.php");
	
	function initFutebol($_nodo){
		return array(array('nome' => 'Gremio'),
					 array('name' => 'Inter'),
					 array('name' => 'Flamengo'),
					 array('name' => 'Corinthias'),
					 array('name' => 'Cruzeiro'),
					 array('name' => 'AtleticoMG'),
					 array('name' => 'SaoPaulo'),
					 array('name' => 'Palmeiras'),
					 array('name' => 'Santos'));
		
	}
	
	function initFutebolAmericano($_nodo){
		return array(array('nome' => 'NFL'),
				     array('nome' => 'DallasCowboys'),
					 array('name' => 'NewEnglandPatriots'));
		
	}
	
	function initeSports($_nodo){
		return array(array('nome' => 'cblol'),
				     array('nome' => 'lol'),
					 array('name' => 'csgo'),
					 array('name' => 'dota')
					 array('name' => 'overwatch')
					 array('name' => 'fifa')
					 array('name' => 'pes'));
		
	}
	
	$_test = new firebaseTest();
	$_test ->_nodo = _todoMilk;
	
	$_test->setUp();
	$_test->testSet();
?>
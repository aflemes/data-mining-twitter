<?php
	require_once("../class/firebaseTest.php");
	ini_set('max_execution_time', 300);
	
	function initFutebol(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo = array(array('nome' => 'Futebol'),
					   array('nome' => 'Gremio'),
				   	   array('nome' => 'Inter'),
					   array('nome' => 'Flamengo'),
					   array('nome' => 'Corinthias'),
					   array('nome' => 'Cruzeiro'),
					   array('nome' => 'AtleticoMG'),
					   array('nome' => 'SaoPaulo'),
					   array('nome' => 'Palmeiras'),
					   array('nome' => 'Santos'),
					   array('nome' => 'Brasileirao2017'));
					   
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/futebol/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	function initFutebolAmericano(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo = array(array('nome' => 'FutebolAmericano'),
					   array('nome' => 'NFL'),
					   array('nome' => 'NFLBrasil'),
					   array('nome' => 'PittsburghSteelers'),
					   array('nome' => '@steelers'),
					   array('nome' => 'DallasCowboys'),
					   array('nome' => 'São Francisco 49ers'),
					   array('nome' => '@49ers'),
					   array('nome' => 'NewEnglandPatriots'),
					   array('nome' => '@Patriots'),
					   array('nome' => 'Green Bay Packers'),
					   array('nome' => '@packers'),
					   array('nome' => 'New York Giants'),
					   array('nome' => 'SuperBowl'));
					   
	   foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/futebolamericano/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}		
	}
	
	function initeSports(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo =  array(array('nome' => 'esports'),
						array('nome' => 'cblol'),
					    array('nome' => 'lol'),
						array('nome' => 'csgo'),
						array('nome' => 'dota'),
						array('nome' => 'overwatch'),
						array('nome' => 'fifa'),
						array('nome' => 'pes'),
						array('nome' => 'pugb'));
					 
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/esports/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	//inicio do bloco
	initFutebol();
	initFutebolAmericano();
	initeSports();
?>
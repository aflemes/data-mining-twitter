<?php
	require_once("../class/firebaseTest.php");
	ini_set('max_execution_time', 300);
	
	function initFutebol(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo = array(array('nome' => '#Futebol',
							 'categoria' => 'Futebol'),
					   array('nome' => '#Copadobrasil',
							 'categoria' => 'Futebol'),
					   array('nome' => '#Libertadores',
							 'categoria' => 'Futebol'),
					   array('nome' => '#Brasileirao2017',
							 'categoria' => 'Futebol'));
					   
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	function initFutebolAmericano(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo = array(array('nome' => '#FutebolAmericano',
							 'categoria' => 'FutebolAmericano'),
					   array('nome' => '#NFL',
							 'categoria' => 'FutebolAmericano'),
					   array('nome' => '#NFLBrasil',
							 'categoria' => 'FutebolAmericano'),
					   array('nome' => '#SuperBowl',
							 'categoria' => 'FutebolAmericano'));
					   
	   foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}		
	}
	
	function initeSports(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo =  array(array('nome' => '#ESports',
							 'categoria' => 'ESports'),
						array('nome' => '#cblol',
							 'categoria' => 'ESports'),
					    array('nome' => '#lol',
							 'categoria' => 'ESports'),
						array('nome' => '#csgo',
							 'categoria' => 'ESports'),
						array('nome' => '#dota',
							 'categoria' => 'ESports'),
						array('nome' => '#overwatch',
							 'categoria' => 'ESports'),
						array('nome' => '#fifa',
							 'categoria' => 'ESports'),
						array('nome' => '#pes',
							 'categoria' => 'ESports'),
						array('nome' => '#wow',
							 'categoria' => 'ESports'),
						array('nome' => '#pugb',
							 'categoria' => 'ESports'));
					 
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	function initAtletismo(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo =  array(array('nome' => '#Atletismo',
							 'categoria' => 'Atletismo'),
						array('nome' => '#corrida',
							 'categoria' => 'Atletismo'));
					 
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	function initNatacao(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo =  array(array('nome' => '#Natacao',
							 'categoria' => 'Natação'),
						array('nome' => '#Natação',
							 'categoria' => 'Natação'));
					 
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	function initVoleibol(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo =  array(array('nome' => '#Voleibol',
							 'categoria' => 'Voleibol'),
						array('nome' => '#Volei',
							 'categoria' => 'Voleibol'),
						array('nome' => '#volleyball',
							 'categoria' => 'Voleibol'),
						 array('nome' => '#volei',
							 'categoria' => 'Voleibol'),
						array('nome' => '#superliga',
							 'categoria' => 'Voleibol'));
					 
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	function initBasquete(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		
		$_nodo =  array(array('nome' => '#Basquete',
							 'categoria' => 'Basquete'),
						array('nome' => '#NBB',
							 'categoria' => 'Basquete'));
					 
		foreach($_nodo as $elements){
			$key_value = hash('md5', $elements["nome"]);
			$path = "hashtag/".$key_value;
			
			$_firebase->_nodo = $elements;
			$_firebase->setHashtag(strval($path));
		}
	}
	
	
	//inicio do bloco
	initFutebol();
	initFutebolAmericano();
	initeSports();
	initAtletismo();
	initNatacao();
	initBasquete();
	initVoleibol();
?>
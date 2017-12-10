<?php
	require_once("../class/firebaseTest.php");
	
	ini_set('max_execution_time', 300);
	
	function get_tweets(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		$_firebase->setTimeout(120);
		
		$_hashtags = $_firebase->getTweet("tweet");
		$_hashtags = json_decode($_hashtags);
		
		$tweets = array();
		foreach($_hashtags as $hash)
		{
			$node = json_decode(json_encode($hash),true);	
			array_push($tweets,$node);
		}
	
		return $tweets;
	}
	
	function get_hashtags(){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		$_firebase->setTimeout(120);
		
		$_hashtags = $_firebase->getHashtag("hashtag");
		$_hashtags = json_decode($_hashtags);
		
		$hashtag = array();
		foreach($_hashtags as $hash)
		{
			$node = json_decode(json_encode($hash),true);	
			array_push($hashtag,$node);
		}
	
		return $hashtag;
	}
	
	$tweets = get_tweets();
	
	$_tweetHashTag = array();
	foreach($tweets as $nodo){
		array_push($_tweetHashTag,$nodo["_tweetHashTag"]);
	}
	
	$hashTags = get_hashtags();
	
	$resultados = array("Futebol" 		   => 0,
						"FutebolAmericano" => 0,
						"ESports" 		   => 0,
						"Atletismo" 	   => 0,
						"Natação" 	  	   => 0,
						"Voleibol" 		   => 0,
						"Basquete" 		   => 0);
	
	
	foreach($_tweetHashTag as $element){
		//varre as hashtags do tweet
		$lgSair = false;
		foreach($element as $nodo){
			//varre todos as hashtags da base para encontrar a categoria
			foreach($hashTags as $hash){
				if (strcmp($hash["nome"],$nodo) == 0){
					$resultados[$hash["categoria"]]++;
					$lgSair = true;
					break;
				}
			}
			if ($lgSair)
				break;
		}
	}
	
	echo json_encode($resultados);
	
	
?>
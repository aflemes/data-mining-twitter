<?php
	require_once("../class/firebaseTest.php");
	
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
			array_push($hashtag,$node["nome"]);
		}
	
		return $hashtag;
	}
	
	$hashtag = get_hashtags();
	
	print_r($hashtag);
	
?>
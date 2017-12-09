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
			foreach($hash as $node)
			{
				$node = json_decode(json_encode($node),true);	
				array_push($tweets,$node);
			}
		}
	
		return $tweets;
	}
	
	$tweets = get_tweets();
	
	echo "A pesquisa foi feita com base em ".sizeof($tweets)." tweets!"
	
?>
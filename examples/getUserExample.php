<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../class/Tweet.php');
	require_once("../class/firebaseTest.php");
	
	ini_set('max_execution_time', 300);
	
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
		'oauth_access_token' => "923623717460234243-T1wKq7d1Y2yJBMEvCkn5NyzkmK0K8b1",
		'oauth_access_token_secret' => "VFbjmnAbAzGUkRJ7yr6N82s28oCCOtDPL2ZvKGXuPDXhZ",
		'consumer_key' => "okxNaA6wr3ZUY8AzRn6mmQNrC",
		'consumer_secret' => "Q9EjQMBKcD0OQ87rml6oH9TX8baX2JqLYFaJqPmR1748HthcK2"
	);

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=G1';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$response = $twitter->setGetfield($getfield)
						->buildOauth($url, $requestMethod)
						->performRequest();

	$result = json_decode($response);
	$tweets = array();
	
	foreach($result as $tweet)
	{
		$array = json_decode(json_encode($tweet),true);
		//hastags
		if (strpos($array["text"], '#') !== false) {
			$hashTags = explode("#",$array["text"]);
			unset($hashTags[0]);
		}
		else 
			$hashTags = "";
		
		$childNode = array (
			"_tweetId"	 => $array["id_str"],
			"_tweetDate" => $array["created_at"],
			"_tweetText" => $array["text"],
			"_tweetUser" => $array["user"]["screen_name"],
			"_tweetHashTag" => $hashTags);
			
		array_push($tweets, $childNode);
		
	}
		
	$_firebase = new firebaseTest();
	$_firebase->setTimeout(60);
	$_firebase->setUp();
	
	foreach($tweets as $elements){
		$path = "tweet/".$elements['_tweetId'];
		
		$_firebase ->_nodo = $elements;
		$_firebase ->setTweet(strval($path));
	}
?>
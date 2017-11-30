<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../class/Tweet.php');
	require_once("../class/firebaseTest.php");
	
	ini_set('max_execution_time', 300);
	
	/* initialize */
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	
	$settings = array(
		'oauth_access_token' => "923623717460234243-T1wKq7d1Y2yJBMEvCkn5NyzkmK0K8b1",
		'oauth_access_token_secret' => "VFbjmnAbAzGUkRJ7yr6N82s28oCCOtDPL2ZvKGXuPDXhZ",
		'consumer_key' => "okxNaA6wr3ZUY8AzRn6mmQNrC",
		'consumer_secret' => "Q9EjQMBKcD0OQ87rml6oH9TX8baX2JqLYFaJqPmR1748HthcK2"
	);
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	
	
	/* functions */
	
	function get_tweet($settings,$url){		
		$getfield = '?screen_name=aflemess&count=10';
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
		
		return $tweets;
	}
	
	function set_tweet($tweets){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		$_firebase->setTimeout(120);
		
		foreach($tweets as $elements){
			$path = "tweet/".$elements['_tweetId'];
			
			$_firebase ->_nodo = $elements;
			$_firebase ->setTweet(strval($path));
		}
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
			foreach($hash as $node)
			{
				$node = json_decode(json_encode($node),true);			
				array_push($hashtag,$node["nome"]);
			}
		}
	
		return $hashtag;
	}

	/* INICIO DO BLOCO */
	
	$tweets  = get_tweet($settings,$url);
	$hastags = get_hashtags();
	
	$id_nodo = 0;
	
	foreach($tweets as $elements){
		$lgSaveTweet = false;
		$tweet_hashtags = $elements['_tweetHashTag'];
		
		//verifica se o tweet sera salvo ou nao
		if ($tweet_hashtags != null){
			print_r($hastags);
			print_r($tweet_hashtags);
			echo "<br>-----------------------------<br>";
			
			$result = array_intersect($hastags, $tweet_hashtags);
			
			echo sizeof($result);
			if (sizeof($result) > 0){
				//tem alguma hashtag valida;
				$lgSaveTweet = true;
			}
		}
		if (!$lgSaveTweet){
			echo "dispose element";
			unset($tweets[$id_nodo]);
		}
		$id_nodo += 1;
	}
	echo "terminei a busca do tweet e encontrei -> ".sizeof($tweets);
	print_r($tweets)."<br>";

	
?>
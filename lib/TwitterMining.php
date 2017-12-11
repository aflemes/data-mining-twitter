<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../class/Tweet.php');
	require_once("../class/firebaseTest.php");
	
	ini_set('max_execution_time', 300);
	ini_set('error_reporting', E_ALL);
	
	/* initialize */
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	
	$settings = array(
		'oauth_access_token' => "923623717460234243-T1wKq7d1Y2yJBMEvCkn5NyzkmK0K8b1",
		'oauth_access_token_secret' => "VFbjmnAbAzGUkRJ7yr6N82s28oCCOtDPL2ZvKGXuPDXhZ",
		'consumer_key' => "okxNaA6wr3ZUY8AzRn6mmQNrC",
		'consumer_secret' => "Q9EjQMBKcD0OQ87rml6oH9TX8baX2JqLYFaJqPmR1748HthcK2"
	);
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	
	
	/* functions */
	
	function get_tweet($settings,$url,$date,$tag){		
		$getfield = '?q=#'.$tag.'&count=200';
		if ($date != ""){
			//7day limit
			$getfield .= "&until=".$date;
		}
		
		echo "Estou procurando pela tag ".$tag."...\n";
		$requestMethod = 'GET';
	
		$twitter = new TwitterAPIExchange($settings);
		$response = $twitter->setGetfield($getfield)
							->buildOauth($url, $requestMethod)
							->performRequest();

		$result = json_decode($response);
		$ArrTweets = array();
		
		foreach($result as $tweets)
		{
			foreach($tweets as $tweet)
			{
				$node = json_decode(json_encode($tweet),true);				
				
				try{
					if ($node["text"] == ""){
						break;
					}
				}
				catch(Exception $e){}
				
				//hastags
				if (strpos($node["text"], '#') !== false) {
					$hashTags = explode(" ",$node["text"]);
					$_hash = array();
					
					foreach($hashTags as $element){
						if (strstr($element, '#')){
							array_push($_hash,$element);
						}
					}
					$hashTags = $_hash;
				}
				else 
					$hashTags = "";
				
				$childNode = array (
					"_tweetId"	 => $node["id_str"],
					"_tweetDate" => $node["created_at"],
					"_tweetText" => $node["text"],
					"_tweetUser" => $node["user"]["screen_name"],
					"_tweetHashTag" => $hashTags);
					
				array_push($ArrTweets, $childNode);
				
			}
		}
		
		return $ArrTweets;
	}
	
	function set_tweet($tweets){
		$_firebase = new firebaseTest();
		$_firebase->setUp();
		$_firebase->setTimeout(120);
		
		$lgSalvei = false;
		foreach($tweets as $elements){
			$path = "tweet/".$elements['_tweetId'];
			
			$_firebase ->_nodo = $elements;
			$_firebase ->setTweet(strval($path));
			
			$lgSalvei = true;
		}
		if ($lgSalvei)
			echo "Tweets salvos com sucesso!"."\n";
		else
			echo "Nenhum tweet sera salvo na base!"."\n";
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
			array_push($hashtag,$node["nome"]);
		}
	
		return $hashtag;
	}
	
	//nesse laco de repeitacao, o programa ira filtrar os tweets para salvar apenas
	//os que tem as hashtags predefinidas
	function filtra_tweets($tweets,$hashtags){
		//
		$id_nodo = 0;
		//
		foreach($tweets as $elements){
			$lgSaveTweet = false;
			$tweet_hashtags = $elements['_tweetHashTag'];

			//verifica se o tweet sera salvo ou nao
			if ($tweet_hashtags != null){
				$result = array_intersect($hashtags, $tweet_hashtags);
				
				if (sizeof($result) > 0){
					//tem alguma hashtag valida;
					$lgSaveTweet = true;
				}
			}
			if (!$lgSaveTweet){
				unset($tweets[$id_nodo]);
			}
			$id_nodo += 1;
		}
		
		return $tweets;
	}
	
	echo "Mineirando...\n";
	ob_flush();
	
	$periodo = $_POST["periodo"];
	$tag 	 = $_POST["tag"];
	// $periodo = "06-12-2017";
	// $tag 	 = "#Gremio";
	
	
	$date = date("Y-m-d", strtotime($periodo));
	echo $date."\n";
	//
	$tweets  = get_tweet($settings,$url,$date,$tag);
	
	$hastags = get_hashtags();
	$tweets  = filtra_tweets($tweets,$hastags);
	set_tweet($tweets);
	flush();
	//seta nova data
	$date = date('Y-m-d', strtotime($date .' +1 day'));
?>
<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../class/Tweet.php');
	require_once("../class/firebaseTest.php");
	
	ob_implicit_flush(true);
	ini_set('max_execution_time', 300);
	ini_set('error_reporting', E_ERROR);
	
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
	
	function get_tweet($settings,$url,$date){		
		$getfield = '?q=#Futebol&count=200';
		if ($date != ""){
			$getfield .= "&until=".$date;
		}
		
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
					$hashTags = explode("#",$node["text"]);
					unset($hashTags[0]);
					
					$index = 0;
					foreach($hashTags as $tag){
						$hashTags[$index] = trim($tag);
						$index++;
					}
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
			
			$lgSalvei == true;
		}
		if ($lgSalvei)
			echo "Tweets salvos com sucesso"."<br>";
		else
			echo "Nenhum tweet sera salvo na base"."<br>";
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

	$tweets  = get_tweet($settings,$url,'');
	print_r($tweets["_tweetHashTag"]);
	$hastags = get_hashtags();
	$tweets  = filtra_tweets($tweets,$hastags);
	set_tweet($tweets);	
	
	/*
	$dias_pesquisa = 10;
	$now = date('Y-m-d');
	//
	$init_date = date('Y-m-d', strtotime('-'.$dias_pesquisa.' day',strtotime($now)));
	$date = $init_date;
	for ($i=0;$i < $dias_pesquisa;$i++){
		echo $date."<br>";
		//
		//$tweets  = get_tweet($settings,$url,$date);
		$tweets  = get_tweet($settings,$url,'');
		print_r($tweets);
		$hastags = get_hashtags();
		$tweets  = filtra_tweets($tweets,$hastags);
		set_tweet($tweets);
		@ob_flush();
		//seta nova data
		$date = date('Y-m-d', strtotime($date .' +1 day'));
	}*/
?>
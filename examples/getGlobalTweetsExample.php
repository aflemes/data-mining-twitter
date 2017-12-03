<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../conf/settings.php');
	
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q=#Gremio';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$response = $twitter->setGetfield($getfield)
						->buildOauth($url, $requestMethod)
						->performRequest();

	$result = json_decode($response);
	
	foreach($result as $tweet)
	{
		foreach($tweet as $tweets)
		{
			$array = json_decode(json_encode($tweet),true);
				
			if (!(sizeof($array) > 0)){
				echo "Oi";
			}
				
			/*foreach($array as $node)
			{
				echo $node["created_at"];
			}
			*/
		}
	}
?>
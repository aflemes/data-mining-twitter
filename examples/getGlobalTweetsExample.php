<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../conf/settings.php');
	
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q=#nerd';
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
			echo var_dump($tweets)."<-----------------><br>";
		}
	}
?>
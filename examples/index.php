<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../conf/settings.php');
	
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';	
	$getfield = '?q=#Gremio';
	$requestMethod = 'GET';
	
	$twitter = new TwitterAPIExchange($settings);
	$response = $twitter->setGetfield($getfield)
						->buildOauth($url, $requestMethod)
						->performRequest();

	$result = json_decode($response);
	var_dump($result);

?>
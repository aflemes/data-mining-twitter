<?php
	require_once('lib/TwitterAPIExchange.php');
	require_once('conf/settings.php');

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=aflemess';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$response = $twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest();

	var_dump(json_decode($response));
?>
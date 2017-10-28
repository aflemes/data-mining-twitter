<?php
	require_once('../lib/TwitterAPIExchange.php');
	require_once('../conf/settings.php');
	
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$requestMethod = 'GET';

	$getfield = '?q=test&geocode=37.781157,-122.398720,1mi&count=100';

	$twitter = new TwitterAPIExchange($settings);
	$response =  $twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest();

	var_dump(json_decode($response));
?>
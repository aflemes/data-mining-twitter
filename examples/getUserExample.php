<?php
	require_once('lib/TwitterAPIExchange.php');

	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
		'oauth_access_token' => "923623717460234243-T1wKq7d1Y2yJBMEvCkn5NyzkmK0K8b1",
		'oauth_access_token_secret' => "VFbjmnAbAzGUkRJ7yr6N82s28oCCOtDPL2ZvKGXuPDXhZ",
		'consumer_key' => "okxNaA6wr3ZUY8AzRn6mmQNrC",
		'consumer_secret' => "Q9EjQMBKcD0OQ87rml6oH9TX8baX2JqLYFaJqPmR1748HthcK2"
	);

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=aflemess';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$response = $twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest();

	var_dump(json_decode($response));
?>
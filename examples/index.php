<?php
	$hashtags = array();
	array_push($hashtags,"Gremio");
	array_push($hashtags,"overwatch");
	array_push($hashtags,"cblol");
	array_push($hashtags,"SaoPaulo");
	array_push($hashtags,"Palmeiras");
	array_push($hashtags,"steelers");
	array_push($hashtags,"NewEnglandPatriots");
	
	$tweet_hashtag = array();
	
	array_push($hashtags,"Gremio");
	array_push($hashtags,"Futebol");
	array_push($hashtags,"MaiordoSul");
	
	$result = array_intersect($tweet_hashtag,$hashtags);
	
	VAR_DUMP($result);
	
	
?>
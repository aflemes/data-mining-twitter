<?php
	$node = array();
	array_push($node,"lorem ipsum");
	array_push($node,"llul");
	array_push($node,"gremio");
	
	for($i = 0; $i < sizeof($node); $i++){
		if (!isset($node["text"])){
			next;
		}
		
		echo $node["text"];
		
	}
	
?>
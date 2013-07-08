<?php

$api_url ="http://search.twitter.com/search.json?q=hitecfest&include_entities=true&result_type=recent&rpp=100&since_id=289276643489501183";
		
		$results = json_decode(file_get_contents ($api_url));
		
		$string=(string)$results->max_id_str;
		
		echo $string;
		
		print_r($results);

?>
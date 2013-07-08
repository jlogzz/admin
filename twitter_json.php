<?php

	require('rb.php');
	require_once('TwitterAPIExchange.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	
	$string = file_get_contents("./lasalitas.json");
	
	//echo $string;
	
		$results = json_decode($string);	
		
		$constants = get_defined_constants(true);
		$json_errors = array();
		foreach ($constants["json"] as $name => $value) {
			if (!strncmp($name, "JSON_ERROR_", 11)) {
				$json_errors[$value] = $name;
			}
		}
		
		foreach (range(4, 3, -1) as $depth) {
			var_dump(json_decode($string, true, $depth));
			echo 'Last error: ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
		}
		
		var_dump(json_decode($string));
		/*
		if(!empty($results->statuses)){
			echo "2";
			$event->lasttweet=$results->max_id_str;
			
			foreach($results->statuses as $result){
				echo ".";
				$tweet=R::dispense('tweets');
				$tweet->tweetid=$result->id_str;
				$tweet->datestr=strtotime(substr($result->created_at,5,24));
				$tweet->from=$result->user->screen_name;
				$tweet->fromimg=$result->user->profile_image_url;
				foreach($result->entities->user_mentions as $mention){
					$mentions=$mentions."|".$mention->screen_name;
				}
				$tweet->mentions=$mentions;
				$tweet->message=$result->text;
				foreach($result->entities->hashtags as $hashtag){
					$hashtags=$hashtags."|".$hashtag->text;
				}
				$tweet->hashtags=$hashtags;
				foreach($result->entities->urls as $url){
					$urls=$urls."|".$url->expanded_url;
				}
				$tweet->urls=$urls;
				$tweet->status="pending";
				
				
				$event->sharedTweets[]=$tweet;
				R::store($tweet);
			}
			
			R::store($event);
			
			//$fecha=$results->results[$i]->created_at;
			//$tweetid=$results->results[$i]->id_str;
			//$from=$results->results[$i]->from_user;
			//$fromimg=$results->results[$i]->profile_image_url;
			//foreach($results->results[$i]->entities->user_mentions as $mention){
			//	$mentions=$mentions."|".$mention->screen_name;
			//}
			//$message=$results->results[$i]->text;
			//foreach($results->results[$i]->entities->hashtags as $hashtag){
			//	$hashtags=$hashtags."|".$hashtag->text;
			//}
			//foreach($results->results[$i]->entities->urls as $url){
			//	$urls=$urls."|".$url->expanded_url;
			//}
			//print_r($results);
		}
	}
	*/
?>
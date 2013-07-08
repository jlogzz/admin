<?php

	require('rb.php');
	require_once('TwitterAPIExchange.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	
	$settings = array(
		'oauth_access_token' => "123790447-2AnICSAgQHCy1DNL9g9SEqS9Zv22WmjWNBTvtYfg",
		'oauth_access_token_secret' => "CfMFQF03PeC7UgHXs5T0U9W2f9k5nFgScDNnoI",
		'consumer_key' => "w0lSs1LzOjca1y9T6nAg",
		'consumer_secret' => "poBQGWOF8oiXW2i16NXZPw86HEnSgozIyUMXpaKbNU"
	);
	
	$events=R::getAll('select * from events where active = 1');
	foreach($events as $eventf){
		$event=R::load('events',$eventf['id']);

		$api_url = "https://api.twitter.com/1.1/search/tweets.json?q=".$event->search."&include_entities=true&result_type=recent&count=100&since_id=".$event->lasttweet;
		//"http://search.twitter.com/search.json?q=hitecfest&include_entities=true&result_type=recent&rpp=100&since_id=289228000099180544";
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$getfield = '?q='.$event->search."&include_entities=true&result_type=recent&count=10&since_id=".$event->lasttweet;
		$requestMethod = 'GET';
		
		$twitter = new TwitterAPIExchange($settings);
		$resultss = $twitter->setGetfield($getfield)
					 ->buildOauth($url, $requestMethod)
					 ->performRequest();
		$results = json_decode($resultss);
		if(!empty($results->statuses)){
			$event->lasttweet=$results->search_metadata->max_id_str;
			
			foreach($results->statuses as $result){
				$tweet=R::dispense('tweets');
				$tweet->tweetid=$result->id_str;
				$tweet->datestr=strtotime($result->created_at);
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
			echo ".";
		}
	}
?>
<?php

	require('rb.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	
	$user=R::dispense('users');
	$user->name="turismonl";
	$user->password=md5("socialsystems");
	$user->lvl=2;//entre mas bajo mas permisos
	
	$event=R::dispense('events');
	$event->name="NLenTiaguis";
	$event->search="%23NLenTianguis+%40TurismoNL";
	$event->active=true;
	$event->hashtags=3;
	$event->retweets=true;
	$event->replys=true;
	$event->lasttweet="12345abc";
	
	$user->sharedEvents[]=$event;
	
	$tweet=R::dispense('tweets');
	$tweet->tweetid="12345abc";
	$tweet->datestr="Thu, 06 Oct 2011 19:36:17 +0000";
	$tweet->from="jlogzz";
	$tweet->fromimg="http://a3.twimg.com/profile_images/51584619/SFist07_normal.jpg";
	$tweet->mentions="hitecfest";
	$tweet->message="Hola a todos en #hitecfest :D";
	$tweet->hashtags="hitecfest";
	$tweet->urls="http://google.com";
	$tweet->status="pending";
	
	$event->sharedTweets[]=$tweet;
	
	R::store($tweet);
	R::store($event);
	R::store($user);

?>
<?php

	require('rb.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	
	$eventId=1;
	
	$event=R::load('events',$eventId);
	$event->active=false;
	
	
	R::store($event);

?>
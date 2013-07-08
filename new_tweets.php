<?php

	require('rb.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	
	$eventId=$_POST['id'];
	
	$event=R::load('events',$eventId);
	
	function cmp($a, $b)
	{
		$a=$a->datestr;
		$b=$b->datestr;
		if ($a == $b) {
			return 0;
		}
		return ($a > $b) ? -1 : 1;
	}
	function display_tweets($event){
		$tweets=$event->withCondition(' status == ? ',array("auth"))->sharedTweets;
		$tweetis=usort($tweets,"cmp");
		$i=0;
		$tweetarray;
		foreach($tweets as $tweet){
			if($tweet->status=="auth"){
				$tweetarray[$i]=array('from'=>$tweet->from,'tweet'=>$tweet->message,'pic'=>$tweet->fromimg);
				$i++;
			}
			if($i==9){
				break;
			}
		}
		/*
		for($i=0;$i<3;$i++){
			$tweetarray[$i]=array('from'=>$tweets[$i]->from,'tweet'=>$tweets[$i]->message);
		}	
		*/
		echo json_encode($tweetarray);
	}
	
	display_tweets($event);
	

?>
<?php

	require('rb.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	
	$db = new mysqli('68.178.138.50', 'livetweets', 'Sauali!123', 'livetweets');

	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$sql = "
		SELECT tweets.`from`, COUNT(*) AS count
		FROM tweets, events_tweets
		WHERE tweets.`id`=events_tweets.`tweets_id` AND events_tweets.`events_id`=5 GROUP BY tweets.`from` ORDER BY count DESC
	";
	
	$sum=0;

	if(!$result = $db->query($sql)){
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while($row = $result->fetch_assoc()){
		echo $row['from'] . ' -> '. $row['count'].'<br />';
		$sum+=$row['count'];
	}

	echo "Total de tweets: ".$sum;

?>
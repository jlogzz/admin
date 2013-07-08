<?php

	require('rb.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	session_start();
	if(isset($_SESSION['myusername'])){
		$id=$_SESSION['id'];
		$user=R::load('users',$id);
	}else{
		header("location:index.php");
	}
	
	function display_events($user){
		$events=$user->sharedEvents;
		foreach($events as $event){
			if($event->active){
				echo "<option value='".$event->id."'>".$event->name."</option>";
			}
		}
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>LiveTweets -</title>
<link href="./styles/styles.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
</head>

<body>
<section class="content">
	<img class="logo" src="img/logo_final.png" />
    <div class="login">
    	<h1>Eventos:</h1>
    	<form action="event.php" method="post" class="form_login">
                <select name="id"><?php display_events($user); ?></select>
                <button type="submit" class="button center">FILTRAR</button>
        </form>
    </div>
</section>
</body>
</html>
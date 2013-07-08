<?php
	
	require('rb.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');
	
	$idstr=$_POST['id'];
	$idarray=explode("|",$idstr);
	$id=substr($idarray[0],2,(strlen($idarray[0])-1));
	$status=$idarray[1];
	
	$tweet=R::load('tweets',$id);
	$tweet->status=$status;
	R::store($tweet);
	
	if($status=="pending"){
		echo "<div id='t_".$tweet->id."' class='btn_auth'>AUTH</div><div id='t_".$tweet->id."' class='btn_reject'>REJECT</div>";
	}else if($status=="auth"){
		echo "<div id='t_".$tweet->id."' class='btn_pending'>PENDING</div><div id='t_".$tweet->id."' class='btn_reject'>REJECT</div>";
	}else if($status=="reject"){
		echo "<div id='t_".$tweet->id."' class='btn_auth'>AUTH</div><div id='t_".$tweet->id."' class='btn_pending'>PENDING</div>";
	}

?>
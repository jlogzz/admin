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
	if(isset($_POST['id'])){
		$event=R::load('events',$_POST['id']);
	}else{
		header("Location:index.php");
	}
	if(isset($_POST['load'])){
		$status=$_POST['load'];
	}else{
		$status="pending";
	}
	
	function display_events($user){
		$events=$user->sharedEvents;
		foreach($events as $event){
			if($event->active==1){
				echo "<option value='".$event->id."'>".$event->name."</option>";
			}
		}
	}
	function cmp($a, $b)
	{
		$a=$a->datestr;
		$b=$b->datestr;
		if ($a == $b) {
			return 0;
		}
		return ($a > $b) ? -1 : 1;
	}
	function display_tweets($event,$status){
		$tweets=$event->with('order by message asc limit 100')->sharedTweets;
		$tweetis=usort($tweets,"cmp");
		foreach($tweets as $tweet){
			if($tweet->status==$status){
				echo "<tr>
					<td><img src='".$tweet->fromimg."' class='pimage' /></td>
					<td>".$tweet->from."</td>
					<td>".$tweet->message."</td>
					<td class='t_".$tweet->id."_status'>".strtoupper($tweet->status)."</td>
					<td class='t_".$tweet->id."_color'>";
					if($tweet->status=="pending"){
						echo "<div id='t_".$tweet->id."' class='btn_auth'>AUTH</div><div id='t_".$tweet->id."' class='btn_reject'>REJECT</div>";
					}else if($tweet->status=="auth"){
						echo "<div id='t_".$tweet->id."' class='btn_pending'>PENDING</div><div id='t_".$tweet->id."' class='btn_reject'>REJECT</div>";
					}else if($tweet->status=="reject"){
						echo "<div id='t_".$tweet->id."' class='btn_auth'>AUTH</div><div id='t_".$tweet->id."' class='btn_pending'>PENDING</div>";
					}
					
					echo"</td>
				  </tr>";
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
<link href="./styles/demo_table_jui.css" rel="stylesheet" type="text/css">
<link href="./styles/excite-bike/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
</head>
<script>
	$(document).ready(function(e) {
		
		$(".btn_auth").click(function(){
			var id = $(this).attr('id')+"|auth";
			var ids=$(this).attr('id');
			$.ajax({
			  type: "POST",
			  url: "change_status.php",
			  datatype: "html",
			  data: "id="+id,
			  success: function(data) {
				  $("."+ids+"_color").html(data);
				  $("."+ids+"_status").html("AUTH");
				}
			});
		});
		$(".btn_pending").click(function(){
			var id = $(this).attr('id')+"|pending";
			var ids=$(this).attr('id');
			$.ajax({
			  type: "POST",
			  url: "change_status.php",
			  datatype: "html",
			  data: "id="+id,
			  success: function(data) {
				  $("."+ids+"_color").html(data);
				  $("."+ids+"_status").html("PENDING");
				}
			});
		});
		$(".btn_reject").click(function(){
			var id = $(this).attr('id')+"|reject";
			var ids=$(this).attr('id');
			$.ajax({
			  type: "POST",
			  url: "change_status.php",
			  datatype: "html",
			  data: "id="+id,
			  success: function(data) {
				  $("."+ids+"_color").html(data);
				  $("."+ids+"_status").html("REJECT");
				}
			});
		});
		
		 $('#tweets').dataTable( {
			"bJQueryUI": true
		} );
		
        $("#pending").click(function(){
			$("#form_pending").submit();
		});
		$("#auth").click(function(){
			$("#form_auth").submit();
		});
		$("#reject").click(function(){
			$("#form_reject").submit();
		});
    });
</script>
<body>
<form action="event.php" method="post" id="form_pending">
    <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
    <input type="hidden" name="load" value="pending" />
</form>
<form action="event.php" method="post" id="form_auth">
    <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
    <input type="hidden" name="load" value="auth" />
</form>
<form action="event.php" method="post" id="form_reject">
    <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
    <input type="hidden" name="load" value="reject" />
</form>
<section class="content">
	<img class="logo small" src="img/logo_final.png" />
    <div class="botones">
        <div id="pending" class="button left">PENDING</div>
        <div id="auth" class="button left">AUTHORIZED</div>
        <div id="reject" class="button left">REJECTED</div>
    </div>
    <div class="tweets">
    	<table id="tweets" class="alumnos">
            <thead>
                <tr>
                    <th>IMG</th>
                    <th>FROM</th>
                    <th>MESSAGE</th>
                    <th>STATUS</th>
                    <th>CHANGE</th>
                </tr>
            </thead>
            <tbody>
                <?php display_tweets($event,$status); ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
<?php
ob_start();
$host="68.178.138.50"; // Host name 
$username="livetweets"; // Mysql username 
$password="Sauali!123"; // Mysql password 
$db_name="livetweets"; // Database name 
$tbl_name="users"; // Table name

	require('rb.php');
	R::setup('mysql:host=68.178.138.50;dbname=livetweets','livetweets','Sauali!123');

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['user']; 
$mypassword=$_POST['pass']; 

$users = R::getAll( 'select * from users' );
foreach($users as $user){
	if($user['name']==$myusername){
		$id=$user['id'];
	}
}
// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

// encrypt password 
$mypassword=md5($mypassword);

$sql="SELECT * FROM users WHERE name='$myusername' and password='$mypassword'";
$result=mysql_query($sql);


// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
	session_start();
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['id'] = $id;
$_SESSION["myusername"] = $myusername;
$_SESSION["mypassword"] = $mypassword;
header("location:admin.php");
}
else {
header("location:index.php?login=false");
}

ob_end_flush();
?>
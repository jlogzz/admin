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
    	<form action="checklogin.php" method="post" class="form_login">
                <label for="user">USER:</label><input name="user" id="user" class="inputs"><br/><br/><br/><br/>
                <label for="pass">PASS:</label><input type="password" name="pass" id="pass" class="inputs"><br/><br/><br/><br/>
                <button type="submit" class="button center">LOGIN</button>
        </form>
    </div>
</section>
</body>
</html>
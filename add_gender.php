<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");

?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/profilepage.css">
</head>
<body>

	<div class="for_textarea clear">
<form action="profile.php#basic_info" method="post">

<h4>Add Gender</h4>
<input type="radio" name="gen" value="male">  Male
<input type="radio" name="gen" value="female">  Female<br>
<button name="gen-btn">Add</button>
</form>

</div>
</body>
</html>
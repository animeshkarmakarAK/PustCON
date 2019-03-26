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
	<title></title>
	<link rel="stylesheet" type="text/css" href="./css/profilepage.css">
</head>
<body>
<div class="for_textarea clear">
<form action="profile.php" method="POST">
	<h4>Write about yourself</h4>
	<table>
		<tr>
			<td><input type="text" name="about" maxlength="300"></td>
		</tr>
		<tr><td><button name="about-btn">Add</button></td></tr>
	</table>
</form>
	
</div>
</body>
</html>


<?php 
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
	<h4>Add your interest </h4>
	<table>
		<tr>
			<td><input type="text" name="ii" maxlength="100"></td>
		</tr>
		<tr><td><button name="ii-btn">Add</button></td></tr>
	</table>
</form>
	
</div>
</body>
</html>


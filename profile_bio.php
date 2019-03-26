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
 <form action="profile.php" method="post" enctype="multipart/form-data">
 	<h4>Describe who you are</h4>
<textarea name = "bio" maxlength="300"></textarea>
<button name="bio-btn">save</button>
 </form>

</div>
</body>
</html>

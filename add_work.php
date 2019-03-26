<?php 
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");

?>


<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="./css/profilepage.css">
</head>
<body>
<div class="for_textarea clear">
<form action="profile.php" method="POST">
	<h4>Add work history</h4>
	<table>
		<tr>
			<td><input type="text" name="add_work" maxlength="100"></td>
		</tr>
		<tr><td><button name="add_work-btn">Add</button></td></tr>
	</table>
</form>
	
</div>
</body>



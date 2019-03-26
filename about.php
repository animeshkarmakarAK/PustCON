<?php
session_start();
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");
?>



<div class="about_main clear">
	<h3>info about  <?php  if(isset(
		$_SESSION['nickname'])) echo  $_SESSION['username']."(N)".$_SESSION['nickname'] ?></h3>
	<p></p> <?php if (isset($_SESSION['occupation'])) echo $_SESSION['occupation'] ?><br>
		<p>works at </p><?php if (isset($_SESSION['workplace'])) 
			# code...
	echo $_SESSION['workplace'] ?><br>
		<p>lives in </p> <?php  if (isset($_SESSION['c_address'])) echo $_SESSION['c_address'] ?><br>
		<p>from </p><?php if(isset($_SESSION['p_address'])) echo $_SESSION['p_address'] ?> 
</div>
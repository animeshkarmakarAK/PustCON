<?php
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");
?>


<div class="settings_main clear">
	<div class="change_setting">
   <a href="change_name.php">
   	Name<br>
   	<?php
   	echo $_SESSION['username'];
   	?>
   </a>
   <a href="change_name.php" name="edit">Edit</a>
	</div>


		<div class="change_setting">
   <a href="change_email.php">
   	Email<br>
   	<?php
   	$q = "select email from users where username = '{$_SESSION['username']}'";
   	$r = mysql_query($q) or die(mysql_error());
   	$row = mysql_fetch_array($r);
   	$email = $row['email'];
   	echo $email;
   	?>
   </a>
   <a href="change_email.php" name="edit">Edit</a>
	</div>



  	<div class="change_setting">
   <a href="change_mobile.php">
   	phone<br>
   	<?php
   	$q = "select mobile from profile_info where username = '{$_SESSION['username']}'";
   	$r = mysql_query($q) or die(mysql_error());
   	$row = mysql_fetch_array($r);
   	$p = $row['mobile'];
   	echo $p;
   	?>
   </a>
   <a href="change_mobile.php" name="edit">Edit</a>
	</div>


			<div class="change_setting">
   <a href="change_password.php">
   	Change password<br>
   
   </a>
   <a href="change_password.php" name="edit">Edit</a>
	</div>

	
</div>
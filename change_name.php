<?php
session_start();
include("./inc/connection.php");
include("./inc/header.inc.php");
include("./inc/navsection.php");


if (isset($_POST['c_name-btn'])) {
	 $fn = $_POST['c_first'];
	 	 $ln = $_POST['c_last'];
	 	 	// $un = $_POST['c_user'];

	 	 	 if ( isset($fn) && $fn !="") {
	 	 	 	$q = "update users set firstname = '$fn' where username = '{$_SESSION['username']}'";
	 	 	 	$r = mysql_query($q)or die(mysql_error());
	 	 	 }


	 	 	  if ( isset($ln) && $ln !="") {
	 	 	 	$q = "update users set lastname = '$ln' where username = '{$_SESSION['username']}'";
	 	 	 	$r = mysql_query($q)or die(mysql_error());
	 	 	 }
            

	 	 	

}


?>


<div class="settings_main clear">
	<h3>change name</h3>
	<form class="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
		<table>
			<tr><td><p><strong>Firstname</strong></p></td></tr>
			<tr>
				<td><input type="text" name="c_first" placeholder="<?php

                  $q = "select firstname from users where username = '{$_SESSION['username']}'";
                  $r = mysql_query($q)or die(mysql_error());
                  $row = mysql_fetch_array($r);
                  echo $row['firstname'];


				  ?>"></td>
			</tr>

			<tr><td><p><strong>Lastname</strong></p></td></tr>
			<tr>
				<td><input type="text" name="c_last" placeholder="<?php

                  $q = "select lastname from users where username = '{$_SESSION['username']}'";
                  $r = mysql_query($q)or die(mysql_error());
                  $row = mysql_fetch_array($r);
                  echo $row['lastname'];


				  ?>"></td>
			</tr>

		
			<tr><td><button type="submit" name="c_name-btn">Save</button></td></tr>
		</table>
		
	</form>
</div>
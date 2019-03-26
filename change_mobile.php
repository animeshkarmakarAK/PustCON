<?php
session_start();
include("./inc/connection.php");
include("./inc/header.inc.php");
include("./inc/navsection.php");

$output = "";
if (isset($_POST['c_mobile-btn'])) {
	$ne = $_POST['mn'];
		if($ne){
			$q = "update profile_info set mobile = '$ne' where username = '{$_SESSION['username']}'";
	 	 	 	$r = mysql_query($q)or die(mysql_error());
	 	 	 	$output = "phone number reset successfully";
	 	 	 	header("Location:settings.php");
		}
	}


	if (isset($_POST['remove-btn'])) {
		if (isset($_POST['remove'])) {
		 	$q = "update profile_info set mobile = null  where username = '{$_SESSION['username']}'";
	 	 	 	$r = mysql_query($q)or die(mysql_error());
	 	 	 	header("Location:settings.php");
		}
	}
?>

<div class="output">
	<?php echo "$output" ;?>
</div>
<div class="settings_main clear">
	<h3>change mobile number</h3>
	<form class="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
		<table>
			<tr><td><p><strong>reset mobile number</strong></p></td></tr>
			<tr>
				<td><input type="text" name="mn" ></td>
			</tr>
		
			<tr><td><button type="submit" name="c_mobile-btn">Reset</button></td></tr>
          <tr>
				<td><input type="radio" name="remove" >remove phone number</td>
			</tr>

			<tr><td><button type="submit" name="remove-btn">Remove</button></td></tr>
		</table>
		
	</form>
</div>
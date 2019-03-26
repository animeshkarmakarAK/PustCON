<?php
session_start();
include("./inc/connection.php");
include("./inc/header.inc.php");
include("./inc/navsection.php");

$output = "";
if (isset($_POST['c_email-btn'])) {
	$ne = $_POST['n_email'];
		
	if ($ne ) {

		$q = "select * from users where email = '$ne'";
       $r = mysql_query($q)or die(mysql_error());

	if(mysql_num_rows($r)==0){
			$q = "update users set email = '$ne' where username = '{$_SESSION['username']}'";
	 	 	 	$r = mysql_query($q)or die(mysql_error());

	 	 	 	$output = "email reset succesfully";
	 	 	 }else $output = "email already exsist";
	}else $output = "fill the fields";
	}
?>

<div class="output">
	<?php echo "$output" ;?>
</div>
<div class="settings_main clear">
	<h3>change email address</h3>
	<form class="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
		<table>
			<tr><td><p><strong>New email address</strong></p></td></tr>
			<tr>
				<td><input type="text" name="n_email" ></td>
			</tr>
		
			<tr><td><button type="submit" name="c_email-btn">Reset</button></td></tr>
		</table>
		
	</form>
</div>
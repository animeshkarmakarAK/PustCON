<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/connection.php");
include("./inc/header.inc.php");
include("./inc/navsection.php");

$output = "";
if (isset($_POST['c_pass-btn'])) {
	$cp = $_POST['c_pass'];
		$np = $_POST['n_pass'];
			$rp = $_POST['rn_pass'];
	if ($cp && $np && $rp) {
		$q = "select password from users where username = '{$_SESSION['username']}'";
$r = mysql_query($q)or die(mysql_error());
$row = mysql_fetch_array($r);
$pass =  $row['password'];
if($pass == $cp){
	if($np == $rp){
			$q = "update users set password = '$rp' where username = '{$_SESSION['username']}'";
	 	 	 	$r = mysql_query($q)or die(mysql_error());

	 	 	 	$output = "password changed succesfully";
		}else echo "password mismatched";
	}else echo "password not correct";
	}else echo "fill all fields";
	}
?>

<div class="output">
	<?php echo "$output" ;?>
</div>
<div class="settings_main clear">
	<h3>change password</h3>
	<form class="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
		<table>
			<tr><td><p><strong>Current password</strong></p></td></tr>
			<tr>
				<td><input  type="password" name="c_pass" ></td>
			</tr>
			<tr><td><p><strong>New password</strong></p></td></tr>
			<tr>
				<td><input type = "password" name="n_pass" ></td>
			</tr>
			<tr><td><p><strong>Reset new password</strong></p></td></tr>
			<tr>
				<td><input  type="password" name="rn_pass" ></td>
			</tr>
			<tr><td><button type="submit" name="c_pass-btn">Change</button></td></tr>
		</table>
		
	</form>
</div>
<?php
session_start();
include("./inc/connection.php");


$username_alert="";
$pass_alert = "";
$alert = ""; 

if(isset($_POST['login']))
{
$user = $_POST['username'];
$pass = $_POST['pass'];
if($user!='' && $pass != ''){
$sql = "select * from users where username = '$user' AND password = '$pass'";
$query = mysql_query($sql);
$num = mysql_num_rows($query);
if($num!= 0){
	$row = mysql_fetch_array($query);
	$_SESSION['id'] = $row['id'];
	//$_SESSION['username'] = $user;
header("Location:Homepage.php");
}else {
	//header("Location:index.php");
	$username_alert = "Wrong username or password";

//exit();
}
}else $alert = "fill up all field";
}
//header("Location:creategroup.html");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PustCON</title>
		<link rel="stylesheet" type="text/css" href="./font-awesome-4.7.0/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="./css/indexstyle.css">
	</head>
	<body>
		<div class="header">
			<h2><b>PustCON</b></h2>
		</div>
        
         <?php
   // output displaying ......
      if ($username_alert || $alert) {
        ?>
        <div class="output" clear="both">
          <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><?php
           if ($username_alert){
           	echo "$username_alert";
           }else echo "$alert";
           
            ?></p>
        </div>

        <?php
      }
      ?>

		<div class="login_main">
			<div class="login_form">
				<table>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
						
						<tr>
							<td class="alert"><input type="text" name="username" placeholder="   &#xf007;Username" style="font-family:Arial, FontAwesome" /></td>
						</tr>

						<tr>
							
							<td><input type="password" name="pass" placeholder="   &#xf084;password" style="font-family:Arial,FontAwesome" /></td>
							<td><?php?></td>
						</tr>
						<tr>
							<td><input type="submit" name="login" value="Log In"></td>
						</tr>
				</form>
				</table>
			</div>
			<div class="create_account">
				<h4>.............................  or  .............................</h4>
				<p><a href="registerform.php">Create New Account</a></p>
			</div>
		</div>
	</body>
</html>
<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");

if (isset($_POST['Remove-btn'])) {
	$q = "update profile_info set professional_sills = NULL  where professional_sills is not NULL and username = '{$_SESSION['username']}'";
	$r = mysql_query($q) or die(mysql_error());

    unset($_POST['Remove-btn']);
}


?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="./css/profilepage.css">
	</head>
	<body>
		<div class="for_textarea clear">
			<form action="profile.php#prof_skill" method="post" enctype="multipart/form-data">
				<h3>Add professional skills</h3><br>
				<textarea name = "skill" maxlength="50"></textarea><br><br>
				
				<button name="skill-btn">Add</button>
			</form>

			<?php 
             
       
       $q = "select professional_sills from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $p = $row['professional_sills'];

        ?>
        <div class="skills"></div>
        <h3 style="
	margin: 0 auto;
	/* margin-left: 300px; */
	margin-top: ;
	width: 304px;
	margin-top: 30px;
	border: 1 px solid darkkhaki;
	">Skills<h3>
	 <p style="
	margin: 0 auto;
	/* margin-left: 300px; */
	margin-top: ;
	width: 304px;
	margin-top: 30px;
	border: 1 px solid darkkhaki;
	font-family: a;"><?php echo $p; ?></p>
	 <form action="#" method="post">
	 	<button name="Remove-btn">Remove</button>
	 </form>
	</div>
		</div>
	</body>
</html>
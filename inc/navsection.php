

<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
$q = "select username from users where id = '{$_SESSION['id']}' ";
$r = mysql_query($q) or die(mysql_error());
$row = mysql_fetch_array($r);
$_SESSION['username'] = $row['username'];


$sql = "select * from notification where notified_to = '{$_SESSION['username']}' and status = '0'";
$count = mysql_query($sql);
$count = mysql_num_rows($count);

$image_src = "";
$q = "select name from profile_pic where username = '{$_SESSION['username']}'";
$res = mysql_query($q) or die(mysql_error());
if (mysql_num_rows($res)>0) {
   $row = mysql_fetch_array($res);

	$image_src = "img/".$row['name'];
}else $image_src = "img/default.png";

 ?>

	<div class="nav clear">
		<img src="<?php echo $image_src?>" width="20px" height="20px">
		<a href="profile.php"><?php echo $_SESSION['username']?></a>
		<a href="Homepage.php"><i class = "fa fa-home " aria-hidden="true" ></i></a>
		<!--a href="about.php"><i class="fa fa-info-circle" aria-hidden = "true"></i></a-->
				<a href="logout.php"><i class="fa fa-sign-out " aria-hidden="true"></i></a>
	</div>
<div class="notify clear">
		<form action="notification.php" method="post">
			<button name="notify"><span class="fa-stack ">
  <i class="fa fa-bell fa-stack-2x" style="color: #BA7935;"></i>
  <strong class="fa-stack-1x text-primary" style="color: red;"><?php if($count){
  	echo $count;
  } ?></strong>
</span></button>
		</form>
	
	</div>
		<div class="settings clear" style="float: right;
	margin-top: 6px;
	">
			
			<a href="settings.php" style="color:#466C53; "><i class="fa fa-cog fa-spin fa-lg" aria-hidden="true" ></i></a>
		</div>
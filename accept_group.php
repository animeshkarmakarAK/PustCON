<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/connection.php");
include("./inc/header.inc.php");
include("./inc/navsection.php");

if (isset($_POST['accept_decline-btn1'])) {
	# code...
	$_SESSION['notification-id'] = $_POST['accept_decline-btn1'];
	//echo $_SESSION['text'];
}

if (isset($_POST['accept_decline-btn2'])) {
	# code...
	$_SESSION['notification-id'] = $_POST['accept_decline-btn2'];
	$_SESSION['text'] = "wish to add you";
	//echo "button 2".$_SESSION['text'];
}


if (isset($_POST['accept-btn'])) {
	
	if (!strcmp($_SESSION['text'], "Request to join your group")) {

	$q = "select * from notification where id = '{$_SESSION['notification-id']}'";
	$r = mysql_query($q)or die(mysql_error());

	$arr = mysql_fetch_array($r);
	$member = $arr['notified_by'];
	$gname = $arr['groupname'];

	$q = "insert into group_members_list value(0,'$member','$gname')";
	$res = mysql_query($q) or die(mysql_error());

	$q = "insert into notification value(0,'{$_SESSION['username']}','$member','accept your request for ','$gname',NOW(),'0')";
	$r = mysql_query($q) or die(mysql_error());
	if($r)
		echo "notified for acceptence";

   if ($res) {
   	echo "added successfully";
   	# code...
   	$q = "delete from notification where id = '{$_SESSION['notification-id']}'";
   	$r = mysql_query($q) or die(mysql_error());

   	if ($r) {
   		header("Location:notification.php");
   	}


   }
}else{



$q = "select * from notification where id = '{$_SESSION['notification-id']}'";
	$r = mysql_query($q)or die(mysql_error());

	$arr = mysql_fetch_array($r);
	$member = $_SESSION['username'];
	$gname = $arr['groupname'];

	$q = "insert into group_members_list value(0,'$member','$gname')";
	$res = mysql_query($q) or die(mysql_error());

   if ($res) {
   	echo "added successfully";
   	# code...
   	$q = "delete from notification where id = '{$_SESSION['notification-id']}'";
   	$r = mysql_query($q) or die(mysql_error());


   }


}
}

if (isset($_POST['decline-btn'])) {

	 	$q = "delete from notification where id = '{$_SESSION['notification-id']}'";
   	     $r = mysql_query($q) or die(mysql_error());
   	     if ($r) {
   	     	header("Location:notification.php");
   	     }
}



?>

<div class="settings_main clear">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> " method = "post" enctype = "multipart/form-data">
<button name="accept-btn" type="submit">Accept</button>	
<button name="decline-btn" type="submit">Decline</button>	

</form>
</div>
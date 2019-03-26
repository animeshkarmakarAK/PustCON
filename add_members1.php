<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/header.inc.php") ; 
include("./inc/connection.php");
include("./inc/navsection.php");

$add = "Add";

if (isset($_POST['add-btn'])) {
	//echo "yeah clicked";
	$notify_to = $_POST['add-btn'];
	//echo $notify_to;
	$by = $_SESSION['username'];
	$text = "wish to add you";
	$gname = $_SESSION['gname'];

	$q = "insert into notification value(0,'$by','$notify_to','$text','$gname',NOW(),'0')";
	$r = mysql_query($q) or die(mysql_error());

}

$msg = "remove request";

if (isset($_POST['remove-request'])) {
	$name = $_POST['remove-request'];
	$sql = "delete from notification where groupname = '{$_SESSION['gname']}' and 
	notified_to = '$name' and notified_by = '{$_SESSION['username']}' ";
	$result = mysql_query($sql) or die("error to removing request".mysql_error());
}

// checking remove request button on or off 
// when visible add button then no remove request button will seen for this purpose 
function removeRequest($name , $msg){
	$sql = "select * from notification where groupname = '{$_SESSION['gname']}' and 
	notified_to = '$name' and notified_by = '{$_SESSION['username']}' ";

	$r = mysql_query($sql);
	if (mysql_num_rows($r) > 0) {
		$msg = "remove request";
		return $msg;
	}else{
		$msg = " ";
		return $msg;
	}
}

 function check($name ,$add){
 	$q = "select * from notification where groupname = '{$_SESSION['gname']}'
 	and notified_to = '$name' and notified_by = '{$_SESSION['username']}'
 	and notification = 'wish to add you' ";
 	$r = mysql_query($q);
 	if (mysql_num_rows($r)>0) {
 		$add = "Request sent";
 		return $add;
 	}else{
 		$add ="Add";
 		return $add;
 	}
 }

?>

<div class="add_mem clear">

	<div class="add_mem_head">
		<h2><?php echo $_SESSION['gname'] ;?></h2>
		<p><i class="fa fa-lock">Secret group</i></p>
	</div>
	<div class="add_mem_body clear">
<?php 

$q = "select * from users where username != '{$_SESSION['username']}'";
$r = mysql_query($q);

while ($row = mysql_fetch_array($r)) {
	
	$name = $row['username'];

	$sql = "select * from group_members_list where groupname = '{$_SESSION['gname']}' and name = '$name' ";
	$que = mysql_query($sql);
	if (mysql_num_rows($que) <1) {
		# code...

		   	?>
	<form  method="POST" enctype="multipart/form-data">
		<p><button name = "prof-name-btn" type ="submit" formaction= "profile.php"  value="<?php echo "$name"?>" ><?php echo "$name" ?></p>
		<button name="add-btn"  formaction="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" value="<?php echo "$name"?>"><?php echo check($name,$add);?></button>

		<button name="remove-request"  formaction="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" value="<?php echo "$name"?>"><?php echo removeRequest($name,$add);?></button>
		
	</form>
	<?php 
		   
	
}

}

 ?>
</div>
</div>




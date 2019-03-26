<?php
session_start();
include("./inc/connection.php");
include("./inc/header.inc.php");
include("./inc/navsection.php");

// make working the groupcreating form ...
function trim_value($value){
	return (strip_tags (htmlspecialchars(trim($value))));
}

$table = "social_groups";
$outputt = " ";

if (isset($_POST['create'])) {
	$g_name = trim_value($_POST['groupname']);
	$g_creator_name = $_SESSION['username'];
	$_SESSION['groupcreator'] = $g_creator_name;
	//$_SESSION['member'] = $g_creator_name;

	if ($g_name!='') {
		$gcheck = "select groupname FROM $table where groupname = '$g_name'";
		$result = mysql_query($gcheck);
		$num = mysql_num_rows($result);

		if($num == 0){

			$query = "insert into $table values (0,'$g_name','$g_creator_name','$g_creator_name')";
			$result = mysql_query($query)
			or die("error in pushing" .mysql_error());

			if($result){
				echo ("'$g_name created by  '". $_SESSION['groupcreator']." successfully");

				$q = "select id from social_groups where groupname = '$g_name'";
				$r = mysql_query($q) or die(mysql_error());

				$row = mysql_fetch_array($r);
				$id = $row['id'];
				//echo $id;

				$q = "insert into group_members_list value( '$id','$g_creator_name','$g_name')";
				$r = mysql_query($q) or die("error in pushing as member".mysql_error());

				if ($r) {
					header("Location:Homepage.php");
				}

			}

		} else  $outputt = "Groupname already exists..<br>Enter another group name";
	}else $outputt =  "Enter a group name";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>PustCON/groupcreatingform</title>
</head>
<body>
  
  <?php if(!empty($outputt)){?>
  <div class="output_showing" clear="both">
  	<i class="fa fa-exclamation-triangle"></i>

  	<?php 
      echo $outputt;
}?>

</div>

<div class="groupcreatingform ">
	<table>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
			<tr>
				<td><input type="text" name="groupname" placeholder="NAME YOUR GROUP"></td>
			</tr>
		
			<tr>
				<td><input type="submit" name="create" value="create"></td>
			</tr>
			
		</form>
	</table>
</div>
</body>
</html>
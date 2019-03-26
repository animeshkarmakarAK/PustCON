<?php 
//session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");

$files ="";
$_SESSION['profile_pic_status'] = "Add profile picture";

if(isset($_POST['submit'])){
	$files = $_FILES['file']['name'];
  if($_FILES['file']['error'] > 0){
    switch($_FILES['file']['error']){
      case 1 : echo 'Uploaded file exceeds maximum file size';
      break;
      case 2 : echo 'Uploaded file exceeds maximum file size mentioned in HTML';
      break;
      case 3 : echo 'Uploaded file partially uploaded';
      break;
      case 4 : echo 'No file uploaded';
      break;
      case 6 : echo 'No temporary directory specified in php.ini';
      break;
      case 7 : echo 'Uploaded file writing to disk failed';
      break;
      case 8 : echo 'File upload stopped by extension';
      break;
  }
  return;
 }
 
   if(($_FILES['file']['type'] == 'image/gif') || ($_FILES['file']['type'] == 'image/jpg') || ($_FILES['file']['type'] == 'image/png') || ($_FILES['file']['type'] == 'image/jpeg')){
 
      $upload_folder = 'img/';
      move_uploaded_file($_FILES['file']['tmp_name'], $upload_folder.$_FILES['file']['name']);
       $files = $_FILES['file']['name'];
       $sql ="insert into profile_pic value(0,'$files','{$_SESSION['username']}')";
      //echo 'File uploaded successfully';
       $result = mysql_query($sql);

       if($result)
       $_SESSION['profile_pic_status'] = "Change profile picture";

  }else{
     echo 'not supported format';
  }
 
}


$nick = "";
$occ = "";
$work = "";
$intro = "";
$c_add = "";
$p_add ="";

if (isset($_POST['nickname-btn']) && $_POST['nickname']!="") {
	# code...
	$_SESSION['nickname']= $_POST['nickname'];
	$nick =  $_POST['nickname'];
}


if (isset($_POST['occupation-btn']) && $_POST['occupation']!="") {
	# code...
	$_SESSION['occupation']= $_POST['occupation'];
	$occ =  $_POST['occupation'];
}


if (isset($_POST['workplace-btn']) && $_POST['workplace']!="") {
	# code...
	$_SESSION['workplace']= $_POST['workplace'];
	$work =  $_POST['workplace'];
}


if (isset($_POST['intro-btn']) && $_POST['intro']!="") {
	# code...
	$_SESSION['intro']= $_POST['intro'];
	$intro =  $_POST['intro'];
}


if (isset($_POST['c_address-btn']) && $_POST['c_address']!="") {
	# code...
	$_SESSION['c_address']= $_POST['c_address'];
	$c_add =  $_POST['c_address'];
}


if (isset($_POST['p_address-btn']) && $_POST['p_address']!="") {
	# code...
	$_SESSION['p_address']= $_POST['p_address'];
	$p_add =  $_POST['p_address'];
	echo "$p_add";
}

$sql = "insert into profile value(0,'{$_SESSION['username']}','$nick','$occ','$intro','$work','$c_add','p_add')";
 	$res = mysql_query($sql) or die(mysql_error());



 	/*if ($nick) {
 		echo $sql = "update profile set nickname = '$nick' where username = '{ $_SESSION['username']}'";
 		$rs = mysql_query($sql);
 	}

 		if ($occ) {
 		$sql = "update profile set occupation = '$occ' where username = '{ $_SESSION['username']}'";
 		$rs = mysql_query($sql);
 	}

 		if ($intro) {
 		$sql = "update profile set intro = '$intro' where username = '{ $_SESSION['username']}'";
 		$rs = mysql_query($sql);
 	}

 		if ($work) {
 		$sql = "update profile set workplace = '$work' where username = '{ $_SESSION['username']}'";
 		$rs = mysql_query($sql);
 	}

 		if ($c_add) {
 		$sql = "update profile set current_address = '$c_add' where username = '{ $_SESSION['username']}'";
 		$rs = mysql_query($sql);
 	}

 		if ($p_add) {
 		$sql = "update profile set permanent_address = '$p_add' where username = '{ $_SESSION['username']}'";
 		$rs = mysql_query($sql);
 	}

 if($nick || $occ || $work || $intro || $c_add || $p_add)
 {
 	

 	$sql = "update profile set nickname = '{$_SESSION['nickname']}' , occupation = '{$_SESSION['occupation']}' ,intro= '{$_SESSION['intro']}',current_address = '{$_SESSION['c_address']}',permanent_address = '{$_SESSION['p_address']}' 
 	 where username = '{$_SESSION['username']}'";
 	$res = mysql_query($sql);

 }*/

 //update when you want 




?>





<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./css/postpage1.css">
</head>
 <body>
<div class="profile_main clear ">
	<div class="profile_main_pic clear">
 	<?php /* 
    //$image=$_FILES['file']['name']; 
    $image = $files;
              $img="img/".$image;
              echo '<img src= "'.$img.'" width = "150px" height = "150px">';


              */?>

              <?php

$sql = "select name from profile_pic where username = '{$_SESSION['username']}'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$image = $row['name'];
$image_src = "img/".$image;

?>
<img src='<?php echo $image_src;?>' width= 200px height = 150px >


 <p><?php echo $_SESSION['profile_pic_status']; ?></p>
 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>"" method="post" enctype="multipart/form-data">
 <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
 <p><input type="file" name="file" id="file" /></p>
 
 <p><button name="submit" value="submit">Add</button></p>
 </form>
</div>

<div class="information clear">
	<p>Add Details about you</p>
	<form action="?php echo htmlspecialchars($_SERVER['PHP_SELF'])" method="post">
		
		<table>
			<tr>
				<td><p>Nickname</p></td>
				<?php if (isset($_SESSION['nickname'])) {?>
				
					<p><?php echo $_SESSION['nickname'];?></p>
					<?php 
				} else {?>
				<td><input type="text" name="nickname" >
				</td>
				<td><button name = nickname-btn>Save</button></td>
				<?php } ?>
			</tr>
			<tr>
				<td><p>Occupation</p></td>
				<td><textarea name="occupation" ></textarea></td>
				<td><button name = occupation-btn>Save</button></td>
			</tr>

			<tr>
				<td><p>Intro</p></td></td>
				<td><input type="text" name="intro"></td>
				<td><button name = intro-btn>Save</button></td>
			</tr>

			<tr>
			<td><p>Workplace</p></td></p>
				<td>
					<textarea name="workplace" ></textarea>
				</td>
				<td><button name = workplace-btn>Save</button></td>
			</tr>


				<tr>
				<td><p>Current Address</p></td>
				<td>
					<textarea name="c_address" ></textarea>
				</td>
				<td><button name = c_address-btn>Save</button></td>
			</tr>

			<tr>
				<td><p>Permanent Address</p></td>
				<td>
					<textarea name="p_address" ></textarea>
				</td>
				<td><button name = p_address-btn>Save</button></td>
			</tr>


		</table>
	</form>
</div>

</div>



 </body>
</html>


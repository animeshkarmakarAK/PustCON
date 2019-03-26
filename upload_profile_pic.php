<?php 
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");

$output = "";

$q = "select name  from profile_pic where username = '{$_SESSION['username']}'";

$res = mysql_query($q)or die(mysql_error());
if(mysql_num_rows($res) == 0){
  //$_SESSION['image'] = "img/default.jpg";
  $q = "insert into profile_pic values(0,'default.png','{$_SESSION['username']}')";
  $res = mysql_query($q) or die(mysql_error());
}


if (isset($_POST['upload'])) {
  if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
   move_uploaded_file($_FILES['file']['tmp_name'], "img/".$_FILES['file']['name']);
   $files = $_FILES['file']['name'];
   $q = "update profile_pic set name = '$files' where username = '{$_SESSION['username']}'";
   $res = mysql_query($q) or die(mysql_error());

   if ($res) {
     $output = "profile pic uploaded successfully";
     header("Location:profile.php");
   }

}else $output = "select a image file";
}

?>



<div class="output">
  <p><?php echo "$output"; ?></p>
</div>
<div class="upload_pic_main clear">
<!--img src='<?php //echo $image_src;?>' width= 200px height = 150px -->


 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
<input type="file" name="file"/><br>
 <button name="upload" value="submit">Upload</button>
 </form>
</div>
<?php
session_start();
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");


if (isset($_POST['yes'])) {
$gname = $_POST['yes'];
$query = "delete from social_groups where groupname = '$gname'";
$res = mysql_query($query) or die("error to deleting the group".mysql_error());
header("Location:Homepage.php");
}


if (isset($_POST['no'])) {
  header("Location:Homepage.php");
}
?>
<?php
// making the suggest_friends option works
if(isset($_POST['suggest_friends'])){
  $_SESSION['gname'] = $_POST['suggest_friends'];
}

$output = "";
if (isset($_POST['suggest-btn'])) {
  $by = $_SESSION['username'];
  $to = $_POST['suggest-btn'];
  $not = "suggest you";
  $gname= $_SESSION['gname'];

  $q = "insert into notification value(0,'$by','$to','$not','$gname',NOW(),'0')";
  $r = mysql_query($q)or die(mysql_error());

  if ($r) {
    $output = "suggested";
    header("Location:suggestfriend.php");
    # code...
  }

}

$suggest = "suggest";

 function check($name ,$add){
  $q = "select * from notification where groupname = '{$_SESSION['gname']}'
  and notified_to = '$name' and notified_by = '{$_SESSION['username']}'
  and notification = 'suggest you' ";
  $r = mysql_query($q);
  if (mysql_num_rows($r)>0) {
    $suggest = "suggested";
    return $suggest;
  }else{
    $add ="suggest";
    return $add;
  }
 }
?>







<div class="suggest_friends_main">
  <div class="suggest_gname clear">
    <h3><?php echo $_SESSION['gname'];?></h3>
  </div>

  <div class="friends_to_suggest clear">
  <?php
    //echo "aaaaaaaaaa$groupname";
  $sql = "select *from users where username !='{$_SESSION['username']}' ";
  $result = mysql_query($sql)or die("error naki".mysql_error());
  while ($arr = mysql_fetch_array($result)) {
  $user = $arr['username'];

  $q = "select * from group_members_list where groupname ='{$_SESSION['gname']}' and name = '$user'";
  $r = mysql_query($q);

  if (mysql_num_rows($r)<1) {
    # code...

  ?>
   <p><?php echo $user?></p>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <button name="suggest-btn" type="submit" value="<?php echo "$user"?>">
      <?php echo check($user,$suggest); ?>
    </button>
  </form>
    
<?php 
}

  }
  ?>
 
</div>
</div>
 <?php
 ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");
include("./inc/chatBox.php");
$table ="posts";
$no_post = "";
$posted_by = "";
$id = "";
$date_time = "";
$post = "";


// delete these notification that is already read
   
      $q = "delete from notification where groupname = '{$_SESSION['gname']}' and status = '1'";
  $r = mysql_query($q) or die(mysql_error());

//..............................

if (isset($_POST['posts_not-btn'])) {
     $_SESSION['gname'] = $_POST['posts_not-btn'];
    // echo "clicked";
}


if(isset($_POST['post_button'])){
  $text = $_POST['post1'];
  if($text){
  
  $q = "select name from group_members_list where groupname = '{$_SESSION['gname']}' and name != '{$_SESSION['username']}'";
  $res = mysql_query($q) or die(mysql_error());
  while ($arr = mysql_fetch_array($res)) {
    $t = " posted in ";
    $to = $arr['name'];
      $q = "insert into notification values(0,'{$_SESSION['username']}','$to','$t','{$_SESSION['gname']}',NOW(),'0')";
      $r = mysql_query($q) or die(mysql_error());
  }
}
}


if(isset($_POST['post_button'])){
  $text = mysql_real_escape_string($_POST['post1']);
  if($text){

$sql = "insert into $table values(0,'$text','{$_SESSION['username']}','{$_SESSION['gname']}',NOW())";
$result = mysql_query($sql) or die("error in post".mysql_error());

  }
}
//form deleting .........
if (isset($_POST['deletepost'])) {


$id = $_POST['deletepost'];
echo $id;
 
$q = "select * from social_groups where creator_name = '{$_SESSION['username']}'
  and groupname = '{$_SESSION['gname']}'";
$r = mysql_query($q) or die(mysql_error());
if (mysql_num_rows($r)==0) {
  # code...
}else{

//echo " $id";
$query = "delete from $table where id= '$id' ";
$res = mysql_query($query) or die("error to deleting the post".mysql_error());
}
}

if (isset($_POST['comment_btn'])) {
  $post_id  = $_POST['comment_btn'];
  $comment = mysql_real_escape_string($_POST['comment']);
  if ($comment) {
    $q = "insert into comments value('$post_id','$comment','{$_SESSION['username']}')";
    $r = mysql_query($q)or die(mysql_error());
  }

}

// 
function check(){

  $q = "select * from social_groups where creator_name = '{$_SESSION['username']}'
  and groupname = '{$_SESSION['gname']}'";
  $r = mysql_query($q) or die(mysql_error());

  if (mysql_num_rows($r)>0) {
    return false;

  }else return true;
}

if (isset($_POST['leave-btn'])) {
  //echo "clicked";
    $q = "delete from group_members_list where name = '{$_SESSION['username']}'
  and groupname = '{$_SESSION['gname']}'";
  $r = mysql_query($q) or die(mysql_error());
   
      $q = "delete from notification where notified_to = '{$_SESSION['username']}'
  and groupname = '{$_SESSION['gname']}' and status =1";
  $r = mysql_query($q) or die(mysql_error());
   
  header("Location:Homepage.php");
}


?>




<!DOCTYPE html>
<html>
  <head>
    <title>PustCON/home/post page </title>
    <link rel="stylesheet" type="text/css" href="./font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="./css/postpage1.css">
  </head>
  <body>
    <div class="main_post_area template clear">
      
      <div class="header_section">
        <p><i class="fa fa-users" aria-hidden="true" style="color: green;"></i><?php echo " ".$_SESSION['gname'] ?>
       
        <?php if (check()){?>
         <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
           <button name="joined-btn">Joined</button>

          <button name="leave-btn" type="submit">Leave</button>
                   </form>
         <?php }?>
      

        </p>
        <h3><i class="fa fa-lock"> secret group</i></h3>
        <form action="add_members1.php" method="POST">
          <button name="add_members" value="<?php echo $_SESSION['gname']?>"><i class="fa fa-user-plus" aria-hidden="true"></i>Add Members</button><br>
        </form>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
          <input name="search_group" type="text" placeholder="Search this group">
          <button name="search_group_btn" type="submit"> <i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
       
       <div class="members clear">
         
         <a href="group_members.php">members</a>
       </div>

      </div>
      <div class="post_area clear">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data" id= "postpageform">
          <div class="post_header">
            <h3><i class="fa fa-pencil" aria-hidden="true" ></i>Post here ...</h3>
          </div>
          <table style="margin-left: 200px;">
            <tr>
              <textarea name = "post1" placeholder=" Write something..."></textarea>
                            <!--input type="submit" name="post_button" value="post"-->
                            <button name="post_button" type="submit" value="post"> post</button>
              
            </tr>
            
          </table>
        </form>
        <!--div class="more_content clear">
          <a href="after_clicking_more"><img src="./img/camera.png" height="17px" width="17px"><p>photo more</p></a>
        </div-->
        <div class="posted template clear">
          <?php
              // search group work
              if(isset($_POST['search_group'])){
              $search = $_POST['search_group'];
              if(isset($_POST['search_group_btn'])){
              $query = "select * from $table where groupname = '{$_SESSION['gname']}' AND posted_by LIKE '%$search%' order by id desc";
              $res = mysql_query($query);
              if ($num = mysql_num_rows($res)>0) {
              while ($array = mysql_fetch_array($res)) {
              $post_id = $array['id'];
              $posted_by = $array['posted_by'];
              $date_time = $array['post_date'];
              $post = $array['post'];
             
             
              ?>
             <div class="posted_box ">

            <?php echo "$posted_by   $date_time " ?>
            <p><?php echo "$post"?></p>

            <div class="deletepost">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "post">
                
              
                <button name="deletepost" type="submit" value="<?php echo $post_id ?>">Delete Post</button>
              </form>
            </div>
            <div class="comment_box">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">

                <textarea name="comment" placeholder="write a comment ..."></textarea>
                <button name="comment_btn" type="submit"><i class="fa fa-comment"></i>comment</button>
              </form>
            </div>
            
            <?php
            }
            }else {$no_post= "no results found";}
            ?>
            <h3><?php echo "$no_post" ?></h3>
          </div>



              <?php
              }
              }else {
         
            






          $sql = "select * from $table where groupname = '{$_SESSION['gname']}' order by id desc" ;
          $result = mysql_query($sql);
          if($num = mysql_num_rows($result)>0){
          while ($arr = mysql_fetch_array($result)) {
            $posted_by = $arr['posted_by'];
          $date_time = $arr['post_date'];
          $post = $arr['post'];
          $post_id = $arr['id'];
 
          //$file = $arr['uploaded_file'];
          ?>
          <div class="posted_box ">

            <?php echo "$posted_by   $date_time" ?>
            <p><?php echo "$post"?></p>

            <div class="deletepost">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "post">
               
                <button name="deletepost" type="submit" value="<?php echo"$post_id"?>">Delete Post</button>
              </form>
            </div>
            <div class="comment_box">
              <div class="comments clear">
              <?php 

                $q = "select * from comments where id = '$post_id'";
                $r = mysql_query($q) or die(mysql_error());
                
                if (mysql_num_rows($r)>0) {
                  # code...
                
                while ($arr = mysql_fetch_array($r)) {
                     $by = $arr['comment_by'];
                     $comment = $arr['comment_text'];
                     
                     ?>
                     
                     <div class="comment-text clear">
                     <h5><?php echo $by ?></h5>
                     <p><?php echo "".$comment; ?></p><br>

                   </div>

                     <?php  
                }
              }


               ?>
             </div>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
                <textarea name="comment" placeholder="   write a comment ..."></textarea>
                <button name="comment_btn" type="submit"  value="<?php echo "$post_id";?>""><i class="fa fa-comment"></i>comment</button>
              </form>

            </div>
            
            <?php
            }
            }else {$no_post= "no post to show";}
          }
            ?>
            <h3><?php echo "$no_post" ?></h3>
          </div>
        </div>
      </div>

    </div>
  </body>
</html>
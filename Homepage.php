<?php 
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");


//session setting

$q = "select username from users where id = '{$_SESSION['id']}' ";
$r = mysql_query($q) or die(mysql_error());
$row = mysql_fetch_array($r);
$_SESSION['username'] = $row['username'];

// activating the activated option for chat box

$u = "update users set activated = '1' where id = '{$_SESSION['id']}'";
$q = mysql_query($u) or die(mysql_error());


//working with the join button
$output = "";
if (isset($_POST['join_btn'])) {
      $groupname = $_POST['join_btn'];
  //check if the request sent before 

  $check = "select * from notification where notified_by = '{$_SESSION['username']}' AND  groupname = '$groupname'";
  $mysql_check = mysql_query($check);
  if($row = mysql_num_rows($mysql_check)>0){
    $output = "Request Pending";
  }else{
  //

   $notified_to ="";
   $notification = "Request to join your group";
   $select = "select creator_name from social_groups where groupname = '$groupname'";
   $res = mysql_query($select);
   while ($arr = mysql_fetch_array($res)) {
      $notified_to = $arr['creator_name'];
   }
     $sql = "insert into notification value(0,'{$_SESSION['username']}','$notified_to','$notification','$groupname',NOW(),'0')";
     $query = mysql_query($sql);

     if ($query) {
       $output = " request sent successfully";
     }
}
}

?>




<div class="group clear">
<div class="creategroup clear ">
<p><a href="groupcreatingform.php"><img src="./img/plus.png">create group</a></p>
</div>

<div class="chatbox clear">
  <h4>contacts</h4>

  <div class="contact-online clear">
    <?php
     // make all activate contacts echo 
     $q = "select * from users where activated = '1' and username != '{$_SESSION['username']}'";
     $r = mysql_query($q) or die(mysql_error());
     if ($row = mysql_num_rows($r)>0) {
     while ($arr = mysql_fetch_array($r)) {
           $activated_user = $arr['username'];
           ?>

          
             <p><i class="fa fa-circle" style="color: green; margin-right: 2px; margin-left: 9px;"></i><?php echo  $activated_user ?></p>
           <?php 
     }
   } else{
       echo "NO PERSON AT ONLINE NOW!";
   }


    ?>
  </div>
</div>

 <?php
   // output displaying ......
      if ($output) {
        ?>
        <div class="output" clear="both">
          <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><?php echo $output; ?></p>
        </div>

        <?php
      }
      ?>

 
 <div class="all_groups clear"  >
  <h3>ALL GROUPS</h3>
  <?php 
  $sql = "select groupname from social_groups where creator_name !=
  '{$_SESSION['username']}' ";
  $result = mysql_query($sql);
     while($array = mysql_fetch_array($result)){
      $name = $array['groupname'];
      ?>
     
        <!--p><a href="#"><?php //echo "$name" ?></a></p-->

          <?php 
        $q = "select group_members_list.groupname from group_members_list where name =
  '{$_SESSION['username']}' and groupname = '$name'";
            $r = mysql_query($q) or die(mysql_error());
           // while($arr = mysql_fetch_array($r)){
             // $name1 = $arr['groupname'];
            ?>
            <form  method="POST">
            <?php
              if(mysql_num_rows($r)>0){
                ?>
        
              <input type="submit" name ="nnn" value="<?php echo "$name"?>" formaction="help1.php" ><pre>Joined</pre>
              
                <?php
              }else{
                ?>
                 <!--form action=" <?php //echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post"-->
            <!--input type="submit" name="join_group" value="Join"-->
               <p><a href="#"><?php echo "$name" ;?></a></p>
               <button name="join_btn" value="<?php echo "$name"?>" >join</button>
          </form>
                <?php 
              }
            //}


           ?>
          
     
       <?php
     }
      
     
   ?>
 </div>

  <div class="your_groups clear">
  <h3>YOUR GROUPS</h3>
  <?php 
  $sql = "select groupname from social_groups where creator_name =
  '{$_SESSION['username']}' ";
  $result = mysql_query($sql);
     while($array = mysql_fetch_array($result)){
      $name = $array['groupname'];
     // $id = $array['id'];
      ?>
      
        <!--<p><a href="#"><?php //echo "$name" ?></a></p>!-->
        <form action="help.php" method="post">
        <input type="submit" name ="nnnn" value="<?php echo "$name"?>" >

          </form>

          <form action="suggestfriend.php" method="post">
             <button name="suggest_friends" type="submit" value="<?php echo "$name"?>">suggest friend</button>

            <div class="delete_button">
             <p>Delete Group</p>
             <div class="delete_button_nav">
              <p>sure! you want to delete this group</p>
               <button name="yes" type="submit" value="<?php echo "$name"?>"">Yes</button>
                 <button name="no" type="submit" >No</button>
             </div>
           </div>

          </form>
       <?php
     
     }
      ?>
 </div>


<a href="chatpage.php"  type = "button" name="chat-btn" class="glyphycon glyphycon-button" style="text-decoration: none; border: 1 px solid gray ;color: #fff; background: green; margin-left: 1000px;height: auto; padding: 10px;border-radius: 40px; padding-left: 10px;"><i class="fa fa-chatButton"></i>
Chat</a>
    
   </div>


  </div>
</div>


</body>
</html>
<?php 
session_start();
include("./inc/header.inc.php") ; 
include("./inc/connection.php");
include("./inc/navsection.php");




?>

<div class="g_members clear">
<?php
              $q = "select * from group_members_list where groupname = '{$_SESSION['gname']}'";
              $r = mysql_query($q) or die(mysql_error());
              if (mysql_num_rows($r)>0) {
          
              while ($row = mysql_fetch_array($r)) {
                $name = $row['name'];
                ?>
                <form method="post" enctype="multipart/form-data">
               <button type ="submit" name="group-member-name-btn" formaction="profile.php" value="<?php echo $name?>"> <p><?php echo $name; ?></p></button>
           </form>
                <?php 
              }
          }else {?><p><?php echo "No members found in this group" ?></p> 
          <?php } ?>

       </div>


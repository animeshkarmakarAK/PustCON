<?php
session_start();
include("./inc/connection.php");
include("./inc/header.inc.php");
include("./inc/navsection.php");

	$sql = "update notification SET status = '1' where notified_to = '{$_SESSION['username']}'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		//echo "successfull";
		//header("Refresh:0");
		//header("Location:notification.php");
	} 

 

	$alert = "";
	$accept = "";
	$decline = "";


	if (isset($_POST['accept'])) {
		 $name = $_POST['accept'];
		  $accept = $_POST['accept'];
		  $groupname = $_POST['add_this_group'];
		  //echo $groupname;

		$sql = "insert into group_members_list value(0,'$name','$groupname')";
		$result = mysql_query($sql);
		if ($result) {
			header("Location:notification.php");
			$alert = "$name  added successfully to $groupname";
		}
	}
		if (isset($_POST['decline'])) {
		$decline = "decline";
	}

	?>

	<?php if ($alert) {
		?>
		<div class="output clear">
			<p><?php echo $alert;?></p>
		</div>
		<?php 
	} ?>
       
	   <div class="notification_main clear">
	   	<p>Notifications</p>
	<?php 

	$sql = "select * from notification where notified_to = '{$_SESSION['username']}' order by id desc ";
    $result = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($result)>0) {
    	while ($arr = mysql_fetch_array($result)) {
    		$by = $arr['notified_by'];//user who request to add or join
    		$g_name = $arr['groupname'];
    		$text = $arr['notification'];
    		$_SESSION['notification-id']=$arr['id'];
    		//echo $_SESSION['notification-id'];

    		//retrive the  id of this group page where the post occur and go to it
              
              $q = "select id from social_groups where groupname = '$g_name'";
              $r = mysql_query($q) or die(mysql_error());
              $row = mysql_fetch_array($r);
              $g_id = $row['id'];

             ?>
            <div class="notification_box clear">
            	<form method="post" enctype="multipart/form-data">
            	<?php if (!strcmp($text, "Request to join your group")){
            		$_SESSION['text'] = "Request to join your group";?>
                    
                    <input  type="hidden" name="text" value="<?php echo $_SESSION['text']?>" formaction ="accept_group.php">
            		<p><button type = "submit" name="accept_decline-btn1" formaction="accept_group.php " value="<?php echo $_SESSION['notification-id']; ?>"><?php echo $by." ".$text."  ".$g_name;?></p>

            	<?php 
                  

            	}elseif(!strcmp($text, "wish to add you")) {
            		$_SESSION['text'] = "wish to add you";?>
                    
                    <input  type="hidden" name="text" value="<?php echo $_SESSION['text']?>" formaction ="accept_group.php">
            	
            		<p><button type = "submit" name="accept_decline-btn2" formaction="accept_group.php " value="<?php echo $_SESSION['notification-id']; ?>"><?php echo $by." ".$text." group ".$g_name;?></p>
            <?php	}elseif (!strcmp($text, "suggest you")) {?>

            <p><button><?php echo $by." ".$text." group ".$g_name;?></button></p>
               <?php 

            } else {?>

           <p><button  type = "submit" name="posts_not-btn" formaction="postpage.php" value="<?php echo $g_name ?>"><?php echo $by." ".$text." group ".$g_name;?></button></p>
           <?php }?>
       </form>
         </div>
         <!--div class="notification_box clear">
         	<form action="accept_group.php" method="post">
         		<p><button type="hidden" name="member_name" value="<?php //echo "$by";?>"></button></p>
         		<p><button type="submit" name="not-btn" value="<?php //echo "g_name;"?>"><?php //echo $by.$text.$g_name; ?></button></p>
         	</form>
         </div-->
                   <?php 
        }
    	}else echo "no notification to show";

?>

</div>


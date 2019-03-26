<?php 
session_start();
include("./inc/header.inc.php") ; 
include("./inc/connection.php");
include("./inc/navsection.php");


//notification
if (isset($_POST['add_member-btn'])) {
  $username = $_POST['add_member-btn'];
  $notification ="wish to add you";
   $sql = "insert into notification values ('','{$_SESSION['username']}','$username',$notification,'{$_SESSION['gname']}',NOW(),'0')";
   $result = mysql_query($sql);
   if ($result) {
    $output = "Request sent ";
    echo $output;
   }
}
//header("Refresh:1");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>social/postpage/addmembers</title>
 	<link rel="stylesheet" type="text/css" href="./css/postpage1.css">
 </head>
 <body>
 


 <div class="add_members_main clear" clear="both" ">

        <div class="header_section">
  <p><i class="fa fa-users" aria-hidden="true" style="color: green;"></i><?php echo " ".$_SESSION['gname'] ?></p>
  <h3><i class="fa fa-lock"> secret group</i></h3>
</div>

 
 <div class="all_members_list clear" >
   <?php 


    /*  $q = "select users.username,group_members_list.name from users,group_members_list  where users.username !='{$_SESSION['username']}'
      and group_members_list.groupname != '{$_SESSION['gname']}'";
      $r = mysql_query($q) or die(mysql_error());
      
      while ($arr = mysql_fetch_array($r)) {
             if($arr['username']== $arr['name'])
              $user = $arr['username'];*/


       
       	   $query = "select username from users where username!='{$_SESSION['username']}'";
       	   $result = mysql_query(
       	   	$query);
       	   while ($arr = mysql_fetch_array($result)) {
       	   	   $user1 = $arr['username'];
       	   	   //echo "$user<br>";
       	   	   // make a list of memebers who are not the member of this gruop by checking the member table

       	   	   $sql = "select name from group_members_list where group_members_list.groupname != '{$_SESSION['gname']}' AND group_members_list.name = '$user1'";

       	   	   $res = mysql_query($sql) or die(mysql_error());
               $row = mysql_fetch_array($res);
               $user = $row['name'];
       	   	  // while ($ar = mysql_fetch_array($res)) {
       	   	   	    // $user2 = $ar['name'];

                    // if($user1==$user2)
                      //$user = $user1;
       	   	   	     //echo "$user<br>";
       	   	   
       	   	   ?>
              <p><?php if($user) {echo $user; ?></p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
              <button name="add_member-btn" type="submit" value="<?php echo "$user";?>"><i class="fa fa-plus" style="border-radius: 60px;background: #fff;color: #466C53"></i> Add</button>


          </form>
       
       	   	   <?php
             }
             //}
       	   }
       
    ?>
   

   </div>
 	
 </div>

 </body>
 </html>
<?php 

// activating the activated option for chat box

$u = "update users set activated = '1' where id = '{$_SESSION['id']}'";
$q = mysql_query($u) or die(mysql_error());
?>


<!DOCTYPE html>
<html>
<head>
	<title>pustcon/social</title>
	
</head>
<body>

</body>
</html>

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
       echo "no person in online";
   }


    ?>
  </div>
</div>
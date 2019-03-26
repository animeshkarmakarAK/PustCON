<?php //include("./inc/header.inc.php") ;
include("./inc/connection.php");

$alert = "";
// .... for trim function .......
function trim_value($value){
  return (strip_tags (htmlspecialchars(trim($value))));
}


if(isset($_POST['reg']))
{
$fn = trim_value($_POST['fname']);
$ln = trim_value($_POST['lname']);
$un = trim_value($_POST['uname']);
$email = trim_value($_POST['email']);
$pass1 = trim_value($_POST['password1']);
$pass2= trim_value($_POST['password2']);
if($fn && $ln && $un && $email && $pass1 && $pass2){
$ucheck = "select username from users where username = '$un'";
$result = mysql_query($ucheck);
$num = mysql_num_rows($result);
if($num == 0){

  $echeck = "select email from users where username = '$un'";
$result = mysql_query($ucheck);
$num = mysql_num_rows($result);
if($num == 0){
if ($pass1 == $pass2) {
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
if((strlen($fn)>0&&strlen($fn<25)) || (strlen($ln)>0&&strlen($ln<25)) || (strlen($ln)>0&&strlen($ln<25))){
if(strlen($pass1)>5 && strlen($pass1)<15 ){
//insert valuse to the tabel of database
$query="insert into users values (0,'$fn','$ln','$un','$email','$pass1',NOW(),'0')";
$result=mysql_query($query)
or die("Error in pushing".mysql_error());

if($result){
echo "<h2>Welcome to PustCON</h2>   login to get stared";
header("Location:index.php");
echo "<h2>Welcome to PustCON</h2>   login to get stared";}
}else $alert = "password should be in 6 to 15 characters";
}else $alert = "firstname/lastname/username should be in 1 to 25 character";
}else $alert =  "Invalid email address";
}else $alert =  "password mismatched";
}else $alert =  "Email already exist";
}else $alert =  "username already exists";
}else $alert =  "all the fields should be filled";

}
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="./css/indexstyle.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
  </head>
  <body>
    <div class="header clear">
      <h2>PustCON</h2>
    </div>
    <div class="nav clear">
      
      <a href="index.php">LogIn!</a>
    </div>
  
  <?php
   if($alert){ ?>
     <div class="alart-output " clear = "both">
       <p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><?php 
       echo $alert; 
       }?></p>

     </div>
    <div class="signup_form " clear="both">
     

        <h2>sign up below</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" autocomplete="on">
          <table>
            <tr><td><strong>First Name: </strong></td></tr>
            <tr><td><input type="text" name="fname" placeholder=" First Name"></td></tr>
            <tr><td><strong>Last Name: </strong></td></tr>
            <tr><td><input type="text" name="lname" placeholder=" Last Name"></td></tr>
            <tr><td><strong>User Name: </strong></td></tr>
            <tr><td><input type="text" name="uname" placeholder=" User Name"></td></tr>
            <tr><td><strong>Email Address: </strong></td></tr>
            <tr><td><input type="text" name="email" placeholder=" Email Address"></td></tr>
            <tr><td><strong>Password: </strong></td></tr>
            <tr><td><input type="password" name="password1" placeholder=" password(At least 6 character)"></td></tr>
            <tr><td><strong>Repeat Password: </strong></td></tr>
            <tr><td><input type="Password" name="password2" placeholder=" Repeat password"></td></tr>
          <tr></tr>
          <tr><td><input type="submit" name="reg" value="sign up!"></td></tr>
          
        </table>
      </form>
    </div>
  </div>
</body>
</html>